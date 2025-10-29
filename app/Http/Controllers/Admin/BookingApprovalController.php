<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingApprovalController extends Controller
{
    public function index()
    {
        $pendingBookings = Booking::with(['user', 'dukun'])
                                ->whereIn('status', [
                                    'pending_completion',             
                                    'menunggu_pembayaran_denda',   
                                    'menunggu_konfirmasi_pembayaran' 
                                ])
                                ->orderBy('updated_at', 'asc')
                                ->paginate(10);
            
        return view('admin.approvals.index', compact('pendingBookings'));
    }

    public function approve(Booking $booking)
    {
        if ($booking->status !== 'pending_completion') {
            return redirect()->back()->with('error', 'Status booking tidak valid untuk disetujui.');
        }

        $tglSelesaiSewa = $booking->tanggal_selesai_sewa;
        $tglPengajuan = $booking->tanggal_pengajuan_pengembalian;
        
        $batasSelesaiTimestamp = $tglSelesaiSewa->startOfDay()->getTimestamp();
        $pengajuanTimestamp = $tglPengajuan->startOfDay()->getTimestamp();

        $denda = 0;
        $tarifDendaPerHari = 50000;
        
        if ($pengajuanTimestamp > $batasSelesaiTimestamp) {
            $selisihDetik = $pengajuanTimestamp - $batasSelesaiTimestamp;
            $keterlambatanHari = ceil($selisihDetik / 86400); 
            $denda = $keterlambatanHari * $tarifDendaPerHari;
        }
        
        $booking->tanggal_pengembalian = Carbon::today();
        
        if ($denda > 0) {
            $booking->denda = $denda;
            $booking->status = 'menunggu_pembayaran_denda';
        } else {
            $booking->denda = 0;
            $booking->status = 'selesai';
        }
        
        $booking->save();
        
        if ($denda > 0) {
            return redirect()->route('admin.approvals.index')->with('success', 'Booking disetujui dengan DENDA Rp ' . number_format($denda) . '. Menunggu Klien membayar denda.');
        } else {
            return redirect()->route('admin.approvals.index')->with('success', 'Booking disetujui tanpa denda. Status diubah menjadi "Selesai".');
        }
    }

    public function confirmPayment(Booking $booking)
    {
        if ($booking->status !== 'menunggu_konfirmasi_pembayaran') {
            return redirect()->back()->with('error', 'Status pembayaran ini tidak valid untuk dikonfirmasi.');
        }

        $booking->status = 'selesai';
        $booking->save();

        return redirect()->route('admin.approvals.index')->with('success', 'Pembayaran berhasil dikonfirmasi. Transaksi telah selesai.');
    }
}