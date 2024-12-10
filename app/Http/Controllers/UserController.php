<?php

namespace App\Http\Controllers;
use App\Models\studentModel;
use App\Models\department;
use App\Models\curriculum;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\SystemInformation;

class UserController extends Controller
{
    public function Mainindex(){

        $departments = department::all();
        $curriculums = curriculum::all();

        $systeminformation = SystemInformation::all();
        return view('index', compact('systeminformation','departments', 'curriculums'));
    }

    public function about(){
        $systeminformation = SystemInformation::all();
        return view('about', compact('systeminformation'));
    }

    public function project(){
        $systeminformation = SystemInformation::all();
        return view('project', compact('systeminformation'));
    }

    public function login(){
        $systeminformation = SystemInformation::all();
        return view('login', compact('systeminformation'));
    }

    // public function register(Request $request){

    //     $validator = Validator::make($request->all(), [

    //         'fullname' => 'required',
    //         'email' =>'required|unique:student_models,email',
    //         'password' =>'min:6|required_with:password_confirmation|same:password_confirmation',
    //         'password_confirmation' =>'min:6',
    //         'department' =>'required',
    //         'curriculum' =>'required',
    //     ],[
    //         'fullname.required' => 'Please enter a full name',
    //         'email.required' => 'Please enter unique email address',
    //         'password.required' => 'Please enter your password',
    //         'password_confirmation.required' => 'Please confirm your password',
    //         'department.required' => 'Please select your department',
    //         'curriculum.required' => 'Please select your curriculum'

    //      ]);

    //      if ($validator->fails()) {
    //         return response()->json(['errors' => $validator->errors()]);
    //       }


    //     $student = new studentModel;
    //     $student->fullname = $request->fullname;
    //     $student->email = $request->email;
    //     // $student->password = Hash::make($request->password);
    //     $student->password = bcrypt($request->password);
    //     $student->department_id = $request->department;
    //     $student->curriculum_id= $request->curriculum;
    //     $student->role = "student";
    //     $student->save();

    //     return response()->json(['status' => 200]);
    //     // return redirect()->route('view_login')->with('mgs', 'Successfully registered ');



    // }


    public function userLogin(Request $request){

            $request->validate([
                'email' =>'required',
                'password' =>'min:6|required',

            ],
            [
                'email.required' => 'Please enter your email address',
                'password.required' => 'Please enter your password',
            ]
        );

    }

    public function NotFound(){

        $systeminformation = SystemInformation::all();
        return view('notfound', compact('systeminformation'));
    }
}
