<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Document_type;
use App\Admin_notification;
use Webpatser\Uuid\Uuid;
use Illuminate\Support\Facades\Storage;

class EditDocumentionController extends Controller
{
    public function View(Request $Request)
    {
        $users_id = Auth::user()->id;
        $users_verifi =  $this->verifiuser($users_id);
        $countnotifications = Admin_notification::where('seen',0)->count();
        $notifications = Admin_notification::where('seen',0)->orderBy('id', 'desc')->get();
    		if ($users_verifi == 0) 
                {    
                    $types = Document_type::all();
                    $arr = array('types' => $types , 'notifications' => $notifications , 'countnotifications' => $countnotifications);
                    return view('admin/configurations/viewdocument',$arr);

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
            'name' => 'required|string|max:50|min:2',
            'other_info' => '|max:250',
        	])->validate();
        	$new = new Document_type();
            $new -> name = $Request->input('name');
            $new -> other_info = $Request->input('other_info');
        	$new -> save();
        	
		}

		            $types = Document_type::all();
                    $arr = array('types' => $types , 'notifications' => $notifications , 'countnotifications' => $countnotifications);
                    //return view('admin/configurations/viewdocument',$arr);
                    return redirect('/home/viewdocument')->with($arr); 
    

			}
			else{return view('publicviews/404error');} 
			
    }
        
}
