<?php

use Illuminate\Auth\Middleware\Authenticate;
use App\User;
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

Route::get('/', 'AuthRegistrant\RegisterController@showRegistrationForm')->name('registrant.register');
Route::get('/register', function(){
	return redirect()->route('registrant.register');
});

// Route::get('/register/{step}', 'StepController@index')->name('registrant.register');
Route::post('/register/check/input', 'StepController@ajaxcheckinput')->name('ajax.check.input');
// registrant register steps
Route::post('/register/step/1', 'AuthRegistrant\RegisterController@register')->name('register.step.1');
Route::post('/register/step/2', 'RegistrantController@registertwo')->name('register.step.2');
Route::post('/register/step/3', 'RegistrantController@registerthree')->name('register.step.3');
Route::post('/register/step/4', 'RegistrantController@registerfour')->name('register.step.4');
// registrant login
Route::get('/login', 'AuthRegistrant\LoginController@showLoginForm')->name('registrant.login');
Route::post('/login/submit', 'AuthRegistrant\LoginController@login')->name('registrant.login.submit');
Route::get('/dashboard', 'RegistrantController@index')->name('registrant.dashboard');
Route::get('/dashboard/continue', 'RegistrantController@continueregs')->name('registrant.dashboard.continue');
Route::get('/dashboard/edit', 'RegistrantController@editdata')->name('registrant.dashboard.edit');
// update data registrant
Route::post('/dashboard/update', 'RegistrantController@update')->name('registrant.dashboard.update');
Route::post('/dashboard/updatesiblings', 'RegistrantController@updatesiblings')->name('registrant.dashboard.updatesiblings');
Route::post('/dashboard/updateschool', 'RegistrantController@updateschool')->name('registrant.dashboard.updateschool');
Route::post('/dashboard/updateparents', 'RegistrantController@updateparents')->name('registrant.dashboard.updateparents');

// Route::get('/dashboard/nexstep/{id}', 'RegistrantController@nextstep')->name('registrant.dashboard.nexstep');
Route::post('/logout', 'RegistrantController@logout')->name('registrant.logout');
// registrant forgot
Route::get('/forgot', 'StepController@forgotpassword')->name('registrant.forgot');
Route::post('/forgot/submit', 'StepController@forgotsubmit')->name('registrant.forgot.submit');
// pdf download
Route::get('/dashboard/kartu-ujian', 'RegistrantController@kartuujian')->name('registrant.pdf.kartuujian');


Route::get('/home', 'DashboardadminController@index')->name('home');
// set admin prefix in url
Route::prefix('admin')->group(function () {

	// prevent register if user already exists
	$user = User::all();
	if($user->count() > 0) $reg = false; else $reg = true;
	// user auth routes
	Auth::routes(['register' => $reg]);

	// default dashboard route
	Route::get('/', function () {
		return redirect()->route('admin.dashboard');
	});

	// users level access route
	Route::middleware('auth')->group(function(){
		// dashboard
		Route::get('dashboard', 'DashboardadminController@index')->name('admin.dashboard');

		// registrants
		Route::get('registrants/{q}', 'RegistController@index')->name('admin.registrants');
		Route::post('registrant/manualverification', 'RegistController@manualverification')->name('admin.registrants.manual');
		Route::get('registrant/profile/{id}', 'RegistController@registrantprofile')->name('admin.registrants.profile');
		Route::post('registrant/destroy', 'RegistController@destroy')->name('admin.registrants.destroy');
		Route::get('registrant/export/all', 'ExportexcelController@exportAll')->name('admin.registrants.export.all');
		Route::get('registrant/export/pending', 'ExportexcelController@exportPending')->name('admin.registrants.export.pending');
		Route::get('registrant/export/verified', 'ExportexcelController@exportVerified')->name('admin.registrants.export.verified');
		Route::get('registrant/export/rh1', 'ExportexcelController@exportRaudhahOne')->name('admin.registrants.export.rh1');
		Route::get('registrant/export/rh2', 'ExportexcelController@exportRaudhahTwo')->name('admin.registrants.export.rh2');
		
		// examcards
		Route::get('registrant/examcard/set/{id}', 'RegistController@examcardset')->name('admin.examcard.set');
		Route::post('registrant/examcard/store', 'RegistController@examcardstore')->name('admin.examcard.store');
		Route::get('registrant/examcard/edit/{id}', 'RegistController@examcardedit')->name('admin.examcard.edit');
		Route::post('registrant/examcard/update', 'RegistController@examcardupdate')->name('admin.examcard.update');
		Route::get('registrant/examcard/view/{id}', 'RegistController@examcardview')->name('admin.examcard.view');

		// payments
		Route::get('payments', 'PaymentController@index')->name('admin.payments');
		Route::post('payments/store', 'PaymentController@store')->name('admin.payments.store');
		Route::post('payments/excelstore', 'PaymentController@excelstore')->name('admin.payments.excelstore');
		Route::post('payments/destroy', 'PaymentController@destroy')->name('admin.payments.destroy');
		
		// users
		Route::get('users', 'UserController@index')->name('admin.users');
		Route::get('users/create', 'UserController@create')->name('admin.users.create');
		Route::post('users/store', 'UserController@store')->name('admin.users.store');
		Route::get('users/edit/{id}', 'UserController@edit')->name('admin.users.edit');
		Route::post('users/update', 'UserController@update')->name('admin.users.update');
		Route::post('users/destroy', 'UserController@destroy')->name('admin.users.destroy');
		Route::post('users/changepass', 'UserController@changepass')->name('admin.users.changepass');
		
		// buildings
		Route::post('buildings/store', 'BuildingController@store')->name('admin.buildings.store');
		Route::post('buildings/destroy', 'BuildingController@destroy')->name('admin.buildings.destroy');
		
		// rooms
		Route::get('rooms', 'RoomController@index')->name('admin.rooms');
		Route::post('rooms/store', 'RoomController@store')->name('admin.rooms.store');
		Route::post('rooms/update', 'RoomController@update')->name('admin.rooms.update');
		Route::get('rooms/destroy/{id}', 'RoomController@destroy')->name('admin.rooms.destroy');
		
		// classrooms
		Route::get('classrooms', 'ClassroomController@index')->name('admin.classrooms');
		Route::post('classrooms/store', 'ClassroomController@store')->name('admin.classrooms.store');
		Route::post('classrooms/update', 'ClassroomController@update')->name('admin.classrooms.update');
		Route::get('classrooms/destroy/{id}', 'ClassroomController@destroy')->name('admin.classrooms.destroy');
		
		// tables
		Route::get('tables', 'FoodtableController@index')->name('admin.tables');
		Route::post('tables/store', 'FoodtableController@store')->name('admin.tables.store');
		Route::post('tables/update', 'FoodtableController@update')->name('admin.tables.update');
		Route::get('tables/destroy/{id}', 'FoodtableController@destroy')->name('admin.tables.destroy');
		
		// settings
		Route::get('settings', 'SettingController@index')->name('admin.settings');
		Route::post('settings/update', 'SettingController@update')->name('admin.settings.update');
		Route::post('settings/updatecost', 'SettingController@updatecost')->name('admin.settings.update.cost');
		Route::post('settings/closemessage', 'SettingController@closemessage')->name('admin.settings.update.closemessage');
		
		// ajax
		Route::post('settings/ajax/registration/toggle', 'AjaxController@registrationtoggle')->name('admin.ajax.registration.toggle');
		Route::post('registrants/ajax/getrooms', 'AjaxController@getrooms')->name('admin.ajax.getrooms');
		Route::post('registrants/ajax/getpayment', 'AjaxController@getpayment')->name('admin.ajax.getpayment');
	});
	
});




// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/home', function(){
// 	return redirect()->route('admin.dashboard');
// })->name('home');

// registrant register
// Route::get('/register/{step}', 'AuthRegistrant\RegisterController@showRegistrationForm')->name('registrant.register');
// Route::get('/register/{step}', 'StepController@index')->name('registrant.register');


// payment step controller
// Route::post('/dashboard/payment/back', 'RegistrantController@goback')->name('registrant.paystep.back');
// Route::post('/dashboard/payment/1', 'RegistrantController@stepone')->name('registrant.paystep.one');
// Route::post('/dashboard/payment/2', 'RegistrantController@steptwo')->name('registrant.paystep.two');


// Route::post('/register/step/1', 'StepController@stepone')->name('register.step.1');
// Route::post('/register/step/2', 'StepController@steptwo')->name('register.step.2');
// Route::post('/register/step/3', 'StepController@stepthree')->name('register.step.3');
// Route::post('/register/step/4', 'StepController@stepfour')->name('register.step.4');