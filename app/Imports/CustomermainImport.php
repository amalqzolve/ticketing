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

class CustomermainImport implements ToCollection, WithStartRow
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

      $node = CustomerModel::create([

                             'cust_category' => $row[0],
                             'cust_code' => $row[1],
                             'cust_type' => $row[2],
                             'cust_group' => $row[3],
                             'key_account' => $row[4],
                             'salesman' => $row[5],
                             'cust_name' => $row[6],
                             'cust_add1' => $row[7],
                             'cust_add2' => $row[8],
                             'cust_region' => $row[9],
                             'province_state' => $row[10],
                             'cust_city' => $row[11],
                             'cust_country' => $row[12],
                             'cust_zip' => $row[13],
                             'additionalno' => $row[14],
                             'vatno' => $row[15],
                             'buyerid_crno' => $row[16],
                             'ar_cust_name' => $row[17],
                             'building_no' => $row[18],
                             'ar_cust_add1' => $row[19],
                             'cust_district' => $row[20],
                             'ar_province_state' => $row[21],
                             'ar_cust_city' => $row[22],
                             'ar_cust_country' => $row[23],
                             'ar_cust_zip' => $row[24],
                             'ar_additionalno' => $row[25],
                             'ar_vatno' => $row[26],
                             'ar_buyerid_crno' => $row[27],
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