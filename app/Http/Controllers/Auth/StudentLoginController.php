<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Session;
use Illuminate\Http\Request;
use App\Models\Admin\Student;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class StudentLoginController extends Controller
{
    use AuthenticatesUsers;

	public function __construct()
	{
		//$this->middleware('guest:student');
        $this->middleware('guest', ['except' => 'logout']);
	}

    public function showLoginForm()
    {
    	return view('auth.student_login');
    }

    public function login(Request $request)
    {
    	// validation form data

    	$this->validate($request,[
			'email'    => 'required|email',
			'password' => 'required|min:6',
    	]);



    	// attempt to log student in
    	if (Auth::guard('student')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember)) {
            if (Auth::guard('student')->user()->is_active) {
                return redirect()->intended(route('student.dash'));
            }else {
                $request->session()->flush();
                return $this->sendFailedLoginResponse($request)->withErrors(['active' => 'You must be active to login.']);
            }
    	}

    	return $this->sendFailedLoginResponse($request);
    }
}
