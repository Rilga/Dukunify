<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Models\Dukun;
use App\Models\Booking;
use Carbon\Carbon; 

class BookingController extends Controller
{
    
    public function index()
    {
        $user = Auth::user();

        $activeBookings = $user->bookings()
                            ->with('dukun')
                            ->whereIn('status', ['aktif', 'pending_completion'])
                            ->orderBy('tanggal_mulai_sewa', 'asc')
                            ->get();

        $historyBookings = $user->bookings()
                            ->with('dukun')
                            ->whereIn('status', ['selesai', 'menunggu_pembayaran_denda'])
                            ->orderBy('tanggal_selesai_sewa', 'desc')
                            ->paginate(10);

        return view('bookings.index', compact('activeBookings', 'historyBookings'));
    }
    
    
    public function store(Request $request)
    {
        $user = Auth::user();
        $cartItems = $user->carts()->with('dukun')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        $request->validate([
            'tanggal_mulai_sewa' => 'required|date|after_or_equal:today',
            'tanggal_selesai_sewa' => 'required|date|after_or_equal:tanggal_mulai_sewa',
        ]);

        $tanggalMulai = Carbon::parse($request->input('tanggal_mulai_sewa'))->startOfDay(); 
        $tanggalSelesai = Carbon::parse($request->input('tanggal_selesai_sewa'))->startOfDay(); 

        $durasiHari = $tanggalMulai->diffInDays($tanggalSelesai) + 1;

        if ($durasiHari > 5) {
            return redirect()->back()->withErrors([
                'tanggal_selesai_sewa' => 'Durasi sewa tidak boleh lebih dari 5 hari.'
            ])->withInput();
        }

        $activeBookingsCount = $user->bookings()->whereIn('status', ['aktif', 'pending_completion', 'menunggu_pembayaran_denda', 'menunggu_konfirmasi_pembayaran'])->count(); // Cek semua status non-final
        if (($activeBookingsCount + $cartItems->count()) > 2) {
            return redirect()->route('cart.index')->with('error', 'Gagal! Anda sudah mencapai batas maksimal 2 unit sewa aktif/tertunda.');
        }

        $dukunsNotAvailable = [];
        foreach ($cartItems as $item) {
            $isAvailable = $this->checkDukunAvailability($item->dukun_id, $tanggalMulai, $tanggalSelesai);
            if (!$isAvailable) {
                $dukunsNotAvailable[] = $item->dukun->nama_dukun;
            }
        }

        if (!empty($dukunsNotAvailable)) {
            $namaDukun = implode(', ', $dukunsNotAvailable);
            return redirect()->back()->withErrors([
                'tanggal_mulai_sewa' => "Maaf, Dukun ($namaDukun) tidak tersedia pada rentang tanggal tersebut. Silakan pilih tanggal lain."
            ])->withInput();
        }

        DB::beginTransaction();
        try {
            
            foreach ($cartItems as $item) {
                $totalHarga = $item->dukun->harga * $durasiHari;

                Booking::create([
                    'kode_transaksi' => 'DKN-' . time() . '-' . $user->id . $item->dukun_id . rand(100,999),
                    'user_id' => $user->id,
                    'dukun_id' => $item->dukun_id,
                    'tanggal_mulai_sewa' => $tanggalMulai,
                    'tanggal_selesai_sewa' => $tanggalSelesai,
                    'total_harga' => $totalHarga,
                    'status' => 'aktif',
                ]);
            }

            $user->carts()->delete();

            DB::commit();

            return redirect()->route('booking.index')->with('success', 'Booking berhasil! Silakan selesaikan sesi sebelum tanggal selesai sewa.');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Booking Error: ' . $e->getMessage() . ' Trace: ' . $e->getTraceAsString()); 
            return redirect()->route('cart.index')->with('error', 'Terjadi kesalahan saat proses booking. Silakan coba lagi. Error: '.$e->getMessage());
        }
    }

    public function requestCompletion(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Aksi tidak diizinkan.');
        }

        if ($booking->status !== 'aktif') {
            return redirect()->back()->with('error', 'Gagal! Pengajuan ini sudah pernah dilakukan atau tidak valid.');
        }

        $booking->status = 'pending_completion';
        $booking->tanggal_pengajuan_pengembalian = now(); 
        $booking->save();
        return redirect()->route('booking.index')->with('success', 'Berhasil mengajukan penyelesaian. Mohon tunggu persetujuan Admin.');
    }

    public function payDenda(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Aksi tidak diizinkan.');
        }

        if ($booking->status !== 'menunggu_pembayaran_denda') {
            return redirect()->back()->with('error', 'Tagihan denda ini tidak valid atau sudah dibayar.');
        }

        $booking->status = 'selesai';
        $booking->save();

        return redirect()->route('booking.index')->with('success', 'Pembayaran denda telah berhasil. Transaksi Anda kini telah selesai.');
    }

    public function show(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }
        
        $booking->load(['user', 'dukun.categories']);

        return view('bookings.show', compact('booking'));
    }

    private function checkDukunAvailability($dukunId, Carbon $mulai, Carbon $selesai)
    {
        $existingBookings = Booking::where('dukun_id', $dukunId)
            ->where('status', 'aktif')
            ->where(function ($query) use ($mulai, $selesai) {
                $query->where(function ($q) use ($mulai, $selesai) {
                    $q->where('tanggal_mulai_sewa', '<=', $mulai)
                      ->where('tanggal_selesai_sewa', '>=', $mulai);
                })->orWhere(function ($q) use ($mulai, $selesai) {
                    $q->where('tanggal_mulai_sewa', '<=', $selesai)
                      ->where('tanggal_selesai_sewa', '>=', $selesai);
                })->orWhere(function ($q) use ($mulai, $selesai) {
                    $q->where('tanggal_mulai_sewa', '>=', $mulai)
                      ->where('tanggal_selesai_sewa', '<=', $selesai);
                });
            })->count();

        return $existingBookings === 0;
    }

}