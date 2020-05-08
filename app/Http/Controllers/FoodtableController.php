<?php

namespace App\Http\Controllers;

use App\Foodtable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class FoodtableController extends Controller
{

	private $errmsg = [
		'name.required'			=> 'Nama ruangan tidak boleh kosong!',
		'capacity.required'	=> 'Kapasitas ruangan tidak boleh kosong!',
		'capacity.numeric'	=> 'Kapasitas ruangan tidak valid.',
	];

	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		//
		$tables = Foodtable::all();
		return view('pagesadmin.foodtables.index', ['tables' => $tables]);
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
		$validator = Validator::make($request->all(), [
			'name'			=> 'required',
			'capacity'	=> 'required|numeric',
		], $this->errmsg);
		// 
		if ($validator->fails()) {
			return back()
			->withToastError($validator->messages()->all()[0])
			->withInput()
			->withErrors($validator);
		}
		// 
		$f = new Foodtable();
		$f->name				= $request->name;
		$f->capacity		= $request->capacity;
		$f->save();
		// 
		return back()->withToastSuccess('Data meja makan berhasil disimpan.');
	}
	
	/**
	* Display the specified resource.
	*
	* @param  \App\Foodtable  $foodtable
	* @return \Illuminate\Http\Response
	*/
	public function show(Foodtable $foodtable)
	{
		//
	}
	
	/**
	* Show the form for editing the specified resource.
	*
	* @param  \App\Foodtable  $foodtable
	* @return \Illuminate\Http\Response
	*/
	public function edit(Foodtable $foodtable)
	{
		//
	}
	
	/**
	* Update the specified resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  \App\Foodtable  $foodtable
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request, Foodtable $foodtable)
	{
		//
		$id = $request->idtoupdate;
		$validator = Validator::make($request->all(), [
			'name'			=> 'required',
			'capacity'	=> 'required|numeric',
		], $this->errmsg);
		// 
		if ($validator->fails()) {
			return back()
			->withToastError($validator->messages()->all()[0])
			->withErrors($validator);
		}
		//
		Foodtable::where('id', $id)->update([
			'name'				=> $request->name,
			'capacity'		=> $request->capacity,
		]);
		// 
		return back()->withToastSuccess('Data meja makan berhasil diubah.');
	}
	
	/**
	* Remove the specified resource from storage.
	*
	* @param  \App\Foodtable  $foodtable
	* @return \Illuminate\Http\Response
	*/
	public function destroy(Foodtable $foodtable, $id)
	{
		//
		Foodtable::find($id)->delete();
		return back()->withToastSuccess('Data meja makan berhasil dihapus.');
	}
}