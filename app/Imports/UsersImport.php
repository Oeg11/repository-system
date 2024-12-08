<?php



namespace App\Imports;



use App\Models\studentModel;

use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Hash;



class UsersImport implements ToModel, WithHeadingRow

{

    /**

    * @param array $row

    *

    * @return \Illuminate\Database\Eloquent\Model|null

    */

    public function model(array $row)

    {

        return new studentModel([

            'fullname'     => $row['fullname'],

            'email'    => $row['email'],

            'password' => Hash::make($row['password']),

            'department_id'     => $row['department_id'],

            'curriculum_id'    => $row['curriculum_id'],

            'role'     => $row['role'],

            'status'    => $row['status'],

            'google_id'     => $row['google_id'],

            'remember_token'    => $row['remember_token'],

            'created_at'     => $row['created_at'],

            'updated_at'    => $row['updated_at'],


        ]);

    }

}
