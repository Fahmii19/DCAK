<?php

namespace App\Imports;

use App\Models\SaksiTps;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Log;

class SaksiTpsImport implements ToModel, WithStartRow
{
    private $images;
    private $rowIndex = 0;  // Initialize rowIndex

    public function __construct($images)
    {
        $this->images = $images;
    }

    public function startRow(): int
    {
        return 2;  // Adjust as per your excel structure
    }

    public function model(array $row)
    {
        Log::info($row);

        // Check if there are images, if not set to null
        $imageFile = $this->images[$this->rowIndex] ?? null;
        $this->rowIndex++;  // Increment rowIndex for each row
        Log::info('Image File: ' . $imageFile);

        try {
            return new SaksiTps([
                'nik' => $row[0] ?? null,
                'no_hp' => $row[1] ?? null,
                'rt' => $row[2] ?? null,
                'rw' => $row[3] ?? null,
                'kelurahan' => isset($row[4]) ? strtoupper($row[4]) : null,
                'kecamatan' => isset($row[5]) ? strtoupper($row[5]) : null,
                'jumlah_suara' => $row[6] ?? null,
                'gambar' => $imageFile ? basename($imageFile) : null,  // Set to null if no image
            ]);
        } catch (\Exception $e) {
            Log::error("Error importing row: " . $e->getMessage());
            Log::error($e->getTraceAsString());
        }
    }
}
