<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomerImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $new_customer = new Customer([
            'company' => $row[0],
            'name' => $row[1],
            'address' => $row[2],
            'city' => $row[3],
            'phone' => $row[4],
            'tenor' => $row[5],
            'user_id' => $row[6],
        ]);

        return $new_customer;
    }
}
