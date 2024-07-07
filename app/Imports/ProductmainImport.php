<?php

namespace App\Imports;

use App\inventory\Product_stockModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\inventory\ProductdetailslistModel;


class ProductmainImport implements ToCollection, WithStartRow
{

    public function startRow(): int
    {
        return 2;
    }

    
    public function collection(Collection $rows)
    {
 foreach ($rows as $row) 
        {

      $node = ProductdetailslistModel::create([
                     
                             'product_name' => $row[0],
                             'description' => $row[1],
                             'product_type' => $row[2],
                             'category' => $row[3],
                             'unit' => $row[4],
                             'product_code' => $row[5],
                             'sku' => $row[6],
                             'barcode' => $row[7],
                             'selling_price' => $row[8],
                             'provider_id' => $row[9],
                             'manufacturer' => $row[10],
                             'brand' => $row[11],
                             'inventory_type' => $row[12],
                             'available_stock' => $row[13],
                             'opening_stock' => $row[13],
                             'part_no' => $row[14],
                             'model_no' => $row[15],
                             'serial_number' => $row[16],
                             'hsn_code' => $row[17],
                             'lotno' => $row[18],
                             'countryoforigin' => $row[19],
                             'cfds' => $row[20],
                             'reference' => $row[21],
                            'catno' => $row[22],
                            'enable_minus_stock_billing' => $row[23],
                            'reorder_quantity_alert' => $row[24],
                            'maintain_batches' => $row[25],
                            'manufacturing_date' => $row[26],
                            'expiry_date' => $row[27],
                            'warranty_date' => $row[28],
                            'warranty_reminder' => $row[29],
                            'warehouse'=> $row[30],

                               ]);

//dd($node);

            // $pnode = Product_stockModel::create([
            //      'product_id' => $node->product_id,
            //                  'product_name' => $row[0],
            //                  'description' => $row[1],
            //                  'product_type' => $row[2],
            //                  'category' => $row[3],
            //                  'unit' => $row[4],
            //                  'product_code' => $row[5],
            //                  'sku' => $row[6],
            //                  'barcode' => $row[7],
            //                  'selling_price' => $row[8],
            //                  'provider_id' => $row[9],
            //                  'manufacturer' => $row[10],
            //                  'brand' => $row[11],
            //                  'inventory_type' => $row[12],
            //                  'opening_stock' => $row[13],
            //                  'part_no' => $row[14],
            //                  'model_no' => $row[15],
            //                  'serial_number' => $row[16],
            //                  'hsn_code' => $row[17],
            //                  'lotno' => $row[18],
            //                  'countryoforigin' => $row[19],
            //                  'cfds' => $row[20],
            //                  'reference' => $row[21],
            //                 'catno' => $row[22],
            //                 'enable_minus_stock_billing' => $row[23],
            //                 'reorder_quantity_alert' => $row[24],
            //                 'maintain_batches' => $row[25],
            //                 'manufacturing_date' => $row[26],
            //                 'expiry_date' => $row[27],
            //                 'warranty_date' => $row[28],
            //                 'warranty_reminder' => $row[29],
            //                 'warehouse'=> $row[30],

            //                    ]);





        }
    }
}