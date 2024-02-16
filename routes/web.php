<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Public controller
Route::get('/', function () {
    return view('/auth/login');
});
Auth::routes();
Route::get('/home', 'Controller@index')->name('home');
Route::get('/home/success', 'Controller@success')->name('success');
//Route::get('/test', 'TestController@ViewProfileById')->name('ViewProfileById');

//Controllers for Notifications
Route::get('/home/viewallnotificationadmin', 'Controller@viewallnotificationadmin')->name('viewallnotificationadmin');
Route::get('/home/viewallnotificationuser', 'Controller@viewallnotificationadmin')->name('viewallnotificationuser');

//Users Controllers for admin
Route::get('/home/registeruser', 'Auth\RegisterUserController@register')->name('register1');
Route::post('/home/registeruser', 'Auth\RegisterUserController@create')->name('register2');
Route::get('/home/viewuser', 'admin\EditUserController@view')->name('viewuser');
Route::get('/home/edituser/{idedit}', 'admin\EditUserController@edit')->name('edituser1');
Route::post('/home/edituser/{idedit}', 'admin\EditUserController@edit')->name('edituser2');
Route::get('/home/deleteuser/{iddelete}', 'admin\EditUserController@delete')->name('deleteuser1');
Route::get('/home/status/{idstatus}', 'admin\EditUserController@status')->name('status');
Route::get('/home/viewuserforresetpassword', 'admin\EditUserController@viewuserforresetpassword')->name('viewuserforresetpassword');
Route::get('/home/resetpassworduser/{idr}', 'admin\EditUserController@resetpassworduser')->name('resetpassword1');
Route::post('/home/resetpassworduser/{idr}', 'admin\EditUserController@resetpassworduser')->name('resetpassword2');
Route::get('/home/viewlogs', 'admin\EditUserController@viewlogs')->name('viewlogs');

//Configuration Controllers for admin
Route::get('/home/viewfindus', 'admin\EditFindUsController@view')->name('viewfindus');
Route::post('/home/createfindus', 'admin\EditFindUsController@create')->name('createfindus');
Route::get('/home/viewdocument', 'admin\EditDocumentionController@view')->name('viewdocument');
Route::post('/home/createdocument', 'admin\EditDocumentionController@create')->name('createdocument');

//Users Controllers for profile
Route::get('/home/viewprfile', 'users\ProfileController@View')->name('viewprfile');
Route::post('/home/editprfile/{idedit}', 'users\ProfileController@edit')->name('editprfile');

//Applications Controllers for user
//applications
Route::get('/home/newapplication', 'users\ApplicationeController@View')->name('newapplication');
Route::post('/home/createapplication', 'users\ApplicationeController@create')->name('createapplication');
Route::get('/home/viewallapplications1', 'users\ApplicationeController@Viewallapplications')->name('viewallapplications1');
Route::get('/home/editapplication1/{id}', 'users\ApplicationeController@editapplication')->name('editapplication11');
Route::post('/home/editapplication1/{idapplication}', 'users\ApplicationeController@editapplication')->name('editapplication21');
Route::get('/home/submitapplication/{idstudent}', 'users\ApplicationeController@submitapplication')->name('submitapplication');
Route::get('/home/continueapplication/{id}', 'users\ApplicationeController@continueapplication')->name('continueapplication1');
Route::post('/home/continueapplication/{idapplication}', 'users\ApplicationeController@continueapplication')->name('continueapplication');

//notifications
Route::get('/home/viewunderprocessapplications1', 'users\ApplicationeController@viewunderprocessapplications')->name('viewunderprocessapplications1');
Route::get('/home/viewnewapplications1', 'users\ApplicationeController@viewnewapplications')->name('viewnewapplications1');
Route::get('/home/viewrejectedapplications1', 'users\ApplicationeController@viewrejectedapplications')->name('viewrejectedapplications1');
Route::get('/home/viewcompletedapplications1', 'users\ApplicationeController@viewcompletedapplications')->name('viewcompletedapplications1');
Route::get('/home/viewupdatedapplications1', 'users\ApplicationeController@viewupdatedapplications')->name('viewupdatedapplications1');
Route::get('/home/viewapplicationsfromnotifications1/{idapp}/{idnot}', 'users\ApplicationeController@viewapplicationsfromnotifications')->name('viewapplicationsfromnotifications1');
Route::get('/home/viewnotcompleyedapplications1', 'users\ApplicationeController@viewnotcompleyedapplications')->name('viewnotcompleyedapplications1');
//documents
Route::get('/home/viewdocument1/{id}', 'users\ApplicationeController@viewdocuments')->name('viewdocument1');
Route::post('/home/uploaddocument1/{idstudent}', 'users\ApplicationeController@uploaddocument')->name('uploaddocument1');
Route::get('/home/deletedocument1/{iddoc}', 'users\ApplicationeController@deletedocument')->name('deletedocument1');
Route::post('/home/uploaddocumentsubmit/{idstudent}', 'users\ApplicationeController@uploaddocumentsubmit')->name('uploaddocumentsubmit');
Route::get('/home/deletedocumentsubmit/{iddoc}', 'users\ApplicationeController@deletedocumentsubmit')->name('deletedocumentsubmit');
Route::get('/home/viewdocumentssubmit/{id}', 'users\ApplicationeController@viewdocumentssubmit')->name('viewdocumentssubmit');

Route::get('/home/viewallstudents1', 'users\StudentsController@viewallstudents')->name('viewallstudents1');


//Applications Controllers for admin
//applications
Route::get('/home/viewallapplications', 'admin\ApplicationeController@view')->name('viewallapplications');
Route::get('/home/editapplication/{id}', 'admin\ApplicationeController@editapplication')->name('editapplication1');
Route::post('/home/editapplication/{idapplication}', 'admin\ApplicationeController@editapplication')->name('editapplication2');
Route::get('/home/deleteapplication/{id}', 'admin\ApplicationeController@deleteapplication')->name('deleteapplication');
Route::get('/home/changestatusapplication/{id}/{status}', 'admin\ApplicationeController@changestatusapplication')->name('changestatusapplication');
Route::post('/home/changestatusapplication/{id}/{status}', 'admin\ApplicationeController@changestatusapplication')->name('changestatusapplication1');
Route::get('/home/viewlogsapplication', 'admin\ApplicationeController@viewlogsapplication')->name('viewlogsapplication');
//notifications
Route::get('/home/viewunderprocessapplications', 'admin\ApplicationeController@viewunderprocessapplications')->name('viewunderprocessapplications');
Route::get('/home/viewnewapplications', 'admin\ApplicationeController@viewnewapplications')->name('viewnewapplications');
Route::get('/home/viewrejectedapplications', 'admin\ApplicationeController@viewrejectedapplications')->name('viewrejectedapplications');
Route::get('/home/viewcompletedapplications', 'admin\ApplicationeController@viewcompletedapplications')->name('viewcompletedapplications');
Route::get('/home/viewupdatedapplications', 'admin\ApplicationeController@viewupdatedapplications')->name('viewupdatedapplications');
Route::get('/home/viewapplicationsfromnotifications/{idapp}/{idnot}', 'admin\ApplicationeController@viewapplicationsfromnotifications')->name('viewapplicationsfromnotifications');
//documents
Route::get('/home/viewdocument/{id}', 'admin\ApplicationeController@viewdocuments')->name('viewdocument');
Route::post('/home/uploaddocument/{idstudent}', 'admin\ApplicationeController@uploaddocument')->name('uploaddocument');
Route::get('/home/deletedocument/{iddoc}', 'admin\ApplicationeController@deletedocument')->name('deletedocument');

Route::get('/home/viewallstudents', 'admin\StudentsController@viewallstudents')->name('viewallstudents');

Route::get('/home/exportecel', 'admin\ApplicationeController@exportecel')->name('exportecel');

//Route::get('/home/downloaddocument/{iddoc}', 'admin\ApplicationeController@downloaddocument')->name('downloaddocument');

//University for admin
Route::post('/home/adduniversity', 'admin\UniversityDepartmentController@adduniversity')->name('viewuniversity');
Route::get('/home/viewuniversity', 'admin\UniversityDepartmentController@view')->name('viewuniversity1');
Route::post('/home/finduniversity', 'admin\UniversityDepartmentController@finduniversity')->name('finduniversity');
Route::get('/home/finduniversity', 'admin\UniversityDepartmentController@finduniversity')->name('finduniversity1');
Route::get('/home/deleteuniversity/{id}', 'admin\UniversityDepartmentController@deleteuniversity')->name('deleteuniversity');

//University for user
Route::post('/home/finduniversitice', 'users\UniversityDepartmentController@finduniversity')->name('finduniversitice');
Route::get('/home/finduniversitice', 'users\UniversityDepartmentController@finduniversity')->name('finduniversitice1');

//Payments for admin
Route::post('/home/addpaymentin', 'admin\PaymentsController@paymentIn')->name('addpaymentin');
Route::get('/home/addpaymentin', 'admin\PaymentsController@paymentIn')->name('addpaymentin1');
Route::post('/home/addpaymentout', 'admin\PaymentsController@paymentOut')->name('addpaymentout');
Route::get('/home/addpaymentout', 'admin\PaymentsController@paymentOut')->name('addpaymentout1');
Route::get('/home/payments', 'admin\PaymentsController@payments')->name('payments');
Route::post('/home/payments', 'admin\PaymentsController@paymentsDate')->name('payments1');
Route::get('/home/deletepayment/{idPayment}', 'admin\PaymentsController@DeletePayments')->name('deletepayment');
Route::get('/home/downloadpayment/{IdPayment}', 'admin\PaymentsController@downloadpayment')->name('downloadpayment');

