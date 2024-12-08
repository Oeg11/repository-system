<?php

namespace App\Exports;

use App\Models\studentModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return studentModel::select("id", "fullname", "email", "password", "department_id", "curriculum_id", "role", "status", "google_id")->get();
    }


    public function headings(): array

    {

        return ["id", "fullname", "email", "password", "department_id", "curriculum_id", "role", "status", "google_id"];

    }


}
