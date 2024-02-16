<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Users_profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Admin_notification;

class RegisterUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function register(Request $Request)
    {
        $users_id = Auth::user()->id;
		$users_verifi =  $this->verifiuser($users_id);
		$countnotifications = Admin_notification::where('seen',0)->count();
		$notifications = Admin_notification::where('seen',0)->orderBy('id', 'desc')->get();
		$arr = array('notifications' => $notifications , 'countnotifications' => $countnotifications);
			if ($users_verifi == 0)
			 {
				 return view('auth/register',$arr);
				
			}
            else{return view('publicviews/404error');} 

    }


    public function create(Request $Request)
    {
		if ($Request->isMethod('post')) 
    	{
    	//$email = User::where('email', $Request->input('email'))->first()->email; echo $email;
    	$users_id = Auth::user()->id;
		$users_verifi =  $this->verifiuser($users_id);
		$countnotifications = Admin_notification::where('seen',0)->count();
        $notifications = Admin_notification::where('seen',0)->orderBy('id', 'desc')->get();
    		if ($users_verifi == 0) {
    		Validator::make($Request->all(), [
			'name' => 'required|alpha|max:25|min:2|unique:users',
			'password' => 'required|string|min:8|confirmed',
            'email' => 'required|string|email|unique:users|max:50',
        	])->validate();

    		//echo $Request;

        	$arr = User::create([
            'name' => $Request['name'],
            'email' => $Request['email'],
			'password' => Hash::make($Request['password']),
			'status' => "Activate",
        	]);

        	$id = User::orderBy('id', 'desc')->first()->id;
        	$newprofile = new Users_profile();
        	$newprofile -> first_name = 'first name';
        	$newprofile -> last_name = 'last name';
        	$newprofile -> mobile = '919638016937';
            $newprofile -> country_id = 0;
        	$newprofile -> city_name ="City";
			$newprofile -> type_user = 'user';
			
        	$newprofile -> users_id = $id;
        	$newprofile -> save();

			$arr = array('notifications' => $notifications , 'countnotifications' => $countnotifications);
        	//$user = User::orderBy('id', 'desc')->first();
			//$arr2 = array('users' => $user);

        	
		}
		
		//return redirect()->back();
        //return view('admin/edit_profile_user/viewuser',$arr);
        //return view('auth/regiser');
        return redirect('/home/viewuser')->with($arr); 
    

			}
			else{return view('publicviews/404error');} 
			
		}
    	
}
