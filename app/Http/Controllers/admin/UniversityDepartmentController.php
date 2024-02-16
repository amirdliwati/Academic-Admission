<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\University_department;
use App\Admin_notification;
use App\Log;

class UniversityDepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }


    public function view(Request $Request)
    {
        $users_id = Auth::user()->id;
        $users_verifi =  $this->verifiuser($users_id);
        $countnotifications = Admin_notification::where('seen',0)->count();
        $notifications = Admin_notification::where('seen',0)->orderBy('id', 'desc')->get();
    		if ($users_verifi == 0)
                {
                    $University_department = University_department::all();
                    $arr = array('University_department' => $University_department , 'notifications' => $notifications , 'countnotifications' => $countnotifications);
                    return view('admin/configurations/edituniversity',$arr);

                }

            else{return view('publicviews/404error');}

    }

    public function adduniversity(Request $Request)
    {
        if ($Request->isMethod('post'))
        {
        $users_id = Auth::user()->id;
        $users_verifi =  $this->verifiuser($users_id);
        $countnotifications = Admin_notification::where('seen',0)->count();
        $notifications = Admin_notification::where('seen',0)->orderBy('id', 'desc')->get();
            if ($users_verifi == 0) {
            Validator::make($Request->all(), [
            'university-name' => 'required|string|max:100|min:2',
            'department-name' => 'required|string|max:50|min:2',
            'Stream' => 'required|string|max:30|min:2',
            ])->validate();
            $new = new University_department();
            $new -> university_name = $Request->input('university-name');
            $new -> department_name = $Request->input('department-name');
            $new -> stream = $Request->input('Stream');
            $new -> save();

        }

        $University_department = University_department::all();
        $arr = array('University_department' => $University_department , 'notifications' => $notifications , 'countnotifications' => $countnotifications);
        //return view('admin/configurations/viewfindus',$arr);
        return redirect('/home/viewuniversity')->with($arr);


            }
            else{return view('publicviews/404error');}

        }


    public function finduniversity(Request $Request)
    {
        if ($Request->isMethod('post')){

            $users_id = Auth::user()->id;
            $users_verifi =  $this->verifiuser($users_id);
            $countnotifications = Admin_notification::where('seen',0)->count();
            $notifications = Admin_notification::where('seen',0)->orderBy('id', 'desc')->get();
                if ($users_verifi == 0)
                    {
                        $universities = University_department::distinct()->get(['university_name']);
                        $departments = University_department::distinct()->get(['department_name']);
                        //$University_department = University_department::where('university_name',$Request->input('university_name'))->orwhere('department_name',$Request->input('department_name'))->orwhere('stream',$Request->input('Stream'))->get();

                        $University_department = University_department::where(function($query) use ($Request) {  $query->where('university_name',$Request->input('university_name'))->where('stream',$Request->input('Stream')); })->orwhere(function($query1) use ($Request) {  $query1->where('department_name',$Request->input('department_name'))->where('stream',$Request->input('Stream')); })->get();

                        $arr = array('University_department' => $University_department , 'universities' => $universities, 'departments' => $departments, 'notifications' => $notifications , 'countnotifications' => $countnotifications);

                        //return redirect('/home/finduniversity')->with($arr);
                        return view('admin/viewuniversity',$arr);

                    }

                else{return view('publicviews/404error');}
                }

            else{

                $users_id = Auth::user()->id;
                $users_verifi =  $this->verifiuser($users_id);
                $countnotifications = Admin_notification::where('seen',0)->count();
                $notifications = Admin_notification::where('seen',0)->orderBy('id', 'desc')->get();
                    if ($users_verifi == 0)
                        {
                            $universities = University_department::distinct()->get(['university_name']);
                            $departments = University_department::distinct()->get(['department_name']);
                            $University_department = University_department::all();
                            $arr = array('University_department' => $University_department , 'universities' => $universities, 'departments' => $departments, 'notifications' => $notifications , 'countnotifications' => $countnotifications);
                            return view('admin/viewuniversity',$arr);

                        }

                    else{return view('publicviews/404error');}
                }
    }

    public function deleteuniversity(Request $Request,$id)
    {
        //echo $Request;
        $users_id = Auth::user()->id;
        $users_name= Auth::user()->name;
        $users_verifi =  $this->verifiuser($users_id);
        $countnotifications = Admin_notification::where('seen',0)->count();
        $notifications = Admin_notification::where('seen',0)->orderBy('id', 'desc')->get();
            if ($users_verifi == 0)
                {
                        $university = University_department::find($id);
                        $addlog = new Log();
                        $addlog -> operating = "Deleted University";
                        $addlog -> application_code = $university->university_name;
                        $addlog -> user_name = $users_name;
                        $addlog -> save();
                        $delete_department = University_department::find($id);
                        $delete_department -> delete();

                        $University_department = University_department::all();
                        $arr = array('University_department' => $University_department , 'notifications' => $notifications , 'countnotifications' => $countnotifications);
                        //return view('admin/applications/viewallapplications',$arr);
                        return redirect('/home/viewuniversity')->with($arr);

                }

            else{return view('publicviews/404error');}


    }


}
