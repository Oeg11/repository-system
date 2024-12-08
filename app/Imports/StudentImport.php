<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\studentModel;
use Hash;

class StudentImport implements ToCollection, ToModel
{

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {

    }

    public function model(array $row)

    {


        return new studentModel([

            'fullname' => $row['fullname'],

            'email' => $row['email'],

            'password' => Hash::make($row['password']),

            'department_id' => $row['department_id'],

            'curriculum_id' => $row['curriculum_id'],

            'role' => $row['role'],

            'status' => $row['status'],

            'google_id' => $row['google_id'],

        ]);

    }

}
