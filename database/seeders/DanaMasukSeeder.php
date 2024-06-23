<?php

namespace Database\Seeders;

use App\Models\DanaMasuk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DanaMasukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DanaMasuk::create([
            'id' => 1,
            'tanggal' => '2024-06-20',
            'nominal' => '500000'
        ]);
        DanaMasuk::create([
            'id' => 2,
            'tanggal' => '2024-06-21',
            'nominal' => '600000'
        ]);
    }
}
