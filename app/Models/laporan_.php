<?php

namespace App\Models;

class laporan
{
    private static $laporans_keuangan = [
        [
            "jenis_rekening" => "Operasional",
            "saldo_sebelumnya" => "Rp.500.000,-",
            "dana_masuk" => "Rp.500.000,-",
            "dana_keluar" => "Rp.300.000",
            "saldo_saat_ini" => "Rp.700.000"
        ],[
            "jenis_rekening" => "Infaq",
            "saldo_sebelumnya" => "Rp.800.000,-",
            "dana_masuk" => "Rp.200.000,-",
            "dana_keluar" => "Rp.0",
            "saldo_saat_ini" => "Rp.1.000.000"
        ], [
            "jenis_rekening" => "Wakaf",
            "saldo_sebelumnya" => "Rp.1.000.000,-",
            "dana_masuk" => "Rp.500.000,-",
            "dana_keluar" => "Rp.1.000.000",
            "saldo_saat_ini" => "Rp.500.000"
        ]
        ];

        public static function all(){
            return collect(self::$laporans_keuangan);
        }
}
