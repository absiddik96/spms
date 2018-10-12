<?php

namespace App\Http\Controllers\Admin\Teacher;

use Auth;
use App\User;
use App\Models\Admin\UserRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeachersController extends Controller
{
    public function index()
    {
        $teachers = '';
        $teacher_role = UserRole::where('name','teacher')->where('department_id',Auth::user()->department_id)->first();
        if ($teacher_role && $teacher_role->id) {
            $teachers = User::where('role_id',$teacher_role->id)->where('department_id',Auth::user()->department_id)->orderBy('name')->get();
        }
        return view('admin.teacher.index')
                ->with('teachers',$teachers);
    }
}
