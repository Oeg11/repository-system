<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\archive;
use App\Models\staff;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\Models\studentModel;
use App\Models\department;
use App\Models\curriculum;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\SystemInformation;
use App\Models\usercontrol;
use App\Models\User;

use DataTables;



class StaffController extends Controller
{

    public function stafflogin(){

        $capstone2 =  archive::where('type', 'Capstone 2')->count();//projects
        $csthesis2 =   archive::where('type', 'CS Thesis 2')->count();//research
        $shspracticalresearch =  archive::where('type', 'SHS Practical Research')->count();//thesisCapstone
        $bstmthesis =  archive::where('type', 'BSTM Thesis')->count();//thesisCapstone
        // $counttotalProjects = archive::where('status', 1)->count();

        $verified =  studentModel::where('status', 1)->count();//verified student
        $notverified =  studentModel::where('status', 0)->count();//Not verified student
        $verifiedarchive =  archive::where('status', 1)->count();//verified archive
        $verifiednotarchive =  archive::where('status', 0)->count();//not verified archive
        $systeminformation = SystemInformation::all();

      return view('staff.dashboard', compact('systeminformation','capstone2', 'csthesis2','shspracticalresearch', 'bstmthesis', 'verified', 'notverified', 'verifiedarchive', 'verifiednotarchive'));
    }



    public function loginfunctionStaff(Request $request)
   {
       $request->validate([
           'email' => 'required',
           'password' => 'required',

       ]);

       $credentials = $request->only('email', 'password');
       $credentials['status'] = 'active';

       if (Auth::guard('staff')->attempt($credentials)) {
            return response()->json([
                'success' => true,
                'redirect_url' => route('staff.dashboard'),
            ]);
       }else {

            return response()->json([
                'success' => false,
                'message' => 'Invalid email and password.',
            ]);
        }


   }

   public function facultylogout(){
    Auth::guard('staff')->logout();
    return redirect('/login/staff');
   }


   public function loginStaff(){
    $systeminformation = SystemInformation::all();
    return view('staff.login', compact('systeminformation'));
   }


   public function archivelists(Request $request){

        // $auth = Auth::user()->id;

        if ($request->ajax()) {

            $data = DB::table('archives')
            ->select(
                'archives.id as archive_id',
                'archives.archive_code',
                'archives.category',
                'archives.year',
                'archives.title',
                'archives.abstract',
                'archives.members',
                'archives.adviser',
                'archives.banner_path',
                'archives.document_path',
                'archives.status',
                'archives.student_id',
                'archives.slug',
                'archives.count_rank',
                'archives.created_at',
                'curricula.name as curriculum_name',
                'departments.name as department_name',
                )
            ->leftjoin('curricula','curricula.id','=','archives.curriculum_id')
            ->leftjoin('departments','departments.id','=','archives.department_id')
            // ->where('archives.usercontrol_id', $auth)
            ->get();

            return Datatables::of($data)

                    ->addIndexColumn()


                    ->addColumn('status',function($data){
                        $html = '';
                        if ($data->status == 1) {
                                    $html = '<center><span class="badge badge-success">Published</span></center>';
                                } else if ($data->status == 0) {
                                    $html = '<center><span class="badge badge-danger">Not Published</span></center>';
                                }
                            return $html;
                        })

                    ->addColumn('action', function($row){

                     $auth = Auth::user()->id;
                     $usercontrols = usercontrol::where('staff_id',$auth)->get();

                     foreach($usercontrols as $user){


                        if($auth == $user->staff_id && $user->collectionlist_view == 1){
                            $view = '<a class="dropdown-item btn-viewarchive" href="javascript:void(0)"
                                        data-toggle="modal" data-target="#modal-viewarchive"
                                            data-id="'.$row->archive_id.'"
                                            data-title="'.$row->title.'"
                                            data-category="'.$row->category.'"
                                            data-department_="'.$row->department_name.'"
                                            data-curriculum_="'.$row->curriculum_name.'"
                                            data-year="'.$row->year.'"
                                            data-abstract="'.$row->abstract.'"
                                            data-members="'.$row->members.'"
                                            data-adviser="'.$row->adviser.'"
                                            data-bannerpath="'.$row->banner_path.'"
                                            data-documentpath="'.$row->document_path.'"
                                        >
                                        <span class="fa fa-external-link-alt text-gray"></span> View</a>
                                  ';
                            }else{

                                $view =  '';

                            }


                            if($auth == $user->staff_id && $user->collectionlist_updatestatus == 1){
                                $edit = ' <a class="dropdown-item btn-update"
                                        href="javascript:void(0)" data-toggle="modal" data-target="#modal-archive"
                                        data-id="'.$row->archive_id.'"
                                        data-stat="'.$row->status.'"
                                        ><span class="fa fa-check text-dark"></span> Update Status</a>
                                    ';
                                }else{

                                    $edit = '';

                                }


                                if($auth == $user->staff_id && $user->collectionlist_delete == 1){
                                    $delete = '<a class="dropdown-item btn-deleteArchive" href="javascript:void(0)"
                                            data-del="'.$row->archive_id.'">
                                            <span class="fa fa-trash text-danger"></span>
                                            Delete</a>
                                          ';
                                    }else{

                                        $delete = '';

                                   }


                        $btn = '<div class="btn-group">
                                        <button type="button" class="btn btn-default">Action</button>
                                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">

                                 '. $view.'
                                 '.$edit.'
                                 '.$delete.'
                            </div>
                        </div>';

                     return $btn;


                    }



                    })

                    ->rawColumns(['status', 'action'])

                    ->make(true);

        }
        $systeminformation = SystemInformation::all();


        return view('staff.archivelists', compact('systeminformation'));
    }

    public function updatearchivelist(Request $request) {

        $archive = archive::find($request->id);
        $archive->status = $request->status;
        $archive->save();
       return response()->json([
        'status' => 200,
    ]);
 }


     public function deleteArchive(Request $request) {
         $id = $request->id;
         archive::find($id)->delete();
         return response()->json(['status'=> 200]);

     }




    //  public function stafftudentlists(Request $request){


    //     if ($request->ajax()) {

    //         $data = DB::table('student_models')
    //             ->select(
    //                 'student_models.id as student_id',
    //                 'student_models.fullname',
    //                 'student_models.email',
    //                 'student_models.department_id',
    //                 'student_models.curriculum_id',
    //                 'student_models.role',
    //                 'student_models.created_at',
    //                 'student_models.status',
    //                 'curricula.name as curriculum_name',
    //                 'departments.name as department_name',
    //                 )
    //             ->leftjoin('curricula','curricula.id','=','student_models.curriculum_id')
    //             ->leftjoin('departments','departments.id','=','student_models.department_id')
    //             ->get();

    //         return Datatables::of($data)

    //                 ->addIndexColumn()


    //                 ->addColumn('status',function($data){
    //                     $html = '';
    //                     if ($data->status == 1) {
    //                                 $html = '<center><span class="badge badge-success">Verified</span></center>';
    //                             } else {
    //                                 $html = '<center><span class="badge badge-danger">Not Verified</span></center>';
    //                             }
    //                         return $html;
    //                     })

    //                 ->addColumn('action', function($row){



    //                         $btn = '<div class="btn-group">
    //                                 <button type="button" class="btn btn-default">Action</button>
    //                                 <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
    //                                 <span class="sr-only">Toggle Dropdown</span>
    //                                 </button>
    //                                 <div class="dropdown-menu" role="menu">
    //                                 <a class="dropdown-item btn-viewstudent" href="javascript:void(0)"
    //                                 data-toggle="modal" data-target="#modal-viewstudent"
    //                                   data-id="'.$row->student_id.'"
    //                                   data-fname="'.$row->fullname.'"
    //                                   data-email="'.$row->email.'"
    //                                   data-cur="'.$row->curriculum_name.'"
    //                                   data-dept="'.$row->department_name.'"
    //                                   data-status="'.$row->status.'"

    //                                 ><span class="fa fa-external-link-alt text-gray"></span> View</a>

    //                                 <a class="dropdown-item btn-deleteStudent" href="javascript:void(0)"
    //                                 data-del="'.$row->student_id.'">
    //                                 <span class="fa fa-trash text-danger"></span>
    //                                 Delete</a>

    //                                 </div>
    //                             </div>';



    //                         return $btn;

    //                 })

    //                 ->rawColumns(['status', 'action'])

    //                 ->make(true);

    //     }
    //     $systeminformation = SystemInformation::all();
    //     return view('staff.studentlists' ,compact('systeminformation'));
    // }



  public function stafftudentlists(Request $request){


    if ($request->ajax()) {

        $data = DB::table('users')
            ->select(
                'users.id as student_id',
                'users.name',
                'users.email',
                'users.role',
                'users.status',
                'users.created_at',
                )
            ->get();

        return Datatables::of($data)

                ->addIndexColumn()


                // ->addColumn('status',function($data){
                //     $html = '';
                //     if ($data->status == 1) {
                //                 $html = '<center><span class="badge badge-success">Verified</span></center>';
                //             } else {
                //                 $html = '<center><span class="badge badge-danger">Not Verified</span></center>';
                //             }
                //         return $html;
                //     })

                ->addColumn('action', function($row){



                        $btn = '<div class="btn-group">
                                <button type="button" class="btn btn-default">Action</button>
                                <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item btn-viewstudent" href="javascript:void(0)"
                                data-toggle="modal" data-target="#modal-viewstudent"
                                  data-id="'.$row->student_id.'"
                                  data-fname="'.$row->name.'"
                                  data-email="'.$row->email.'"
                                  data-status="'.$row->status.'"

                                ><span class="fa fa-external-link-alt text-gray"></span> View</a>

                                <a class="dropdown-item btn-deleteStudent" href="javascript:void(0)"
                                data-del="'.$row->student_id.'">
                                <span class="fa fa-trash text-danger"></span>
                                Delete</a>

                                </div>
                            </div>';



                        return $btn;

                })

                ->rawColumns(['action'])

                ->make(true);

    }
    $systeminformation = SystemInformation::all();
    return view('staff.studentlistsgoogleauth' ,compact('systeminformation'));
}




public function deleteStudent(Request $request) {
    $id = $request->id;
    User::find($id)->delete();
    return response()->json(['status'=> 200]);

}



public function ViewProject(Request $request){


    $archive = DB::table('users')
    ->select(
        'users.id as student_id',
        'users.name',
        'users.email',
        'archives.id as archives_id',
        'archives.student_id',
        'archives.title',
        'archives.abstract',
        'archives.banner_path',
        'archives.status',
        'archives.category',
        'archives.created_at',
        'archives.archive_code',
        'curricula.name as curriculum_name',
        'departments.name as department_name',
        )
    ->leftjoin('archives','archives.student_id','=','users.id')
    ->leftjoin('curricula','curricula.id','=','archives.curriculum_id')
    ->leftjoin('departments','departments.id','=','archives.department_id')
    ->where('archives.type', 'Capstone 2')
    ->orderBy('archives.id','DESC')
    ->get();

    $systeminformation = SystemInformation::all();
    return view('staff.viewproject', compact('archive','systeminformation'));
}


public function ViewResearch(Request $request){


    $archive = DB::table('users')
    ->select(
        'users.id as student_id',
        'users.name',
        'users.email',
        'archives.id as archives_id',
        'archives.student_id',
        'archives.title',
        'archives.abstract',
        'archives.banner_path',
        'archives.status',
        'archives.category',
        'archives.created_at',
        'archives.archive_code',
        'curricula.name as curriculum_name',
        'departments.name as department_name',
        )
    ->leftjoin('archives','archives.student_id','=','users.id')
    ->leftjoin('curricula','curricula.id','=','archives.curriculum_id')
    ->leftjoin('departments','departments.id','=','archives.department_id')
    ->where('archives.type', 'CS Thesis 2')
    ->orderBy('archives.id','DESC')
    ->get();

    $systeminformation = SystemInformation::all();
    return view('staff.viewresearch', compact('archive','systeminformation'));
}


public function ViewCapstonethesis(Request $request){


    $archive = DB::table('users')
    ->select(
        'users.id as student_id',
        'users.name',
        'users.email',
        'archives.id as archives_id',
        'archives.student_id',
        'archives.title',
        'archives.abstract',
        'archives.banner_path',
        'archives.status',
        'archives.category',
        'archives.created_at',
        'archives.archive_code',
        'curricula.name as curriculum_name',
        'departments.name as department_name',
        )
    ->leftjoin('archives','archives.student_id','=','users.id')
    ->leftjoin('curricula','curricula.id','=','archives.curriculum_id')
    ->leftjoin('departments','departments.id','=','archives.department_id')
    ->where('archives.type', 'SHS Practical Research')
    ->orderBy('archives.id','DESC')
    ->get();

    $systeminformation = SystemInformation::all();
    return view('staff.viewcapstonethesis', compact('archive','systeminformation'));
}


public function ViewTotalprojects(Request $request){


    $archive = DB::table('users')
    ->select(
        'users.id as student_id',
        'users.name',
        'users.email',
        'archives.id as archives_id',
        'archives.student_id',
        'archives.title',
        'archives.abstract',
        'archives.banner_path',
        'archives.status',
        'archives.category',
        'archives.created_at',
        'archives.archive_code',
        'curricula.name as curriculum_name',
        'departments.name as department_name',
        )
    ->leftjoin('archives','archives.student_id','=','users.id')
    ->leftjoin('curricula','curricula.id','=','archives.curriculum_id')
    ->leftjoin('departments','departments.id','=','archives.department_id')
    ->where('archives.type', 'Standalone BSTM Thesis')
    ->orderBy('archives.id','DESC')
    ->get();


    $systeminformation = SystemInformation::all();
    return view('staff.viewtotalprojects', compact('archive','systeminformation'));
}


public function ViewVerifiedarchive(Request $request){


    $verifiedarchive = DB::table('student_models')
    ->select(
        'student_models.id as student_id',
        'student_models.fullname',
        'student_models.email',
        'archives.id as archives_id',
        'archives.student_id',
        'archives.title',
        'archives.abstract',
        'archives.banner_path',
        'archives.status',
        'archives.category',
        'archives.created_at',
        'archives.archive_code',
        'curricula.name as curriculum_name',
        'departments.name as department_name',
        )
    ->leftjoin('archives','archives.student_id','=','student_models.id')
    ->leftjoin('curricula','curricula.id','=','student_models.curriculum_id')
    ->leftjoin('departments','departments.id','=','student_models.department_id')
    ->where('archives.status', 1)
    ->orderBy('archives.id','DESC')
    ->get();

    $systeminformation = SystemInformation::all();
    return view('staff.viewverifiedarchive', compact('verifiedarchive','systeminformation'));

}

public function ViewNotVerifiedarchive(Request $request){

    $notverifiedarchive = DB::table('student_models')
    ->select(
        'student_models.id as student_id',
        'student_models.fullname',
        'student_models.email',
        'archives.id as archives_id',
        'archives.student_id',
        'archives.title',
        'archives.abstract',
        'archives.banner_path',
        'archives.status',
        'archives.category',
        'archives.created_at',
        'archives.archive_code',
        'curricula.name as curriculum_name',
        'departments.name as department_name',
        )
    ->leftjoin('archives','archives.student_id','=','student_models.id')
    ->leftjoin('curricula','curricula.id','=','student_models.curriculum_id')
    ->leftjoin('departments','departments.id','=','student_models.department_id')
    ->where('archives.status', 0)
    ->orderBy('archives.id','DESC')
    ->get();

    $systeminformation = SystemInformation::all();
    return view('staff.viewnotverifiedarchive', compact('notverifiedarchive','systeminformation'));
}


public function ViewVerifiedstudents(Request $request){


    $verifiedstudent = DB::table('student_models')
    ->select(
        'student_models.id as student_id',
        'student_models.fullname',
        'student_models.email',
        'curricula.name as curriculum_name',
        'departments.name as department_name',
        'student_models.status as student_status',
        )
    ->leftjoin('curricula','curricula.id','=','student_models.curriculum_id')
    ->leftjoin('departments','departments.id','=','student_models.department_id')
    ->where('student_models.status', 1)
    ->get();

    $systeminformation = SystemInformation::all();
    return view('staff.viewverifiedstudent', compact('verifiedstudent','systeminformation'));

}

public function ViewNotVerifiedstudents(Request $request){


    $notverifiedstudent = DB::table('student_models')
    ->select(
        'student_models.id as student_id',
        'student_models.fullname',
        'student_models.email',
        'curricula.name as curriculum_name',
        'departments.name as department_name',
        'student_models.status as student_status',
        )
    ->leftjoin('curricula','curricula.id','=','student_models.curriculum_id')
    ->leftjoin('departments','departments.id','=','student_models.department_id')
    ->where('student_models.status', 0)
    ->get();

    $systeminformation = SystemInformation::all();
    return view('staff.viewnotverifiedstudent', compact('notverifiedstudent','systeminformation'));

}



        public function ChangePassword(Request $request){


            $staffauthID = Auth::user()->id;
            $userlog = staff::where('id', $staffauthID)->get();

            $systeminformation = SystemInformation::all();
            return view('staff.changepassword',compact('systeminformation','userlog'));

        }

        public function updatePassword(Request $request){


            $validator = \Validator::make($request->all(), [

                'email' => 'required',
                'password' => 'required|min:8',

            ],[
                'name.required' => 'Required Email',
                'password.required' => 'Password minimum 8 characters',

            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }



            $id = staff::find($request->id);
            $cpassword = "";
            if (empty($request->password)) {
                $cpassword = $request->defaultpassword; //back old password
            } else {
                $cpassword = bcrypt($request->password); //update new password

            }

            $data = [
                'email' => $request->email,
                'password' => $cpassword,

            ];

        $id->update($data);
            return response()->json([
                'status' => 200,
            ]);


        }





}

