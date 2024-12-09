<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\archive;
use App\Models\admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\Models\studentModel;
use App\Models\department;
use App\Models\curriculum;
use App\Models\staff;
use App\Models\SystemInformation;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\usercontrol;
use App\Models\User;
use App\Models\backup;
use DataTables;

use App\Exports\StudentExport;
use App\Imports\StudentImport;
use Excel;


class AdminController extends Controller
{

    public function adminlogin(){

        return view('admin.index');
    }

    public function loginfunctionadmin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',

        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
             return response()->json([
                 'success' => true,
                 'redirect_url' => route('admin.dashboard'),
             ]);
        }else {

             return response()->json([
                 'success' => false,
                 'message' => 'Invalid email and password.',
             ]);
         }


    }



    public function admindashboard(){

        $capstone2 =  archive::where('type', 'Capstone 2')->count();//projects
        $csthesis2 =   archive::where('type', 'CS Thesis 2')->count();//research
        $shspracticalresearch =  archive::where('type', 'SHS Practical Research')->count();//thesisCapstone
        $bstmthesis =  archive::where('type', 'BSTM Thesis')->count();//thesisCapstone
        // $counttotalProjects = archive::where('status', 1)->count();

        $countdepartment= department::count();
        $countcurriculum = curriculum::count();
        $verifiedarchive =  archive::where('status', 1)->count();//verified archive
        $verifiednotarchive =  archive::where('status', 0)->count();//not verified archive

        $systeminformation = SystemInformation::all();

      return view('admin.dashboard', compact('systeminformation','capstone2', 'csthesis2','shspracticalresearch', 'bstmthesis', 'countdepartment', 'countcurriculum', 'verifiedarchive', 'verifiednotarchive'));
    }


    public function archivelists(Request $request){


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
                'archives.remark',
                'archives.student_id',
                'archives.slug',
                'archives.count_rank',
                'archives.created_at',
                'curricula.name as curriculum_name',
                'departments.name as department_name',
                )
            ->leftjoin('curricula','curricula.id','=','archives.curriculum_id')
            ->leftjoin('departments','departments.id','=','archives.department_id')
            ->get();

            return Datatables::of($data)

                    ->addIndexColumn()


                    ->addColumn('status',function($data){
                        $html = '';
                          if ($data->status == 1) {
                                      $html = '<center><span class="badge badge-success">Approved</span></center>';
                                  } else if ($data->status == 0) {
                                      $html = '<center><span class="badge badge-danger">Rejected</span></center>';
                                  } else if ($data->status == 2) {
                                    $html = '<center><span class="badge badge-warning">Pending</span></center>';
                                }
                              return $html;
                          })

                    ->addColumn('action', function($row){


                            $btn = '<div class="btn-group">
                                    <button type="button" class="btn btn-default">Action</button>
                                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item btn-viewarchive" href="javascript:void(0)"
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
                                    <a class="dropdown-item btn-update"
                                     href="javascript:void(0)" data-toggle="modal" data-target="#modal-archive"
                                    data-id="'.$row->archive_id.'"
                                    data-stat="'.$row->status.'"
                                    data-remark="'.$row->remark.'"
                                    ><span class="fa fa-check text-dark"></span> Update Status</a>
                                    <a class="dropdown-item btn-deleteArchive" href="javascript:void(0)"
                                    data-del="'.$row->archive_id.'">
                                    <span class="fa fa-trash text-danger"></span>
                                     Delete</a>

                                    </div>
                                </div>';



                            return $btn;

                    })

                    ->rawColumns(['status', 'action'])

                    ->make(true);

        }


        $departments = department::all();
        $curriculums = curriculum::all();

        $systeminformation = SystemInformation::all();

        return view('admin.archivelists', compact('systeminformation', 'departments', 'curriculums'));
    }


    public function updatearchivelist(Request $request) {

           $archive = archive::find($request->id);
           $archive->status = $request->status;
           $archive->remark = $request->remark;
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



    // public function adminstudentlists(Request $request){


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

    //                                  <a class="dropdown-item btn-editstudentstatus" href="javascript:void(0)"
    //                                 data-toggle="modal" data-target="#modal-editstudentstatus"
    //                                   data-id="'.$row->student_id.'"
    //                                   data-status1="'.$row->status.'"

    //                                 ><span class="fa fa-edit text-blue"></span> Edit</a>


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


    //     return view('admin.studentlists', compact('systeminformation'));
    // }


    public function adminstudentlists(Request $request){


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

                    // <a class="dropdown-item btn-editstudentstatus" href="javascript:void(0)"
                    // data-toggle="modal" data-target="#modal-editstudentstatus"
                    //   data-id="'.$row->student_id.'"
                    //   data-status1="'.$row->status.'"

                    // ><span class="fa fa-edit text-blue"></span> Edit</a>

                    ->rawColumns(['action'])

                    ->make(true);

        }

        $systeminformation = SystemInformation::all();


        return view('admin.studentlistsgoogleauth', compact('systeminformation'));
    }



    public function updateStudentstatus(Request $request){
            $archive = User::find($request->id);
            $archive->status = $request->status;
            $archive->save();
        return response()->json([
            'status' => 200,
        ]);

    }

    public function deleteStudent_(Request $request) {
        $id = $request->id;
        User::find($id)->delete();
        return response()->json(['status'=> 200]);

    }



    public function admindepartmentlists_(Request $request){


        if ($request->ajax()) {

            $data = DB::table('departments')
                ->select('*')
                ->get();

            return Datatables::of($data)

                    ->addIndexColumn()


                    ->addColumn('action', function($row){



                            $btn = '<div class="btn-group">
                                    <button type="button" class="btn btn-default">Action</button>
                                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item btn-editdepartment" href="javascript:void(0)"
                                    data-toggle="modal" data-target="#modal-editdepartment"
                                        data-id="'.$row->id.'"
                                        data-name="'.$row->name.'"
                                        data-desc="'.$row->description.'"


                                    ><span class="fa fa-edit text-blue"></span> Edit</a>

                                    <a class="dropdown-item btn-deleteDepartment" href="javascript:void(0)"
                                    data-del="'.$row->id.'">
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

        return view('admin.departmentlists', compact('systeminformation'));
    }

    public function addDepartment(Request $request){


        $validator = \Validator::make($request->all(), [
            'name' => 'required|regex:/^([a-zA-Z\s\-\+\/\(\)]*)$/',
            'description' => 'required',

        ],[
            'name.required' => 'Please input Department Name',
            'description.required' => 'Please input Department Description',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $deptData = [
            'name' => $request->name,
            'description' => $request->description,


          ];
          department::create($deptData);
          return response()->json([
            'status' => 200,
          ]);
    }

    public function updateDepartment(Request $request){

        $dept = department::find($request->id);
        $dept->name = $request->name;
        $dept->description = $request->description;
        $dept->save();

       return response()->json([
        'status' => 200,

      ]);

    }

    public function deleteDepartment_(Request $request){
        $id = $request->id;
        department::find($id)->delete();
        return response()->json(['status'=> 200]);
    }


    public function admincurriculumlists_(Request $request){

        if ($request->ajax()) {

            $data = DB::table('curricula')
            ->select(
                'curricula.id as curriculum_id',
                'curricula.department_id',
                'curricula.name',
                'curricula.description',
                'departments.name as department_name',
                )
            ->leftjoin('departments','departments.id','=','curricula.department_id')
            ->get();

            return Datatables::of($data)

                    ->addIndexColumn()


                    ->addColumn('action', function($row){



                            $btn = '<div class="btn-group">
                                    <button type="button" class="btn btn-default">Action</button>
                                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item btn-editcurriculum" href="javascript:void(0)"
                                    data-toggle="modal" data-target="#modal-editcurriculum"
                                        data-id="'.$row->curriculum_id.'"
                                        data-deptid="'.$row->department_id.'"
                                        data-name="'.$row->name.'"
                                        data-desc="'.$row->description.'"


                                    ><span class="fa fa-edit text-blue"></span> Edit</a>

                                    <a class="dropdown-item btn-deleteCurriculum" href="javascript:void(0)"
                                    data-del="'.$row->curriculum_id.'">
                                    <span class="fa fa-trash text-danger"></span>
                                    Delete</a>

                                    </div>
                                </div>';



                            return $btn;

                    })

                    ->rawColumns(['action'])

                    ->make(true);

        }

        $departments = department::all();
        $systeminformation = SystemInformation::all();
        return view('admin.curriculumlists', compact('departments', 'systeminformation'));
    }

    public function addCurriculum(Request $request){

        $validator = \Validator::make($request->all(), [
            'department_id' => 'required',
            'name' => 'required|regex:/^([a-zA-Z\s\-\+\/\(\)]*)$/',
            'description' => 'required',

        ],[
            'department_id.required' => 'Please select Department',
            'name.required' => 'Please input Name',
            'description.required' => 'Please input Description',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }


        $deptData = [
            'department_id' => $request->department_id,
            'name' => $request->name,
            'description' => $request->description,
          ];
          curriculum::create($deptData);
          return response()->json([
            'status' => 200,
          ]);
    }

    public function updateCurriculum(Request $request){

        $curri = curriculum::find($request->id);
        $curri->department_id = $request->department_id;
        $curri->name = $request->name;
        $curri->description = $request->description;
        $curri->save();

       return response()->json([
        'status' => 200,

      ]);

    }

    public function deleteCurriculum_(Request $request){
        $id = $request->id;
        curriculum::find($id)->delete();
        return response()->json(['status'=> 200]);

    }


    public function adminfaculty_stafflists_(Request $request){


        if ($request->ajax()) {

            $data = DB::table('staff')
            ->select(
                'id',
                'firstname',
                'middlename',
                'lastname',
                'email',
                'password',
                'status',
                DB::raw('CONCAT(firstname, " ", IFNULL(middlename, ""), " ",  lastname) AS fullname')
                )
            ->get();

            return Datatables::of($data)

                    ->addIndexColumn()


                    ->addColumn('status',function($data){
                        $html = '';
                        if ($data->status == 'active') {
                                    $html = '<center><span class="badge badge-success">Active</span></center>';
                                } else {
                                    $html = '<center><span class="badge badge-danger">In Active</span></center>';
                                }
                            return $html;
                        })


                    ->addColumn('action', function($row){



                            $btn = '<div class="btn-group">
                                    <button type="button" class="btn btn-default">Action</button>
                                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item btn-fstaff" href="javascript:void(0)"
                                    data-toggle="modal" data-target="#modal-editfacultystaff"
                                        data-id="'.$row->id.'"
                                        data-fname="'.$row->firstname.'"
                                        data-mname="'.$row->middlename.'"
                                        data-lname="'.$row->lastname.'"
                                        data-email="'.$row->email.'"
                                        data-stat="'.$row->status.'"

                                    ><span class="fa fa-edit text-blue"></span> Edit</a>

                                    <a class="dropdown-item btn-deletefacultystaff" href="javascript:void(0)"
                                    data-del="'.$row->id.'">
                                    <span class="fa fa-trash text-danger"></span>
                                    Delete</a>

                                    </div>
                                </div>';



                            return $btn;

                    })

                    ->rawColumns(['status', 'action'])

                    ->make(true);

        }
        $systeminformation = SystemInformation::all();
        return view('admin.faculty_stafflists', compact('systeminformation'));
    }

    public function AddStaff(Request $request){


        $validator = \Validator::make($request->all(), [
            'firstname' => 'required|regex:/^([a-zA-Z\s\-\+\/\(\)]*)$/',
            'middlename' => '',
            'lastname' => 'required|regex:/^([a-zA-Z\s\-\+\/\(\)]*)$/',
            'email' => 'required|email|unique:staff',
            'password' => 'required|min:8',

        ],[
            'firstname.required' => 'Required First Name',
            'name.required' => 'Required Last Name',
            'name.required' => 'Required Unique Email',
            'password.required' => 'Password minimum 8 characters',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }


        $staff = [
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
          ];
          staff::create($staff);

          return response()->json([
            'status' => 200,
          ]);

    }


    public function updateFacultystaff(Request $request){

        $fstaff = staff::find($request->id);
        $fstaff->firstname = $request->firstname;
        $fstaff->middlename = $request->middlename;
        $fstaff->lastname = $request->lastname;
        $fstaff->email = $request->email;
        $fstaff->status = $request->status;
        $fstaff->save();

       return response()->json([
        'status' => 200,

      ]);

    }

    public function deleteFacultystaff_(Request $request){
        $id = $request->id;
        staff::find($id)->delete();
        return response()->json(['status'=> 200]);
    }


    public function adminsettings_(Request $request){


        if ($request->ajax()) {

            $data = DB::table('system_information')
            ->select('*')
            ->get();

            return Datatables::of($data)

                    ->addIndexColumn()

                    ->addColumn('action', function($row){



                            $btn = '<div class="btn-group">
                                    <button type="button" class="btn btn-default">Action</button>
                                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item btn-settings" href="javascript:void(0)"
                                    data-toggle="modal" data-target="#modal-editsettings"
                                        data-id="'.$row->id.'"
                                        data-sname="'.$row->system_name.'"
                                        data-ssname="'.$row->system_short_name.'"
                                        data-desc="'.$row->description.'"
                                        data-about="'.$row->about.'"
                                        data-email="'.$row->email.'"
                                        data-cno="'.$row->contact_number.'"
                                        data-address="'.$row->address.'"


                                    ><span class="fa fa-edit text-blue"></span> Edit</a>

                                    <a class="dropdown-item btn-deletesettings" href="javascript:void(0)"
                                    data-del="'.$row->id.'">
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
        return view('admin.settings', compact('systeminformation'));
    }


    public function updateSettings(Request $request){

        $settings = SystemInformation::find($request->id);
        $settings->system_name = $request->system_name;
        $settings->system_short_name = $request->system_short_name;
        $settings->description = $request->description;
        $settings->about = $request->about;
        $settings->email = $request->email;
        $settings->contact_number = $request->contact_number;
        $settings->address = $request->address;
        $settings->save();

       return response()->json([
        'status' => 200,

      ]);

    }

    public function deleteSettings_(Request $request){

        $id = $request->id;
        SystemInformation::find($id)->delete();
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
        ->where('archives.category', 'Web Application')
        ->orderBy('archives.id','DESC')
        ->get();

        $systeminformation = SystemInformation::all();
        return view('admin.viewproject', compact('archive','systeminformation'));
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
        ->where('archives.category', 'Mobile Application')
        ->orderBy('archives.id','DESC')
        ->get();


        $systeminformation = SystemInformation::all();
        return view('admin.viewresearch', compact('archive','systeminformation'));
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
        ->where('archives.category', 'PC Application')
        ->orderBy('archives.id','DESC')
        ->get();

        $systeminformation = SystemInformation::all();
        return view('admin.viewcapstonethesis', compact('archive','systeminformation'));
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
        ->where('archives.category', 'Standalone Application')
        ->orderBy('archives.id','DESC')
        ->get();


        $systeminformation = SystemInformation::all();
        return view('admin.viewtotalprojects', compact('archive','systeminformation'));
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
        return view('admin.viewverifiedarchive', compact('verifiedarchive','systeminformation'));

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
        return view('admin.viewnotverifiedarchive', compact('notverifiedarchive','systeminformation'));
    }



    public function ChangePassword(Request $request){


        $adminauthID = Auth::user()->id;
        $userlog = admin::where('id', $adminauthID)->get();

        $systeminformation = SystemInformation::all();
        return view('admin.changepassword',compact('systeminformation','userlog'));

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



        $id = admin::find($request->id);
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

    public function userControl(){

        $systeminformation = SystemInformation::all();
        $staffs = staff::all();
        $collections = archive::all();



        $collections = DB::table('usercontrols')
        ->select(
            'usercontrols.id as usercontrol_id',
            'usercontrols.staff_id',
            'usercontrols.collectionlist_view',
            'usercontrols.collectionlist_updatestatus',
            'usercontrols.collectionlist_delete',
            'staff.id as ustaff_id',
            'staff.firstname',
            'staff.lastname',

            )

        ->leftjoin('staff','staff.id','=','usercontrols.staff_id')
        ->get();

        return view('admin.usercontrol', compact('systeminformation','staffs','collections'));
    }



    public function AddUserControl(Request $request){
        $validator = \Validator::make($request->all(), [
            'staff_id' => 'required|unique:usercontrols,staff_id,'.$request->input('staff_id'),

        ],[
            'staff_id.required' => 'Required select a Staff',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }


        $staff = [
            'staff_id' => $request->staff_id,
            'collectionlist_view' => $request->collectionlist_view,
            'collectionlist_updatestatus' => $request->collectionlist_updatestatus,
            'collectionlist_delete' => $request->collectionlist_delete,
          ];
          usercontrol::create($staff);

          return response()->json([
            'status' => 200,
          ]);


     }


    // public function userControl(){

    //     $systeminformation = SystemInformation::all();
    //     $staffs = staff::all();
    //     $collections = archive::all();



    //     $collections = DB::table('staff')
    //     ->select(
    //         'staff.id as ustaff_id',
    //         'staff.firstname',
    //         'staff.lastname',
    //         'usercontrols.id as usercontrol_id',
    //         'usercontrols.staff_id',
    //         'usercontrols.collectionlist_view',
    //         'usercontrols.collectionlist_updatestatus',
    //         'usercontrols.collectionlist_delete',


    //         )

    //     ->leftjoin('usercontrols','usercontrols.staff_id','=','staff.id')
    //     ->get();

    //     return view('admin.usercontrol', compact('systeminformation','staffs','collections'));
    // }


    public function UpdateUserControl(Request $request){

        $id = usercontrol::find($request->id);
        $data = [
            'staff_id' => $request->staff_id,
            'collectionlist_view' => $request->collectionlist_view,
            'collectionlist_updatestatus' => $request->collectionlist_updatestatus,
            'collectionlist_delete' => $request->collectionlist_delete,


        ];

       $id->update($data);
          return response()->json([
            'status' => 200,
          ]);


    }


    public function AdminReports(Request $request)
    {

        $fetchdata = archive::select('type',
              DB::raw("count(type) as counttype")
             )
            ->groupBy('type')
            ->get();

            $types = archive::select(
                DB::raw('type as NameType'))
                ->groupBy('type')->get();

            $result[] = ['NameType'];

            foreach ($types as $key => $value) {

                $result[++$key] = $value->NameType;

                // info($result);
            }

            $typecount2 = archive::select(
                DB::raw('count(type) as TypeCount'))
                ->groupBy('type')->get();

            $result2[] = ['TypeCount'];

            foreach ($typecount2 as $key => $value2) {

                $result2[++$key] = $value2->TypeCount;

                // info($result2);
            }


            ///////////////////////////////////barchart 2/////////////////////////////////



            $fetchdata2 = archive::select('category',
             DB::raw("count(category) as countcategory"))
            ->groupBy('category')
            ->get();

            $cat = archive::select(
                DB::raw('category as CategoryName'))
                ->groupBy('category')->get();

            $result3[] = ['CategoryName'];

            foreach ($cat as $key => $value3) {

                $result3[++$key] = $value3->CategoryName;

                // info($result3);
            }

            $fetchcategory = archive::select(
                DB::raw('count(category) as countCategory'))
                ->groupBy('category')->get();

            $result4[] = ['countCategory'];

            foreach ($fetchcategory as $key => $value4) {

                $result4[++$key] = $value4->countCategory;

                // info($result4);
            }


            $systeminformation = SystemInformation::all();
            $types = archive::all();
            return view('admin.reports', compact('fetchdata','fetchdata2', 'systeminformation','types'))
            ->with('NameType', json_encode($result))
            ->with('TypeCount', json_encode($result2))
            ->with('CategoryName', json_encode($result3))
            ->with('countCategory', json_encode($result4));

    }



    public function AdminBackupDatabase(Request $request){




                $data = DB::table('backupdatabase')
                    ->select('*')
                    ->orderBy('id', 'DESC')
                    ->get();

            $systeminformation = SystemInformation::all();
            return view('admin.backupdatabase', compact('systeminformation','data'));
    }

                //my added funtion
    public function Adminuserimport(Request $request){

        $students = studentModel::all();

        $systeminformation = SystemInformation::all();
        return view('admin.import', compact('systeminformation','students'));



    }

    public function Adminimportdata(Request $request){

        $validator = \Validator::make($request->all(), [
            'import_file' => 'required',

        ],[
            'import_file.required' => 'Required csv file',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

         Excel::import(new StudentImport, request()->file('import_file'));


        return response()->json(['status' => 200]);


    }

        public function AdminExportexcel(Request $request){

            return Excel::download(new StudentExport, 'studentlist.xlsx');
        }


    public function AdminSearchReports(Request $request){

        $types = archive::select('type')->distinct()->get();
        $systeminformation = SystemInformation::all();
        return view('admin.searchimport', compact('systeminformation','types'));

    }


    public function AdminSearchTypeReports(Request $request){

        $date1 =  \Carbon\Carbon::parse($request->date1);
        $date2 =  \Carbon\Carbon::parse($request->date2);
        $type =  $request->type;
        if($request->ajax())
        {

            $output = '';
            $output .="
            <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th>Date Created</th>
                    <th>Archive Code</th>
                    <th>Project Title</th>
                    <th>Department</th>
                    <th>Curriculum</th>
                    <th>Status</th>
                    <th>Rank</th>
                </tr>
            <tbody id='load_data'>
        ";
            $query = $request->get('query');
            if($query != '')
            {
                $data = DB::table('archives')
                ->select(
                    'student_models.id as student_id',
                    'student_models.fullname',
                    'student_models.email',
                    'users.name',
                    'users.email',
                    'users.role',
                    'users.status',
                    'archives.id as archives_id',
                    'archives.student_id',
                    'archives.student_foreign_id',
                    'archives.title',
                    'archives.abstract',
                    'archives.banner_path',
                    'archives.status as archives_status',
                    'archives.category',
                    'archives.created_at',
                    'archives.archive_code',
                    'archives.count_rank',
                    'curricula.name as curriculum_name',
                    'departments.name as department_name',
                    )
                ->leftjoin('student_models','student_models.id','=','archives.student_id')
                ->leftjoin('users','users.id','=','archives.student_foreign_id')
                ->leftjoin('curricula','curricula.id','=','archives.curriculum_id')
                ->leftjoin('departments','departments.id','=','archives.department_id')
                ->where('archives.type',  $type)
                ->whereBetween('archives.created_at', [$date1, $date2])
               ->get();


            }
            else
            {
                $data = DB::table('archives')
                ->select(
                    'student_models.id as student_id',
                    'student_models.fullname',
                    'student_models.email',
                    'users.name',
                    'users.email',
                    'users.role',
                    'archives.id as archives_id',
                    'archives.student_id',
                    'archives.student_foreign_id',
                    'archives.title',
                    'archives.abstract',
                    'archives.banner_path',
                    'archives.status',
                    'archives.type',
                    'archives.category',
                    'archives.created_at',
                    'archives.archive_code',
                    'archives.count_rank',
                    'curricula.name as curriculum_name',
                    'departments.name as department_name',
                    )
                ->leftjoin('student_models','student_models.id','=','archives.student_id')
                ->leftjoin('users','users.id','=','archives.student_foreign_id')
                ->leftjoin('curricula','curricula.id','=','archives.curriculum_id')
                ->leftjoin('departments','departments.id','=','archives.department_id')
                ->where('archives.type',  $type)
                ->whereBetween('archives.created_at', [$date1, $date2])
               ->get();
            }

            $total_row = $data->count();

            if($total_row > 0)
            {
                foreach($data as $row)
                {

                    if($row->status == 1){
                        $stat = '<span class="badge bg-success">Approved</span>';
                    }elseif($row->status == 0){
                        $stat ='<span class="badge bg-danger">Rejected</span>';
                    }else{
                       $stat = '<span class="badge bg-warning">Pending</span>';
                    }

                    $output .= '
                    <tr>
                        <td>'.$row->archives_id.'</td>
                        <td style="text-transform: capitalize;">'.$row->type.'</td>
                        <td>'.$row->category.'</td>
                        <td>'.$row->created_at.'</td>
                        <td>'.$row->archive_code.'</td>
                         <td>'.$row->title.'</td>
                        <td>'.$row->department_name.'</td>
                        <td>'.$row->curriculum_name.'</td>
                        <td>'.$stat.'</td>
                        <td>'.$row->count_rank.'</td>
                    </tr>
                    ';
                }


                $date1 =  \Carbon\Carbon::parse($request->date1);
                $date2 =  \Carbon\Carbon::parse($request->date2);
                $type =  $request->type;


                 $TotalTypes = DB::table('archives')
                 ->where('type', $type)
                 ->whereBetween('archives.created_at', [$date1, $date2])
                ->count();

                $TotalRanks = DB::table('archives')
                ->select('count_rank')
                ->where('type', $type)
                ->whereBetween('archives.created_at', [$date1, $date2])
               ->count();



                //end Absent Part
                 $output .= '

                    <tr style="background-color:#e3e2e1">
                              <td colspan="2" style="font-size:1rem">Total Type: <span style="background-color:#1bdce3;padding: 2px 2px 2px 2px; border-radius:6px;color:#fff">'.$TotalTypes.'</span></td>
                     <td colspan="1" style="font-size:0.8rem"></td>
                              <td colspan="8" style="font-size:1rem">Total Rank: <span style="background-color:#a69d41;padding: 2px 2px 2px 2px; border-radius:6px;color:#fff">'.$TotalRanks.'</span></td>
                    </tr>
                  ';


             }
            else
            {
                $output = '
                <tr>
                    <td colspan="10"><center>No Data Found</center></td>
                </tr>
                ';
            }
            $data = array(
                'table_data' => $output,
                //'total_data' => $total_row
            );

            $data = implode(" ", $data);

            return response()->json($data);


        }

    }



    public function AdminFilterCategoryReports(Request $request){

        $date1 =  \Carbon\Carbon::parse($request->date1);
        $date2 =  \Carbon\Carbon::parse($request->date2);
        $category =  $request->category;
        if($request->ajax())
        {

            $output = '';
            $output .="
            <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th>Date Created</th>
                    <th>Archive Code</th>
                    <th>Project Title</th>
                    <th>Department</th>
                    <th>Curriculum</th>
                    <th>Status</th>
                </tr>
            <tbody id='load_data'>
        ";
            $query = $request->get('query');
            if($query != '')
            {
                $data = DB::table('archives')
                ->select(
                    'student_models.id as student_id',
                    'student_models.fullname',
                    'student_models.email',
                    'users.name',
                    'users.email',
                    'users.role',
                    'archives.id as archives_id',
                    'archives.student_id',
                    'archives.student_foreign_id',
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
                ->leftjoin('student_models','student_models.id','=','archives.student_id')
                ->leftjoin('users','users.id','=','archives.student_foreign_id')
                ->leftjoin('curricula','curricula.id','=','archives.curriculum_id')
                ->leftjoin('departments','departments.id','=','archives.department_id')
                ->where('archives.category',  $category)
                ->whereBetween('archives.created_at', [$date1, $date2])
               ->get();


            }
            else
            {
                $data = DB::table('archives')
                ->select(
                    'student_models.id as student_id',
                    'student_models.fullname',
                    'student_models.email',
                    'users.name',
                    'users.email',
                    'users.role',
                    'archives.id as archives_id',
                    'archives.student_id',
                    'archives.student_foreign_id',
                    'archives.title',
                    'archives.abstract',
                    'archives.banner_path',
                    'archives.status',
                    'archives.type',
                    'archives.category',
                    'archives.created_at',
                    'archives.archive_code',
                    'curricula.name as curriculum_name',
                    'departments.name as department_name',
                    )
                ->leftjoin('student_models','student_models.id','=','archives.student_id')
                ->leftjoin('users','users.id','=','archives.student_foreign_id')
                ->leftjoin('curricula','curricula.id','=','archives.curriculum_id')
                ->leftjoin('departments','departments.id','=','archives.department_id')
                ->where('archives.category',  $category)
                ->whereBetween('archives.created_at', [$date1, $date2])
               ->get();
            }

            $total_row = $data->count();

            if($total_row > 0)
            {
                foreach($data as $row)
                {

                if($row->status == 1){
                    $stat = '<span class="badge bg-success">Approved</span>';
                }elseif($row->status == 0){
                    $stat ='<span class="badge bg-danger">Rejected</span>';
                }else{
                   $stat = '<span class="badge bg-warning">Pending</span>';
                }

                    $output .= '
                    <tr>
                        <td>'.$row->archives_id.'</td>
                        <td style="text-transform: capitalize;">'.$row->type.'</td>
                        <td>'.$row->category.'</td>
                        <td>'.$row->created_at.'</td>
                        <td>'.$row->archive_code.'</td>
                        <td>'.$row->title.'</td>
                        <td>'.$row->department_name.'</td>
                        <td>'.$row->curriculum_name.'</td>
                        <td>'.$stat.'</td>
                    </tr>
                    ';
                }


                $date1 =  \Carbon\Carbon::parse($request->date1);
                $date2 =  \Carbon\Carbon::parse($request->date2);
                $category =  $request->category;


                 $TotalCategory = DB::table('archives')
                 ->where('category', $category)
                 ->whereBetween('archives.created_at', [$date1, $date2])
                ->count();


                //end Absent Part
                 $output .= '
                  <tr>
                    <td colspan="9" class="mt-3"><h6>Total Category: <span style="background-color:#1bdce3;padding: 1px 3px 1px 3px; border-radius:6px;color:#fff">'.$TotalCategory.'</span></h6></td>
                 </tr>
                  ';


             }
            else
            {
                $output = '
                <tr>
                    <td colspan="10"><center>No Data Found</center></td>
                </tr>
                ';
            }
            $data = array(
                'table_data' => $output,
                //'total_data' => $total_row
            );

            $data = implode(" ", $data);

            return response()->json($data);


        }

    }



    public function AdminFilterStatusReports(Request $request){

        $date1 =  \Carbon\Carbon::parse($request->date1);
        $date2 =  \Carbon\Carbon::parse($request->date2);
        $status =  $request->status;
        if($request->ajax())
        {

            $output = '';
            $output .="
            <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th>Date Created</th>
                    <th>Archive Code</th>
                    <th>Project Title</th>
                    <th>Department</th>
                    <th>Curriculum</th>
                    <th>Status</th>
                </tr>
            <tbody id='load_data'>
        ";
            $query = $request->get('query');
            if($query != '')
            {
                $data = DB::table('archives')
                ->select(
                    'student_models.id as student_id',
                    'student_models.fullname',
                    'student_models.email',
                    'users.name',
                    'users.email',
                    'users.role',
                    'archives.id as archives_id',
                    'archives.student_id',
                    'archives.student_foreign_id',
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
                ->leftjoin('student_models','student_models.id','=','archives.student_id')
                ->leftjoin('users','users.id','=','archives.student_foreign_id')
                ->leftjoin('curricula','curricula.id','=','archives.curriculum_id')
                ->leftjoin('departments','departments.id','=','archives.department_id')
                ->where('archives.status',  $status)
                ->whereBetween('archives.created_at', [$date1, $date2])
               ->get();


            }
            else
            {
                $data = DB::table('archives')
                ->select(
                    'student_models.id as student_id',
                    'student_models.fullname',
                    'student_models.email',
                    'users.name',
                    'users.email',
                    'users.role',
                    'archives.id as archives_id',
                    'archives.student_id',
                    'archives.student_foreign_id',
                    'archives.title',
                    'archives.abstract',
                    'archives.banner_path',
                    'archives.status',
                    'archives.type',
                    'archives.category',
                    'archives.created_at',
                    'archives.archive_code',
                    'curricula.name as curriculum_name',
                    'departments.name as department_name',
                    )
                ->leftjoin('student_models','student_models.id','=','archives.student_id')
                ->leftjoin('users','users.id','=','archives.student_foreign_id')
                ->leftjoin('curricula','curricula.id','=','archives.curriculum_id')
                ->leftjoin('departments','departments.id','=','archives.department_id')
                ->where('archives.status',  $status)
                ->whereBetween('archives.created_at', [$date1, $date2])
               ->get();
            }

            $total_row = $data->count();

            if($total_row > 0)
            {
                foreach($data as $row)
                {

                if($row->status == 1){
                    $stat = '<span class="badge bg-success">Approved</span>';
                }elseif($row->status == 0){
                    $stat ='<span class="badge bg-danger">Rejected</span>';
                }else{
                   $stat = '<span class="badge bg-warning">Pending</span>';
                }

                    $output .= '
                    <tr>
                        <td>'.$row->archives_id.'</td>
                        <td style="text-transform: capitalize;">'.$row->type.'</td>
                        <td>'.$row->category.'</td>
                        <td>'.$row->created_at.'</td>
                        <td>'.$row->archive_code.'</td>
                        <td>'.$row->title.'</td>
                        <td>'.$row->department_name.'</td>
                        <td>'.$row->curriculum_name.'</td>
                        <td>'.$stat.'</td>
                    </tr>
                    ';
                }

                $date1 =  \Carbon\Carbon::parse($request->date1);
                $date2 =  \Carbon\Carbon::parse($request->date2);
                $status =  $request->status;


                 $TotalStatus= DB::table('archives')
                 ->where('status', $status)
                 ->whereBetween('archives.created_at', [$date1, $date2])
                ->count();


                //end Absent Part
                 $output .= '
                  <tr>
                    <td colspan="9" class="mt-3"><h6>Total Status: <span style="background-color:#1bdce3;padding: 1px 3px 1px 3px; border-radius:6px;color:#fff">'.$TotalStatus.'</span></h6></td>
                 </tr>
                  ';


             }
            else
            {
                $output = '
                <tr>
                    <td colspan="10"><center>No Data Found</center></td>
                </tr>
                ';
            }
            $data = array(
                'table_data' => $output,
                //'total_data' => $total_row
            );

            $data = implode(" ", $data);

            return response()->json($data);


        }

    }


     public function AdminSearchStatusReports(Request $request){

        $types = archive::select('type')->distinct()->get();
        $systeminformation = SystemInformation::all();
        return view('admin.searchstatus', compact('systeminformation','types'));
     }


    public function AdminSearchCategoryReports(Request $request){

        $categorys = archive::select('category')->distinct()->get();
        $systeminformation = SystemInformation::all();
        return view('admin.searchcategory', compact('systeminformation','categorys'));

    }


}
