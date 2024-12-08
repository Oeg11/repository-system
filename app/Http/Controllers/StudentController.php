<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\archive;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\Models\studentModel;
use App\Models\department;
use App\Models\curriculum;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\SystemInformation;
use Socialite;
use Google_Client;
use Illuminate\Support\Facades\Session;
use Hash;

class StudentController extends Controller
{

    public function studentDashboard(){



        $capstone2 =  archive::where(['type' => 'Capstone 2', 'student_foreign_id' => Auth::user()->id])->count();//projects
        $csthesis2 =   archive::where(['type' => 'CS Thesis 2', 'student_foreign_id' => Auth::user()->id])->count();//research
        $shspracticalresearch =  archive::where(['type' => 'SHS Practical Research', 'student_foreign_id' => Auth::user()->id])->count();//thesisCapstone
        $bstmthesis =  archive::where(['type' => 'BSTM Thesis', 'student_foreign_id' => Auth::user()->id])->count();//thesisCapstone


        $systeminformation = SystemInformation::all();
        return view('students.dashboard', compact('systeminformation','capstone2', 'csthesis2','shspracticalresearch', 'bstmthesis'));
    }


    public function studentThesisCapstone(){

        $departments = department::all();
        $curriculums = curriculum::all();
        $systeminformation = SystemInformation::all();
        return view('students.thesiscapstone', compact('systeminformation','departments', 'curriculums'));
    }



    public function loginfunction(Request $request)
   {
       $request->validate([
           'email' => 'required',
           'password' => 'required',

       ]);

       $credentials = $request->only('email', 'password');
       $credentials['status'] = 1;

       if (Auth::guard('student')->attempt($credentials)) {
            return response()->json([
                'success' => true,
                'redirect_url' => route('students.index'),
            ]);
       }else {

            return response()->json([
                'success' => false,
                'message' => 'Invalid email and password.',
            ]);
        }


   }

   public function studentlogout(){
    Auth::guard('student')->logout();
    return redirect('/login');
   }

   public function submitProject(Request $request){

         $validator = Validator::make($request->all(), [

                'type' =>'required',
                'category' =>'required',
                'department_id' =>'required',
                'curriculum_id' =>'required',
                'title' =>'required',
                'year' =>'required',
                'abstract' =>'required',
                'members' =>'required',
                'adviser' =>'required',
                'banner_path' =>'required|mimes:png,jpg,jpeg|max:2048',
                'document_path' =>'required',
            ],[

                'type.required' => 'Please select type',
                'category.required' => 'Please select category',
                'department_id.required' => 'Please select your Department',
                'curriculum_id.required' => 'Please select your Curriculum',
                'title.required' => 'Please input unique Title',
                'year.required' => 'Please select Year',
                'abstract.required' => 'Please enter Abstract',
                'members.required' => 'Please enter members',
                'adviser.required' => 'Please input your Adviser',
                'banner_path.required' => 'Please upload sample Image',
                'document_path.required' => 'Please Attached document'

            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

        $archive = new archive;
        $banner_path = "";
        $files = $request->file('banner_path');
        if ($files !== null) {
            $banner_path = time() . '.' . $files->getClientOriginalExtension();
            $destinationPath = public_path('/storage/uploads');
            $files->move($destinationPath, $banner_path);
        }

        $document_path = "";
        $files = $request->file('document_path');
        if ($files !== null) {
            $document_path = time() . '.' . $files->getClientOriginalExtension();
            $destinationPath = public_path('/storage/uploads');
            $files->move($destinationPath, $document_path);
        }

        $archive_code = rand();
        $archive->archive_code = $archive_code;
        $archive->type = $request->type;
        $archive->category = $request->category;
        $archive->department_id = $request->department_id;
        $archive->curriculum_id = $request->curriculum_id;
        $archive->title = $request->title; //payroll system
        $archive->year = $request->year;
        $archive->abstract = $request->abstract;
        $archive->members = $request->members;
        $archive->adviser = $request->adviser;
        $archive->banner_path = $banner_path;
        $archive->document_path = $document_path;
        $archive->status = 2;
        $archive->student_foreign_id = $request->student_foreign_id;
        $archive->slug = Str::slug($request->title); //payroll-system
        $archive->save();

            return response()->json(['status' => 200]);

     }

     public function studentProfile(Request $request){


        $userauth = DB::table('student_models')
        ->select(
            'student_models.id',
            'student_models.fullname',
            'student_models.email',
            'student_models.password',
            'student_models.department_id',
            'student_models.curriculum_id',
            'curricula.name as curriculum_name',
            'departments.name as department_name',
            )
        ->leftjoin('curricula','curricula.id','=','student_models.curriculum_id')
        ->leftjoin('departments','departments.id','=','student_models.department_id')
        ->where('student_models.id',  Auth::user()->id)
        ->get();

        $departments = department::all();
        $curriculums = curriculum::all();
        $systeminformation = SystemInformation::all();

        return view('students.profile',  compact('systeminformation','userauth','departments','curriculums'));
     }

     public function studentStatus(Request $request){

        $archive = DB::table('student_models')
        ->select(
            'student_models.id as student_id',
            'student_models.fullname',
            'student_models.email',
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

            )
        ->leftjoin('archives','archives.student_foreign_id','=','student_models.id')
        ->leftjoin('curricula','curricula.id','=','student_models.curriculum_id')
        ->where('student_foreign_id',  Auth::user()->id)
        ->orderBy('archives.id','DESC')
        ->simplePaginate(5);
        // ->get();
        $systeminformation = SystemInformation::all();
        return view('students.status', compact('systeminformation','archive'));
     }

     public function updateProfile(Request $request){
        studentModel::where('id', $request->id)
        ->update([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'department_id' => $request->department_id,
            'curriculum_id' => $request->curriculum_id,
        ]);
        return response()->json([
            'status' => 200,
          ]);
     }




     public function SearchProject(Request $request){

        $paginates = archive::query()
        ->when(
            $request->q,
            function (Builder $builder) use ($request) {
                $builder->where('title', 'like', "%{$request->q}%");
                    // ->orWhere('abstract', 'like', "%{$request->q}%");
            }
        )
        ->latest()->paginate(3);
        $getSearchurl = $request->q;


        $ranks = DB::table('student_models')
        ->select(
            'student_models.id',
            'student_models.fullname',
            'student_models.email',
            'archives.student_id',
            'archives.title',
            'archives.abstract',
            'archives.count_rank',
            'archives.banner_path')
        ->leftjoin('archives','archives.student_id','=','student_models.id')
        ->where('archives.status',  1)
        ->orderBy('archives.count_rank','DESC')
        ->get();

        $systeminformation = SystemInformation::all();
        return view('students.projects',compact('systeminformation','paginates','getSearchurl','ranks'));
    }


    public function studentProject(Request $request){
        $archive = DB::table('student_models')
        ->select(
            'student_models.id',
            'student_models.fullname',
            'student_models.email',
            'archives.student_id',
            'archives.title',
            'archives.abstract',
            'archives.slug',
            'archives.banner_path')
        ->leftjoin('archives','archives.student_id','=','student_models.id')
        ->where('archives.status', '=',  1)
        ->orderBy('archives.id','DESC')
        ->simplePaginate(5);
        // ->get();


        $ranks = DB::table('student_models')
        ->select(
            'student_models.id',
            'student_models.fullname',
            'student_models.email',
            'archives.student_id',
            'archives.title',
            'archives.abstract',
            'archives.count_rank',
            'archives.banner_path')
        ->leftjoin('archives','archives.student_id','=','student_models.id')
        ->where('archives.status',  1)
        ->orderBy('archives.count_rank','DESC')
        ->get();
        // ->get();


        $paginates = archive::query()
        ->when(
            $request->q,
            function (Builder $builder) use ($request) {
                $builder->where('title', 'like', "%{$request->q}%");
                    // ->orWhere('abstract', 'like', "%{$request->q}%");
            }
        )
        ->where('status',  1)
        ->latest()->paginate(3);
        $getSearchurl = $request->q;
        $systeminformation = SystemInformation::all();
           return view('students.projects', compact('systeminformation','archive','paginates','getSearchurl','ranks'));
     }



     public function Studentviewmore($slug){

        $getonethesis = archive::orwhere('slug', $slug)->first();
        if(is_null($getonethesis)){
            return redirect()->back();
        }else{
            $systeminformation = SystemInformation::all();
            return view('students.viewmore', compact('getonethesis','systeminformation'));
        }
     }


     public function Rankcount(Request $request){

        archive::where('id', $request->id)
        ->update([
          'count_rank'=> DB::raw('count_rank + 1'),
        ]);

        return response()->json([
            'status' => 200,
          ]);


     }


     public function ProjectUpdate(Request $request){

       $id =  decrypt($request->id);

       $uthesiscapstone = DB::table('student_models')
       ->select(
           'student_models.id',
           'student_models.fullname',
           'student_models.email',
           'archives.id as archives_id',
           'archives.student_id',
           'archives.student_foreign_id',
           'archives.type',
           'archives.category',
           'archives.department_id',
           'archives.curriculum_id',
           'archives.year',
           'archives.title',
           'archives.abstract',
           'archives.members',
           'archives.adviser',
           'archives.banner_path',
           'archives.document_path',
           'archives.status',
           'archives.created_at',
           'archives.archive_code',
           'curricula.name as curriculum_name',

           )
       ->leftjoin('archives','archives.student_foreign_id','=','student_models.id')
       ->leftjoin('curricula','curricula.id','=','student_models.curriculum_id')
       ->where(['archives.id' =>  decrypt($request->id)])
       ->get();

       $departments = department::all();
       $curriculums = curriculum::all();

       $systeminformation = SystemInformation::all();
          return view('students.updatethesiscapstone', compact('id','departments', 'curriculums', 'uthesiscapstone','systeminformation'));
     }


     public function updateProject(Request $request){


        $validator = Validator::make($request->all(), [

            'type' =>'required',
            'category' =>'required',
            'department_id' =>'required',
            'curriculum_id' =>'required',
            'title' =>'required',
            'year' =>'required',
            'abstract' =>'required',
            'members' =>'required',
            'adviser' =>'required',
            'banner_path' =>'required',
            'document_path' =>'required',
        ],[

            'type.required' => 'Please select type',
            'category.required' => 'Please select category',
            'department_id.required' => 'Please select your Department',
            'curriculum_id.required' => 'Please select your Curriculum',
            'title.required' => 'Please input unique Title',
            'year.required' => 'Please select Year',
            'abstract.required' => 'Please enter Abstract',
            'members.required' => 'Please enter members',
            'adviser.required' => 'Please input your Adviser',
            'banner_path.required' => 'Please upload sample Image',
            'document_path.required' => 'Please Attached document'

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }


        $imagefile = '';
        $docfile = '';

        $id = archive::find($request->id);

        if ($request->hasFile('banner_path')) {
          $file = $request->file('banner_path');
          $imagefile = time() . '.' . $file->getClientOriginalExtension();
          $file->storeAs('uploads', $imagefile,'public');
          if ($id->banner_path) {
              Storage::delete('/storage/uploads/' . $id->banner_path);
          }
        } else {
            $imagefile = $request->default_banner_path;
        }


        if ($request->hasFile('document_path')) {
          $file2 = $request->file('document_path');
          $docfile = time() . '.' . $file2->getClientOriginalExtension();
          $file2->storeAs('uploads', $docfile,'public');
          if ($id->document_path) {
              Storage::delete('/storage/uploads/' . $id->document_path);
          }
        } else {
            $docfile = $request->default_document_path;
        }


         $projectData = [
            'type' => $request->type,
            'category' => $request->category,
            'department_id' => $request->department_id,
            'curriculum_id' => $request->curriculum_id,
            'title' => $request->title,
            'year' => $request->year,
            'abstract' => $request->abstract,
            'members' => $request->members,
            'adviser' => $request->adviser,
            'banner_path' => $request->banner_path,
            'document_path' => $request->document_path,
            'banner_path' => $imagefile,
            'document_path' => $docfile,
            // 'student_foreign_id' => $request->student_foreign_id,

        ];
       $id->update($projectData);
          return response()->json([
            'status' => 200,
          ]);



    }


    public function DeleteProject(Request $request){

        $id = $request->id;
        archive::find($id)->delete();
        return response()->json(['status'=> 200]);
    }


    public function ViewProject(Request $request){


        $archive = DB::table('student_models')
        ->select(
            'student_models.id as student_id',
            'student_models.fullname',
            'student_models.email',
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
        ->leftjoin('archives','archives.student_foreign_id','=','student_models.id')
        ->leftjoin('curricula','curricula.id','=','student_models.curriculum_id')
        ->leftjoin('departments','departments.id','=','student_models.department_id')
        ->where(['archives.category' => 'Web Application', 'archives.student_foreign_id' => Auth::user()->id])
        ->orderBy('archives.id','DESC')
        ->get();


        $systeminformation = SystemInformation::all();
        return view('students.viewproject', compact('archive','systeminformation'));
    }


    public function ViewResearch(Request $request){


        $archive = DB::table('student_models')
        ->select(
            'student_models.id as student_id',
            'student_models.fullname',
            'student_models.email',
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
        ->leftjoin('archives','archives.student_foreign_id','=','student_models.id')
        ->leftjoin('curricula','curricula.id','=','student_models.curriculum_id')
        ->leftjoin('departments','departments.id','=','student_models.department_id')
        ->where(['archives.category' => 'Mobile Application', 'archives.student_foreign_id' => Auth::user()->id])
        ->orderBy('archives.id','DESC')
        ->get();

        $systeminformation = SystemInformation::all();
        return view('students.viewresearch', compact('archive','systeminformation'));
    }


    public function ViewCapstonethesis(Request $request){


        $archive = DB::table('student_models')
        ->select(
            'student_models.id as student_id',
            'student_models.fullname',
            'student_models.email',
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
        ->leftjoin('archives','archives.student_foreign_id','=','student_models.id')
        ->leftjoin('curricula','curricula.id','=','student_models.curriculum_id')
        ->leftjoin('departments','departments.id','=','student_models.department_id')
        ->where(['archives.category' => 'PC Application', 'archives.student_foreign_id' => Auth::user()->id])
        ->orderBy('archives.id','DESC')
        ->get();

        $systeminformation = SystemInformation::all();
        return view('students.viewcapstonethesis', compact('archive','systeminformation'));
    }


    public function ViewTotalprojects(Request $request){


        $archive = DB::table('student_models')
        ->select(
            'student_models.id as student_id',
            'student_models.fullname',
            'student_models.email',
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
        ->leftjoin('archives','archives.student_foreign_id','=','student_models.id')
        ->leftjoin('curricula','curricula.id','=','student_models.curriculum_id')
        ->leftjoin('departments','departments.id','=','student_models.department_id')
        ->where(['archives.category' => 'Standalone Application', 'archives.student_foreign_id' => Auth::user()->id])
        ->orderBy('archives.id','DESC')
        ->get();

        $systeminformation = SystemInformation::all();
        return view('students.viewtotalprojects', compact('archive','systeminformation'));
    }


//////////////////////////////////all below for login google authentication//////////////////////////////////////

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        try {
            // Get the authenticated user's information from Google
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Failed to authenticate with Google.');
        }

        // Check if the user already exists in the database
        $existingUser = User::where('email', $googleUser->getEmail())->first();
        $accessToken = $googleUser->token;
        // Store the access token in the session
        session(['google_access_token' => $accessToken]);

        if ($existingUser) {
            // Log in the user if they already exist
            Auth::login($existingUser, true);
        } else {
            // If the user doesn't exist, create a new user
            $newUser = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'password' => bcrypt(Str::random(16)),
                'role' => 'student',
                'status' => 1,
            ]);

            Auth::login($newUser, true);
        }

        // Redirect the user to the desired location after login
        return redirect()->route('dashboard.google');
    }

    public function studentDashboardGoogle(){

        $user = Auth::user(); //google auth
        $capstone2 =  archive::where(['type' => 'Capstone 2', 'student_id' => Auth::user()->id])->count();//projects
        $csthesis2 =   archive::where(['type' => 'CS Thesis 2', 'student_id' => Auth::user()->id])->count();//research
        $shspracticalresearch =  archive::where(['type' => 'SHS Practical Research', 'student_id' => Auth::user()->id])->count();//thesisCapstone
        $bstmthesis =  archive::where(['type' => 'BSTM Thesis', 'student_id' => Auth::user()->id])->count();//thesisCapstone

        $systeminformation = SystemInformation::all();
        return view('studentgoogleauth.dashboard', compact('user', 'systeminformation','capstone2', 'csthesis2','shspracticalresearch', 'bstmthesis'));

    }

    public function googleauthstudentThesisCapstone(Request $request){

        $departments = department::all();
        $curriculums = curriculum::all();
        $systeminformation = SystemInformation::all();
        $user = Auth::user(); //google auth
        return view('studentgoogleauth.thesiscapstone', compact('user','systeminformation','departments', 'curriculums'));

    }


    public function googleauthstudentProject(Request $request){
        $archive = DB::table('archives')
        ->select(
            'archives.id',
            'archives.title',
            'archives.abstract',
            'archives.slug',
            'archives.banner_path')
        ->where('archives.status', '=',  1)
        ->orderBy('archives.id','DESC')
        ->simplePaginate(5);
        // ->get();


        // $ranks = DB::table('archives')
        // ->select(
        //     'archives.id',
        //     'archives.title',
        //     'archives.abstract',
        //     'archives.count_rank',
        //     'archives.banner_path')
        // ->where('archives.status',  1)
        // ->orderBy('archives.count_rank','DESC')
        // ->get();
        // ->get();


        $paginates = archive::query()
        ->when(
            $request->q,
            function (Builder $builder) use ($request) {
                $builder->where('title', 'like', "%{$request->q}%");
                    // ->orWhere('abstract', 'like', "%{$request->q}%");
            }
        )
        ->where('status',  1)
        ->latest()->paginate(3);
        $getSearchurl = $request->q;
        $systeminformation = SystemInformation::all();
        $user = Auth::user(); //google auth
        return view('studentgoogleauth.projects', compact('user', 'systeminformation','archive','paginates','getSearchurl'));
     }

     public function googleauthSearchProject(Request $request){

        $paginates = archive::query()
        ->when(
            $request->q,
            function (Builder $builder) use ($request) {
                $builder->where('title', 'like', "%{$request->q}%");
                    // ->orWhere('abstract', 'like', "%{$request->q}%");
            }
        )
        ->latest()->paginate(3);
        $getSearchurl = $request->q;


        // $ranks = DB::table('archives')
        // ->select(
        //     'archives.id',
        //     'archives.title',
        //     'archives.abstract',
        //     'archives.count_rank',
        //     'archives.banner_path')
        // ->where('archives.status',  1)
        // ->orderBy('archives.count_rank','DESC')
        // ->get();


        $systeminformation = SystemInformation::all();
        $user = Auth::user(); //google auth

        return view('studentgoogleauth.projects',compact('user', 'systeminformation','paginates','getSearchurl'));
    }


    public function googleauthStudentviewmore($slug){

        $getonethesis = archive::orwhere('slug', $slug)->first();
        if(is_null($getonethesis)){
            return redirect()->back();
        }else{
            $systeminformation = SystemInformation::all();
            $user = Auth::user(); //google auth
            return view('studentgoogleauth.viewmore', compact('user', 'getonethesis','systeminformation'));
        }
     }


     public function googleauthRankcount(Request $request){

       $studentauth = archive::find($request->id);
       $studentauth->count_rank += 1;
       $studentauth->save();

        return response()->json([
            'status' => 200,
          ]);


     }

     public function googleauthstudentProfile(Request $request){


        $userauth = DB::table('users')
        ->select(
            'users.id',
            'users.name',
            'users.email',
            )
        ->where('users.id',  Auth::user()->id)
        ->get();

        $systeminformation = SystemInformation::all();
        $user = Auth::user(); //google auth
        return view('studentgoogleauth.profile',  compact('user', 'systeminformation','userauth'));
     }


     public function googleauthupdateProfile(Request $request){
        User::where('id', $request->id)
        ->update([
            'name' => $request->fullname,
            'email' => $request->email,
        ]);
        return response()->json([
            'status' => 200,
          ]);
     }


     public function googleauthstudentStatus(Request $request){

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
            'archives.type',
            'archives.status',
            'archives.remark',
            'archives.category',
            'archives.created_at',
            'archives.archive_code',
            // 'curricula.name as curriculum_name',

            )
        ->leftjoin('archives','archives.student_id','=','users.id')
        // ->leftjoin('curricula','curricula.id','=','users.curriculum_id')
        ->where('archives.google_id', Auth::user()->google_id)
        ->orderBy('archives.id','DESC')
        ->simplePaginate(5);
        // ->get();
        $systeminformation = SystemInformation::all();
        $user = Auth::user(); //google auth
        return view('studentgoogleauth.status', compact('user', 'systeminformation','archive'));
     }


     public function googleauthsubmitProject(Request $request){

        $validator = Validator::make($request->all(), [

              'type' =>'required',
               'category' =>'required',
               'department_id' =>'required',
               'curriculum_id' =>'required',
               'title' =>'required',
               'year' =>'required',
               'abstract' =>'required',
               'members' =>'required',
               'adviser' =>'required',
               'banner_path' =>'required|mimes:png,jpg,jpeg|max:2048',
               'document_path' =>'required',
           ],[

               'type.required' => 'Please select type',
               'category.required' => 'Please select category',
               'department_id.required' => 'Please select your Department',
               'curriculum_id.required' => 'Please select your Curriculum',
               'title.required' => 'Please input unique Title',
               'year.required' => 'Please select Year',
               'abstract.required' => 'Please enter Abstract',
               'members.required' => 'Please enter members',
               'adviser.required' => 'Please input your Adviser',
               'banner_path.required' => 'Please upload sample Image',
               'document_path.required' => 'Please Attached document'

           ]);

           if ($validator->fails()) {
               return response()->json(['errors' => $validator->errors()]);
           }

       $archive = new archive;
       $banner_path = "";
       $files = $request->file('banner_path');
       if ($files !== null) {
           $banner_path = time() . '.' . $files->getClientOriginalExtension();
           $destinationPath = public_path('/storage/uploads');
           $files->move($destinationPath, $banner_path);
       }

       $document_path = "";
       $files = $request->file('document_path');
       if ($files !== null) {
           $document_path = time() . '.' . $files->getClientOriginalExtension();
           $destinationPath = public_path('/storage/uploads');
           $files->move($destinationPath, $document_path);
       }

       $status = 2;
       $archive_code = rand();
       $archive->archive_code = $archive_code;
       $archive->type = $request->type;
       $archive->category = $request->category;
       $archive->department_id = $request->department_id;
       $archive->curriculum_id = $request->curriculum_id;
       $archive->title = $request->title; //payroll system
       $archive->year = $request->year;
       $archive->abstract = $request->abstract;
       $archive->members = $request->members;
       $archive->adviser = $request->adviser;
       $archive->banner_path = $banner_path;
       $archive->document_path = $document_path;
       $archive->status = $status;
       $archive->student_id = $request->student_id;
       $archive->slug = Str::slug($request->title); //payroll-system
       $archive->google_id = $request->google_id;
       $archive->save();

           return response()->json(['status' => 200]);

    }


    public function googleauthProjectUpdate(Request $request){

        $id =  decrypt($request->id);

        $uthesiscapstone = DB::table('users')
        ->select(
            'users.id',
            'users.name',
            'users.email',
            'archives.id as archives_id',
            'archives.student_id',
            'archives.category',
            'archives.department_id',
            'archives.curriculum_id',
            'archives.year',
            'archives.title',
            'archives.abstract',
            'archives.members',
            'archives.adviser',
            'archives.banner_path',
            'archives.document_path',
            'archives.type',
            'archives.status',
            'archives.created_at',
            'archives.archive_code',
            // 'curricula.name as curriculum_name',

            )
        ->leftjoin('archives','archives.student_id','=','users.id')
        // ->leftjoin('curricula','curricula.id','=','users.curriculum_id')
        ->where('archives.id',  decrypt($request->id))
        ->get();

        $departments = department::all();
        $curriculums = curriculum::all();
        $user = Auth::user(); //google auth
        $systeminformation = SystemInformation::all();
           return view('studentgoogleauth.updatethesiscapstone', compact('systeminformation', 'user', 'id','departments', 'curriculums', 'uthesiscapstone'));
      }

      public function googleauthupdateProject(Request $request){


        $validator = Validator::make($request->all(), [

            'type' =>'required',
            'category' =>'required',
            'department_id' =>'required',
            'curriculum_id' =>'required',
            'title' =>'required',
            'year' =>'required',
            'abstract' =>'required',
            'members' =>'required',
            'adviser' =>'required',
            'banner_path' =>'required',
            'document_path' =>'required',
        ],[

            'type.required' => 'Please select type',
            'category.required' => 'Please select category',
            'department_id.required' => 'Please select your Department',
            'curriculum_id.required' => 'Please select your Curriculum',
            'title.required' => 'Please input unique Title',
            'year.required' => 'Please select Year',
            'abstract.required' => 'Please enter Abstract',
            'members.required' => 'Please enter members',
            'adviser.required' => 'Please input your Adviser',
            'banner_path.required' => 'Please upload sample Image',
            'document_path.required' => 'Please Attached document'

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }


        $imagefile = '';
        $docfile = '';

        $id = archive::find($request->id);

        if ($request->hasFile('banner_path')) {
          $file = $request->file('banner_path');
          $imagefile = time() . '.' . $file->getClientOriginalExtension();
          $file->storeAs('uploads', $imagefile,'public');
          if ($id->banner_path) {
              Storage::delete('/storage/uploads/' . $id->banner_path);
          }
        } else {
            $imagefile = $request->default_banner_path;
        }


        if ($request->hasFile('document_path')) {
          $file2 = $request->file('document_path');
          $docfile = time() . '.' . $file2->getClientOriginalExtension();
          $file2->storeAs('uploads', $docfile,'public');
          if ($id->document_path) {
              Storage::delete('/storage/uploads/' . $id->document_path);
          }
        } else {
            $docfile = $request->default_document_path;
        }


         $projectData = [
            'type' => $request->type,
            'category' => $request->category,
            'department_id' => $request->department_id,
            'curriculum_id' => $request->curriculum_id,
            'title' => $request->title,
            'year' => $request->year,
            'abstract' => $request->abstract,
            'members' => $request->members,
            'adviser' => $request->adviser,
            'banner_path' => $request->banner_path,
            'document_path' => $request->document_path,
            'banner_path' => $imagefile,
            'document_path' => $docfile,

        ];
       $id->update($projectData);
          return response()->json([
            'status' => 200,
          ]);



    }


    public function googleauthDeleteProject(Request $request){

        $id = $request->id;
        archive::find($id)->delete();
        return response()->json(['status'=> 200]);
    }




    public function googleauthViewProject(Request $request){


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
        ->where(['archives.category' => 'Web Application', 'archives.student_id' => Auth::user()->id])
        ->orderBy('archives.id','DESC')
        ->get();

        $user = Auth::user(); //google auth
        $systeminformation = SystemInformation::all();
        return view('studentgoogleauth.viewproject', compact('archive','user','systeminformation'));
    }


    public function googleauthViewResearch(Request $request){


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
        ->where(['archives.category' => 'Mobile Application', 'archives.student_id' => Auth::user()->id])
        ->orderBy('archives.id','DESC')
        ->get();

        $user = Auth::user(); //google auth
        $systeminformation = SystemInformation::all();
        return view('studentgoogleauth.viewresearch', compact('archive','user','systeminformation'));
    }


    public function googleauthViewCapstonethesis(Request $request){


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
        ->where(['archives.category' => 'PC Application', 'archives.student_id' => Auth::user()->id])
        ->orderBy('archives.id','DESC')
        ->get();

        $user = Auth::user(); //google auth
        $systeminformation = SystemInformation::all();
        return view('studentgoogleauth.viewcapstonethesis', compact('archive','user','systeminformation'));
    }


    public function googleauthViewTotalprojects(Request $request){


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
        ->where(['archives.category' => 'Standalone Application', 'archives.student_id' => Auth::user()->id])
        ->orderBy('archives.id','DESC')
        ->get();

        $user = Auth::user(); //google auth
        $systeminformation = SystemInformation::all();
        return view('studentgoogleauth.viewtotalprojects', compact('archive','user','systeminformation'));
    }





    public function studentgoogleauthlogout(){

          Auth::logout();
          session()->flush();  // Clear session if needed

          // Revoke the Google access token
          $googleToken = session('google_access_token');

          if ($googleToken) {
              $client = new Google_Client();
              $client->setAccessToken($googleToken);

              // Revoke the token
              $client->revokeToken($googleToken);
          }
        //   return redirect('/');
        //   // Redirect the user to Google logout URL (Optional)
          $googleLogoutUrl = 'https://accounts.google.com/Logout';
          return redirect($googleLogoutUrl);  // Logs out from Google completely

    }

}
