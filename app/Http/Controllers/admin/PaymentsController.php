<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Admin_notification;
use App\Log;
use Carbon\Carbon;
use App\Daily_payment;
use App\Print_payment;

use Illuminate\Support\Facades\Storage;
use Image;
use PDF;
use File;
use Elibyy\TCPDF\Facades\TCPDF;
use Johntaa\Arabic\I18N_Arabic;

class PaymentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }


    public function payments(Request $Request)
    {
        $users_id = Auth::user()->id;
        $users_verifi =  $this->verifiuser($users_id);
        $countnotifications = Admin_notification::where('seen',0)->count();
        $notifications = Admin_notification::where('seen',0)->orderBy('id', 'desc')->get();
    		if ($users_verifi == 0) 
                {    
                    $paymentsIn = Daily_payment::where('type',0)->get();
                    $paymentsOut = Daily_payment::where('type',1)->get();
                    $t1 = Daily_payment::where('type',0)->sum('in_usd');
                    $t2 = Daily_payment::where('type',0)->sum('in_local');
                    $t3 = Daily_payment::where('type',1)->sum('in_usd');
                    $t4 = Daily_payment::where('type',1)->sum('in_local');
                    $arr = array('paymentsIn' => $paymentsIn, 'paymentsOut' => $paymentsOut, 't1' => $t1, 't2' => $t2, 't3' => $t3, 't4' => $t4, 'r1' => $t1 - $t3, 'r2' => $t2 - $t4, 'notifications' => $notifications , 'countnotifications' => $countnotifications);
                            return view('admin/payments/payments',$arr);

                }

            else{return view('publicviews/404error');} 
    	
    }

    public function paymentsDate(Request $Request)
    {
        $users_id = Auth::user()->id;
        $users_verifi =  $this->verifiuser($users_id);
        $countnotifications = Admin_notification::where('seen',0)->count();
        $notifications = Admin_notification::where('seen',0)->orderBy('id', 'desc')->get();
            if ($users_verifi == 0) 
                {    
                    $paymentsIn = Daily_payment::where('type',0)->where('date',$Request->input('date'))->get();
                    $paymentsOut = Daily_payment::where('type',1)->where('date',$Request->input('date'))->get();
                    $t1 = Daily_payment::where('type',0)->where('date',$Request->input('date'))->sum('in_usd');
                    $t2 = Daily_payment::where('type',0)->where('date',$Request->input('date'))->sum('in_local');
                    $t3 = Daily_payment::where('type',1)->where('date',$Request->input('date'))->sum('in_usd');
                    $t4 = Daily_payment::where('type',1)->where('date',$Request->input('date'))->sum('in_local');
                    $arr = array('paymentsIn' => $paymentsIn, 'paymentsOut' => $paymentsOut, 't1' => $t1, 't2' => $t2, 't3' => $t3, 't4' => $t4, 'r1' => $t1 - $t3, 'r2' => $t2 - $t4, 'notifications' => $notifications , 'countnotifications' => $countnotifications);
                            return view('admin/payments/payments',$arr);

                }

            else{return view('publicviews/404error');} 
        
    }

    public function paymentIn(Request $Request)
    {
        if ($Request->isMethod('post')) 
        {
            $users_id = Auth::user()->id;
            $users_verifi =  $this->verifiuser($users_id);
            $countnotifications = Admin_notification::where('seen',0)->count();
            $notifications = Admin_notification::where('seen',0)->orderBy('id', 'desc')->get();
                if ($users_verifi == 0) {
                $myDate = Carbon::now();
                Validator::make($Request->all(), [
                'name' => 'required|string|max:200|min:2',
                'about_payment' => 'required|string|max:200|min:2',
                ])->validate();
                $new = new Daily_payment();
                $new -> type = 0;
                $new -> name = $Request->input('name');
                $new -> in_usd = $Request->input('in_usd');
                $new -> in_local = $Request->input('in_local');
                $new -> date = $myDate;
                $new -> about_payment = $Request->input('about_payment');
                $new -> amount = $Request->input('amount');
                $new -> save();

                return redirect('/home/addpaymentin'); 
                
            }
            
            else{return view('publicviews/404error');}

        }else {

                $users_id = Auth::user()->id;
                $users_verifi =  $this->verifiuser($users_id);
                $countnotifications = Admin_notification::where('seen',0)->count();
                $notifications = Admin_notification::where('seen',0)->orderBy('id', 'desc')->get();
                    if ($users_verifi == 0) 
                        {   
                            $payments = Daily_payment::where('type',0)->get();
                            $arr = array('payments' => $payments, 'notifications' => $notifications , 'countnotifications' => $countnotifications);
                            return view('admin/payments/paymentin',$arr);

                        }

                    else{return view('publicviews/404error');}
            }
            
    }

    public function paymentOut(Request $Request)
    {
        if ($Request->isMethod('post')) 
        {
            $users_id = Auth::user()->id;
            $users_verifi =  $this->verifiuser($users_id);
            $countnotifications = Admin_notification::where('seen',0)->count();
            $notifications = Admin_notification::where('seen',0)->orderBy('id', 'desc')->get();
                if ($users_verifi == 0) {
                $myDate = Carbon::now();
                Validator::make($Request->all(), [
                'name' => 'required|string|max:200|min:2',
                'about_payment' => 'required|string|max:200|min:2',
                ])->validate();
                $new = new Daily_payment();
                $new -> type = 1;
                $new -> name = $Request->input('name');
                $new -> in_usd = $Request->input('in_usd');
                $new -> in_local = $Request->input('in_local');
                $new -> date = $myDate;
                $new -> about_payment = $Request->input('about_payment');
                $new -> amount = $Request->input('amount');
                $new -> save();

                return redirect('/home/addpaymentout'); 
                
            }
            
            else{return view('publicviews/404error');}

        }else {

                $users_id = Auth::user()->id;
                $users_verifi =  $this->verifiuser($users_id);
                $countnotifications = Admin_notification::where('seen',0)->count();
                $notifications = Admin_notification::where('seen',0)->orderBy('id', 'desc')->get();
                    if ($users_verifi == 0) 
                        {   
                            $payments = Daily_payment::where('type',1)->get();
                            $arr = array('payments' => $payments, 'notifications' => $notifications , 'countnotifications' => $countnotifications);
                            return view('admin/payments/paymentout',$arr);

                        }

                    else{return view('publicviews/404error');}
            }
            
    }

    public function DeletePayments(Request $Request, $idPayment)
    {
        $users_id = Auth::user()->id;
        $users_verifi =  $this->verifiuser($users_id);
        $countnotifications = Admin_notification::where('seen',0)->count();
        $notifications = Admin_notification::where('seen',0)->orderBy('id', 'desc')->get();
            if ($users_verifi == 0) 
                {    
                    
                    $addlog = new Log();
                    $addlog -> operating = "Deleted Payment";
                    $addlog -> application_code = $idPayment;
                    $addlog -> user_name = Auth::user()->name;
                    $addlog -> save();
                    $delete_payment = Daily_payment::find($idPayment);
                    $payment_type = $delete_payment->type;
                    $delete_payment -> delete();

                    if ($payment_type ==  1) {
                        return redirect('/home/addpaymentout');
                    } else {
                     
                        return redirect('/home/addpaymentin');
                    }
                }

            else{return view('publicviews/404error');} 
        
    }

    private $siz;
    private $align;
    public function writeimage($IdPayment)
    {
        
        $PaymentReceived = Daily_payment::find($IdPayment);
        if ($PaymentReceived->type == 0) {
            $img = Image::make('Template/'. 'Received' .'.png');
        } else {
           $img = Image::make('Template/'. 'Paid' .'.png'); 
        }
        
        $PrintPayment = Print_payment::find(1);

        $this->align = 'center';

        //Number
        $this->siz=$PrintPayment->numbersize;
        $img->text($PaymentReceived->id, $PrintPayment->numberx, $PrintPayment->numbery, function($font)
        { 
            $font->file(public_path('font/bold.ttf'));
            $font->size($this->siz);  
            $font->color('#ee0707');  
            //$font->align($this->align);  
            $font->valign('bottom');  
            $font->angle(0);  
        });


        //name
        $this->siz=$PrintPayment->namesize;
        $img->text($PaymentReceived->name, $PrintPayment->namex, $PrintPayment->namey, function($font)
        { 
            $font->file(public_path('font/bold.ttf'));
            $font->size($this->siz);  
            $font->color('#000000');  
            //$font->align($this->align);  
            $font->valign('bottom');  
            $font->angle(0);  
        });

        //in_usd
        $this->siz=$PrintPayment->receivedusdsize;
        $img->text($PaymentReceived->in_usd, $PrintPayment->receivedusdx, $PrintPayment->receivedusdy, function($font)
        { 
            $font->file(public_path('font/bold.ttf'));
            $font->size($this->siz);  
            $font->color('#000000');  
            //$font->align($this->align);  
            $font->valign('bottom');  
            $font->angle(0);  
        });


        //in_local
        $this->siz=$PrintPayment->receiveddinarsize;
        $img->text($PaymentReceived->in_local, $PrintPayment->receiveddinarx, $PrintPayment->receiveddinary, function($font)
        { 
            $font->file(public_path('font/bold.ttf'));
            $font->size($this->siz);  
            $font->color('#000000');  
            //$font->align($this->align);  
            $font->valign('bottom');  
            $font->angle(0);  
        });

        //date
        $this->siz=$PrintPayment->datesize;
        $img->text($PaymentReceived->date, $PrintPayment->datex, $PrintPayment->datey, function($font)
        { 
            $font->file(public_path('font/bold.ttf'));
            $font->size($this->siz);  
            $font->color('#000000');  
            //$font->align($this->align);  
            $font->valign('bottom');  
            $font->angle(0);  
        });

        $Arabic = new I18N_Arabic('Glyphs');
        $AboutPaymentArabic = $Arabic->utf8Glyphs($PaymentReceived->about_payment);
        //about_payment
        $this->siz=$PrintPayment->aboutpaymentsize;
        $img->text($AboutPaymentArabic, $PrintPayment->aboutpaymentx, $PrintPayment->aboutpaymenty, function($font)
        { 
            $font->file(public_path('font/trado.ttf'));
            $font->size($this->siz);  
            $font->color('#000000');  
            //$font->align($this->align);  
            $font->valign('bottom');  
            $font->angle(0);  
        });

        $Arabic = new I18N_Arabic('Glyphs');
        $PaymentReceivedArabic = $Arabic->utf8Glyphs($PaymentReceived->amount);
        //amount
        $this->siz=$PrintPayment->amountsize;
        $img->text($PaymentReceivedArabic, $PrintPayment->amountx, $PrintPayment->amounty, function($font)
        { 
            $font->file(public_path('font/trado.ttf'));
            $font->size($this->siz);  
            $font->color('#000000');  
            //$font->align($this->align);  
            $font->valign('bottom');  
            $font->angle(0);  
        });

        $img->save('output/'. $PaymentReceived->id . '_payment' .'.png');


    }

    public function downloadpayment(Request $Request, $IdPayment)
    {
        $users_id = Auth::user()->id;
        $users_verifi =  $this->verifiuser($users_id);
        if ($users_verifi == 0) 
        {                    
            //write invoice            
            $this->writeimage($IdPayment);
           // return redirect('/home/finalizer/'.$IdInvoice);
            ////////////////*************************************************************////////////////////////

            PDF::SetTitle("Payment Export");
            PDF::setPrintHeader(false);
            PDF::setPrintFooter(false);
            PDF::SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            PDF::SetHeaderMargin(0);
            PDF::SetFooterMargin(0);
            PDF::SetAutoPageBreak(false, 0);
            PDF::setImageScale(PDF_IMAGE_SCALE_RATIO);
            PDF::AddPage('L','A5');

            // Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)

            PDF::Image(public_path('output/'. $IdPayment .'_payment.png'), 0, 0, 210, 148, '', '', '', false, 300, '', false, false, 0);     
            PDF::Output($IdPayment .'_payment.pdf', 'D');  
            Storage::disk('public_uploads')->delete($IdPayment .'_payment.png');
        }
        else
        {
            return view('publicviews/404error');
        } 
    }

}
