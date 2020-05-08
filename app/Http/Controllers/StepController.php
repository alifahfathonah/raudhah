<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Setting;
use App\Registrant;
use App\Regsibling;
use App\Regschool;
use App\Regparent;
use App\Regstep;


class StepController extends Controller
{
	public function __construct()
	{
		$this->middleware('guest:registrant');
	}
	
	private $bloodtypes = [
		'A', 'B', 'AB', 'O'
	];
	private	$hobbies = [
		'MEMBACA','BERBURU','BERDAGANG','BERENANG','BERKEMAH','BERSEPEDA','BISNIS','BLOGGING','BOLA VOLI','BOWLING','BULUTANGKIS','CATUR','DESAIN GRAFIS','ELEKTRONIK','FASHION','FOTOGRAFI','FUTSAL','GO KART','GOLF','KALIGRAFI','KANO','KARATE','KERAJINAN (HANDICRAFT)','KOLEKTOR','KOMPUTER','KULINER DAN MEMASAK','MELUKIS','MEMANCING','MENARI','MENEMBAK','MENGAJI','MENULIS','MENUNGGANG KUDA','MENYELAM','MEREKAM VIDEO','MODIFIKASI MOTOR','MOUNTAINEERING','MUSIK','OLAHRAGA MENEMBAK','OTOMOTIF','PANJAT TEBING','PARALAYANG','PECINTA BATU','PERTANIAN','PROGRAMMING','SEPAKBOLA','SKATEBOARDING','SNORKELING','SURFING','TENIS','TINJU','TRAVELING'
	];
	private	$wishes = [
		'AKUNTAN','ANGGOTA BPK','ANGGOTA DPD','ANGGOTA DPRD','ANGGOTA KABINET/KEMENTERIAN','ANGGOTA MAHKAMAH KONSTITUSI','APOTEKER','ARSITEK','BIDAN','BUPATI','BURUH HARIAN LEPAS','BURUH NELAYAN/PERIKANAN','BURUH PETERNAKAN','BURUH TANI/PERKEBUNAN','DOKTER','DOSEN','DUTA BESAR','GUBERNUR','GURU','IMAM MESJID','INDUSTRI','JURU MASAK','KARYAWAN BUMD','KARYAWAN BUMN','KARYAWAN SWASTA','KEPALA DESA','KEPOLISIAN RI','KONSTRUKSI','KONSULTAN','MEKANIK','MENGURUS RUMAH TANGGA','NELAYAN/PERIKANAN','NOTARIS','PANDAI BESI','PEDAGANG','PEDAGANG','PEGAWAI NEGERI SIPIL','PELAJAR/MAHASISWA','PELAUT','PEMBANTU RUMAH TANGGA','PENATA BUSANA','PENATA RAMBUT','PENATA RIAS','PENELITI','PENGACARA','PENJAHIT','PENSIUNAN','PENTERJEMAH','PENYIAR RADIO','PENYIAR TELEVISI','PERANCANG BUSANA','PERANGKAT DESA','PERAWAT','PETANI/PEKEBUN','PETERNAK','PIALANG','PILOT','PRESIDEN','PROMOTOR ACARA','PSIKIATER/PSIKOLOG','SECURITY','SENIMAN','SOPIR','TABIB','TENTARA NASIONAL INDONESIA','TRANSPORTASI','TUKANG BATU','TUKANG CUKUR','TUKANG GIGI','TUKANG KAYU','TUKANG LISTRIK','USTADZ/MUBALIGH','WAKIL BUPATI','WAKIL GUBERNUR','WAKIL PRESIDEN','WAKIL WALIKOTA','WALIKOTA','WARTAWAN','WIRASWASTA'
	];
	private	$sibrelations = [
		'ADIK','ABANG','KAKAK','ADIK TIRI','ABANG TIRI','KAKAK TIRI'
	];
	private $movereasons = [
		'EKONOMI','AKADEMIK','KESEHATAN','TUGAS ORANGTUA','TIDAK BETAH'
	];
	private $edulevels = [
		'SD','MI','SMP','MTS','MA','SMA','PESANTREN','D1','D2','D3','S1','S2','S3'
	];
	private $religions = [
		'ISLAM', 'KRISTEN', 'BUDDHA', 'HINDU'
	];
	private $salaries = [
		'500 Ribu - 1,9 Juta','2 Juta - 3,5 Juta','3,6 Juta - 5,5 Juta','5,6 Juta - 7,5 Juta','7,6 Juta - 9,5 Juta','9,6 Juta - 11,5 Juta','11,6 Juta - 13,5 Juta','13,6 Juta - 15,5 Juta','16,6 Juta - 18,5 Juta','18,6 Juta - 19,5 Juta','> 20 Juta'
	];
	private $donaturs = [
		'PAMAN','BIBI','KAKEK','NENEK','ABANG','DERMAWAN'
	];
	//
	private $errmsg1 = [
		'nisn.required'					=> 'Kolom "NISN" tidak boleh dikosongkan',
		'kknumber.required'			=> 'Kolom "Nomor KK" tidak boleh dikosongkan',
		'username.required'			=> 'Kolom "NIK" tidak boleh dikosongkan',
		'username.unique'				=> 'NIK calon santri sudah terdaftar. Silahkan login untuk mengubah data.',
		// 'email.required'				=> 'Kolom "Email" tidak boleh dikosongkan',
		// 'email.unique'					=> 'Email yang anda isi sudah pernah didaftarkan sebelumnya. Silahkan login atau isi dengan email yang lain.',
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
	// 
	private $errmsg2 = [
		'sibname.*.required'	=> 'Kolom "Nama Saudara" tidak boleh dikosongkan.',
		'sibnik.*.required'		=> 'Kolom "NIK" tidak boleh dikosongkan.',
	];
	// 
	private $errmsg3 = [
		'schname.required'		=> 'Kolom "Nama Sekolah" tidak boleh dikosongkan.',
		'schstreet.required'	=> 'Kolom "Alamat Sekolah" tidak boleh dikosongkan.',
		'schprov.required'		=> 'Mohon pilih "Provinsi" asal sekolah.',
		'schkab.required'			=> 'Mohon pilih "Kabupaten" asal sekolah.',
		'schkec.required'			=> 'Mohon pilih "Kecamatan" asal sekolah.',
		'schkel.required'			=> 'Mohon pilih "Kelurahan" asal sekolah.',
		'psnfrom.required_if'	=> 'Kolom "Asal Pesantren" tidak boleh dikosongkan.',
		'psnadd.required_if'	=> 'Kolom "Alamat Pesantren" tidak boleh dikosongkan.',
		'psndesc.required_if'	=> 'Kolom "Deskripsi" alasan pindah tidak boleh dikosongkan.',
		'psnup.required_if'		=> 'Mohon tentukan calon santri "Naik Ke Kelas" berapa.',
		'psnto.required_if'		=> 'Mohon tentukan calon santri "Ingin Ke Kelas" berapa.',
	];
	// 
	private $errmsg4 = [
		// 
		'fname.required'	=> 'Kolom "Nama Lengkap" Ayah tidak boleh dikosongkan.',
		'fadd.required'		=> 'Kolom "Alamat Lengkap" Ayah tidak boleh dikosongkan.',
		'fprov.required'	=> 'Pilih "Provinsi" dari alamat Ayah.',
		'fkab.required'		=> 'Pilih "Kabupaten/Kota" dari alamat Ayah.',
		'fkec.required'		=> 'Pilih "Kecamatan" dari alamat Ayah.',
		'fkel.required'		=> 'Pilih "Kelurahan/Desa" dari alamat Ayah.',
		'fphone.required'	=> 'Kolom "Nomor Telepon/HP" Ayah tidak boleh dikosongkan.',
		'fktp.required'		=> 'Kolom "Nomor KTP" Ayah tidak boleh dikosongkan.',
		'fsal.required'		=> 'Kolom "Penghasilan Perbulan" Ayah tidak boleh dikosongkan',
		'mname.required'		=> 'Kolom "Nama Lengkap" Ibu tidak boleh dikosongkan.',
		'madd.required_if'	=> 'Kolom "Alamat Lengkap" Ibu tidak boleh dikosongkan.',
		'mprov.required_if'	=> 'Pilih "Provinsi" dari alamat Ibu.',
		'mkab.required_if'	=> 'Pilih "Kabupaten/Kota" dari alamat Ibu.',
		'mkec.required_if'	=> 'Pilih "Kecamatan" dari alamat Ibu.',
		'mkel.required_if'	=> 'Pilih "Kelurahan/Desa" dari alamat Ibu.',
		'mphone.required'		=> 'Kolom "Nomor Telepon/HP" Ibu tidak boleh dikosongkan.',
		'mktp.required'			=> 'Kolom "Nomor KTP" Ibu tidak boleh dikosongkan.',
		'msal.required'			=> 'Kolom "Penghasilan Perbulan" Ibu tidak boleh dikosongkan',
		'donaturname.required_if'		=> 'Kolom "Nama Pembiaya" tidak boleh dikosongkan.',
		'donaturphone.required_if'	=> 'Kolom "No. Handphone/WhatsApp" Pembiaya tidak boleh dikosongkan.',
		'donaturadd.required_if'		=> 'Kolom "Alamat Lengkap" Pembiaya tidak boleh dikosongkan.',
		'dprov.required_if'					=> 'Pilih "Provinsi" dari alamat Pembiaya.',
		'dkab.required_if'					=> 'Pilih "Kabupaten/Kota" dari alamat Pembiaya.',
		'dkec.required_if'					=> 'Pilih "Kecamatan" dari alamat Pembiaya.',
		'dkel.required_if'					=> 'Pilih "Kelurahan/Desa" dari alamat Pembiaya.',
	];
	
	
	public function index(Request $request)
	{
		// $request->session()->put('regid', 20);
		// $request->session()->forget('regid');
		// 
		
		$id = $request->session()->get('regid');
		$dt = Registrant::find($id);
		if($dt) $data = $dt; else $data = null;
		if($data == null && $request->segment(2) > 1){
			return redirect()->route('registrant.register', 1);
		}
		// 
		// $siblings = Regsibling::where('registrant_id', $id)->get();
		// 
		return view('authregistrant.pageregister', [
			'data' => $data, 
			// 'siblings'	=> $siblings,
			'bloodtypes' => $this->bloodtypes, 
			'hobbies' => $this->hobbies,
			'wishes' => $this->wishes, 
			'sibrelations' => $this->sibrelations,
			'movereasons' => $this->movereasons,
			'edulevels' => $this->edulevels,
			'religions' => $this->religions,
			'salaries' => $this->salaries,
			'donaturs' => $this->donaturs,
			]
		);
	}
	
	public function stepone(Request $request)
	{
		
		// 
		$validator = Validator::make($request->all(), [
			// 'email'		=> 'required_if:username,==,11',
			'nisn'					=> 'required',
			'kknumber'			=> 'required',
			'username'			=> 'required|unique:registrants',
			// 'email'					=> 'required|unique:registrants',
			'password'			=> 'required|min:6',
			'name'					=> 'required',
			'nickname'			=> 'required',
			'birthplace'		=> 'required',
			'birthdate'			=> 'required',
			'siblings'			=> 'required',
			'stepsiblings'	=> 'required',
			'totalsiblings'	=> 'required',
			'numposition'		=> 'required',
		], $this->errmsg1);
		// 
		if ($validator->fails()) {
			return back()->withInput()->withErrors($validator);
		}
		// 
		// virtual account setup
		$th = Setting::first()->years;
		$th = explode('/', $th);
		$tn = array_map(function($x){
			return substr($x, -2);
		}, $th);
		$tn = implode('', $tn);
		$baseva = '71227' . $tn . '555';
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
		// dd($nova);
		// dd(strlen($nova));
		// ----------------------- end va
		
		$bd = $request->birthdate;
		$bd = explode('/', $bd);
		$bd = $bd[2] . '-' . $bd[1] . '-' . $bd[0];
		if($request->hobby) $hb = implode(',', $request->hobby); else $hb = null;
		if($request->wishes) $ws = implode(',', $request->wishes); else $ws = null;
		// 
		$k = $request->siblings;
		if($k == null || $k == '') $k = 0;
		$t = $request->stepsiblings;
		if($t == null || $t == '') $t = 0;
		$ttls = $k + $t;
		// 
		// store data
		$r = new Registrant();
		$r->indexno = $num;
		$r->years = $request->years;
		$r->nova = $nova;	// no virtual account
		$r->email = $request->email;
		$r->destination = $request->destination;
		$r->password = Hash::make($request->password);
		$r->kknumber = $request->kknumber;
		$r->username = $request->username;
		$r->name = $request->name;
		$r->nickname = $request->nickname;
		$r->nisn = $request->nisn;
		$r->gender = $request->gender;
		$r->bloodtype = $request->bloodtype;
		$r->weight = $request->weight;
		$r->height = $request->height;
		$r->birthplace = $request->birthplace;
		$r->birthdate = $bd;
		$r->consulat = null;
		$r->hobby = $hb;
		$r->wishes = $ws;
		$r->achievement = $request->achievement;
		$r->competition = $request->competition;
		$r->siblings = $k;
		$r->stepsiblings = $t;
		$r->totalsiblings = $ttls;
		$r->numposition = $request->numposition;
		$r->save();
		// 
		$id = $r->id;
		// 
		$rs = new Regstep();
		$rs->registrant_id = $id;
		$rs->save();
		// $data = Registrant::find($id);
		// store session
		$request->session()->put('regid', $id);
		// 
		return redirect()->route('registrant.register', 2);
		// 
	}
	
	public function steptwo(Request $request)
	{
		
		$validator = Validator::make($request->all(), [
			// 'email'		=> 'required_if:username,==,11',
			'sibname.*'	=> 'required',
			'sibnik.*'	=> 'required',
		], $this->errmsg2);
		// 
		if ($validator->fails()) {
			return back()->withInput()->withErrors($validator);
		}
		// 
		
		$sname = $request->sibname;
		$srels = $request->sibrel;
		$sniks = $request->sibnik;
		$sphon = $request->sibphone;
		// dd($sphon);
		$id = $request->session()->get('regid');
		$ts = Registrant::where('id', $id)->first()->totalsiblings;
		// delete record
		Regsibling::where('registrant_id', $id)->delete();
		// save record
		for ($i=0; $i < $ts; $i++) { 
			$s = new Regsibling();
			$s->registrant_id		= $id;
			$s->siblingname 		= $sname[$i];
			$s->siblingrelation = $srels[$i];
			$s->siblingnik 			= $sniks[$i];
			$s->siblingphone 		= $sphon[$i];
			$s->save();
		}
		// 
		return redirect()->route('registrant.register', 3);
		
	}
	
	
	public function stepthree(Request $request)
	{
		
		$validator = Validator::make($request->all(), [
			'schname'			=> 'required',
			'schstreet'		=> 'required',
			'schprov'			=> 'required',
			'schkab'			=> 'required',
			'schkec'			=> 'required',
			'schkel'			=> 'required',
			'psnfrom'			=> 'required_if:pindahan,==,true',
			'psnadd'			=> 'required_if:pindahan,==,true',
			'psndesc'			=> 'required_if:pindahan,==,true',
			'psnup'				=> 'required_if:pindahan,==,true',
			'psnto'				=> 'required_if:pindahan,==,true',
			
		], $this->errmsg3);
		// 
		if ($validator->fails()) {
			return back()->withInput()->withErrors($validator);
		}
		// 
		
		// get id registrant
		$id = $request->session()->get('regid');
		// delete old data
		Regschool::where('registrant_id', $id)->delete();
		// store data asal sekolah
		$s = new Regschool();
		$s->registrant_id	= $id;
		$s->schfrom				= $request->schfrom;
		$s->schlvl				= $request->schlvl;
		$s->schname				= $request->schname;		
		$s->schstreet			= $request->schstreet;
		$s->schprov				= strtoupper($request->schprov);		
		$s->schkab				= strtoupper($request->schkab);			
		$s->schkec				= strtoupper($request->schkec);			
		$s->schkel				= strtoupper($request->schkel);			
		$s->schpsn				= $request->schpsn;			
		$s->schun					= $request->schun;				
		$s->schijazah			= $request->schijazah;
		$s->schskhun			= $request->schskhun;
		// 
		if($request->pindahan == 'true'){
			$s->pindahan		= true;
			$s->psnfrom			= $request->psnfrom;
			$s->psnadd			= $request->psnadd;
			$s->psnwhy			= $request->psnwhy;
			$s->psndesc			= $request->psndesc;
			$s->psnup				= $request->psnup;
			$s->psnlvl			= $request->psnlvl;
			$s->psnto				= $request->psnto;
			if($request->psnrep == 'true') {$s->psnrep	= true;} else {$s->psnrep = false;}
		}
		// 
		$s->save();
		// 
		return redirect()->route('registrant.register', 4);
		// 
	}
	
	public function stepfour(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'fname'			=> 'required',
			'fadd'			=> 'required',
			'fprov'			=> 'required',
			'fkab'			=> 'required',
			'fkec'			=> 'required',
			'fkel'			=> 'required',
			'fphone'		=> 'required',
			'fktp'			=> 'required',
			'fsal'			=> 'required',
			// 
			'mname'			=> 'required',
			'madd'			=> 'required_if:serumah,==,false',
			'mprov'			=> 'required_if:serumah,==,false',
			'mkab'			=> 'required_if:serumah,==,false',
			'mkec'			=> 'required_if:serumah,==,false',
			'mkel'			=> 'required_if:serumah,==,false',
			'mphone'		=> 'required',
			'mktp'			=> 'required',
			'msal'			=> 'required',
			// 
			'donaturname'		=> 'required_if:pembiayaan,==,false',
			'donaturphone'	=> 'required_if:pembiayaan,==,false',
			'donaturadd'		=> 'required_if:pembiayaan,==,false',
			'dprov'					=> 'required_if:pembiayaan,==,false',
			'dkab'					=> 'required_if:pembiayaan,==,false',
			'dkec'					=> 'required_if:pembiayaan,==,false',
			'dkel'					=> 'required_if:pembiayaan,==,false',
			
		], $this->errmsg4);
		// 
		if ($validator->fails()) {
			return back()->withInput()->withErrors($validator);
		}
		// 
		$id = $request->session()->get('regid');
		// delete old data
		Regparent::where('registrant_id', $id)->delete();
		// store data
		$s = new Regparent();
		$s->registrant_id = $id;
		// ayah
		$s->fname					= $request->fname;
		$s->flive					= $request->flive == 'true' ? true : false;
		$s->fadd					= $request->fadd;
		$s->fprov					= $request->fprov;
		$s->fkab					= $request->fkab;
		$s->fkec					= $request->fkec;
		$s->fkel					= $request->fkel;
		$s->fphone				= $request->fphone;
		$s->fwa						= $request->fwa;
		$s->fktp					= $request->fktp;
		$s->fedu					= $request->fedu;
		$s->freli					= $request->freli;
		$s->fmari					= $request->fmari == 'true' ? true : false;
		$s->fwork					= $request->fwork;
		$s->fsal					= $request->fsal;
		$s->faddsal				= $request->faddsal;
		// ibu
		$s->mname					= $request->mname;
		$s->mlive					= $request->mlive == 'true' ? true : false;
		if($request->serumah == 'true'){
			$s->madd					= $request->fadd;
			$s->mprov					= $request->fprov;
			$s->mkab					= $request->fkab;
			$s->mkec					= $request->fkec;
			$s->mkel					= $request->fkel;
		} else {
			$s->madd					= $request->madd;
			$s->mprov					= $request->mprov;
			$s->mkab					= $request->mkab;
			$s->mkec					= $request->mkec;
			$s->mkel					= $request->mkel;
		}
		$s->mphone				= $request->mphone;
		$s->mwa						= $request->mwa;
		$s->mktp					= $request->mktp;
		$s->medu					= $request->medu;
		$s->mreli					= $request->mreli;
		$s->mwork					= $request->mwork;
		$s->msal					= $request->msal;
		$s->maddsal				= $request->maddsal;
		// pembiaya
		$s->pembiayaan		= $request->pembiayaan == 'true' ? true : false;
		if($request->pembiayaan == 'false'){
			$s->donaturname		= $request->donaturname;
			$s->donaturrels		= $request->donaturrels;
			$s->donaturphone	= $request->donaturphone;
			$s->donaturadd		= $request->donaturadd;
			$s->dprov					= $request->dprov;
			$s->dkab					= $request->dkab;
			$s->dkec					= $request->dkec;
			$s->dkel					= $request->dkel;
		}
		// berkas
		$s->berkasijz		= $request->berkasijz == 'true' ? true : false;
		$s->berkasskhun	= $request->berkasskhun == 'true' ? true : false;
		$s->berkasnisn	= $request->berkasnisn == 'true' ? true : false;
		$s->berkaskk		= $request->berkaskk == 'true' ? true : false;
		$s->berkasktp		= $request->berkasktp == 'true' ? true : false;
		$s->berkasfoto	= $request->berkasfoto == 'true' ? true : false;
		$s->berkasrapor	= $request->berkasrapor == 'true' ? true : false;
		$s->berkasskbb	= $request->berkasskbb == 'true' ? true : false;
		$s->berkaskes		= $request->berkaskes == 'true' ? true : false;
		// 
		$s->save();
		// 
		return redirect()->route('registrant.register', 5);
		
	}
	
	public function ajaxcheckinput(Request $request)
	{
		$f = $request->field;
		$v = $request->value;
		// 
		$c = Registrant::where($f, $v)->first();
		// 
		if($c) {return response()->json(['errors' => 'true']);}
		else {return response()->json(['errors' => 'false']);}
	}
	
	
	public function forgotpassword()
	{
		// 
		return view('authregistrant.registerparts.forgotpassword');
	}
	
	public function forgotsubmit(Request $request)
	{
		// 
		$validator = Validator::make($request->all(), [
			// 'email'		=> 'required_if:username,==,11',
			'kknumber'	=> 'required',
			'nisn'			=> 'required',
			'username'	=> 'required',
			'password'	=> 'required|min:6',
		], [
			'nisn.required'			=> 'Kolom No. KTP Ayah tidak boleh dikosongkan!',		
			'kknumber.required' => 'Kolom No. KK tidak boleh dikosongkan!',		
			'username.required' => 'Kolom NIK tidak boleh dikosongkan!',		
			'password.required' => 'Kolom Password tidak boleh dikosongkan!',		
			'password.min'			=> 'Password minimal 6 karakter.',
			]
		);
		// 
		if ($validator->fails()) {
			return back()->withInput()->withErrors($validator);
		}
		// 
		$regis = Registrant::where(['nisn' => $request->nisn, 'kknumber' => $request->kknumber, 'username' => $request->username])->first();
		if(!$regis){
			return back()->withInput()->withErrors(['invalid' => 'Data yang anda masukkan tidak valid!']);
		}
		// 
		$pass = Hash::make($request->password);
		// 
		$regis->update([
			'password' => $pass,
		]);
		// 
		return redirect()->route('registrant.login')->with(['success' => 'Password berhasil diubah, silahkan login.']);
		
	}
	
}