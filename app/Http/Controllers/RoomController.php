<?php

namespace App\Http\Controllers;

use App\Room;
use App\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class RoomController extends Controller
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
		$rooms			= Room::all();
		$buildings 	= Building::where('category', 2)->get();
		return view('pagesadmin.rooms.index', ['buildings' => $buildings, 'rooms' => $rooms]);
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
		$r = new Room();
		$r->building_id	= $request->building;
		$r->name				= $request->name;
		$r->capacity		= $request->capacity;
		$r->save();
		// 
		return back()->withToastSuccess('Data asrama berhasil disimpan.');
	}
	
	/**
	* Display the specified resource.
	*
	* @param  \App\Room  $room
	* @return \Illuminate\Http\Response
	*/
	public function show(Room $room)
	{
		//
	}
	
	/**
	* Show the form for editing the specified resource.
	*
	* @param  \App\Room  $room
	* @return \Illuminate\Http\Response
	*/
	public function edit(Room $room)
	{
		//
	}
	
	/**
	* Update the specified resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  \App\Room  $room
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request, Room $room)
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
		Room::where('id', $id)->update([
			'building_id'	=> $request->building,
			'name'				=> $request->name,
			'capacity'		=> $request->capacity,
		]);
		// 
		return back()->withToastSuccess('Data asrama berhasil diubah.');
	}
	
	/**
	* Remove the specified resource from storage.
	*
	* @param  \App\Room  $room
	* @return \Illuminate\Http\Response
	*/
	public function destroy(Room $room, $id)
	{
		//
		Room::find($id)->delete();
		return back()->withToastSuccess('Data asrama berhasil dihapus.');
	}
}