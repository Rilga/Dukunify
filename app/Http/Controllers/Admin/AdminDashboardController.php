<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; // <-- Tambah ini
use App\Models\Booking;
use App\Models\Dukun;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // <-- Tambah ini

class AdminDashboardController extends Controller
{
    public function index(Request $request) 
    {
        $persetujuanCount = Booking::whereIn('status', [
                                        'pending_completion', 
                                        'menunggu_konfirmasi_pembayaran'
                                    ])->count();
        $bookingAktifCount = Booking::where('status', 'aktif')->count();
        $riwayatCount = Booking::where('status', 'selesai')->count();

        $totalDukun = Dukun::count();
        $totalKlien = User::where('role', 'user')->count();

        $revenueFilter = $request->input('revenue_filter', 'all'); 
        $pendapatanQuery = Booking::where('status', 'selesai');

        if ($revenueFilter === 'week') {
            $pendapatanQuery->whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($revenueFilter === 'month') {
             $pendapatanQuery->whereBetween('updated_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
        }

        $totalPendapatan = $pendapatanQuery->sum(DB::raw('total_harga + denda'));

        return view('admin.dashboard', compact(
            'persetujuanCount',
            'bookingAktifCount',
            'riwayatCount', 
            'totalDukun',
            'totalKlien',
            'totalPendapatan',
            'revenueFilter' 
        ));
    }
}