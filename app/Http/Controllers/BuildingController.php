<?php

namespace App\Http\Controllers;

use App\Building;
use App\Room;
use App\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class BuildingController extends Controller
{
	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		//
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
			'name'		=> 'required',
		], [
			'name.required' => 'Nama gedung tidak boleh kosong!',
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
		$b = new Building();
		$b->name 			= $request->name;
		$b->category 	= $request->category;
		$b->save();
		return back()->withToastSuccess('Gedung berhasil ditambahkan.');
	}
	
	/**
	* Display the specified resource.
	*
	* @param  \App\Building  $building
	* @return \Illuminate\Http\Response
	*/
	public function show(Building $building)
	{
		//
	}
	
	/**
	* Show the form for editing the specified resource.
	*
	* @param  \App\Building  $building
	* @return \Illuminate\Http\Response
	*/
	public function edit(Building $building)
	{
		//
	}
	
	/**
	* Update the specified resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  \App\Building  $building
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request, Building $building)
	{
		//
	}
	
	/**
	* Remove the specified resource from storage.
	*
	* @param  \App\Building  $building
	* @return \Illuminate\Http\Response
	*/
	public function destroy(Building $building, Request $request)
	{
		$id = $request->idtodelete;
		//
		Building::find($id)->delete();
		Room::where('building_id', $id)->delete();
		Classroom::where('building_id', $id)->delete();
		return back()->withToastSuccess('Gedung asrama berhasil dihapus.');
	}
}