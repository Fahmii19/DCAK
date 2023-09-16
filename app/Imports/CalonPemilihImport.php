<?php

namespace App\Imports;

use App\Models\CalonPemilih;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Log;


class CalonPemilihImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        Log::info($row);
        try {
            return new CalonPemilih([
                'nama_pemilih' => isset($row[0]) ? strtoupper($row[0]) : 'N/A',
                'nik' => isset($row[1]) ? $row[1] : 'N/A',
                'jenis_kelamin' => isset($row[2]) ? $row[2] : 'N/A',
                'no_hp' => isset($row[3]) ? $row[3] : 'N/A',
                'rt' => isset($row[4]) ? $row[4] : 'N/A',
                'rw' => isset($row[5]) ? $row[5] : 'N/A',
                'tps' => isset($row[6]) ? $row[6] : 'N/A',
                'kelurahan' => isset($row[7]) ? strtoupper($row[7]) : 'N/A'
            ]);
        } catch (\Exception $e) {
            // Hanya abaikan error dan lanjutkan
        }
    }
}
