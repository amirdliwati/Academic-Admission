<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Users_profile;
use App\Countrie;
use App\Log;
use App\Admin_notification;
use Illuminate\Support\Facades\Storage;


class EditUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function View(Request $Request)
    {
        $users_id = Auth::user()->id;
        $users_verifi =  $this->verifiuser($users_id);
        $countnotifications = Admin_notification::where('seen',0)->count();
        $notifications = Admin_notification::where('seen',0)->orderBy('id', 'desc')->get();
    		if ($users_verifi == 0) 
                {    
                    $countries = Users_profile::with('country')->get();
                    $users = User::orderBy('id', 'desc')->get();
                    $arr = array('users' => $users , 'country'=> $countries , 'notifications' => $notifications , 'countnotifications' => $countnotifications);
                    return view('admin/edit_profile_user/viewuser',$arr);

                }

            else{return view('publicviews/404error');} 
    	
    }


    public function edit(Request $Request,$idedit)
    {
        $users_id = Auth::user()->id;
        $users_verifi =  $this->verifiuser($users_id);
        $countnotifications = Admin_notification::where('seen',0)->count();
        $notifications = Admin_notification::where('seen',0)->orderBy('id', 'desc')->get();
        if ($Request->isMethod('post')) 
        {
            if ($users_verifi == 0) 
                {
                    Validator::make($Request->all(), [
                    //'name' => 'required|string|max:25|min:2',
                    'first_name' => 'required|string|max:25|min:2',
                    'last_name' => 'required|string|max:25|min:2',
                    'mobile' => 'required|numeric|digits_between:1,15',
                    'country' => 'required',
                    'city' => 'required|string|max:25|min:2',
                    ])->validate();

                    //echo $Request;

                    $editprofile = Users_profile::where('users_id',$idedit)->first();
                    $editprofile -> first_name = $Request->input('first_name');
                    $editprofile -> last_name = $Request->input('last_name');
                    $editprofile -> mobile = "+".$Request->input('mobile');
                    $editprofile -> country_id = $Request->country;
                    $editprofile -> city_name = $Request->city;
                    $editprofile -> save();
                    $arr = array('notifications' => $notifications , 'countnotifications' => $countnotifications);
                    return redirect('/home/viewuser')->with($arr); 

                }

            else{return view('publicviews/404error');}      
        }

        else{

            if ($users_verifi == 0) 
                {

                    $detailsuser = User::find($idedit);
                    $allcountries = Countrie::all();
                    $countnotifications = Admin_notification::where('seen',0)->count();
                    $notifications = Admin_notification::where('seen',0)->orderBy('id', 'desc')->get();
                    $arr = array('detailsusers' => $detailsuser ,  'allcountries'=> $allcountries ,  'notifications' => $notifications , 'countnotifications' => $countnotifications);
                    return view('admin/edit_profile_user/editusers',$arr);

                }

            else{return view('publicviews/404error');} 

        }
    }

    public function delete(Request $Request,$iddelete)
    {
        //echo $Request;
        $users_id = Auth::user()->id;
        $users_name= Auth::user()->name;
        $users_verifi =  $this->verifiuser($users_id);
        $countnotifications = Admin_notification::where('seen',0)->count();
        $notifications = Admin_notification::where('seen',0)->orderBy('id', 'desc')->get();
            if ($users_verifi == 0) 
                {
                    $deleteuser = User::find($iddelete);
                    Storage::disk('public_uploads')->deleteDirectory("applicationfiles/".$deleteuser->name);
                        $deleteuser -> delete();

                        $arr = array('notifications' => $notifications , 'countnotifications' => $countnotifications);
                   
                        
                        return redirect('/home/viewuser')->with($arr);    

                }

            else{return view('publicviews/404error');} 

        
    }

    public function status(Request $Request,$idstatus)
    {
        //echo $Request;
        $users_id = Auth::user()->id;
        $users_verifi =  $this->verifiuser($users_id);
        $countnotifications = Admin_notification::where('seen',0)->count();
        $notifications = Admin_notification::where('seen',0)->orderBy('id', 'desc')->get();
            if ($users_verifi == 0) 
                {

                    $changestatus = User::find($idstatus);
                    if ($changestatus->status == "Activate") {
                        $changestatus -> status = "Desactivate";
                        $changestatus -> password = Hash::make("kjlksfkdjgkjglkfdgjfidogjrhdsfhjdsbfbjhb,vddhfehrdsfdgfggh");
                        $changestatus->save();
                    }
                    else {
                        $changestatus -> status = "Activate";
                        $changestatus -> password = Hash::make($changestatus->email);
                        $changestatus->save();
                    }

                    
                    $arr = array('notifications' => $notifications , 'countnotifications' => $countnotifications);
                    return redirect('/home/viewuser')->with($arr);  

                }

            else{return view('publicviews/404error');} 

        
    }


    public function viewuserforresetpassword(Request $Request)
    {
        //echo $Request;
        $users_id = Auth::user()->id;
        $users_verifi =  $this->verifiuser($users_id);
        $countnotifications = Admin_notification::where('seen',0)->count();
        $notifications = Admin_notification::where('seen',0)->orderBy('id', 'desc')->get();

            if ($users_verifi == 0) 
                {
                    $users = User::all();
                    $profiles = Users_profile::with('country')->get();
                    $arr = array('users' => $users,'profiles'=>$profiles , 'notifications' => $notifications , 'countnotifications' => $countnotifications);
                    return view('admin/edit_profile_user/viewuserforresetpassword',$arr);  

                }
            else{return view('publicviews/404error');}     
    }


    public function resetpassworduser(Request $Request,$idr)
    {
        //echo $Request;
        $users_id = Auth::user()->id;
        $users_verifi =  $this->verifiuser($users_id);
        $countnotifications = Admin_notification::where('seen',0)->count();
        $notifications = Admin_notification::where('seen',0)->orderBy('id', 'desc')->get();
        if ($Request->isMethod('post')) 
        {
            if ($users_verifi == 0) 
                {
                    Validator::make($Request->all(), [
                    'password' => 'required|string|min:8|confirmed',
                    ])->validate();

                    //echo $Request;

                    $edituser = User::find($idr);
                    $edituser -> password = Hash::make($Request->input('password'));
                    $edituser -> save();

                    //return redirect('/home');
                    $arr = array('notifications' => $notifications , 'countnotifications' => $countnotifications);
                    return redirect('/home/viewuser')->with($arr);  
 
                }

            else{return view('publicviews/404error');}      
        }

        else{

            if ($users_verifi == 0) 
                {
                    $updatepassword = User::find($idr);
                    $arr = array('detailsusers' => $updatepassword ,'notifications' => $notifications , 'countnotifications' => $countnotifications);
                    return view('admin/edit_profile_user/resetpassworduser',$arr);  

                }

            else{return view('publicviews/404error');} 

        }
    }

    public function viewlogs(Request $Request)
    {
        $users_id = Auth::user()->id;
        $users_verifi =  $this->verifiuser($users_id);
        $countnotifications = Admin_notification::where('seen',0)->count();
        $notifications = Admin_notification::where('seen',0)->orderBy('id', 'desc')->get();
    		if ($users_verifi == 0) 
                {    
                    $logs = Log::all();
                    $arr = array('logs' => $logs , 'notifications' => $notifications , 'countnotifications' => $countnotifications);
                    return view('admin/edit_profile_user/loguser',$arr);

                }

            else{return view('publicviews/404error');} 
    	
    }


}
