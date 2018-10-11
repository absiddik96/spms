<?php

namespace App\Http\Controllers\Student\StudentProfile;

use Auth;
use Session;
use Illuminate\Http\Request;
use App\Models\Admin\Student;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class StudentProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }
    public function dashboard()
    {
        return view('student.dashboard');
    }

    public function profile()
    {
        return view('student.profile')
                ->with('profile', Auth::user());
    }

    public function changePassword()
    {
        return view('student.change_pass');
    }

    public function changePasswordSubmit(Request $request)
    {
        $this->validate($request,[
            'old_password' => 'required|min:6',
            'password' => 'required|min:6|confirmed',
        ]);

        $student = Student::find(Auth::user()->id);

        if (Hash::check($request->old_password, $student->password)) {
            $student->password = bcrypt($request->password);;
            if ($student->save()) {
                Session::flash('success','Password changed successfully');
            }
        }else{
            Session::flash('info','Old password doesn\'t match');
        }
        return redirect()->route('student.profile');
    }
}
