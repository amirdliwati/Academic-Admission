<?php

namespace App\Http\Controllers\users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Student;
use App\User_notification;

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
        $countnotifications = User_notification::where('seen',0)->where('user_id',$users_id)->count();
        $notifications = User_notification::where('seen',0)->where('user_id',$users_id)->orderBy('id', 'desc')->get();
  
                    $students = Student::where('user_id',$users_id)->get();
                    $arr = array('students' => $students , 'notifications' => $notifications , 'countnotifications' => $countnotifications);
                    return view('users/viewstudents',$arr);


    	
    }
}
