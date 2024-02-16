<?php

namespace App\Http\Controllers\users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Users_profile;
use App\Countrie;
use App\City_table;
use App\How_find_us_table;
use App\Document_type;
use App\Student;
use App\Educational_background;
use App\Program;
use App\Students_document;
use App\Application;
use App\Log;
use App\Admin_notification;
use App\User_notification;
use Illuminate\Support\Facades\Storage;




class ApplicationeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function View(Request $Request)//this function for new application
    {
        $users_id = Auth::user()->id;
        $countnotifications = User_notification::where('seen',0)->where('user_id',$users_id)->count();
        $notifications = User_notification::where('seen',0)->where('user_id',$users_id)->orderBy('id', 'desc')->get();
   
                    $allcountries = Countrie::all();
                    $how = How_find_us_table::all();
                    $typedocuments = Document_type::all();
                    $arr = array('allcountries' => $allcountries , 'how' => $how , 'typedocuments' => $typedocuments , 'notifications' => $notifications , 'countnotifications' => $countnotifications );
                    return view('users.applications.newapplication',$arr);

    }

    public function Viewallapplications(Request $Request)
    {
        $users_id = Auth::user()->id;
        $countnotifications = User_notification::where('seen',0)->where('user_id',$users_id)->count();
        $notifications = User_notification::where('seen',0)->where('user_id',$users_id)->orderBy('id', 'desc')->get();

                    $allapplication = Application::where('user_id',$users_id)->where('seen',1)->get();
                    $arr = array('allapplication' => $allapplication , 'notifications' => $notifications , 'countnotifications' => $countnotifications,'status'=>"All");
                    return view('users/applications/viewallapplications',$arr);
    }

    public function viewapplicationsfromnotifications(Request $Request,$idapp,$idnot)
    {
        $users_id = Auth::user()->id;
        $users_verifi =  $this->verifiuser($users_id);
        $countnotifications = User_notification::where('seen',0)->where('user_id',$users_id)->count();
        $notifications = User_notification::where('seen',0)->where('user_id',$users_id)->orderBy('id', 'desc')->get();
    		       
                    $allapplication = Application::where('id',$idapp)->get();
                    $arr = array('allapplication' => $allapplication , 'notifications' => $notifications , 'countnotifications' => $countnotifications,'status'=>'All');
                    $updateseennotification = User_notification::where('id',$idnot)->first();
                    $updateseennotification -> 	seen = 1 ;
                    $updateseennotification -> save();
                    return view('users/applications/viewallapplications',$arr);   

    }

    public function create(Request $Request)
    {
        $users_id = Auth::user()->id;
        $users_name = Auth::user()->name;
        $countnotifications = User_notification::where('seen',0)->where('user_id',$users_id)->count();
        $notifications = User_notification::where('seen',0)->where('user_id',$users_id)->orderBy('id', 'desc')->get();
        if ($Request->isMethod('post')) 
        {

                    Validator::make($Request->all(), [
                        'First_Name' => 'required|string|max:20|min:2',
                    'Middle_Name' => 'nullable|string|max:20|min:2',
                    'Last_Name' => 'required|string|max:20|min:2',
                    'Gender' => 'required|string|max:8|min:2',
                    'Date' => 'required|date_format:d/m/Y',
                    'Nationality' => 'required',
                    'Passport' => 'required|string|max:25|min:2|unique:students,passport_number',
                    'Marital' => 'required|string|max:20|min:2',
                    'Disability' => 'nullable|string|max:5',
                    'Facilities' => 'nullable|string|max:20',
                    'How' => 'required|numeric',
                    'email' => 'required|string|email|max:100',
                    'mobile' => 'required|numeric|digits_between:1,15',

                    'attended' => 'nullable|string|max:5|min:2',
                    'student_number' => 'nullable|numeric',
                    'Institute' => 'nullable|string|max:50|min:2',
                    'Yars_From' => 'nullable|digits:4',
                    'Years_To' => 'nullable|digits:4',
                    'type_degree' => 'nullable|string|max:50|min:2',
                    'latest_grade' => 'nullable|string|max:50|min:2',

                    'Program_Semester' => 'required|string|max:25|min:2',
                    'Program_Level' => 'required|string|max:25|min:2',
                    'direct_transfer' => 'required|string|max:25|min:2',
                    'Faculty_Institute' => 'required|string|max:250|min:2',
                    'Program_Name' => 'required|string|max:50|min:2',

                    'Program_Semester2' => 'nullable|string|max:25|min:2',
                    'Program_Level2' => 'nullable|string|max:25|min:2',
                    'direct_transfer2' => 'nullable|string|max:25|min:2',
                    'Faculty_Institute2' => 'nullable|string|max:250|min:2',
                    'Program_Name2' => 'nullable|string|max:50|min:2',
    
                        ])->validate();
                   
                    
                    //echo $Request;

                    
                    $addstudent = new Student();
                    $addstudent -> 	first_name = $Request['First_Name'];
                    $addstudent -> 	middle_name = $Request['Middle_Name'];
                    $addstudent -> 	last_name = $Request['Last_Name'];
                    $addstudent -> 	gender = $Request['Gender'];
                    $addstudent -> 	date_birth = $Request['Date'];
                    $addstudent -> 	nationality_id = $Request['Nationality'];
                    $addstudent -> 	passport_number = $Request['Passport'];
                    $addstudent -> 	marital_status = $Request['Marital'];
                    $addstudent -> 	disability = $Request['Disability'];
                    $addstudent -> 	facilitie = $Request['Facilities'];
                    $addstudent -> 	how_find_id = $Request['How'];
                    $addstudent -> 	email = $Request['email'];
                    $addstudent -> 	mobile = $Request['mobile'];
                    $addstudent ->  note = $Request['note'];
                    $addstudent -> 	user_id = $users_id;
                    $addstudent -> save();
                    
                    $student_id = Student::orderBy('id', 'desc')->first()->id;

                    $addeducational = new Educational_background();
                    $addeducational -> 	attended = $Request['attended'];
                    $addeducational -> 	student_number = $Request['student_number'];
                    $addeducational -> 	instituate_depatment = $Request['Institute'];
                    $addeducational -> 	yers_from = $Request['Yars_From'];
                    $addeducational -> 	years_to = $Request['Years_To'];
                    $addeducational -> 	type_degree = $Request['type_degree'];
                    $addeducational -> 	latest_grade = $Request['latest_grade'];
                    $addeducational -> 	student_id = $student_id;
                    $addeducational -> save();

                    $addprogram = new Program();
                    $addprogram -> 	type_program = "First Program";
                    $addprogram -> 	p_semester = $Request['Program_Semester'];
                    $addprogram -> 	p_level = $Request['Program_Level'];
                    $addprogram -> 	direct_transfer = $Request['direct_transfer'];
                    $addprogram -> 	institute_name = $Request['Faculty_Institute'];
                    $addprogram -> 	p_name = $Request['Program_Name'];
                    $addprogram -> 	student_id = $student_id;
                    $addprogram -> save();

                    $addprogram2 = new Program();
                    $addprogram2 -> type_program = "Second Program";
                    $addprogram2 -> p_semester = $Request['Program_Semester2'];
                    $addprogram2 -> p_level = $Request['Program_Level2']; 
                    $addprogram2 -> direct_transfer = $Request['direct_transfer2'];
                    $addprogram2 -> institute_name = $Request['Faculty_Institute2'];
                    $addprogram2 -> p_name = $Request['Program_Name2'];
                    $addprogram2 -> student_id = $student_id;
                    $addprogram2 -> save();

                    $user_name = Auth::user()->name;

                    $addapplication = new Application();
                    $addapplication -> code = $user_name."@";
                    $addapplication -> status = "Not Completed";
                    $addapplication -> seen = 0;
                    $addapplication -> user_id = $users_id;
                    $addapplication -> student_id = $student_id;
                    $addapplication -> save();

                    $application_id = Application::orderBy('id', 'desc')->first()->id;
                    $application = Application::where('id',$application_id)->first();
                    $application -> code = $user_name."@".$application_id;
                    $application -> save();
                    


                    $typesdocuments = Document_type::all();
                    $students_documents = Students_document::where('student_id',$student_id)->get();
                    $arr = array('students_documents' => $students_documents , 'typesdocuments' => $typesdocuments, 'notifications' => $notifications , 'countnotifications' => $countnotifications,'idstudent' =>$student_id);
                    //return view('users/applications/uploaddocumentssubmit',$arr);
                    return redirect('/home/viewdocumentssubmit/'.$student_id)->with($arr);

        }

            else{return view('publicviews/404error');}      

    }


    public function submitapplication(Request $Request,$idstudent)
    {

        $users_id = Auth::user()->id;
        $users_name = Auth::user()->name;
        $countnotifications = User_notification::where('seen',0)->where('user_id',$users_id)->count();
        $notifications = User_notification::where('seen',0)->where('user_id',$users_id)->orderBy('id', 'desc')->get();

                    $application_code = Application::where('student_id', $idstudent)->first();
                    $application_code -> status = "New";
                    $application_code -> seen = 1;
                    $application_code -> save();

                    $addlog = new Log();
                    $addlog -> operating = "Add New Application";
                    $addlog -> application_code = $application_code->code;
                    $addlog -> user_name = $users_name;
                    $addlog -> save();

                    $addnotification = new Admin_notification();
                    $addnotification -> operating = "Add New Application";
                    $addnotification -> application_id = $application_code->id;
                    $addnotification -> user_id = $users_id;
                    $addnotification -> seen = 0;
                    $addnotification -> save();
   
                    $allapplication = Application::where('user_id',$users_id)->get();
                    $arr = array('allapplication' => $allapplication , 'notifications' => $notifications , 'countnotifications' => $countnotifications,'status'=>"All");
                    //return view('users/applications/viewallapplications',$arr);
                    return redirect('/home/viewallapplications1')->with($arr);


    }

    public function continueapplication(Request $Request,$id)
    {
        $users_id = Auth::user()->id;
        $users_name = Auth::user()->name;
        $users_verifi =  $this->verifiuser($users_id);
        $countnotifications = User_notification::where('seen',0)->where('user_id',$users_id)->count();
        $notifications = User_notification::where('seen',0)->where('user_id',$users_id)->orderBy('id', 'desc')->get();
        if ($Request->isMethod('post')) 
        {

                Validator::make($Request->all(), [
                    'First_Name' => 'required|string|max:20|min:2',
                    'Middle_Name' => 'nullable|string|max:20|min:2',
                    'Last_Name' => 'required|string|max:20|min:2',
                    'Gender' => 'required|string|max:8|min:2',
                    'Date' => 'required|date_format:d/m/Y',
                    'Nationality' => 'required',
                    'Passport' => 'required|string|max:25|min:2',
                    'Marital' => 'required|string|max:20|min:2',
                    'Disability' => 'nullable|string|max:5',
                    'Facilities' => 'nullable|string|max:20',
                    'How' => 'required|numeric',
                    'email' => 'required|string|email|max:100',
                    'mobile' => 'required|numeric|digits_between:1,15',

                    'attended' => 'nullable|string|max:5|min:2',
                    'student_number' => 'nullable|numeric',
                    'Institute' => 'nullable|string|max:50|min:2',
                    'Yars_From' => 'nullable|digits:4',
                    'Years_To' => 'nullable|digits:4',
                    'type_degree' => 'nullable|string|max:50|min:2',
                    'latest_grade' => 'nullable|string|max:50|min:2',

                    'Program_Semester' => 'required|string|max:25|min:2',
                    'Program_Level' => 'required|string|max:25|min:2',
                    'direct_transfer' => 'required|string|max:25|min:2',
                    'Faculty_Institute' => 'required|string|max:250|min:2',
                    'Program_Name' => 'required|string|max:50|min:2',

                    'Program_Semester2' => 'nullable|string|max:25|min:2',
                    'Program_Level2' => 'nullable|string|max:25|min:2',
                    'direct_transfer2' => 'nullable|string|max:25|min:2',
                    'Faculty_Institute2' => 'nullable|string|max:250|min:2',
                    'Program_Name2' => 'nullable|string|max:50|min:2',

                    ])->validate();
               
                
                //echo $Request;

                $application = Application::find($id);
                $addstudent =   Student::where('id',$application->student->id)->first();
                $addstudent -> 	first_name = $Request['First_Name'];
                $addstudent -> 	middle_name = $Request['Middle_Name'];
                $addstudent -> 	last_name = $Request['Last_Name'];
                $addstudent -> 	gender = $Request['Gender'];
                $addstudent -> 	date_birth = $Request['Date'];
                $addstudent -> 	nationality_id = $Request['Nationality'];
                $addstudent -> 	passport_number = $Request['Passport'];
                $addstudent -> 	marital_status = $Request['Marital'];
                $addstudent -> 	disability = $Request['Disability'];
                $addstudent -> 	facilitie = $Request['Facilities'];
                $addstudent -> 	how_find_id = $Request['How'];
                $addstudent -> 	email = $Request['email'];
                $addstudent -> 	mobile = $Request['mobile'];
                $addstudent ->  note = $Request['note'];
                $addstudent -> save();
                
                
                $addeducational =   Educational_background::where('student_id',$application->student->id)->first();
                $addeducational -> 	attended = $Request['attended'];
                $addeducational -> 	student_number = $Request['student_number'];
                $addeducational -> 	instituate_depatment = $Request['Institute'];
                $addeducational -> 	yers_from = $Request['Yars_From'];
                $addeducational -> 	years_to = $Request['Years_To'];
                $addeducational -> 	type_degree = $Request['type_degree'];
                $addeducational -> 	latest_grade = $Request['latest_grade'];
                $addeducational -> save();

                $addprogram =   Program::where('student_id',$application->student->id)->where('type_program','=','First Program')->first();
                $addprogram -> 	p_semester = $Request['Program_Semester'];
                $addprogram -> 	p_level = $Request['Program_Level'];
                $addprogram -> 	direct_transfer = $Request['direct_transfer'];
                $addprogram -> 	institute_name = $Request['Faculty_Institute'];
                $addprogram -> 	p_name = $Request['Program_Name'];
                $addprogram -> save();

                $addprogram2 = Program::where('student_id',$application->student->id)->where('type_program','=','Second Program')->first();
                $addprogram2 -> p_semester = $Request['Program_Semester2'];
                $addprogram2 -> p_level = $Request['Program_Level2']; 
                $addprogram2 -> direct_transfer = $Request['direct_transfer2'];
                $addprogram2 -> institute_name = $Request['Faculty_Institute2'];
                $addprogram2 -> p_name = $Request['Program_Name2'];
                $addprogram2 -> save();


                $typesdocuments = Document_type::all();
                $students_documents = Students_document::where('student_id',$application->student->id)->get();
                $arr = array('students_documents' => $students_documents , 'typesdocuments' => $typesdocuments, 'notifications' => $notifications , 'countnotifications' => $countnotifications,'idstudent' =>$application->student->id);
                //return view('users/applications/uploaddocumentssubmit',$arr);
                return redirect('/home/viewdocumentssubmit/'.$application->student->id)->with($arr);


        }
        else{

                $allcountries = Countrie::all();
                $how = How_find_us_table::all();
                $application = Application::find($id);
                $arr = array('application' => $application, 'how' => $how , 'allcountries'=> $allcountries , 'notifications' => $notifications , 'countnotifications' => $countnotifications);
                return view('users/applications/continueapplication',$arr);
        }

    }
 

    public function editapplication(Request $Request,$id)
    {
        $users_id = Auth::user()->id;
        $users_name = Auth::user()->name;
        $users_verifi =  $this->verifiuser($users_id);
        $countnotifications = User_notification::where('seen',0)->where('user_id',$users_id)->count();
        $notifications = User_notification::where('seen',0)->where('user_id',$users_id)->orderBy('id', 'desc')->get();
        if ($Request->isMethod('post')) 
        {

                Validator::make($Request->all(), [
                    'First_Name' => 'required|string|max:20|min:2',
                    'Middle_Name' => 'nullable|string|max:20|min:2',
                    'Last_Name' => 'required|string|max:20|min:2',
                    'Gender' => 'required|string|max:8|min:2',
                    'Date' => 'required|date_format:d/m/Y',
                    'Nationality' => 'required',
                    'Passport' => 'required|string|max:25|min:2',
                    'Marital' => 'required|string|max:20|min:2',
                    'Disability' => 'nullable|string|max:5',
                    'Facilities' => 'nullable|string|max:20',
                    'How' => 'required|numeric',
                    'email' => 'required|string|email|max:100',
                    'mobile' => 'required|numeric|digits_between:1,15',

                    'attended' => 'nullable|string|max:5|min:2',
                    'student_number' => 'nullable|numeric',
                    'Institute' => 'nullable|string|max:50|min:2',
                    'Yars_From' => 'nullable|digits:4',
                    'Years_To' => 'nullable|digits:4',
                    'type_degree' => 'nullable|string|max:50|min:2',
                    'latest_grade' => 'nullable|string|max:50|min:2',

                    'Program_Semester' => 'required|string|max:25|min:2',
                    'Program_Level' => 'required|string|max:25|min:2',
                    'direct_transfer' => 'required|string|max:25|min:2',
                    'Faculty_Institute' => 'required|string|max:250|min:2',
                    'Program_Name' => 'required|string|max:50|min:2',

                    'Program_Semester2' => 'nullable|string|max:25|min:2',
                    'Program_Level2' => 'nullable|string|max:25|min:2',
                    'direct_transfer2' => 'nullable|string|max:25|min:2',
                    'Faculty_Institute2' => 'nullable|string|max:250|min:2',
                    'Program_Name2' => 'nullable|string|max:50|min:2',

                    ])->validate();
               
                
                //echo $Request;

                $application = Application::find($id);
                $addstudent =   Student::where('id',$application->student->id)->first();
                $addstudent -> 	first_name = $Request['First_Name'];
                $addstudent -> 	middle_name = $Request['Middle_Name'];
                $addstudent -> 	last_name = $Request['Last_Name'];
                $addstudent -> 	gender = $Request['Gender'];
                $addstudent -> 	date_birth = $Request['Date'];
                $addstudent -> 	nationality_id = $Request['Nationality'];
                $addstudent -> 	passport_number = $Request['Passport'];
                $addstudent -> 	marital_status = $Request['Marital'];
                $addstudent -> 	disability = $Request['Disability'];
                $addstudent -> 	facilitie = $Request['Facilities'];
                $addstudent -> 	how_find_id = $Request['How'];
                $addstudent -> 	email = $Request['email'];
                $addstudent -> 	mobile = $Request['mobile'];
                $addstudent ->  note = $Request['note'];
                $addstudent -> save();
                
                
                $addeducational =   Educational_background::where('student_id',$application->student->id)->first();
                $addeducational -> 	attended = $Request['attended'];
                $addeducational -> 	student_number = $Request['student_number'];
                $addeducational -> 	instituate_depatment = $Request['Institute'];
                $addeducational -> 	yers_from = $Request['Yars_From'];
                $addeducational -> 	years_to = $Request['Years_To'];
                $addeducational -> 	type_degree = $Request['type_degree'];
                $addeducational -> 	latest_grade = $Request['latest_grade'];
                $addeducational -> save();

                $addprogram =   Program::where('student_id',$application->student->id)->where('type_program','=','First Program')->first();
                $addprogram -> 	p_semester = $Request['Program_Semester'];
                $addprogram -> 	p_level = $Request['Program_Level'];
                $addprogram -> 	direct_transfer = $Request['direct_transfer'];
                $addprogram -> 	institute_name = $Request['Faculty_Institute'];
                $addprogram -> 	p_name = $Request['Program_Name'];
                $addprogram -> save();

                $addprogram2 = Program::where('student_id',$application->student->id)->where('type_program','=','Second Program')->first();
                $addprogram2 -> p_semester = $Request['Program_Semester2'];
                $addprogram2 -> p_level = $Request['Program_Level2']; 
                $addprogram2 -> direct_transfer = $Request['direct_transfer2'];
                $addprogram2 -> institute_name = $Request['Faculty_Institute2'];
                $addprogram2 -> p_name = $Request['Program_Name2'];
                $addprogram2 -> save();

                
                $application = Application::where('id',$id)->first();
                $application -> status = "Updated";
                $application -> save();


                $addlog = new Log();
                $addlog -> operating = "Updeated Application";
                $addlog -> application_code = $application->code;
                $addlog -> user_name = $users_name;
                $addlog -> save();

                $addnotification = new Admin_notification();
                $addnotification -> operating = "Updeated Application";
                $addnotification -> application_id = $application->id;
                $addnotification -> user_id = $users_id;
                $addnotification -> seen = 0;
                $addnotification -> save();


                $typesdocuments = Document_type::all();
                $students_documents = Students_document::where('student_id',$application->student->id)->get();
                $arr = array('students_documents' => $students_documents , 'typesdocuments' => $typesdocuments, 'notifications' => $notifications , 'countnotifications' => $countnotifications,'idstudent' =>$application->student->id);
                //return view('users/applications/uploaddocuments',$arr);
                return redirect('/home/viewdocument1/'.$application->student->id)->with($arr);


        }
        else{

                $allcountries = Countrie::all();
                $how = How_find_us_table::all();
                $application = Application::find($id);
                $arr = array('application' => $application, 'how' => $how , 'allcountries'=> $allcountries , 'notifications' => $notifications , 'countnotifications' => $countnotifications);
                return view('users/applications/editapplication',$arr);
        }

    }


    public function viewdocuments(Request $Request,$id)
    {

        $users_id = Auth::user()->id;
        $users_verifi =  $this->verifiuser($users_id);
        $countnotifications = User_notification::where('seen',0)->where('user_id',$users_id)->count();
        $notifications = User_notification::where('seen',0)->where('user_id',$users_id)->orderBy('id', 'desc')->get();
    		 
                    $typesdocuments = Document_type::all();
                    $students_documents = Students_document::where('student_id',$id)->get();
                    $arr = array('students_documents' => $students_documents , 'typesdocuments' => $typesdocuments, 'notifications' => $notifications , 'countnotifications' => $countnotifications,'idstudent' =>$id);
                    return view('users/applications/uploaddocuments',$arr);
                


    }

    public function viewdocumentssubmit(Request $Request,$id)
    {

        $users_id = Auth::user()->id;
        $users_verifi =  $this->verifiuser($users_id);
        $countnotifications = User_notification::where('seen',0)->where('user_id',$users_id)->count();
        $notifications = User_notification::where('seen',0)->where('user_id',$users_id)->orderBy('id', 'desc')->get();
    		 
                    $typesdocuments = Document_type::all();
                    $students_documents = Students_document::where('student_id',$id)->get();
                    $arr = array('students_documents' => $students_documents , 'typesdocuments' => $typesdocuments, 'notifications' => $notifications , 'countnotifications' => $countnotifications,'idstudent' =>$id);
                    return view('users/applications/uploaddocumentssubmit',$arr);
                


    }

    public function uploaddocument(Request $Request,$idstudent)
    {
            $users_id = Auth::user()->id;
            $users_verifi =  $this->verifiuser($users_id);
            $countnotifications = User_notification::where('seen',0)->where('user_id',$users_id)->count();
            $notifications = User_notification::where('seen',0)->where('user_id',$users_id)->orderBy('id', 'desc')->get();
    	   
                    $application = Application::where('student_id',$idstudent)->first();
                    $DocumentType = $Request['Document_Type'];
                    $file = $Request->file('document');
                    Validator::make($Request->all(), [
                        'document' => 'required|file|max:5120|mimes:jpeg,bmb,png,pdf',
                        ])->validate();
                    Storage::disk('public_uploads')->putFileAs("applicationfiles"."/".$application->user->name."/".$application->code, $Request->file('document'), $file->getClientOriginalName());


        	        $newdoucument = new Students_document();
        	        $newdoucument -> doucment_name = $file->getClientOriginalName();
        	        $newdoucument -> docyment_type = $Request['Document_Type'];
                    $newdoucument -> document_path = "uploads/applicationfiles/".$application->user->name."/".$application->code."/".$file->getClientOriginalName();
                    $newdoucument -> document_path_delete = "applicationfiles/".$application->user->name."/".$application->code."/".$file->getClientOriginalName();
                    $newdoucument -> student_id = $idstudent;
                    $newdoucument -> save();
                    
                    $typesdocuments = Document_type::all();
                    $students_documents = Students_document::where('student_id',$idstudent)->get();
                    $arr = array('students_documents' => $students_documents , 'typesdocuments' => $typesdocuments, 'notifications' => $notifications , 'countnotifications' => $countnotifications , 'idstudent' =>$idstudent);
                    //return view('users/applications/uploaddocuments',$arr);
                    return redirect('/home/viewdocument1/'.$idstudent)->with($arr);
                           

    }


    public function uploaddocumentsubmit(Request $Request,$idstudent)
    {
            $users_id = Auth::user()->id;
            $users_verifi =  $this->verifiuser($users_id);
            $countnotifications = User_notification::where('seen',0)->where('user_id',$users_id)->count();
            $notifications = User_notification::where('seen',0)->where('user_id',$users_id)->orderBy('id', 'desc')->get();
    	   
                    $application = Application::where('student_id',$idstudent)->first();
                    $DocumentType = $Request['Document_Type'];
                    $file = $Request->file('document');
                    Validator::make($Request->all(), [
                        'document' => 'required|file|max:5120|mimes:jpeg,bmb,png,pdf',
                        ])->validate();
                    Storage::disk('public_uploads')->putFileAs("applicationfiles"."/".$application->user->name."/".$application->code, $Request->file('document'), $file->getClientOriginalName());


        	        $newdoucument = new Students_document();
        	        $newdoucument -> doucment_name = $file->getClientOriginalName();
        	        $newdoucument -> docyment_type = $Request['Document_Type'];
                    $newdoucument -> document_path = "uploads/applicationfiles/".$application->user->name."/".$application->code."/".$file->getClientOriginalName();
                    $newdoucument -> document_path_delete = "applicationfiles/".$application->user->name."/".$application->code."/".$file->getClientOriginalName();
                    $newdoucument -> student_id = $idstudent;
                    $newdoucument -> save();
                    
                    $typesdocuments = Document_type::all();
                    $students_documents = Students_document::where('student_id',$idstudent)->get();
                    $arr = array('students_documents' => $students_documents , 'typesdocuments' => $typesdocuments, 'notifications' => $notifications , 'countnotifications' => $countnotifications , 'idstudent' =>$idstudent);
                    //return view('users/applications/uploaddocumentssubmit',$arr);
                    return redirect('/home/viewdocumentssubmit/'.$idstudent)->with($arr);
                           

    }


    public function deletedocument(Request $Request,$iddoc)
    {
            $users_id = Auth::user()->id;
            $users_verifi =  $this->verifiuser($users_id);
            $countnotifications = User_notification::where('seen',0)->where('user_id',$users_id)->count();
            $notifications = User_notification::where('seen',0)->where('user_id',$users_id)->orderBy('id', 'desc')->get();
    		    


                    $students_documents = Students_document::find($iddoc);
                    $idstudent = $students_documents->student_id;
                    Storage::disk('public_uploads')->delete($students_documents->document_path_delete);
                    $students_documents -> delete();

                    $typesdocuments = Document_type::all();
                    $students_documents = Students_document::where('student_id',$idstudent)->get();
                    $arr = array('students_documents' => $students_documents , 'typesdocuments' => $typesdocuments, 'notifications' => $notifications , 'countnotifications' => $countnotifications , 'idstudent' =>$idstudent);
                    //return view('users/applications/uploaddocuments',$arr);
                    return redirect('/home/viewdocument1/'.$idstudent)->with($arr);
  

    }


    public function deletedocumentsubmit(Request $Request,$iddoc)
    {
            $users_id = Auth::user()->id;
            $users_verifi =  $this->verifiuser($users_id);
            $countnotifications = User_notification::where('seen',0)->where('user_id',$users_id)->count();
            $notifications = User_notification::where('seen',0)->where('user_id',$users_id)->orderBy('id', 'desc')->get();
                


                    $students_documents = Students_document::find($iddoc);
                    $idstudent = $students_documents->student_id;
                    Storage::disk('public_uploads')->delete($students_documents->document_path_delete);
                    $students_documents -> delete();

                    $typesdocuments = Document_type::all();
                    $students_documents = Students_document::where('student_id',$idstudent)->get();
                    $arr = array('students_documents' => $students_documents , 'typesdocuments' => $typesdocuments, 'notifications' => $notifications , 'countnotifications' => $countnotifications , 'idstudent' =>$idstudent);
                    //return view('users/applications/uploaddocumentssubmit',$arr);
                    return redirect('/home/viewdocumentssubmit/'.$idstudent)->with($arr);
  

    }




    //////////nav an side bar link
    public function viewunderprocessapplications(Request $Request)
    {
        $users_id = Auth::user()->id;
        $users_verifi =  $this->verifiuser($users_id);
        $countnotifications = User_notification::where('seen',0)->where('user_id',$users_id)->count();
        $notifications = User_notification::where('seen',0)->where('user_id',$users_id)->orderBy('id', 'desc')->get();

                    $allapplication = Application::where('status','Under Process')->where('user_id',$users_id)->get();
                    $arr = array('allapplication' => $allapplication , 'notifications' => $notifications , 'countnotifications' => $countnotifications,'status'=>"Under Process");
                    return view('users/applications/viewallapplications',$arr);

    }

    public function viewrejectedapplications(Request $Request)
    {
        $users_id = Auth::user()->id;
        $users_verifi =  $this->verifiuser($users_id);
        $countnotifications = User_notification::where('seen',0)->where('user_id',$users_id)->count();
        $notifications = User_notification::where('seen',0)->where('user_id',$users_id)->orderBy('id', 'desc')->get();

                    $allapplication = Application::where('status','Rejected')->where('user_id',$users_id)->get();
                    $arr = array('allapplication' => $allapplication , 'notifications' => $notifications , 'countnotifications' => $countnotifications,'status'=>"Rejected");
                    return view('users/applications/viewallapplications',$arr);
   	
    }

    public function viewnewapplications(Request $Request)
    {
        $users_id = Auth::user()->id;
        $users_verifi =  $this->verifiuser($users_id);
        $countnotifications = User_notification::where('seen',0)->where('user_id',$users_id)->count();
        $notifications = User_notification::where('seen',0)->where('user_id',$users_id)->orderBy('id', 'desc')->get();
  
                    $allapplication = Application::where('status','New')->where('user_id',$users_id)->get();
                    $arr = array('allapplication' => $allapplication , 'notifications' => $notifications , 'countnotifications' => $countnotifications,'status'=>"New");
                    return view('users/applications/viewallapplications',$arr);

    }

    public function viewcompletedapplications(Request $Request)
    {
        $users_id = Auth::user()->id;
        $users_verifi =  $this->verifiuser($users_id);
        $countnotifications = User_notification::where('seen',0)->where('user_id',$users_id)->count();
        $notifications = User_notification::where('seen',0)->where('user_id',$users_id)->orderBy('id', 'desc')->get();
   
                    $allapplication = Application::where('status','Accepted')->where('user_id',$users_id)->get();
                    $arr = array('allapplication' => $allapplication , 'notifications' => $notifications , 'countnotifications' => $countnotifications,'status'=>"Accepted");
                    return view('users/applications/viewallapplications',$arr);

    }

    public function viewupdatedapplications(Request $Request)
    {
        $users_id = Auth::user()->id;
        $users_verifi =  $this->verifiuser($users_id);
        $countnotifications = User_notification::where('seen',0)->where('user_id',$users_id)->count();
        $notifications = User_notification::where('seen',0)->where('user_id',$users_id)->orderBy('id', 'desc')->get();
  
                    $allapplication = Application::where('status','Updated')->where('user_id',$users_id)->get();
                    $arr = array('allapplication' => $allapplication , 'notifications' => $notifications , 'countnotifications' => $countnotifications,'status'=>"Updated");
                    return view('users/applications/viewallapplications',$arr);

    }

    public function viewnotcompleyedapplications(Request $Request)
    {
        $users_id = Auth::user()->id;
        $users_verifi =  $this->verifiuser($users_id);
        $countnotifications = User_notification::where('seen',0)->where('user_id',$users_id)->count();
        $notifications = User_notification::where('seen',0)->where('user_id',$users_id)->orderBy('id', 'desc')->get();
  
                    $allapplication = Application::where('status','Not Completed')->where('user_id',$users_id)->get();
                    $arr = array('allapplication' => $allapplication , 'notifications' => $notifications , 'countnotifications' => $countnotifications);
                    return view('users/applications/viewnotcompletedapplication',$arr);

    }

    

    //////////nav an side bar link

    


}
