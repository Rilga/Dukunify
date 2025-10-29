<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create(['name' => 'Penerawangan', 'description' => 'Jasa terkait melihat masa depan atau hal gaib.']);
        Category::create(['name' => 'Penyembuhan', 'description' => 'Jasa terkait penyembuhan penyakit non-medis.']);
        Category::create(['name' => 'Konsultasi Metafisika', 'description' => 'Jasa konsultasi spiritual dan energi.']);
        Category::create(['name' => 'Pesugihan', 'description' => 'Jasa terkait ritual kekayaan.']);
    }
}