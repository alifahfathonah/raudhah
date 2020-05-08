<?php

namespace App\Http\Controllers\AuthRegistrant;

use App\Http\Controllers\Controller;
use App\Registrant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Register Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users as well as their
	| validation and creation. By default this controller uses a trait to
	| provide this functionality without requiring any additional code.
	|
	*/
	
	
	
	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct()
	{
		$this->middleware('guest:registrant');
	}
	
	public function showRegistrationForm()
	{
		$bloodtypes = array('A', 'B', 'AB', 'O');
		$hobbies = array('MEMBACA','BERBURU','BERDAGANG','BERENANG','BERKEMAH','BERSEPEDA','BISNIS','BLOGGING','BOLA VOLI','BOWLING','BULUTANGKIS','CATUR','DESAIN GRAFIS','ELEKTRONIK','FASHION','FOTOGRAFI','FUTSAL','GO KART','GOLF','KALIGRAFI','KANO','KARATE','KERAJINAN (HANDICRAFT)','KOLEKTOR','KOMPUTER','KULINER DAN MEMASAK','MELUKIS','MEMANCING','MENARI','MENEMBAK','MENGAJI','MENULIS','MENUNGGANG KUDA','MENYELAM','MEREKAM VIDEO','MODIFIKASI MOTOR','MOUNTAINEERING','MUSIK','OLAHRAGA MENEMBAK','OTOMOTIF','PANJAT TEBING','PARALAYANG','PECINTA BATU','PERTANIAN','PROGRAMMING','SEPAKBOLA','SKATEBOARDING','SNORKELING','SURFING','TENIS','TINJU','TRAVELING');
		$wishes = array('AKUNTAN','ANGGOTA BPK','ANGGOTA DPD','ANGGOTA DPRD','ANGGOTA KABINET/KEMENTERIAN','ANGGOTA MAHKAMAH KONSTITUSI','APOTEKER','ARSITEK','BIDAN','BUPATI','BURUH HARIAN LEPAS','BURUH NELAYAN/PERIKANAN','BURUH PETERNAKAN','BURUH TANI/PERKEBUNAN','DOKTER','DOSEN','DUTA BESAR','GUBERNUR','GURU','IMAM MESJID','INDUSTRI','JURU MASAK','KARYAWAN BUMD','KARYAWAN BUMN','KARYAWAN SWASTA','KEPALA DESA','KEPOLISIAN RI','KONSTRUKSI','KONSULTAN','MEKANIK','MENGURUS RUMAH TANGGA','NELAYAN/PERIKANAN','NOTARIS','PANDAI BESI','PEDAGANG','PEDAGANG','PEGAWAI NEGERI SIPIL','PELAJAR/MAHASISWA','PELAUT','PEMBANTU RUMAH TANGGA','PENATA BUSANA','PENATA RAMBUT','PENATA RIAS','PENELITI','PENGACARA','PENJAHIT','PENSIUNAN','PENTERJEMAH','PENYIAR RADIO','PENYIAR TELEVISI','PERANCANG BUSANA','PERANGKAT DESA','PERAWAT','PETANI/PEKEBUN','PETERNAK','PIALANG','PILOT','PRESIDEN','PROMOTOR ACARA','PSIKIATER/PSIKOLOG','SECURITY','SENIMAN','SOPIR','TABIB','TENTARA NASIONAL INDONESIA','TRANSPORTASI','TUKANG BATU','TUKANG CUKUR','TUKANG GIGI','TUKANG KAYU','TUKANG LISTRIK','USTADZ/MUBALIGH','WAKIL BUPATI','WAKIL GUBERNUR','WAKIL PRESIDEN','WAKIL WALIKOTA','WALIKOTA','WARTAWAN','WIRASWASTA');
		$sibrelations = array('ADIK','ABANG','KAKAK','ADIK TIRI','ABANG TIRI','KAKAK TIRI');
		
		

		return view('authregistrant.register', ['bloodtypes' => $bloodtypes, 'hobbies' => $hobbies, 'wishes' => $wishes, 'sibrelations' => $sibrelations]);
	}
	
	/**
	* Handle a registration request for the application.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function register(Request $request)
	{
		$this->validator($request->all())->validate();
		
		event(new Registered($registrant = $this->create($request->all())));
		
		$this->guard()->login($registrant);
		
		return redirect()->route('registrant.dashboard');
	}
	
	protected function guard()
	{
		return Auth::guard('registrant');
	}
	
	/**
	* Get a validator for an incoming registration request.
	*
	* @param  array  $data
	* @return \Illuminate\Contracts\Validation\Validator
	*/
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'password' => ['required', 'string', 'min:6'],
			]
		);
	}
	
	/**
	* Create a new user instance after a valid registration.
	*
	* @param  array  $data
	* @return \App\User
	*/
	protected function create(array $data)
	{
		return Registrant::create([
			'email' => $data['email'],
			'password' => Hash::make($data['password']),
			'kknumber' => $data['kknumber'],
			'username' => $data['username'],
			'name' => $data['name'],
			'nickname' => $data['nickname'],
			'nisn' => $data['nisn'],
			'gender' => $data['gender'],
			// 'bloodtype' => $data['bloodtype'],
			// 'weight' => $data['weight'],
			// 'height' => $data['height'],
			'birthplace' => $data['birthplace'],
			'birthdate' => $data['birthdate'],
			// 'consulat' => $data['consulat'],
			// 'hobby' => $data['hobby'],
			// 'wishes' => $data['wishes'],
			// 'achievement' => $data['achievement'],
			// 'competition' => $data['competition'],
			'siblings' => $data['siblings'],
			'stepsiblings' => $data['stepsiblings'],
			'totalsiblings' => $data['totalsiblings'],
			'numposition' => $data['numposition'],
			]
		);
	}

	
	protected function registered(Request $request, $user)
	{
		//
	}
}