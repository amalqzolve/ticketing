<?php

namespace App\Imports;

use App\boq\MaterialDirectoryModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Session;
use Auth;


class MaterialDirectoryImport implements ToCollection, WithStartRow
{

    public function  __construct($useasr_id, $branch)
    {
        $this->useasr_id = $useasr_id;
        $this->branch = $branch;
    }
    public function startRow(): int
    {
        return 2;
    }


    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $node = MaterialDirectoryModel::create([
                'material_name' => $row[0],
                'description' => $row[1],
                'code' => $row[2],
                'unit' => $row[3],
                'category' => $row[4],
                'group' => $row[5],
                'amount' => $row[6],
                // 'branch' => $row[7],
                // 'warehouse' => $this->branch,
                'created_by' => $this->useasr_id,
            ]);
        }
    }
}
