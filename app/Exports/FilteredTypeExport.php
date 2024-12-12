<?php

namespace App\Exports;

use App\Models\YourModel;
use App\Models\archive;
use Maatwebsite\Excel\Concerns\FromCollection;

class FilteredTypeExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return archive::select("id", "fullname", "email", "department_id", "curriculum_id", "role", "status")->get();
    }
}
