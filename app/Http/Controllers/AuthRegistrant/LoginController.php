<?php

namespace App\Http\Controllers\AuthRegistrant;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Registrant;

class LoginController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles authenticating users for the application and
	| redirecting them to your home screen. The controller uses a trait
	| to conveniently provide its functionality to your applications.
	|
	*/
	
	
	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct()
	{
		$this->middleware('guest:registrant')->except('logout');
	}
	
	public function showLoginForm()
	{
		return view('authregistrant.login');
	}
	
	public function login(Request $request)
	{
		
		$validator = Validator::make($request->all(), [
			'username' => 'required',
			'password'	=> 'required|min:6',
		], [
			'username.required' => 'Kolom NIK tidak boleh dikosongkan.',
			'password.required'	=> 'Kolom Password tidak boleh dikosongkan.',
			'password.min'			=> 'Password minimal terdiri dari 6 karakter.'
		]);

		$credential = [
			'username'	=> $request->username,
			'password'	=> $request->password,
		];

		// if(Auth::guard('registrant')->attempt($credential, $request->member, true)){
		if(Auth::guard('registrant')->attempt($credential, true)){
			return redirect()->intended(route('registrant.dashboard'));
		}
		// 
		$user = Registrant::where('username', $request->username)->first();
		if($user){
			if (!Hash::check($request->password, $user->password)){
				return redirect()->back()->withInput($request->only('username', 'remember'))->with(['invalid' => 'Password anda salah!']);
			}
		}
		return redirect()->back()->withInput($request->only('username', 'remember'))->withErrors($validator)->with(['invalid' => 'NIK anda salah!']);
	}
	
	public function username()
	{
		return 'username';
	}

}