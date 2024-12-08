<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\studentModel;
use Hash;

class StudentImport implements ToCollection, ToModel
{

    private $current = 0;
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {

    }

    public function model(array $row)

    {
        $this->current++;
        if($this->current > 1){

            $stud = new studentModel;
            $stud->fullname = $row[1];
            $stud->email = $row[2];
            $stud->password = Hash::make($row[3]);
            $stud->department_id = $row[4];
            $stud->curriculum_id = $row[5];
            $stud->role = $row[6];
            $stud->status = $row[7];
            $stud->google_id = $row[8];
            $stud->remember_token = $row[9];
            $stud->save();


        }
    }

}
