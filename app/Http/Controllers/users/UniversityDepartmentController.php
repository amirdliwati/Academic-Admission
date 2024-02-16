<?php

namespace App\Http\Controllers\users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\University_department;
use App\User_notification;
use App\Log;

class UniversityDepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }


    public function finduniversity(Request $Request)
    {
        if ($Request->isMethod('post')){ 
        
            $users_id = Auth::user()->id;
        $users_verifi =  $this->verifiuser($users_id);
        $countnotifications = User_notification::where('seen',0)->where('user_id',$users_id)->count();
        $notifications = User_notification::where('seen',0)->where('user_id',$users_id)->orderBy('id', 'desc')->get();
                if ($users_verifi == 1) 
                    {   
                        $universities = University_department::distinct()->get(['university_name']);
                        $departments = University_department::distinct()->get(['department_name']);
                        //$University_department = University_department::where('university_name',$Request->input('university_name'))->orwhere('department_name',$Request->input('department_name'))->orwhere('stream',$Request->input('Stream'))->get();

                        $University_department = University_department::where(function($query) use ($Request) {  $query->where('university_name',$Request->input('university_name'))->where('stream',$Request->input('Stream')); })->orwhere(function($query1) use ($Request) {  $query1->where('department_name',$Request->input('department_name'))->where('stream',$Request->input('Stream')); })->get();

                        $arr = array('University_department' => $University_department , 'universities' => $universities, 'departments' => $departments, 'notifications' => $notifications , 'countnotifications' => $countnotifications);
                        
                        //return redirect('/home/finduniversity')->with($arr);
                        return view('users/viewuniversity',$arr);

                    }

                else{return view('publicviews/404error');}
                }

            else{

                $users_id = Auth::user()->id;
        $users_verifi =  $this->verifiuser($users_id);
        $countnotifications = User_notification::where('seen',0)->where('user_id',$users_id)->count();
        $notifications = User_notification::where('seen',0)->where('user_id',$users_id)->orderBy('id', 'desc')->get();
                    if ($users_verifi == 1) 
                        {   
                            $universities = University_department::distinct()->get(['university_name']);
                            $departments = University_department::distinct()->get(['department_name']);
                            $University_department = University_department::all();
                            $arr = array('University_department' => $University_department , 'universities' => $universities, 'departments' => $departments, 'notifications' => $notifications , 'countnotifications' => $countnotifications);
                            return view('users/viewuniversity',$arr);

                        }

                    else{return view('publicviews/404error');}
                }
    } 
        


}
