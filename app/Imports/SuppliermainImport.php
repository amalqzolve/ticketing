<?php

namespace App\Imports;

use App\inventory\Product_stockModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\inventory\ProductdetailslistModel;
use App\crm\CustomerModel;
use App\crm\SupplierModel;
use Session;

class SuppliermainImport implements ToCollection, WithStartRow
{

    public function startRow(): int
    {
        return 3;
    }

    
    public function collection(Collection $rows)
    {
               $branch=Session::get('branch');
 foreach ($rows as $row) 
        {

      $node = SupplierModel::create([
                     
           

                             'sup_category' => $row[0],
                             'sup_code' => $row[1],
                             'sup_type' => $row[2],
                            // 'cust_group' => $row[3],
                             'key_account' => $row[4],
                             'salesman' => $row[5],
                             'sup_name' => $row[6],
                             'sup_add1' => $row[7],
                             'sup_add2' => $row[8],
                             'sup_region' => $row[9],
                             'sup_state' => $row[10],
                             'sup_city' => $row[11],
                             'sup_country' => $row[12],
                             'sup_zip' => $row[13],
                             'additionalno' => $row[14],
                             'vatno' => $row[15],
                             'buyerid_crno' => $row[16],
                             'sup_name_ar' => $row[17],
                            // 'building_no' => $row[18],
                             'sup_add1_ar' => $row[19],
                             'sup_add2_ar' => $row[20],
                             'sup_state_ar' => $row[21],
                             'sup_city_ar' => $row[22],
                             'sup_country_ar' => $row[23],
                             'sup_zip_ar' => $row[24],
                             'additionalno_ar' => $row[25],
                             'vatno_ar' => $row[26],
                             'buyerid_crno_ar' => $row[27],
                             'email1' => $row[28],
                             'email2' => $row[29],
                             'office_phone1' => $row[30],
                             'office_phone2' => $row[31],
                             'mobile1' => $row[32],
                             'mobile2' => $row[33],
                             'fax' => $row[34],
                             'website' => $row[35],
                             'branch'=>$branch,

                               ]);





        }
    }
}