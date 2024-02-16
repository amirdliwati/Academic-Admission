<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Users_profile;
use App\User;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


	public function AddProfile()
    {

    		//echo $Request;
    	$newprofile = new Users_profile();
    	$newprofile -> first_name = 'aa';
    	$newprofile -> last_name = 'bb';
    	$newprofile -> mobile = '9638016937';
        $newprofile -> city = 'syria';
    	$newprofile -> city = 'aleppo';
    	$newprofile -> users_id = '1';
        //$newprofile -> users_id = Auth::user()->id;
    	$newprofile -> save();
    	return view('home');
    }


    public function ViewProfileById()
    {
    	$user = User::find(1);
    	echo $user;
    	echo "<br>";
    	$profile = Users_profile::find(1);
    	echo $profile;
    	echo "<br>";
        $profile2 = Users_profile::where('users_id','1')->get();
        echo $profile2->users->name;
        echo "<br>";
    	echo $user->users_profiles->first_name; //one to one
        /*echo $user->users_profiles;  //one to many
        echo "<br>";
        foreach ($user->users_profiles as $profiles) {
            echo $profiles->first_name;
        }*/
    	
    }


    public function test(Request $Request)
    {
        /*if ($Request['attended'] || $Request['student_number'] || 
                $Request['Institute'] || $Request['Yars_From'] || $Request['Years_To'] || $Request['type_degree'] || 
                $Request['latest_grade'] || $Request['Program_Semester2'] || $Request['Program_Level2'] || $Request['direct_transfer2'] || 
                $Request['fee2'] || $Request['Faculty_Institute2'] || $Request['Program_Name2'] ) {
                    
                    Validator::make($Request->all(), [
                        'First_Name' => 'required|string|max:20|min:2',
                        'Last_Name' => 'required|string|max:20|min:2',
                        'Gender' => 'required|string|max:8|min:2',
                        'Date' => 'required|date_format:m/d/Y',
                        'Nationality' => 'required',
                        'Passport' => 'required|numeric',
                        'Marital' => 'required|string|max:20|min:2',
                        'Father_Name' => 'required|string|max:20|min:2',
                        'Disability' => 'required|string|max:5|min:2',
                        'Facilities' => 'required|string|max:20|min:2',
                        'How' => 'required|numeric',
                        'email' => 'required|string|email|max:100',
                        'mobile' => 'required|numeric|digits_between:1,15',
    
                        'Program_Semester' => 'required|string|max:25|min:2',
                        'Program_Level' => 'required|string|max:25|min:2',
                        'direct_transfer' => 'required|string|max:25|min:2',
                        'fee' => 'required|between:0,1000000.99999',
                        'Faculty_Institute' => 'required|string|max:25|min:2',
                        'Program_Name' => 'required|string|max:50|min:2',
    
                        ])->validate();
                }

                else {
                    Validator::make($Request->all(), [
                        'First_Name' => 'required|string|max:20|min:2',
                        'Middle_Name' => 'string|max:20|min:2',
                        'Last_Name' => 'required|string|max:20|min:2',
                        'Gender' => 'required|string|max:8|min:2',
                        'Date' => 'required|date_format:m/d/Y',
                        'Nationality' => 'required',
                        'Passport' => 'required|numeric',
                        'Marital' => 'required|string|max:20|min:2',
                        'Father_Name' => 'required|string|max:20|min:2',
                        'Disability' => 'required|string|max:5|min:2',
                        'Facilities' => 'required|string|max:20|min:2',
                        'How' => 'required|numeric',
                        'email' => 'required|string|email|max:100',
                        'mobile' => 'required|numeric|digits_between:1,15',
    
                        'attended' => 'string|max:5|min:2',
                        'student_number' => 'numeric',
                        'Institute' => 'string|max:50|min:2',
                        'Yars_From' => 'digits:4',
                        'Years_To' => 'digits:4',
                        'type_degree' => 'string|max:50|min:2',
                        'latest_grade' => 'string|max:50|min:2',
    
                        'Program_Semester' => 'required|string|max:25|min:2',
                        'Program_Level' => 'required|string|max:25|min:2',
                        'direct_transfer' => 'required|string|max:25|min:2',
                        'fee' => 'required|between:0,1000000.99999',
                        'Faculty_Institute' => 'required|string|max:25|min:2',
                        'Program_Name' => 'required|string|max:50|min:2',
    
                        'Program_Semester2' => 'string|max:25|min:2',
                        'Program_Level2' => 'string|max:25|min:2',
                        'direct_transfer2' => 'string|max:25|min:2',
                        'fee2' => 'between:0,1000000.99999',
                        'Faculty_Institute2' => 'string|max:25|min:2',
                        'Program_Name2' => 'string|max:50|min:2',
                        ])->validate();
                }*/
        
    }
}
