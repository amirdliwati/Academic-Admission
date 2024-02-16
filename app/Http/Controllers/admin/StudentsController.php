<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Student;
use App\Admin_notification;

class StudentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    public function viewallstudents(Request $Request)
    {
        $users_id = Auth::user()->id;
        $users_verifi =  $this->verifiuser($users_id);
        $countnotifications = Admin_notification::where('seen',0)->count();
        $notifications = Admin_notification::where('seen',0)->orderBy('id', 'desc')->get();
    		if ($users_verifi == 0) 
                {    
                    $students = Student::all();
                    $arr = array('students' => $students , 'notifications' => $notifications , 'countnotifications' => $countnotifications);
                    return view('admin/viewstudents',$arr);

                }

            else{return view('publicviews/404error');} 
    	
    }
}
