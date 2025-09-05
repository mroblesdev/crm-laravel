<?php

namespace App\Imports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithSkipDuplicates;

class ClientsImport implements ToModel, WithSkipDuplicates
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Client([
            'name' => $row[0],
            'email' => $row[1],
            'phone' => $row[2],
            'company' => $row[3],
            'notes' => $row[4],
            'user_id' => auth()->user()->id,
        ]);
    }
}
