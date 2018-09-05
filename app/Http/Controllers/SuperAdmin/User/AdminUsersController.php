<?php

namespace App\Http\Controllers\SuperAdmin\User;

use Auth;
use Session;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SuperAdmin\Department;
use Illuminate\Support\Facades\Validator;

class AdminUsersController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('super_admin.user.index')
                ->with('users', User::where('is_admin',User::ADMIN_USER)->get());
    }

    public function super_admin_list()
    {
        return view('super_admin.user.super_admin_list')
                ->with('users', User::where('is_super_admin',User::SUPER_ADMIN_USER)->get());
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('super_admin.user.create')
                ->with('roles', Department::pluck('dept','id')->all());
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        if (!$request->is_super_admin) {
            $this->validate($request,[
                'name'     => 'required|min:2|max:100',
                'email'    => 'required|email|max:255|unique:users',
                'password' => 'required|min:6|max:50|confirmed',
                'department'  => 'required|numeric',
            ]);
        }else{
            $this->validate($request,[
                'name'     => 'required|min:2|max:100',
                'email'    => 'required|email|max:255|unique:users',
                'password' => 'required|min:6|max:50|confirmed',
            ]);
        }



        $input = $request->all();

        if (!$request->is_super_admin) {
            $input['department_id'] = $request->department;
            $input['is_admin'] = User::ADMIN_USER;
        }else{
            $input['is_super_admin'] = User::SUPER_ADMIN_USER;
        }

        $input['user_id']            = User::generateUserId();
        $input['password']           = bcrypt($request->password);
        $input['verified']           = User::UNVERIFIED_USER;
        $input['verification_token'] = User::generateVerificationToken();

        if (User::create($input)) {
            Session::flash('success','User create successfull');
        }

        return redirect()->back();
    }


    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\User  $user
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $user = User::where('user_id',$id)->first();
        return view('super_admin.user.edit')
                ->with('user', $user)
                ->with('roles', Department::pluck('dept','id')->all());
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\User  $user
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $user_id)
    {
        $user = User::where('user_id',$user_id)->first();

        if (!$request->is_super_admin) {
            $this->validate($request,[
                'name'     => 'required|min:2|max:100',
                'email'   => 'required|email|max:255|unique:users,email,'.$user->user_id.',user_id',
                'department_id'  => 'required|numeric',
            ],[
                'department_id.required' => 'The department field is required',
            ]);
        }else{
            $this->validate($request,[
                'name'     => 'required|min:2|max:100',
                'email'   => 'required|email|max:255|unique:users,email,'.$user->user_id.',user_id',
            ]);
        }

        if ($request->has('name')) {
            if ($request->name != $user->name) {
                $user->name = $request->name;
            }
        }

        if ($request->has('email')) {
            if ($request->email != $user->email) {
                $user->email = $request->email;
                $user->verified = User::UNVERIFIED_USER;
                $user->verification_token = User::generateVerificationToken();
                $user->is_active = User::INACTIVE_USER;
            }
        }

        if ($request->has('department_id')) {
            if ($request->department_id != $user->department_id) {
                $user->department_id = $request->department_id;
            }
        }

        if (!$request->is_super_admin) {
            $user->department_id = $request->department_id;
            $user->is_admin = User::ADMIN_USER;
            $user->is_super_admin = User::REGULAR_USER;
        }else{
            $user->department_id = User::REGULAR_USER;
            $user->is_admin = User::REGULAR_USER;
            $user->is_super_admin = User::SUPER_ADMIN_USER;
        }

        if ($user->save()) {
            Session::flash('success', 'User update successfull.');
        }

        if (!$request->is_super_admin) {
            return redirect()->route('user.index');
        }else {
            return redirect()->route('super-admin.list');
        }

    }


    public function changePassword(Request $request, $user_id)
    {
        $user = User::where('user_id',$user_id)->first();

        $validator = Validator::make($request->all(),[
            'password' => 'required|min:6|max:50|confirmed',
        ]);

        if ($validator->fails()) {
            Session::flash('info',$validator->errors()->all()[0]);
            return redirect()->back();
        }else {
            $user->password = bcrypt($request->password);
            $user->save();
            Session::flash('success', 'Password change successfull.');
        }

        return redirect()->back();
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\User  $user
    * @return \Illuminate\Http\Response
    */
    public function destroy($user_id)
    {
        $user = User::where('user_id',$user_id)->first();
        $user->delete();
        Session::flash('success','User delete successfull.');
        return redirect()->back();
    }

    public function verifyByAdmin($token)
    {
        $user = User::where('verification_token', $token)->firstOrFail();

        $user->verified           = User::VERIFIED_USER;
        $user->verification_token = null;
        $user->is_active          = User::ACTIVE_USER;
        $user->save();

        Session::flash('success','User verify successfull');
        return redirect()->back();
    }

    public function active($user_id)
    {
        $user = User::where('user_id',$user_id)->first();
        //.........user need to be verify before make admin
        if (!$user->isVerified()) {
            Session::flash('info','User not verified!');
            return redirect()->back();
        }

        $user->is_active = User::ACTIVE_USER;
        $user->save();

        Session::flash('success','User active successfull');
        return redirect()->back();
    }

    public function deactive($user_id)
    {
        $user = User::where('user_id',$user_id)->first();

        $user->is_active = User::INACTIVE_USER;
        $user->save();

        Session::flash('success','User deactive successfull');
        return redirect()->back();
    }
}
