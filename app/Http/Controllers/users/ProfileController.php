<?php

namespace App\Http\Controllers\users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Users_profile;
use App\Countrie;
use App\User_notification;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function View(Request $Request)
    {
        $users_id = Auth::user()->id;
        $countnotifications = User_notification::where('seen',0)->where('user_id',$users_id)->count();
        $notifications = User_notification::where('seen',0)->where('user_id',$users_id)->orderBy('id', 'desc')->get();
   
                    
                    $allcountries = Countrie::all();
                    $users = User::find($users_id);
                    $arr = array('users' => $users , 'allcountries' => $allcountries , 'notifications' => $notifications , 'countnotifications' => $countnotifications);
                    return view('users/editprofile',$arr);

    	
    }

    public function edit(Request $Request,$idedit)
    {
        $users_id = Auth::user()->id;
        $countnotifications = User_notification::where('seen',0)->where('user_id',$users_id)->count();
        $notifications = User_notification::where('seen',0)->where('user_id',$users_id)->orderBy('id', 'desc')->get();

        if ($Request->isMethod('post')) 
        {
            
                    Validator::make($Request->all(), [
                    'first_name' => 'required|string|max:25|min:2',
                    'last_name' => 'required|string|max:25|min:2',
                    'mobile' => 'required|numeric',
                    'country' => 'required',
                    'city' => 'required|string|max:25|min:2',
                    ])->validate();

                    $editprofile = Users_profile::where('users_id',$idedit)->first();
                    $editprofile -> first_name = $Request->input('first_name');
                    $editprofile -> last_name = $Request->input('last_name');
                    $editprofile -> mobile = $Request->mobile;
                    $editprofile -> country_id = $Request->country;
                    $editprofile -> city_name = $Request->city;
                    $editprofile -> save();
                    $arr = array('notifications' => $notifications , 'countnotifications' => $countnotifications);
                    return redirect('/home/viewprfile')->with($arr);
        }

        
    }
}
