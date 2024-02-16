<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\How_find_us_table;
use App\Admin_notification;

class EditFindUsController extends Controller
{
    public function View(Request $Request)
    {
        $users_id = Auth::user()->id;
        $users_verifi =  $this->verifiuser($users_id);
        $countnotifications = Admin_notification::where('seen',0)->count();
        $notifications = Admin_notification::where('seen',0)->orderBy('id', 'desc')->get();
    		if ($users_verifi == 0) 
                {    
                    $findus = How_find_us_table::all();
                    $arr = array('findus' => $findus , 'notifications' => $notifications , 'countnotifications' => $countnotifications);
                    return view('admin/configurations/viewfindus',$arr);

                }

            else{return view('publicviews/404error');} 

    	
    }

    public function create(Request $Request)
    {
		if ($Request->isMethod('post')) 
    	{
    	$users_id = Auth::user()->id;
        $users_verifi =  $this->verifiuser($users_id);
        $countnotifications = Admin_notification::where('seen',0)->count();
        $notifications = Admin_notification::where('seen',0)->orderBy('id', 'desc')->get();
    		if ($users_verifi == 0) {
    		Validator::make($Request->all(), [
			'how' => 'required|string|max:50|min:2',
        	])->validate();
        	$new = new How_find_us_table();
        	$new -> how = $Request->input('how');
        	$new -> save();
        	
		}

		$findus = How_find_us_table::all();
        $arr = array('findus' => $findus , 'notifications' => $notifications , 'countnotifications' => $countnotifications);
        //return view('admin/configurations/viewfindus',$arr);
        return redirect('/home/viewfindus')->with($arr); 
    

			}
			else{return view('publicviews/404error');} 
			
		}


}
