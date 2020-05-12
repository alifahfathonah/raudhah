<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Registrant;
use App\Sibling;
use App\Regstep;
use App\Payment;
use App\Classroom;
use App\Room;
use App\Foodtable;
use App\Building;
use App\Examcard;
use PDF;

class RegistController extends Controller
{
	//
	private $errmsg = [
		'numchar.required'		=> 'Nomor kartu ujian tidak boleh kosong!',
		'numchar.unique'			=> 'Nomor kartu ujian sudah terdaftar.',
		'foodtable.required'	=> 'Nomor meja tidak boleh kosong!',
		'builc.required'			=> 'Gedung Kelas tidak boleh kosong!',
		'classroom.required'	=> 'Ruangan belajar tidak boleh kosong!',
		'build.required'			=> 'Gedung Asrama tidak boleh kosong!',
		'dormroom.required'		=> 'Ruang asrama tidak boleh kosong!',
	];
	
	public function index(Request $request)
	{
		$q = $request->segment(3);
		$bcs = Building::where('category', 1)->get();
		$bds = Building::where('category', 2)->get();
		$classes = Classroom::all();
		$dorms = Room::all();
		$tables = Foodtable::all();
		
		if($q == 'pending') {
			$regs = Registrant::where('isverified', false)->orderBy('created_at', 'desc')->get();
		} elseif($q == 'verified'){
			$regs = Registrant::where('isverified', true)->orderBy('updated_at', 'desc')->get();
		} else {
			$regs = Registrant::orderBy('id', 'desc')->get();
		}
		
		return view('pagesadmin.registrants.index2', ['regs' => $regs, 'class' => $classes, 'dorms' => $dorms, 'tables' => $tables, 'bcs' => $bcs, 'bds' => $bds]);
	}
	
	public function examcardset($id)
	{
		if(Examcard::where('registrant_id', $id)->first()){
			return redirect()->route('admin.registrants', 'all');
		}
		$reg = Registrant::find($id);
		$bcs = Building::where('category', 1)->get();
		$bds = Building::where('category', 2)->get();
		$classes = Classroom::all();
		$dorms = Room::all();
		$tables = Foodtable::all();
		$charcards = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
		$cardnums = array();
		foreach ($charcards as $cc) {
			$cardnums[] = Examcard::where('numchar', 'like', $cc . '%')->max('numchar');
		}
		
		return view('pagesadmin.registrants.examcardset', ['cardnums' => $cardnums, 'reg' => $reg, 'class' => $classes, 'dorms' => $dorms, 'tables' => $tables, 'bcs' => $bcs, 'bds' => $bds]);
	}
	
	public function examcardstore(Request $request)
	{
		// 
		$validator = Validator::make($request->all(), [
			'numchar'		=> 'required|unique:examcards',
			'foodtable'	=> 'required',
			'builc'			=> 'required',
			'classroom'	=> 'required',
			'build'			=> 'required',
			'dormroom'	=> 'required',
		], $this->errmsg);
		// 
		if ($validator->fails()) {
			return back()
			->withToastError($validator->messages()->all()[0])
			->withInput()
			->withErrors($validator);
		}
		//
		$num = 0;
		$last_index = Examcard::max('index');
		if($last_index == null) {
			$num = 1;
		} else {
			$num = $last_index + 1;
		} 	
		// simpan data		
		$x = new Examcard();
		$x->registrant_id 	= $request->idtostore;
		$x->index 					= $num;
		$x->numchar 				= $request->numchar;
		$x->room_id 				= $request->dormroom;
		$x->classroom_id 		= $request->classroom;
		$x->foodtable_id 		= $request->foodtable;
		// 
		$x->save();
		// 
		$r = Room::where('id', $request->dormroom)->first()->vnow;
		$c = Classroom::where('id', $request->classroom)->first()->vnow;
		$f = Foodtable::where('id', $request->foodtable)->first()->vnow;
		Room::where('id', $request->dormroom)->update(['vnow' => $r + 1]);
		Classroom::where('id', $request->classroom)->update(['vnow' => $c + 1]);
		Foodtable::where('id', $request->foodtable)->update(['vnow' => $f + 1]);
		Regstep::where('registrant_id', $request->idtostore)->update(['steppay' => 2]);
		return redirect()->route('admin.registrants', 'verified')->withToastSuccess('Kartu Ujian berhasil dibuat.');
	}
	
	public function examcardedit($id)
	{
		$reg = Registrant::find($id);
		$card = Examcard::where('registrant_id', $id)->first();
		if(!$card){
			return redirect()->route('admin.registrants', 'all');
		}
		$bcs = Building::where('category', 1)->get();
		$bds = Building::where('category', 2)->get();
		$classes = Classroom::all();
		$dorms = Room::all();
		$tables = Foodtable::all();
		$charcards = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
		$cardnums = array();
		foreach ($charcards as $cc) {
			$cardnums[] = Examcard::where('numchar', 'like', $cc . '%')->max('numchar');
		}
		
		return view('pagesadmin.registrants.examcardedit', ['card' => $card, 'cardnums' => $cardnums, 'reg' => $reg, 'class' => $classes, 'dorms' => $dorms, 'tables' => $tables, 'bcs' => $bcs, 'bds' => $bds]);
	}
	
	public function examcardupdate(Request $request)
	{
		// 
		$id = $request->idtoupdate;
		$ex = Examcard::where('registrant_id', $id)->first();
		
		// dd($orv);
		// 
		$validator = Validator::make($request->all(), [
			'numchar'		=> 'required|unique:examcards,numchar,'.$ex->id,
			'classroom'	=> 'required',
			'dormroom'	=> 'required',
			'foodtable'	=> 'required',
		], $this->errmsg);
		// 
		if ($validator->fails()) {
			return back()
			->withToastError($validator->messages()->all()[0])
			->withInput()
			->withErrors($validator);
		}
		// 
		
		// $f = Foodtable::where('id', $fid)->first()->vnow;
		
		// update data
		Examcard::where('registrant_id', $id)->update([
			'numchar'				=> $request->numchar,
			'room_id'				=> $request->dormroom,
			'classroom_id'	=> $request->classroom,
			'foodtable_id'	=> $request->foodtable,
			]
		);
		
			Room::where('id', $ex->room_id)->decrement('vnow');
			Room::where('id', $request->dormroom)->increment('vnow');
			Classroom::where('id', $ex->classroom_id)->decrement('vnow'); 
			Classroom::where('id', $request->classroom)->increment('vnow');
			Foodtable::where('id', $ex->foodtable_id)->decrement('vnow'); 
			Foodtable::where('id', $request->foodtable)->increment('vnow');
		
		// update vnow data baru
		return redirect()->route('admin.registrants', 'verified')->withToastSuccess('Kartu Ujian berhasil diubah');
		
	}

	public function examcardview($id)
	{
		$data = Registrant::find($id);
		$card = Examcard::where('registrant_id', $id)->first();
		// $paper = 
		$pdf = PDF::loadview('pagesregistrant.dashboard.examcard',['data' => $data, 'card' => $card]);
		return $pdf->stream($card->numchar . '.pdf');
	}

	public function registrantprofile($id)
	{
		$data = Registrant::find($id);
		$card = Examcard::where('registrant_id', $id)->first();
		$pdf = PDF::loadview('pagesadmin.registrants.profile',['d' => $data]);
		return $pdf->stream($data->nova . '.pdf');
	}
	
	public function manualverification(Request $request)
	{
		$id = $request->idtoverif;
		Registrant::where('id', $id)->update(['isverified' => true, 'manualverify' => true, 'verified_at' => today()]);
		return back()->withToastSuccess('Verifikasi manual berhasil dilakukan.');
	}
	
	public function destroy(Request $request)
	{
		$id = $request->idtodelete;
		Registrant::find($id)->delete();
		return back()->withToastSuccess('Data calon santri berhasil dihapus.');
	}
	
	/*
	public function filter(Request $request)
	{
		// 
		$a = $request->get('schlvl');
		$b = $request->get('destination');
		if($b == 1) $b = 'RAUDHAH 1'; else $b = 'RAUDHAH 2';
		$c = $request->get('gender');
		$d = $request->get('status');
		if($d == 1) $d = '1'; else $d = '0';
		// 
		// $reg = Registrant::all();
		// $regs = Registrant::where('destination', 'like', '%' . $b . '%')->where('gender', $c)->where('isverified', $d)->get();
		$regs = Registrant::when($b, function($q) use ($b){
			$q->where('destination', 'like', '%' .$b. '%');
		})->when($c, function($q) use ($c){
			$q->where('gender', $c);
		})->when($d, function($q) use ($d){
			$q->where('isverified', '=', $d);
		})->when($a, function($q) use ($a){
			$q->regschool()->where('schlvl', $a);
		})->get();
		// 
		$bcs = Building::where('category', 1)->get();
		$bds = Building::where('category', 2)->get();
		$classes = Classroom::all();
		$dorms = Room::all();
		$tables = Foodtable::all();
		// 
		return view('pagesadmin.registrants.index', ['regs' => $regs, 'class' => $classes, 'dorms' => $dorms, 'tables' => $tables, 'bcs' => $bcs, 'bds' => $bds]);
	}
	*/
	
}