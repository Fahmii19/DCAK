<?php

namespace App\Imports;

use App\Models\SaksiTps;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Log;

class SaksiTpsImport implements ToModel, WithStartRow
{
    private $images;

    public function __construct($images)
    {
        $this->images = $images;
    }

    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        Log::info($row);

        // Here you need a logic to associate each row of data with the correct image
        // For simplicity, I'm just using the first image for every row of data
        $imageFile = $this->images[0] ?? null;

        try {
            return new SaksiTps([
                'nik'          => $row[0] ?? null,
                'no_hp'        => $row[1] ?? null,
                'rt'           => $row[2] ?? null,
                'rw'           => $row[3] ?? null,
                'kelurahan'    => isset($row[4]) ? strtoupper($row[4]) : null,
                'kecamatan'    => isset($row[5]) ? strtoupper($row[5]) : null,
                'jumlah_suara' => $row[6] ?? null,
                'gambar'       => basename($imageFile), // Store only the image name
            ]);
        } catch (\Exception $e) {
            Log::error("Error importing row: " . $e->getMessage());
            Log::error($e->getTraceAsString());
        }
    }
}
