<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\User;

class UserController extends Controller
{
	
	private $errmsg = [
		'name.required'			=> 'Nama tidak boleh kosong!',
		'name.min'					=> 'Nama minimal 3 karakter.',
		'email.required'		=> 'Email tidak boleh kosong!',
		'email.email'				=> 'Email tidak valid.',
		'email.unique'			=> 'Email sudah pernah digunakan.',
		'username.required'	=> 'Username tidak boleh kosong!',
		'username.unique'		=> 'Username sudah pernah digunakan.',
		'password.required'	=> 'Password tidak boleh kosong!',
		'password.min'			=> 'Password minimal 6 karakter.',
		'password.confirmed'=> 'Konfirmasi password salah.',
	];
	
	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		//
		// $users = User::all();
		$users = User::orderBy('role')->get();
		return view('pagesadmin.users.index', ['users' => $users]);
	}
	
	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function create()
	{
		//
		if(Auth::user()->role <= 2){
			return view('pagesadmin.users.create');
		} else {
			return redirect()->route('admin.users');
		}
	}
	
	/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function store(Request $request)
	{
		// 
		$validator = Validator::make($request->all(), [
			'name'		=> 'required|min:3',
			'email'		=> 'required|email|unique:users',
			'username'=> 'required|unique:users',
			'password'=> 'required|min:6|confirmed',
		], $this->errmsg);
		// 
		if ($validator->fails()) {
			return back()
			->withToastError($validator->messages()->all()[0])
			->withInput()
			->withErrors($validator);
		}
		//
		$u = new User();
		$u->name			= $request->name;
		$u->email			= $request->email;
		$u->username	= $request->username;
		$u->phone			= $request->phone;
		$u->password	= Hash::make($request->password);
		$u->role			= $request->role;
		$u->save();
		return redirect()->route('admin.users')->withToastSuccess('Pegawai berhasil ditambahkan.');
	}
	
	/**
	* Display the specified resource.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function show($id)
	{
		//
	}
	
	/**
	* Show the form for editing the specified resource.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function edit($id)
	{
		//
		$user = User::find($id);	
		if(Auth::id() == $id || Auth::user()->role <= 2 && $user->role != 1){
			return view('pagesadmin.users.edit', ['user' => $user]);
		} else {
			return redirect()->route('admin.users');
		}
	}
	
	/**
	* Update the specified resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request)
	{
		$id = $request->idtoupdate;
		//
		$validator = Validator::make($request->all(), [
			'name'		=> 'required|min:3',
			'email'		=> 'required|email|unique:users,username,'.$id,
			'username'=> 'required|unique:users,username,'.$id,
		], $this->errmsg);
		// 
		if ($validator->fails()) {
			return back()
			->withToastError($validator->messages()->all()[0])
			->withInput()
			->withErrors($validator);
		}
		// 
		User::where('id', $id)->update([
			'name' 			=> $request->name,
			'username'	=> $request->username,
			'email' 		=> $request->email,
			'phone' 		=> $request->phone,
			'role'			=> $request->role,
			]
		);
		
		return redirect()->route('admin.users')->withToastSuccess('Data berhasil diubah!');
	}
	
	/**
	* Remove the specified resource from storage.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function destroy(Request $request)
	{
		$id = $request->idtodelete;
		//
		User::find($id)->delete();
		// 
		return back()->withToastSuccess('Pegawai berhasil dihapus.');
	}
	
	public function changepass(Request $request)
	{
		// 
		$validator = Validator::make($request->all(), [
			'oldpassword'	=> 'required',
			'password'		=> 'required|min:6|confirmed',
		], [
			'oldpassword.required'	=> 'Password lama tidak boleh kosong!',
			'password.required'			=> 'Password baru tidak boleh kosong!',
			'password.min'					=> 'Password baru minimal 6 karakter.',
			'password.confirmed'		=> 'Konfirmasi password tidak sama.',
			]);
			// 
			if ($validator->fails()) {
				return back()
				->withToastError($validator->messages()->all()[0])
				->withInput()
				->withErrors($validator);
			}
			// 
			$id = $request->id;
			$user = User::find($id);
			// 
			if (Hash::check($request->oldpassword, $user->password)) {
				$pass = Hash::make($request->password);
				User::where('id', $id)->update(['password' => $pass]);
				return redirect()->back()->withToastSuccess('Password berhasil diubah.');
			} else {
				return redirect()->back()->withToastError('Password lama anda salah!');
			}	
			
		}
	}