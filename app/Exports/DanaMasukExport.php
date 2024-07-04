<?php

namespace App\Exports;

use App\Models\DanaMasuk;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DanaMasukExport implements FromQuery, WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return DanaMasuk::query()->select('tanggal', 'nominal', 'ket_pemasukan');
    }
    
    public function headings(): array
    {
        return [
            'Tanggal',
            'Nominal',
            'Keterangan Pemasukan',
        ];
    }
}
