<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MataKuliah;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MataKuliah::create([
            'nama_mk' => 'Pemrograman Web Lanjut',
            'sks' => 3,
        ]);

        MataKuliah::create([
            'nama_mk' => 'Data Mining',
            'sks' => 3,
        ]);
    }
}