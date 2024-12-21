<?php

namespace App\Imports;

use App\Models\Asset;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class AssetsImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            Asset::create([
                'asset_tag'      => $row[0],
                'asset_name'     => $row[1],
                'asset_unit_id'  => $row[2],
                'belong_to_user' => $row[3],
                'asset_location' => $row[4],
                'delivery_date'  => $row[5],
            ]);
        }
    }
}
