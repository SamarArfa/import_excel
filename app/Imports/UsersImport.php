<?php

namespace App\Imports;

use App\info;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new info([
                 'Beneficiary_number'     => $row[0],
                 'amount'    => $row[0],
                 'coins' => $row[1],
                 'batch_number'     => $row[2],


        ]);
    }
}
