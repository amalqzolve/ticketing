<?php

namespace App\Imports;

use App\Asset;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;



class AssetmainImport implements ToCollection, WithStartRow
{

    public function startRow(): int
    {
        return 2;
    }

    
    public function collection(Collection $rows)
    {
 foreach ($rows as $row) 
        {

        $node = Asset::create([
                             'asset_name' => $row[0],
                             'asset_type' => $row[1],
                             'consumable' => $row[2],
                             'asset_code' => $row[3],
                             'barcode' => $row[4],
                             'tag' => $row[5],
                             'inv_type' => $row[6],
                             'asgroup' => $row[7],
                             'category' => $row[8],
                             'warehouse' => $row[9],
                             'type' => $row[10],
                             'store' => $row[11],
                             'rack' => $row[12],
                             'unit' => $row[13],
                             'manufaturer' => $row[14],
                             'supplier' => $row[15],
                             'brand' => $row[16],
                             'asset_cost' => $row[17],
                             'barcodeformat' => $row[18],
                             'slno' => $row[19],
                             'modelno' => $row[20],
                             'partno' => $row[21],
                             'hsncode' => $row[22],
                             'upc' => $row[23],
                             'ean' => $row[24],
                             'jan' => $row[25],
                             'isbn' => $row[26],
                             'mpn' => $row[27],
                               ]);


        }
    }
}