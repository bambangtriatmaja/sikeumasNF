<?php

namespace App\Exports;

use App\Models\DanaKeluar;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DanaKeluarExport implements FromQuery, WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return DanaKeluar::query()->select('tanggal', 'nominal', 'ket_pengeluaran');
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Nominal',
            'Keterangan Pengeluaran',
        ];
    }
}
