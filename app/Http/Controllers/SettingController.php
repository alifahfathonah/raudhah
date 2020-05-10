<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;


class SettingController extends Controller
{
	
	private $errmsg = [
		'name.required'			=> 'Nama institusi tidak boleh kosong!',
		'address.required'	=> 'Alamat institusi tidak boleh kosong!',
		'city.required'			=> 'Kota tidak boleh kosong!',
		'email.required'		=> 'Alamat email tidak boleh kosong!',
		'email.email'				=> 'Mohon isi email yang valid.',
		'phone.required'		=> 'Nomor telepon tidak boleh kosong!',
		'pic.image' 				=> 'Foto tidak valid!',
		'pic.mimes' 				=> 'Format foto harus jpg/png',
		'pic.max'						=> 'Ukuran foto terlalu besar (maks 1MB)',
	];
	
	public function __construct()
	{
		// 
	}

	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		if(Auth::user()->role > 2){
			return redirect()->route('admin.dashboard');
		}
		//
		$setting = Setting::first();
		return view('pagesadmin.settings.index', ['setting' => $setting]);
	}
	
	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function create()
	{
		//
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
	}
	
	/**
	* Display the specified resource.
	*
	* @param  \App\Setting  $setting
	* @return \Illuminate\Http\Response
	*/
	public function show(Setting $setting)
	{
		//
	}
	
	/**
	* Show the form for editing the specified resource.
	*
	* @param  \App\Setting  $setting
	* @return \Illuminate\Http\Response
	*/
	public function edit(Setting $setting)
	{
		//
	}
	
	/**
	* Update the specified resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  \App\Setting  $setting
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request, Setting $setting)
	{
		//
		$id = $request->id;
		// 
		$validator = Validator::make($request->all(), [
			'name'		=> 'required',
			'address'	=> 'required',
			'city'		=> 'required',
			'email'		=> 'required|email',
			'phone'		=> 'required',
			'pic'		 	=> 'image|mimes:jpeg,jpg,png|max:1024',
		], $this->errmsg);
		// 
		if ($validator->fails()) {
			return back()
			->withToastError($validator->messages()->all()[0])
			->withInput()
			->withErrors($validator);
		}
		//
		$s = Setting::find($id);
		if ($request->hasFile('logo')) {
			//
			$pic = $request->file('logo');
			$path = public_path('img/app');
			$filename = 'logo.' . $pic->getClientOriginalExtension();
			$oldlogo = $path . '/' . $s->logo;
			if(File::exists($oldlogo)){
				// hapus foto lama
				File::delete($oldlogo);
			}
			$upload = $pic->move($path, $filename);
		} else {
			$filename = $s->logo;
		}
		// 
		Setting::where('id', $id)->update([
			'logo' 			=> $filename,
			'name'			=> $request->name,
			'prefix'		=> $request->prefix,
			'suffix'		=> $request->suffix,
			'shorts'		=> $request->shorts,
			'company'		=> $request->company,
			'address'		=> $request->address,
			'city'			=> $request->city,
			'postal'		=> $request->postal,
			'phone'			=> $request->phone,
			'mobile'		=> $request->mobile,
			'email'			=> $request->email,
			'fax'				=> $request->fax,
			'web'				=> $request->web,
			'fb'				=> $request->fb,
			'ig'				=> $request->ig,
			'tw'				=> $request->tw,
			]
		);
		return back()->withToastSuccess('Pengaturan berhasil diubah.');
	}

	public function closemessage(Request $request)
	{
		$id = $request->id;
		$msg = $request->closemessage;
		Setting::where('id', $id)->update(['message' => $msg]);
		return back()->withToastSuccess('Pesan penutupan pendaftaran berhasil disimpan.');
	}
	
	public function updatecost(Request $request)
	{
		//
		$id = $request->id;
		// 
		$validator = Validator::make($request->all(), [
			'years'		=> 'required|max:9',
			'cost'		=> 'required',
			'nova'		=> 'required|size:13'
		], [
			'years.required'	=> 'Tahun ajaran tidak boleh kosong!',
			'years.max'				=> 'Tahun ajaran tidak valid!',
			'cost.required'		=>  'Biaya pendaftaran tidak boleh kosong!',
			'nova.required'		=> 'Nomor Virtual Account tidak boleh kosong!',
			'nova.size'				=> 'Nomor Virtual Account harus 12 digit.',
			]
		);
		// 
		if ($validator->fails()) {
			return back()
			->withToastError($validator->messages()->all()[0])
			->withInput()
			->withErrors($validator);
		}
		// 
		$cost = $request->cost;
		$cost = str_replace(['Rp ','.'], '', $cost);
		// 
		$nova = str_replace('-', '', $request->nova);
		Setting::where('id', $id)->update([
			'years'		=> $request->years,
			'cost'		=> $cost,
			'nova'		=> $nova,
			]
		);
		return back()->withToastSuccess('Pengaturan berhasil diubah.');
	}
	
	/**
	* Remove the specified resource from storage.
	*
	* @param  \App\Setting  $setting
	* @return \Illuminate\Http\Response
	*/
	public function destroy(Setting $setting)
	{
		//
	}
}