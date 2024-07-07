<?php

namespace App\Imports;

use App\Boq;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;



class BoqmainImport implements ToCollection, WithStartRow
{

    public function startRow(): int
    {
        return 2;
    }

    
    public function collection(Collection $rows)
    {
 foreach ($rows as $row) 
        {

            $node = Boq::create([
                             'category_name' => $row[0],
                             'description' => $row[1],
                             'amount' => $row[2],

                               ]);

 DB::table('boqs')->where('id',$node->id)->update([ 'category_code' => $node->id]);



        }
    }
}