<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Authentication Routes...
$this->get('/', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login/submit', 'Auth\LoginController@login')->name('login.submit');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

//........admin login
Route::get('admin/login','Admin\User\AdminUsersController@login')->name('admin.login');

//........Student login
Route::get('student/login', 'Auth\StudentLoginController@showLoginForm')->name('student.login');
Route::post('student/login/submit', 'Auth\StudentLoginController@login')->name('student.login.submit');

//.........SUPER ADMIN AREA..........
Route::group(['prefix'=>'admin','middleware'=>'isSuperAdmin'], function(){
    //.......dashboard
    Route::get('dashboard', function () {
        return view('super_admin.dash.index');
    })->name('super.admin.dash');

    //.......departments
    Route::resource('department','SuperAdmin\Department\DepartmentsController');

    //.......exam-room
    Route::resource('exam-room','SuperAdmin\ExamRoom\ExamRoomsController');
    Route::get('exam-rooms/{exam_season}','SuperAdmin\ExamRoom\ExamRoomsController@room_list')->name('super-admin.exam-room.list');

    //.......exam-season
    Route::resource('exam-season','SuperAdmin\ExamSeason\ExamSeasonsController');

    //.......Admin & Super admin
    Route::resource('user','SuperAdmin\User\AdminUsersController',['except'=>'show']);
    Route::get('user/super-admin-list','SuperAdmin\User\AdminUsersController@super_admin_list')->name('super-admin.list');
    Route::put('user/password/{id}','SuperAdmin\User\AdminUsersController@changePassword')->name('super-admin.user.changePassword');
    Route::get('user/verify/{token}','SuperAdmin\User\AdminUsersController@verifyByAdmin')->name('super-admin.user.verifyByAdmin');
    Route::get('user/active/{id}','SuperAdmin\User\AdminUsersController@active')->name('super-admin.user.active');
    Route::get('user/deactive/{id}','SuperAdmin\User\AdminUsersController@deactive')->name('super-admin.user.deactive');

    //.......exam/shift-times
    Route::resource('exam/shift-time','SuperAdmin\ExamShiftTime\ExamShiftTimeController');

    //.......exam-date
    Route::resource('exam-date','SuperAdmin\ExamDate\ExamDatesController');
    Route::get('exam-date-by-season','SuperAdmin\ExamDate\ExamDatesController@getExamDate')->name('exam-date.by-season');
});

//.........ADMIN AREA..........
Route::group(['prefix'=>'admin','middleware'=>'isAdmin'],function(){
    //..........admin dash
    Route::get('dash','Admin\Dash\AdminDashController@dash')->name('admin.dash');
    //..........user role
    Route::resource('user-role','Admin\Role\UserRolesController',['except'=>['create','show']]);
    //..........user
    Route::resource('users','Admin\User\AdminUsersController',['except'=>'show']);
    Route::put('users/password/{id}','Admin\User\AdminUsersController@changePassword')->name('user.changePassword');
    Route::get('users/verify/{token}','Admin\User\AdminUsersController@verifyByAdmin')->name('user.verifyByAdmin');
    Route::get('users/admin/{id}','Admin\User\AdminUsersController@makeAdmin')->name('user.makeAdmin');
    Route::get('users/regular/{id}','Admin\User\AdminUsersController@makeRegular')->name('user.makeRegular');
    Route::get('users/active/{id}','Admin\User\AdminUsersController@active')->name('user.active');
    Route::get('users/deactive/{id}','Admin\User\AdminUsersController@deactive')->name('user.deactive');

    //.........batch
    Route::resource('batch','Admin\Batch\BatchesController',['except'=>'show']);
    //.........student
    Route::resource('student', 'Admin\Student\StudentsController');

    Route::get('student/{batch_id}/list', 'Admin\Student\StudentsController@studentsList')->name('student.list');

    //.........semester
    Route::resource('semester','Admin\Semester\SemestersController',['except'=>['create','show']]);
    //.........course
    Route::resource('course','Admin\Course\CoursesController',['except'=>'show']);
    //.........teacher
    Route::get('teacher','Admin\Teacher\TeachersController@index')->name('teacher.index');
    //.........course enroll
    Route::resource('course-enroll','Admin\CourseEnroll\CourseEnrollController',['show']);
    Route::get('course-enroll/show','Admin\CourseEnroll\CourseEnrollController@show')->name('course-enroll.show');
    //.........student enroll
    Route::resource('student-enroll','Admin\StudentEnroll\StudentEnrollsController');
    Route::get('student-enrolls/show','Admin\StudentEnroll\StudentEnrollsController@enrolls_show')->name('student-enrolls.show');
    Route::get('student-enrolls/get_data','Admin\StudentEnroll\StudentEnrollsController@get_data_by_json_where_semester_id')->name('student-enrolls.get_data');
    Route::get('student-enrolls/unroll','Admin\StudentEnroll\StudentEnrollsController@student_unroll')->name('student-enrolls.unroll');

    //.........student room enroll
    Route::resource('student-room-enroll','Admin\StudentRoomEnroll\StudentRoomEnrollsController');
    Route::get('student-room-enrolls/show','Admin\StudentRoomEnroll\StudentRoomEnrollsController@enrolls_show')->name('student-room-enrolls.show');
    Route::get('student-room-enrolls/get_data','Admin\StudentRoomEnroll\StudentRoomEnrollsController@get_data_by_json_where_semester_id')->name('student-room-enrolls.get_data');
    Route::get('student-room-enrolls/unroll','Admin\StudentRoomEnroll\StudentRoomEnrollsController@student_unroll')->name('student-room-enrolls.unroll');

    //.........student room enroll
    Route::resource('teacher-room-enroll','Admin\TeacherRoomEnroll\TeacherRoomEnrollsController');
    Route::get('teacher-room-enroll/{exam_season_id}/date/{date_id}','Admin\TeacherRoomEnroll\TeacherRoomEnrollsController@showTeachers')->name('teacher-room-enrolls.show');
    Route::get('teacher-room-enroll/{tre_id}/is-chief','Admin\TeacherRoomEnroll\TeacherRoomEnrollsController@isChief')->name('teacher-room-enrolls.is-hief');
});

//.........Teacher common features
Route::group(['prefix'=>'teacher'],function(){
    //........dashboard
    Route::get('/dash', 'User\Dash\UserDashController@dash')->name('user.dash');
    //........user profile
    // Route::get('profile/{user_id}','User\Profile\ProfilesController@show')->name('profile.show');
    //........user account
    Route::get('account/setting/{user_id}','User\Account\AccountsController@setting')->name('account.setting');
    Route::put('account/setting/{user_id}','User\Account\AccountsController@update')->name('account.update');
    Route::put('account/password/{user_id}','User\Account\AccountsController@changePassword')->name('account.changePassword');
    //........user personal info
    Route::get('personal-info/{user_id}','User\PersonalInfo\PersonalInfosController@edit')->name('personal-info.edit');
    Route::post('personal-info/{user_id}','User\PersonalInfo\PersonalInfosController@update')->name('personal-info.update');
    Route::get('personal-info/profile-pic/{user_id}','User\PersonalInfo\PersonalInfosController@profilePic')->name('personal-info.profile-pic.edit');
    Route::post('personal-info/profile-pic/{user_id}','User\PersonalInfo\PersonalInfosController@uploadProfilePic')->name('personal-info.profile-pic.upload');

    // student invigilate area
    Route::get('invigilating-area/exam-season', 'Teacher\InvigilatingArea\InvigilatingAreasController@examSeason')->name('teacher.invigilating.area.season');
    Route::get('invigilating-area/{season_id}', 'Teacher\InvigilatingArea\InvigilatingAreasController@invigilatingArea')->name('teacher.invigilating.area');
});

//.........Student
Route::group(['prefix'=>'student'],function(){
    Route::get('dashboard', 'Student\StudentProfile\StudentProfilesController@dashboard')->name('student.dash');
    Route::get('profile', 'Student\StudentProfile\StudentProfilesController@profile')->name('student.profile');
    // Change Password
    Route::get('change-password', 'Student\StudentProfile\StudentProfilesController@changePassword')->name('student.change-password');
    Route::post('change-password', 'Student\StudentProfile\StudentProfilesController@changePasswordSubmit')->name('student.change-password.submit');
    // student seat plan
    Route::get('seat-plan/exam-season', 'Student\SeatPlan\SeatPlansController@examSeason')->name('student.seat.plan.season');
    Route::get('seat-plan/{season_id}', 'Student\SeatPlan\SeatPlansController@seatPlan')->name('student.seat.plan');
});

Route::group(['middleware'=>'auth'],function(){
    Route::get('ajax/exam-rooms/exam-season', 'AjaxData\AjaxDatasController@examRoomsByExamSeason')->name('ajax.exam.rooms.season');
    Route::get('ajax/exam-dates/exam-season', 'AjaxData\AjaxDatasController@examDatesByExamSeason')->name('ajax.exam.dates.season');
    Route::get('ajax/exam-shift-time/exam-season', 'AjaxData\AjaxDatasController@examShifttimeByExamSeason')->name('ajax.exam.shift-time.season');
    Route::get('ajax/exam-courses/exam-season-semester', 'AjaxData\AjaxDatasController@examCoursesByExamSeasonSemester')->name('ajax.exam.courses.season.semester');
});
