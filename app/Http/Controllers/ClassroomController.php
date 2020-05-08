<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ClassroomController extends Controller
{

	private $errmsg = [
		'building.required'	=> 'Nama gedung tidak boleh kosong!',
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
		$classrooms	= Classroom::all();
		$buildings 	= Building::where('category', 1)->get();
		return view('pagesadmin.classrooms.index', ['buildings' => $buildings, 'classrooms' => $classrooms]);
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
			'building'	=> 'required',
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
		$c = new Classroom();
		$c->building_id	= $request->building;
		$c->name				= $request->name;
		$c->capacity		= $request->capacity;
		$c->save();
		// 
		return back()->withToastSuccess('Data ruang belajar berhasil disimpan.');
	}
	
	/**
	* Display the specified resource.
	*
	* @param  \App\Classroom  $classroom
	* @return \Illuminate\Http\Response
	*/
	public function show(Classroom $classroom)
	{
		//
	}
	
	/**
	* Show the form for editing the specified resource.
	*
	* @param  \App\Classroom  $classroom
	* @return \Illuminate\Http\Response
	*/
	public function edit(Classroom $classroom)
	{
		//
	}
	
	/**
	* Update the specified resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  \App\Classroom  $classroom
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request, Classroom $classroom)
	{
		//
		$id = $request->idtoupdate;
		$validator = Validator::make($request->all(), [
			'building'	=> 'required',
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
		Classroom::where('id', $id)->update([
			'building_id'	=> $request->building,
			'name'				=> $request->name,
			'capacity'		=> $request->capacity,
		]);
		// 
		return back()->withToastSuccess('Data ruang belajar berhasil diubah.');
	}
	
	/**
	* Remove the specified resource from storage.
	*
	* @param  \App\Classroom  $classroom
	* @return \Illuminate\Http\Response
	*/
	public function destroy(Classroom $classroom, $id)
	{
		//
		Classroom::find($id)->delete();
		return back()->withToastSuccess('Data ruang belajar berhasil dihapus.');
	}
}