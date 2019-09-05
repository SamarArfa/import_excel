<?php

namespace App\Imports;

use App\import_excels;
use Maatwebsite\Excel\Concerns\ToModel;

//use Maatwebsite\Excel\Concernsrns\ToModel;

class ExcelImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new import_excels([
            'batch_number'     => $row[0],
            'date_of_batch'    => $row[1],
            'sponsor_number' => $row[2],
            'Beneficiary_number'     => $row[3],
            'amount'    => $row[4],
            'coins' => $row[5],
            'batch_number'     => $row[6],

        ]);
    }
}
