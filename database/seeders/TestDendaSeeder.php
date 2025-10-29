<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Dukun;
use App\Models\Booking;
use Carbon\Carbon; 

class TestDendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $klien = User::where('email', 'klien@dukunify.com')->first();
        $dukun = Dukun::where('kode_dukun', 'DKN-001')->first();

        if (!$klien || !$dukun) {
            $this->command->error('Data Klien (klien@dukunify.com) atau Dukun (DKN-001) tidak ditemukan.');
            $this->command->error('Pastikan Anda sudah menjalankan UserSeeder dan DukunSeeder.');
            return;
        }

        Booking::where('kode_transaksi', 'TEST-DENDA-001')->delete();

        
        $tglMulai = Carbon::now()->subDays(5);
        $tglSelesai = Carbon::now()->subDays(3);
        $tglPengajuan = Carbon::now()->subDay();  

        Booking::create([
            'kode_transaksi' => 'TEST-DENDA-001',
            'user_id' => $klien->id,
            'dukun_id' => $dukun->id,
            'tanggal_mulai_sewa' => $tglMulai,
            'tanggal_selesai_sewa' => $tglSelesai,
            'tanggal_pengajuan_pengembalian' => $tglPengajuan, 
            'tanggal_pengembalian' => null, 
            'total_harga' => $dukun->harga,
            'denda' => 0,
            'status' => 'pending_completion',
        ]);

        $this->command->info('===================================================');
        $this->command->info('Seeder Tes Denda Berhasil Dijalankan!');
        $this->command->info('Booking ' . $tglSelesai->format('d M Y') . ' diajukan ' . $tglPengajuan->format('d M Y'));
        $this->command->info('===================================================');
    }
}