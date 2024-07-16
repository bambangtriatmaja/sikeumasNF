<?php

namespace App\Imports;

use App\Models\DanaMasuk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class DanaMasukImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DanaMasuk([
            'tanggal' => \Carbon\Carbon::parse($row['tanggal'])->format('Y-m-d'),
            'nominal' => $row['nominal'],
            'keterangan_pemasukan' => $row['keterangan_pemasukan'],
        ]);
    }

    public function rules(): array
    {
        return [
            '*.tanggal' => 'required|date',
            '*.nominal' => 'required|numeric',
            '*.keterangan' => 'nullable|string',
        ];
    }

    public function startRow(): int
    {
        return 2;
    }
}
