<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


    Route::get('/', [UserController::class, 'Mainindex'])->name('main');
    Route::get('/about', [UserController::class, 'about'])->name('about_us');
    Route::get('/project', [UserController::class, 'project'])->name('view_project');
    Route::get('/login', [UserController::class, 'login'])->name('view_login');
    // Route::post('/register', [UserController::class, 'register'])->name('student.register');
    Route::post('/user-login', [UserController::class, 'userLogin'])->name('user.login');

    Route::get('/admin/login', [AdminController::class, 'adminlogin'])->name('admin.login');
    Route::post('/admin/login/account', [AdminController::class, 'loginfunctionadmin'])->name('admin.loginaccount');

    Route::middleware(['auth:admin'])->group(function(){
        Route::get('/admin/dashboard', [AdminController::class, 'admindashboard'])->name('admin.dashboard');

        Route::get('/admin/archivelist', [AdminController::class, 'archivelists'])->name('admin.archive');
        Route::post('/admin/update/archivelist', [AdminController::class, 'updatearchivelist'])->name('admin.updatestatus');
        Route::delete('/admin/deletearchive', [AdminController::class, 'deleteArchive'])->name('admin.deletearchive');

        Route::get('/admin/studentlist', [AdminController::class, 'adminstudentlists'])->name('admin.studentlist');
        Route::post('/admin/update/studentstatus', [AdminController::class, 'updateStudentstatus'])->name('admin.updatestudentstatus');
        Route::delete('/admin/deletestudent', [AdminController::class, 'deleteStudent_'])->name('admin.deletestudent');

        Route::get('/admin/departmentlist', [AdminController::class, 'admindepartmentlists_'])->name('admin.departmentlist');
        Route::post('/admin/add/department', [AdminController::class, 'addDepartment'])->name('admin.adddepartment');
        Route::post('/admin/update/department', [AdminController::class, 'updateDepartment'])->name('admin.updatedepartment');
        Route::delete('/admin/deletedepartment', [AdminController::class, 'deleteDepartment_'])->name('admin.deletedepartment');

        Route::get('/admin/curriculumlist', [AdminController::class, 'admincurriculumlists_'])->name('admin.curriculumlist');
        Route::post('/admin/add/curriculum', [AdminController::class, 'addCurriculum'])->name('admin.addcurriculum');
        Route::post('/admin/update/curriculum', [AdminController::class, 'updateCurriculum'])->name('admin.updatecurriculum');
        Route::delete('/admin/deletecurriculum', [AdminController::class, 'deleteCurriculum_'])->name('admin.deletecurriculum');

        Route::get('/admin/faculty_stafflist', [AdminController::class, 'adminfaculty_stafflists_'])->name('admin.faculty_stafflist');
        Route::post('/admin/add/faculty_stafflist', [AdminController::class, 'AddStaff'])->name('admin.addstaff');
        Route::post('/admin/update/facultystaff', [AdminController::class, 'updateFacultystaff'])->name('admin.updatefacultystaff');
        Route::delete('/admin/deletefacultystaff', [AdminController::class, 'deleteFacultystaff_'])->name('admin.deletefacultystaff');

        Route::get('/admin/settings', [AdminController::class, 'adminsettings_'])->name('admin.settings');
        Route::post('/admin/update/settings', [AdminController::class, 'updateSettings'])->name('admin.updatesettings');
        Route::delete('/admin/deletesettings', [AdminController::class, 'deleteSettings_'])->name('admin.deletesettings');

        Route::get('/admin/usercontrol', [AdminController::class, 'userControl'])->name('admin.usercontrol');

        Route::get('admin/viewmore/view/project', [AdminController::class, 'ViewProject'])->name('admin.viewproject');
        Route::get('admin/viewmore/view/research', [AdminController::class, 'ViewResearch'])->name('admin.viewresearch');
        Route::get('admin/viewmore/view/capstonethesis', [AdminController::class, 'ViewCapstonethesis'])->name('admin.viewcapstonethesis');
        Route::get('admin/viewmore/view/totalprojects', [AdminController::class, 'ViewTotalprojects'])->name('admin.viewtotalprojects');


        Route::get('admin/viewmore/view/verifiedarchive', [AdminController::class, 'ViewVerifiedarchive'])->name('admin.viewverifiedarchive');
        Route::get('admin/viewmore/view/notverifiedarchive', [AdminController::class, 'ViewNotVerifiedarchive'])->name('admin.viewnotverifiedarchive');


        Route::get('admin/changepassword', [AdminController::class, 'ChangePassword'])->name('admin.changepassword');
        Route::post('/admin/update/password', [AdminController::class, 'updatePassword'])->name('admin.updatepassword');
        // Route::post('/admin/update/', [YourController::class, 'updateStatus'])->name('update.status');
        Route::post('/admin/add/usercontrol', [AdminController::class, 'AddUserControl'])->name('admin.addusercontrol');
        Route::post('/admin/update/usercontrol', [AdminController::class, 'UpdateUserControl'])->name('admin.updateusercontrol');


       Route::get('/admin/reports', [AdminController::class, 'AdminReports'])->name('admin.reports');
       Route::get('/admin/backup/database', [AdminController::class, 'AdminBackupDatabase'])->name('admin.backupdb');

    });

    Route::get('/staff/login', [StaffController::class, 'stafflogin'])->name('staff.login');
    Route::post('/ajax-login', [StudentController::class, 'loginfunction'])->name('ajax.login');


    Route::get('auth/google', [StudentController::class, 'redirect'])->name('auth.google');
    Route::get('auth/google/call-back', [StudentController::class, 'googleCallback']);

    Route::middleware(['auth'])->group(function(){

        Route::get('/student/dashboard', [StudentController::class, 'studentDashboardGoogle'])->name('dashboard.google');
        Route::post('/students/googleauth/logout', [StudentController::class, 'studentgoogleauthlogout'])->name('studentgoogleauth.logout');
        Route::get('/students/googleauth/thesiscapstone', [StudentController::class, 'googleauthstudentThesisCapstone'])->name('studentgoogleauth.thesiscapstone');

        Route::get('/students/googleauth/projects', [StudentController::class, 'googleauthstudentProject'])->name('studentgoogleauth.project');
        Route::get('/students/googleauth/search', [StudentController::class, 'googleauthSearchProject'])->name('googleauthstudents.search');

        Route::post('/students/googleauth/submitproject', [StudentController::class, 'googleauthsubmitProject'])->name('googleauthstudent.submitproject');

        Route::get('/googleauth/viewmore/{slug}', [StudentController::class, 'googleauthStudentviewmore'])->name('googleauthstudent.viewmore');
        Route::post('/students/googleauth/rankcount', [StudentController::class, 'googleauthRankcount'])->name('googleauthstudents.rankcount');

        Route::get('/students/googleauth/profile', [StudentController::class, 'googleauthstudentProfile'])->name('googleauthstudents.profile');
        Route::post('/students/googleauth/update', [StudentController::class, 'googleauthupdateProfile'])->name('googleauthstudents.updateProfile');

        Route::get('/students/googleauth/status', [StudentController::class, 'googleauthstudentStatus'])->name('googleauthstudents.status');
        Route::get('/projects/googleauth/update/{id}', [StudentController::class, 'googleauthProjectUpdate'])->name('googleauthprojects.edit');
        Route::post('/students/googleauth/updateproject', [StudentController::class, 'googleauthupdateProject'])->name('googleauthstudent.updateproject');
        Route::delete('/students/googleauth/deleteproject', [StudentController::class, 'googleauthDeleteProject'])->name('googleauthstudent.deleteproject');


        Route::get('/viewmore/googleauth/view/project', [StudentController::class, 'googleauthViewProject'])->name('googleauthstudent.viewproject');
        Route::get('/viewmore/googleauth/view/research', [StudentController::class, 'googleauthViewResearch'])->name('googleauthstudent.viewresearch');
        Route::get('/viewmore/googleauth/view/capstonethesis', [StudentController::class, 'googleauthViewCapstonethesis'])->name('googleauthstudent.viewcapstonethesis');
        Route::get('/viewmore/googleauth/view/totalprojects', [StudentController::class, 'googleauthViewTotalprojects'])->name('googleauthstudent.viewtotalprojects');

    });


    Route::middleware(['auth:student'])->group(function(){

        Route::get('/students/dashboard', [StudentController::class, 'studentDashboard'])->name('students.index');
        Route::get('/students/thesiscapstone', [StudentController::class, 'studentThesisCapstone'])->name('students.thesiscapstone');

        Route::post('/students/logout', [StudentController::class, 'studentlogout'])->name('student.logout');
        Route::post('/students/update', [StudentController::class, 'updateProfile'])->name('student.updateProfile');
        Route::post('/students/submitproject', [StudentController::class, 'submitProject'])->name('student.submitproject');
        Route::get('/students/projects', [StudentController::class, 'studentProject'])->name('students.project');
        Route::get('/students/profile', [StudentController::class, 'studentProfile'])->name('students.profile');
        Route::get('/students/status', [StudentController::class, 'studentStatus'])->name('students.status');
        Route::get('/students/search', [StudentController::class, 'SearchProject'])->name('students.search');
        Route::get('/viewmore/{slug}', [StudentController::class, 'Studentviewmore'])->name('student.viewmore');
        Route::post('/students/rankcount', [StudentController::class, 'Rankcount'])->name('students.rankcount');
        Route::get('/projects/update/{id}', [StudentController::class, 'ProjectUpdate'])->name('projects.edit');
        Route::post('/students/updateproject', [StudentController::class, 'updateProject'])->name('student.updateproject');
        Route::delete('/students/deleteproject', [StudentController::class, 'DeleteProject'])->name('project.deleteproject');

        Route::get('/viewmore/view/project', [StudentController::class, 'ViewProject'])->name('student.viewproject');
        Route::get('/viewmore/view/research', [StudentController::class, 'ViewResearch'])->name('student.viewresearch');
        Route::get('/viewmore/view/capstonethesis', [StudentController::class, 'ViewCapstonethesis'])->name('student.viewcapstonethesis');
        Route::get('/viewmore/view/totalprojects', [StudentController::class, 'ViewTotalprojects'])->name('student.viewtotalprojects');


    });



         Route::get('/login/staff', [StaffController::class, 'loginStaff'])->name('view_loginstaff');
         Route::post('/staff/login', [StaffController::class, 'loginfunctionStaff'])->name('staff.loginaccount');
   Route::middleware(['auth:staff'])->group(function(){
        Route::get('/staff/dashboard', [StaffController::class, 'stafflogin'])->name('staff.dashboard');
        Route::get('/staff/archivelist', [StaffController::class, 'archivelists'])->name('staff.archive');
        Route::post('/staff/update/archivelist', [StaffController::class, 'updatearchivelist'])->name('staff.updatestatus');
        Route::delete('/staff/deletearchive', [StaffController::class, 'deleteArchive'])->name('staff.deletearchive');

        Route::get('/staff/studentlist', [StaffController::class, 'stafftudentlists'])->name('staff.studentlist');
        Route::delete('/staff/deletestudent', [StaffController::class, 'deleteStudent'])->name('staff.deletestudent');


        Route::get('staff/viewmore/view/project', [StaffController::class, 'ViewProject'])->name('staff.viewproject');
        Route::get('staff/viewmore/view/research', [StaffController::class, 'ViewResearch'])->name('staff.viewresearch');
        Route::get('staff/viewmore/view/capstonethesis', [StaffController::class, 'ViewCapstonethesis'])->name('staff.viewcapstonethesis');
        Route::get('staff/viewmore/view/totalprojects', [StaffController::class, 'ViewTotalprojects'])->name('staff.viewtotalprojects');

        Route::get('staff/viewmore/view/verifiedstudents', [StaffController::class, 'ViewVerifiedstudents'])->name('staff.verifiedstudents');
        Route::get('staff/viewmore/view/notverifiedstudents', [StaffController::class, 'ViewNotVerifiedstudents'])->name('staff.notverifiedstudents');

        Route::get('staff/viewmore/view/verifiedarchive', [StaffController::class, 'ViewVerifiedarchive'])->name('staff.viewverifiedarchive');
        Route::get('staff/viewmore/view/notverifiedarchive', [StaffController::class, 'ViewNotVerifiedarchive'])->name('staff.viewnotverifiedarchive');

        Route::get('staff/changepassword', [StaffController::class, 'ChangePassword'])->name('staff.changepassword');
        Route::post('/staff/update/password', [StaffController::class, 'updatePassword'])->name('staff.updatepassword');


        Route::post('/staff/logout', [StaffController::class, 'stafflogout'])->name('staff.logout');
    });

