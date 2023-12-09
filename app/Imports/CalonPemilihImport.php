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
                'nik'            => isset($row[0]) ? $row[0] : 'Tidak Ada',
                'nama_pemilih'   => isset($row[1]) ? strtoupper($row[1]) : 'Tidak Ada',
                'jenis_kelamin'  => isset($row[2]) ? $row[2] : 'Tidak Ada',
                'no_hp'          => isset($row[3]) ? $row[3] : 'Tidak Ada',
                'rt'             => isset($row[4]) ? $row[4] : 'Tidak Ada',
                'rw'             => isset($row[5]) ? $row[5] : 'Tidak Ada',
                'tps'            => isset($row[6]) ? $row[6] : 'Tidak Ada',
                'kelurahan'      => isset($row[7]) ? strtoupper($row[7]) : 'Tidak Ada',
            ]);
        } catch (\Exception $e) {
            // Hanya abaikan error dan lanjutkan
        }
    }
}
