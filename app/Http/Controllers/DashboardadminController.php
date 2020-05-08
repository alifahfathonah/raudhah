<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Building;
use App\Classroom;
use App\Room;
use App\Foodtable;
use App\Registrant;

class DashboardadminController extends Controller
{
	
	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		//
		$u = User::where('role' ,'>', 1)->get();
		$b = Building::all();
		$d = Room::all();
		$r = Classroom::all();
		$t = Foodtable::all();
		$reg = Registrant::all();
		$ver = Registrant::where('isverified', true)->get();
		$pen = Registrant::where('isverified', false)->where('paysubmitted', false)->get();
		$sub = Registrant::where('paysubmitted', true)->where('isverified', false)->get();

		return view('pagesadmin.dashboard.index', [
			'users'				=> $u,
			'buildings'		=> $b,
			'rooms'				=> $d,
			'classrooms'	=> $r,
			'tables'			=> $t,
			'registrants'	=> $reg,
			'verified'		=> $ver,
			'pending'			=> $pen,
			'submitted'		=> $sub,
		]);
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
	}
	
	/**
	* Update the specified resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request, $id)
	{
		//
	}
	
	/**
	* Remove the specified resource from storage.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function destroy($id)
	{
		//
	}
}