<?php

namespace App\Imports;

use App\Models\CalonPemilih;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CalonPemilihImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        try {
            return new CalonPemilih([
                'nik' => isset($row[0]) ? $row[0] : 'N/A',
                'nama_pemilih' => isset($row[1]) ? $row[1] : 'N/A',
                'no_hp' => isset($row[2]) ? $row[2] : 'N/A',
                'rt' => isset($row[3]) ? $row[3] : 'N/A',
                'rw' => isset($row[4]) ? $row[4] : 'N/A',
                'tps' => isset($row[5]) ? $row[5] : 'N/A'
            ]);
        } catch (\Exception $e) {
            // Hanya abaikan error dan lanjutkan
        }
    }
}
