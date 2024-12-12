<?php

namespace App\Exports;

use App\Models\YourModel;
use App\Models\archive;
use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\WithHeadings;

class FilteredTypeExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return studentModel::select("id", "fullname", "email", "department_id", "curriculum_id", "role", "status")->get();
    }


    public function headings(): array

    {

        // return ["id", "fullname", "email",  "department_id", "curriculum_id", "role", "status"];

    }
}
