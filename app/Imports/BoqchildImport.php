<?php

namespace App\Imports;

use App\Boq;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;



class BoqchildImport implements ToCollection, WithStartRow
{

    public function  __construct($parent)
    {
        $this->parent = $parent;
    }

    public function startRow(): int
    {
        return 2;
    }


    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $node = Boq::create([

                // 'category_name' => $row[0],
                // 'productname' => $row[0],
                // 'unit' => $row[1],
                // 'quantity' => $row[2],
                // 'rate' => $row[3],
                // 'discountamount' => $row[4],
                // 'amount1' => $row[5],
                // 'amount' => $row[5],
                // 'vat_percentage' => $row[6],
                // 'vatamount' => $row[7],
                // 'totalamount' => $row[8],
                // 'description' => $row[9],

                'ref' => $row[0],
                'category_name' => $row[1],
                'description' => $row[2],
                'unit' => $row[3],
                'quantity' => $row[4],

            ]);

            //
            $child_id = $node->id;


            $parent = Boq::findOrFail($this->parent);

            $node->appendToNode($parent)->save();

            $result = Boq::ancestorsOf($child_id);
            $pid = '';
            foreach ($result as  $value) {



                $nodes = Boq::findOrFail($value->id);
                if ($nodes->isRoot()) {
                    $pid .= $value->id . '-';
                } else {
                    $result1 = $nodes->getSiblings()->count();
                    $num_padded = sprintf("%02d", $result1);
                    $pid .= $num_padded . '-';
                }
            }

            $result2 = $node->getSiblings()->count() + 1;

            $num_padded1 = sprintf("%02d", $result2);
            $pid .= $num_padded1;

            //$pid.=$child_id;

            DB::table('boqs')->where('id', $node->id)->update(['category_code' => $pid]);

            //

        }
    }
}
