<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\PaymentsImport;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Payment;
use App\Registrant;
use Auth;

class PaymentController extends Controller
{

	private $errmsg = [
		'paydate.required'		=> 'Tanggal transfer tidak boleh kosong!',
		'paynumber.required'	=> 'Nomor referensi transfer tidak boleh kosong!',
		'paynominal.required'	=> 'Nominal transfer tidak boleh kosong!',
	];


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
		$payments = Payment::all()->sortByDesc('paydate');
		
		return view('pagesadmin.payments.index', ['payments' => $payments]);
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
			'paydate'		=> 'required',
			'paynumber'	=> 'required',
			'paynominal'=> 'required',
		], $this->errmsg);
		// 
		if ($validator->fails()) {
			return back()->withToastError($validator->messages()->all()[0])->withInput()->withErrors($validator);
		}
		// 
		$reg = Registrant::where('nova', $request->paynumber)->where('isverified', false)->first();
		if(!$reg){
			return back()->withToastError('Santri dgn no. VA tsb tidak ditemukan/sudah terverifikasi.');
		}
		Registrant::where('nova', $request->paynumber)->update(['isverified' => true]);
		// 
		$date = $request->paydate;
		$datearray = explode('/', $date);
		$datetostore = $datearray[2] . '-' . $datearray[1] . '-' . $datearray[0];
		// 
		$nominal = $request->paynominal;
		$nominaltostore = str_replace(['Rp ','.'], '', $nominal);
		// 
		$p = new Payment();
		$p->paydate = $datetostore;
		$p->paynumber = $request->paynumber;
		$p->paynominal = $nominaltostore;
		$p->save();

		
		return back()->withToastSuccess('Data transfer berhasil disimpan.');
		
	}
	
	public function excelstore(Request $request)
	{
		// 'photo' => 'mimes:jpeg,bmp,png'
		if ($request->hasFile('fileexcel')) {
			// 
			$validator = Validator::make($request->all(), [
				'fileexcel'		=> 'required|mimes:xls,xlsx,csv',
			], [
				'fileexcel.required' 	=> 'File tidak boleh kosong!',
				'fileexcel.mimes'			=> 'Mohon pilih file dalam format Excel.',
			]);
			// 
			if ($validator->fails()) {
				return back()->withToastError($validator->messages()->all()[0]);
			}
			$xcl = Excel::import(new PaymentsImport, $request->file('fileexcel'));
			return back()->withToastSuccess('Data transfer berhasil diupload.');
		}
	}

	/**
	* Display the specified resource.
	*
	* @param  \App\Payment  $payment
	* @return \Illuminate\Http\Response
	*/
	public function show(Payment $payment)
	{
		//
	}
	
	/**
	* Show the form for editing the specified resource.
	*
	* @param  \App\Payment  $payment
	* @return \Illuminate\Http\Response
	*/
	public function edit(Payment $payment)
	{
		//
	}
	
	/**
	* Update the specified resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  \App\Payment  $payment
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request, Payment $payment)
	{
		//
	}
	
	/**
	* Remove the specified resource from storage.
	*
	* @param  \App\Payment  $payment
	* @return \Illuminate\Http\Response
	*/
	public function destroy(Payment $payment, Request $request)
	{
		//
		$id = $request->idtodelete;
		// Payment::find($id)->delete();
		$payment = Payment::find($id);
		$nova = $payment->paynumber;
		Registrant::where('nova', $nova)->update(['isverified' => false]);
		Payment::find($id)->delete();
		return back()->withToastSuccess('Data pembayaran dihapus, pendaftar berstatus pending.');
	}
}