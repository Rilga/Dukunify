<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingReportController extends Controller
{
    public function activeBookings()
    {
        $activeBookings = Booking::with(['user', 'dukun'])
            ->whereIn('status', ['aktif', 'pending_completion'])
            ->orderBy('tanggal_selesai_sewa', 'asc')
            ->paginate(10);

        return view('admin.reports.active', compact('activeBookings'));
    }

    public function historyBookings(Request $request)
    {
        $query = $this->buildHistoryQuery($request);

        $historyBookings = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.reports.history', compact('historyBookings'));
    }

    public function printHistory(Request $request)
    {
        $query = $this->buildHistoryQuery($request);

        $historyBookings = $query->orderBy('created_at', 'desc')->get();

        return view('admin.reports.print', compact('historyBookings'));
    }

    private function buildHistoryQuery(Request $request)
    {
        $query = Booking::with(['user', 'dukun']);

        if ($request->filled('search_user')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('search_user') . '%');
            });
        }

        if ($request->filled('search_status')) {
            $query->where('status', $request->input('search_status'));
        }

        if ($request->filled('start_date')) {
            $query->whereDate('tanggal_mulai_sewa', '>=', $request->input('start_date'));
        }

        if ($request->filled('end_date')) {
            $query->whereDate('tanggal_selesai_sewa', '<=', $request->input('end_date'));
        }

        return $query;
    }

    public function show(Booking $booking)
    {
        $booking->load(['user', 'dukun.categories']);

        return view('admin.reports.show', compact('booking'));
    }

    public function confirmPayment(Booking $booking)
    {
        if ($booking->status !== 'menunggu_konfirmasi_pembayaran') {
            return redirect()->back()->with('error', 'Status pembayaran ini tidak valid untuk dikonfirmasi.');
        }

        $booking->status = 'selesai';
        $booking->save();

        return redirect()->route('admin.reports.history')->with('success', 'Pembayaran berhasil dikonfirmasi. Transaksi telah selesai.');
    }
}