<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Admin_notification;
use App\User_notification;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
        
    }

    public function index(Request $Request)
    {
        $users_id = Auth::user()->id;
        $notifications = $this->viewnotifications($users_id);

        if ($Request->isMethod('post'))
        {
            $user_type = User::find($users_id);
            if ($user_type->users_profiles->type_user == "admin") {return view('admin/homeadmin',$notifications);}
            if ($user_type->users_profiles->type_user == "user") {return view('users/homeuser',$notifications);}
            //else{return view('/homeuser');}
        }

        else
        {
            $user_type = User::find($users_id);
            if ($user_type->users_profiles->type_user == "admin") {return view('admin/homeadmin',$notifications);}
            if ($user_type->users_profiles->type_user == "user") {return view('users/homeuser',$notifications);}
            //else{return view('/homeuser');}
        }
    }

    public function verifiuser($id)
    {
        
            $user_type = User::find($id);
            if ($user_type->users_profiles->type_user == "admin") {return 0;}
            if ($user_type->users_profiles->type_user == "user") {return 1;}
            //else{return view('/homeuser');}
        
    }

    public function viewnotifications($users_id)
    {
        
          if ($users_id == 1)
            {

                $countnotifications = Admin_notification::where('seen',0)->count();
                $notifications = Admin_notification::where('seen',0)->orderBy('id', 'desc')->get();
                $arr = array('countnotifications' => $countnotifications , 'notifications' => $notifications);
                return $arr;
            }
            else
            {

                $countnotifications = User_notification::where('seen',0)->where('user_id',$users_id)->count();
                $notifications = User_notification::where('seen',0)->where('user_id',$users_id)->orderBy('id', 'desc')->get();
                $arr = array('countnotifications' => $countnotifications , 'notifications' => $notifications);
                return $arr;

            } 

            
    }

    public function viewallnotificationadmin(Request $Request)
    {
        $users_id = Auth::user()->id;
            if ($users_id == 1)
            {
                $countnotifications = Admin_notification::where('seen',0)->count();
                $notifications = Admin_notification::all();
                $arr = array('notifications' => $notifications , 'countnotifications' => $countnotifications , 'notifications' => $notifications);
                return view('admin/viewallnotifications',$arr);

            } 
            
            else {
                $countnotifications = User_notification::where('seen',0)->where('user_id',$users_id)->count();
                $notifications = User_notification::where('user_id',$users_id)->orderBy('id', 'desc')->get();
                $arr = array('notifications' => $notifications , 'countnotifications' => $countnotifications);
                return view('users/viewallnotifications',$arr);;
            }

    
    }


}
