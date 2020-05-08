<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Setting;
use App\Registrant;
use App\Sibling;
use App\Building;
use App\Room;
use App\Classroom;

class AjaxController extends Controller
{
	// open/close registration setting
	public function registrationtoggle(Request $request)
	{
		$id = $request->id;
		Setting::where('id', $id)->update([
			'registration'	=> $request->reg == 't' ? true : false,
			]
		);
		return response()->json(['success' => true, 'reg' => $request->reg]);
	}
	
	// check input
	public function checking(Request $request)
	{
		$f = $request->field;
		$v = $request->value;
		$data = Registrant::where($f, $v)->first();
		if($f == 'email') $x = 'Email'; else $x = 'NIK';
		$msg = $x . ' sudah pernah didaftarkan sebelumnya. Silahkan Login atau lanjutkan mendaftar dengan ' . $x . ' yang baru.';
		if($data){
			return response()->json(['errors' => $msg]);
		}
	}

	// ajax get rooms
	public function getrooms(Request $request)
	{
		$bid = $request->bid;
		$cat = $request->cat;
		if($cat == 1){
			$data = Classroom::where('building_id', $bid)->get();
		} else {
			$data = Room::where('building_id', $bid)->get();
		}
		return response()->json(['success' => true, 'data' => $data]);
	}

	// ajax get payment
	public function getpayment(Request $request)
	{
		$id = $request->id;
		$data = Registrant::find($id);

		return response()->json(['success' => true, 'data' => $data]);
	}
	
	// // register step one
	// public function regstepone(Request $request)
	// {
		
	// 	$cmd = $request->command;
	// 	$bd = $request->birthdate;
	// 	$bd = explode('/', $bd);
	// 	$bd = $bd[2] . '-' . $bd[1] . '-' . $bd[0];
	// 	if($request->hobby) $hb = implode(',', $request->hobby); else $hb = null;
	// 	if($request->wishes) $ws = implode(',', $request->wishes); else $ws = null;
	// 	if($cmd == null || $cmd == ''){
			
	// 		// save data
	// 		$r = new Registrant();
	// 		$r->email = $request->email;
	// 		$r->password = Hash::make($request->password);
	// 		$r->kknumber = $request->kknumber;
	// 		$r->username = $request->username;
	// 		$r->name = $request->name;
	// 		$r->nickname = $request->nickname;
	// 		$r->nisn = $request->nisn;
	// 		$r->gender = $request->gender;
	// 		$r->bloodtype = $request->bloodtype;
	// 		$r->weight = $request->weight;
	// 		$r->height = $request->height;
	// 		$r->birthplace = $request->birthplace;
	// 		$r->birthdate = $bd;
	// 		$r->consulat = null;
	// 		$r->hobby = $hb;
	// 		$r->wishes = $ws;
	// 		$r->achievement = $request->achievement;
	// 		$r->competition = $request->competition;
	// 		$r->siblings = $request->siblings;
	// 		$r->stepsiblings = $request->stepsiblings;
	// 		$r->totalsiblings = $request->totalsiblings;
	// 		$r->numposition = $request->numposition;
	// 		$r->save();
	// 		// 
	// 		return response()->json(['idtoupdate' => $r->id]);
	// 		// 
	// 	} 
	// 	if($cmd == 'update') {
	// 		// update data
	// 		$id = $request->idtoupdate;
	// 		Registrant::where('id', $id)->update([
	// 			'email' => $request->email,
	// 			'password' => Hash::make($request->password),
	// 			'kknumber' => $request->kknumber,
	// 			'username' => $request->username,
	// 			'name' => $request->name,
	// 			'nickname' => $request->nickname,
	// 			'nisn' => $request->nisn,
	// 			'gender' => $request->gender,
	// 			'bloodtype' => $request->bloodtype,
	// 			'weight' => $request->weight,
	// 			'height' => $request->height,
	// 			'birthplace' => $request->birthplace,
	// 			'birthdate' => $bd,
	// 			'consulat' => null,
	// 			'hobby' => $hb,
	// 			'wishes' => $ws,
	// 			'achievement' => $request->achievement,
	// 			'competition' => $request->competition,
	// 			'siblings' => $request->siblings,
	// 			'stepsiblings' => $request->stepsiblings,
	// 			'totalsiblings' => $request->totalsiblings,
	// 			'numposition' => $request->numposition,
	// 			]
	// 		);
	// 		// 
	// 		return response()->json(['idtoupdate' => $id]);
	// 		// 
	// 	}
		
	// }
	
	// // register step two
	// public function regsteptwo(Request $request)
	// {
	// 	$id = $request->idtoupdate;
	// 	if($id){
	// 		$dt = $request->data;
	// 		$dts = array_chunk($dt, 4);
	// 		// delete old sibling
	// 		Sibling::where('registrant_id', $id)->delete();
	// 		foreach ($dts as $dt) {
	// 			$s = new Sibling();
	// 			$s->registrant_id = $id;
	// 			$s->siblingname = $dt[0];
	// 			$s->siblingrelation = $dt[1];
	// 			$s->siblingnik = $dt[2];
	// 			$s->siblingphone = $dt[3];
	// 			$s->save();
	// 		}
	// 	}
	// 	return response()->json(['id' => $id]);
	// }
}