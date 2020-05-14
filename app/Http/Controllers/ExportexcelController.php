<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\RegistrantExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Registrant;

class ExportexcelController extends Controller
{
	//
	public function exportAll() 
	{
		$data = new RegistrantExport(Registrant::with(
			'examcard', 
			'examcard.room', 
			'examcard.foodtable',
			'examcard.classroom',
			'regschool',
			'regparent',
			)->get(), 'KESELURUHAN');
		return Excel::download($data, 'DATA CALON SANTRI KESELURUHAN.xlsx');
		// return Excel::download(new RegistrantExport, 'registrants.xlsx');
	}
	
	public function exportPending()
	{
		$data = new RegistrantExport(Registrant::where('isverified', false)->with(
			'examcard', 
			'examcard.room', 
			'examcard.foodtable',
			'examcard.classroom',
			'regschool',
			'regparent',
			)->get(), 'PENDING');
		return Excel::download($data, 'DATA CALON SANTRI PENDING.xlsx');
	}
	// 
	public function exportVerified()
	{
		$data = new RegistrantExport(Registrant::where('isverified', true)->with(
			'examcard', 
			'examcard.room', 
			'examcard.foodtable',
			'examcard.classroom',
			'regschool',
			'regparent',
			)->get(), 'TERVERIFIKASI');
		return Excel::download($data, 'DATA CALON SANTRI TERVERIFIKASI.xlsx');
	}
	// 
	public function exportRaudhahOne()
	{
		$data = new RegistrantExport(Registrant::where('destination','like', '%MEDAN%')->with(
			'examcard', 
			'examcard.room', 
			'examcard.foodtable',
			'examcard.classroom',
			'regschool',
			'regparent',
			)->get(), 'RAUDHAH 1 - MEDAN');
		return Excel::download($data, 'DATA CALON SANTRI RAUDHAH 1 - MEDAN.xlsx');
	}
	// 
	public function exportRaudhahTwo()
	{
		$data = new RegistrantExport(Registrant::where('destination','like', '%LUMUT%')->with(
			'examcard', 
			'examcard.room', 
			'examcard.foodtable',
			'examcard.classroom',
			'regschool',
			'regparent',
			)->get(), 'RAUDHAH 2 - LUMUT (TAPANULI TENGAH)');
		return Excel::download($data, 'DATA CALON SANTRI RAUDHAH 2 - LUMUT.xlsx');
	}
}