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
    protected $filters;

    public function collection($filters)
    {
        $this->filters = $filters;
    }

    public function view(): View
    {
        $query = archive::query();

        // Apply filters
        if (!empty($this->filters['type'])) {
            $query->where('type', 'like', '%' . $this->filters['type'] . '%');
        }

        // if (!empty($this->filters['status'])) {
        //     $query->where('status', $this->filters['status']);
        // }

        $data = $query->get();

        return view('exports.filtered-data', [
            'data' => $data,
        ]);
    }
}
