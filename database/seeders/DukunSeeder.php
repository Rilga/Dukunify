<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Dukun;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DukunSeeder extends Seeder
{
    public function run(): void
    {
        $categoryIds = Category::pluck('id');

        $dukun1 = Dukun::create([
            'kode_dukun' => 'DKN-001',
            'nama_dukun' => 'Ki Rogo Sejati',
            'description' => 'Spesialis penerawangan dan penyembuhan.',
            'harga' => 150000,
            'status' => 'available',
        ]);

        $dukun1->categories()->attach([$categoryIds[0], $categoryIds[1]]);


        $dukun2 = Dukun::create([
            'kode_dukun' => 'DKN-002',
            'nama_dukun' => 'Eyang Subur',
            'description' => 'Spesialis konsultasi dan pesugihan.',
            'harga' => 500000,
            'status' => 'available',
        ]);

        $dukun2->categories()->attach([$categoryIds[2], $categoryIds[3]]);

        $dukun3 = Dukun::create([
            'kode_dukun' => 'DKN-003',
            'nama_dukun' => 'Mbah Maridjan',
            'description' => 'Spesialis konsultasi metafisika.',
            'harga' => 100000,
            'status' => 'available',
        ]);
         // Lampirkan kategori (Konsultasi)
        $dukun3->categories()->attach([$categoryIds[2]]);
    }
}