<?php



namespace App\Exports;



use App\Models\studentModel;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;



class UsersExport implements FromCollection, WithHeadings

{

    /**

    * @return \Illuminate\Support\Collection

    */

    public function collection()

    {

        return User::select("id", "fullname", "email", "password", "department_id", "curriculum_id", "role", "status", "google_id", "remember_token", "created_at", "	updated_at")->get();

    }



    /**

     * Write code on Method

     *

     * @return response()

     */

    public function headings(): array

    {

        return ["id", "fullname", "email", "password", "department_id", "curriculum_id", "role", "status", "google_id", "remember_token", "created_at", "	updated_at"];

    }

}
