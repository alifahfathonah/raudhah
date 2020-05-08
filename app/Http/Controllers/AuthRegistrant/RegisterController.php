<?php

namespace App\Http\Controllers\AuthRegistrant;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Registrant;
use App\Regstep;
use App\Setting;

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
	
	//
	private $errmsg1 = [
		'nisn.required'					=> 'Kolom "NISN" tidak boleh dikosongkan',
		'nisn.size'							=> '"NISN" terdiri dari 10 digit angka.',
		'kknumber.required'			=> 'Kolom "Nomor KK" tidak boleh dikosongkan',
		'kknumber.size'					=> '"Nomor KK" terdiri dari 16 digit angka.',
		'username.required'			=> 'Kolom "NIK" tidak boleh dikosongkan',
		'username.size'					=> '"NIK" terdiri dari 16 digit angka.',
		'username.unique'				=> '"NIK" calon santri sudah terdaftar. Silahkan <strong>login</strong> atau periksa kembali NIK yang anda masukkan.',
		'password.required'			=> 'Kolom "Password" tidak boleh dikosongkan',
		'password.min'					=> 'Password minimal terdiri dari 6 karakter.',
		'name.required'					=> 'Kolom "Nama Lengkap" tidak boleh dikosongkan',
		'nickname.required'			=> 'Kolom "Nama Panggilan" tidak boleh dikosongkan',
		'birthplace.required'		=> 'Kolom "Tempat Lahir" tidak boleh dikosongkan',
		'birthdate.required'		=> 'Kolom "Tanggal Lahir" tidak boleh dikosongkan',
		'siblings.required'			=> 'Jumlah "Saudara Kandung" tidak boleh dikosongkan, isi dengan angka 0 jika tidak ada.',
		'stepsiblings.required'	=> 'Jumlah "Saudara Tiri" tidak boleh dikosongkan, isi dengan angka 0 jika tidak ada.',
		'numposition.required'	=> 'Kolom "Anak Ke" tidak boleh dikosongkan.'
	];
	
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
		
		
		
		return view('pagesregistrant.register', ['bloodtypes' => $bloodtypes, 'hobbies' => $hobbies, 'wishes' => $wishes]);
	}
	
	// ---------------------------------------
	public function register(Request $request)
	{
		$this->validator($request->all())->validate();
		// 
		event(new Registered($registrant = $this->create($request->all())));
		// 
		$steps = new Regstep();
		$steps->registrant_id = $registrant->id;
		$steps->stepreg				= 2;
		$steps->save();
		// 
		$this->guard()->login($registrant, true);
		return redirect()->route('registrant.dashboard');
	}

	// ---------------------------------------
	protected function guard()
	{
		return Auth::guard('registrant');
	}
	
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'nisn'				=> ['required', 'size:10'],
			'kknumber'		=> ['required', 'size:16'],
			'username'		=> ['required', 'size:16', 'unique:registrants'],
			'password' 		=> ['required', 'min:6'],
			'name' 				=> ['required'],
			'nickname' 		=> ['required'],
			'birthplace' 	=> ['required'],
			'birthdate' 	=> ['required'],
			'siblings' 		=> ['required'],
			'stepsiblings'=> ['required'],
			'numposition' => ['required'],
		], $this->errmsg1
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

		$baseva = Setting::first()->nova;
		$last_index = Registrant::max('indexno');
		if($last_index == null) {
			$num = 1;
		} else {
			$num = $last_index + 1;
		}
		$digits = strlen($num);
		if($digits == 1){
			$nova = $baseva . '000' . $num;
		} elseif($digits == 2){
			$nova = $baseva . '00' . $num;
		} elseif($digits == 3){
			$nova = $baseva . '0' . $num;
		} else {
			$nova = $baseva . $num;
		}
		// ----------------------- end va
		
		$bd = $data['birthdate'];
		$bd = explode('/', $bd);
		$bd = $bd[2] . '-' . $bd[1] . '-' . $bd[0];
		$hobby = $data['hobby'] ?? null;
		$wishes = $data['wishes'] ?? null;
		if($hobby) $hb = implode(',', $hobby); else $hb = null;
		if($wishes) $ws = implode(',', $wishes); else $ws = null;
		// 
		$k = $data['siblings'];
		if($k == null || $k == '') $k = 0;
		$t = $data['stepsiblings'];
		if($t == null || $t == '') $t = 0;
		$ttls = $k + $t;
		// 
		
		return Registrant::create([
			'indexno'			=> $num,
			'years'				=> $data['years'],
			'nova'				=> $nova,
			'email' 			=> $data['email'],
			'destination'	=> $data['destination'],
			'password' 		=> Hash::make($data['password']),
			'kknumber' 		=> $data['kknumber'],
			'username' 		=> $data['username'],
			'name' 				=> $data['name'],
			'nickname' 		=> $data['nickname'],
			'nisn' 				=> $data['nisn'],
			'gender' 			=> $data['gender'],
			'bloodtype' 	=> $data['bloodtype'] ?? null,
			'weight' 			=> $data['weight'],
			'height' 			=> $data['height'],
			'birthplace' 	=> $data['birthplace'],
			'birthdate' 	=> $bd,
			'consulat' 		=> null,
			'hobby' 			=> $hb,
			'wishes'			=> $ws,
			'achievement' => $data['achievement'],
			'competition' => $data['competition'],
			'siblings' 		=> $k,
			'stepsiblings'=> $t,
			'totalsiblings'	=> $ttls,
			'numposition' => $data['numposition'],
			]
		);
		
	}


	
	
	protected function registered(Request $request, $user)
	{
		//
	}
}