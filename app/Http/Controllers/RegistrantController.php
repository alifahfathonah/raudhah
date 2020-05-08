<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use PDF;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Setting;
use App\Registrant;
use App\Regsibling;
use App\Regschool;
use App\Regparent;
use App\Sibling;
use App\Regstep;
use App\Payment;
use App\Examcard;
// 

class RegistrantController extends Controller
{
	
	// ------------------
	// ARRAY DECLARATIONS
	// ------------------
	
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
		'nisn.size'							=> '"NISN" terdiri dari 10 digit angka.',
		'kknumber.required'			=> 'Kolom "Nomor KK" tidak boleh dikosongkan',
		'kknumber.size'					=> '"Nomor KK" terdiri dari 16 digit angka.',
		'username.required'			=> 'Kolom "NIK" tidak boleh dikosongkan',
		'username.size'					=> '"NIK" terdiri dari 16 digit angka.',
		'username.unique'				=> '"NIK" calon santri sudah terdaftar. Periksa kembali NIK yang anda masukkan.',
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
		'sibnik.*.size'				=> 'Kolom "NIK" terdiri dari 16 digit angka.'
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
		'fktp.size'				=> '"Nomor KTP" Ayah terdiri dari 16 digit angka.',
		'fwork.required'	=> '"Pekerjaan Ayah" tidak boleh dikosongkan.',
		'fsal.required'		=> 'Kolom "Penghasilan Perbulan" Ayah tidak boleh dikosongkan',
		'mname.required'		=> 'Kolom "Nama Lengkap" Ibu tidak boleh dikosongkan.',
		'madd.required_if'	=> 'Kolom "Alamat Lengkap" Ibu tidak boleh dikosongkan.',
		'mprov.required_if'	=> 'Pilih "Provinsi" dari alamat Ibu.',
		'mkab.required_if'	=> 'Pilih "Kabupaten/Kota" dari alamat Ibu.',
		'mkec.required_if'	=> 'Pilih "Kecamatan" dari alamat Ibu.',
		'mkel.required_if'	=> 'Pilih "Kelurahan/Desa" dari alamat Ibu.',
		'mphone.required'		=> 'Kolom "Nomor Telepon/HP" Ibu tidak boleh dikosongkan.',
		'mktp.required'			=> 'Kolom "Nomor KTP" Ibu tidak boleh dikosongkan.',
		'mwork.required'		=> '"Pekerjaan Ibu" tidak boleh dikosongkan.',
		'mktp.size'					=> '"Nomor KTP" ibu terdiri dari 16 digit angka.',
		'msal.required'			=> 'Kolom "Penghasilan Perbulan" Ibu tidak boleh dikosongkan',
		'donaturname.required_if'		=> 'Kolom "Nama Pembiaya" tidak boleh dikosongkan.',
		'donaturphone.required_if'	=> 'Kolom "No. Handphone/WhatsApp" Pembiaya tidak boleh dikosongkan.',
		'donaturadd.required_if'		=> 'Kolom "Alamat Lengkap" Pembiaya tidak boleh dikosongkan.',
		'dprov.required_if'					=> 'Pilih "Provinsi" dari alamat Pembiaya.',
		'dkab.required_if'					=> 'Pilih "Kabupaten/Kota" dari alamat Pembiaya.',
		'dkec.required_if'					=> 'Pilih "Kecamatan" dari alamat Pembiaya.',
		'dkel.required_if'					=> 'Pilih "Kelurahan/Desa" dari alamat Pembiaya.',
	];
	// 
	
	// ------------------------------------------- 
	// 
	public function __construct()
	{
		$this->middleware('auth:registrant');
	}
	
	public function index()
	{
		$id = Auth::id();
		// check if register is complete
		$step = Regstep::where('registrant_id', $id)->first()->stepreg;
		if($step <= 4){
			return redirect()->route('registrant.dashboard.continue');
		}
		// redirect if examcard already defined
		$ec = Examcard::where('registrant_id', $id)->first();
		if($ec){
			Regstep::where('registrant_id', $id)->update(['steppay' => 2]);
		}
		
		
		return view('pagesregistrant.dashboard.index');
		
	}
	
	// ---------------------------------------
	public function editdata()
	{
		if(Auth::user()->regstep['stepreg'] <= 4){
			return redirect()->route('registrant.dashboard');
		}
		return view('pagesregistrant.dashboard.edit', ['bloodtypes' => $this->bloodtypes, 'hobbies' => $this->hobbies, 'wishes' => $this->wishes, 'sibrelations' => $this->sibrelations, 'movereasons' => $this->movereasons, 'edulevels' => $this->edulevels, 'religions' => $this->religions, 'salaries' => $this->salaries, 'donaturs' => $this->donaturs]);
	}
	
	
	
	public function continueregs()
	{
		$id = Auth::id();
		// check if register is complete
		$step = Regstep::where('registrant_id', $id)->first()->stepreg;
		if($step > 4){
			return redirect()->route('registrant.dashboard');
		}
		return view('pagesregistrant.dashboard.continue', [
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
	
	// ---------------------------------------
	public function registertwo(Request $request)
	{
		if($request->id){
			$this->nextstep($request->id);
			return redirect()->route('registrant.dashboard.continue');
		}
		// dd($request->sibname);
		$validator = Validator::make($request->all(), [
			'sibname.*'	=> 'required',
			'sibnik.*'	=> 'required|size:16',
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
		// 
		$id = Auth::id();
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
		$this->nextstep($id);
		// 
		return redirect()->route('registrant.dashboard.continue');
		
	}
	
	// ---------------------------------------
	public function registerthree(Request $request)
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
		$id = Auth::id();
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
			if($request->psnrep == 'true') {
				$s->psnrep	= true;
			} else {
				$s->psnrep = false;
			}
		}
		// 
		$s->save();
		// 
		$this->nextstep($id);
		// 
		return redirect()->route('registrant.dashboard.continue');
		// 
	}
	
	// ---------------------------------------
	public function registerfour(Request $request)
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
			'fwork'			=> 'required',
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
			'mwork'			=> 'required',
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
		$id = Auth::id();
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
		$this->nextstep($id);
		// 
		return redirect()->route('registrant.dashboard.continue');
		
	}
	
	// ---------------------------------------
	public function nextstep($id)
	{
		return Regstep::where('registrant_id', $id)->increment('stepreg');
	}
	
	// ---------------------------------------
	public function logout(Request $request)
	{
		Auth::guard('registrant')->logout();
		return redirect()->route('registrant.dashboard');
	}
	
	
	// ---------------------------------------
	// pdf download kartu ujian
	public function kartuujian()
	{
		$id = Auth::id();
		$data = Registrant::find($id);
		$card = Examcard::where('registrant_id', $id)->first();
		// dd($data->examcard['numchar']);
		
		
		$pdf = PDF::loadview('pagesregistrant.dashboard.kartuujian',['data' => $data, 'card' => $card]);
		return $pdf->stream($card->numchar);
		// return $pdf->download($data->nomorujian['number']);
		
		// return view('pagesregistrant.dashboard.kartuujian', ['data' => $data]);
	}
	
	

	// ---------------------------------------
	// UPDATE DATA REGISTRANT
	// ---------------------------------------

	// biodata
	public function update(Request $request)
	{
		$id = Auth::id();
		$validator = Validator::make($request->all(), [
			'nisn'				=> 'required|size:10',
			'kknumber'		=> 'required|size:16',
			'username'		=> 'required|size:16|unique:registrants,username,'.$id,
			'name' 				=> 'required',
			'nickname' 		=> 'required',
			'birthplace' 	=> 'required',
			'birthdate' 	=> 'required',
			'siblings' 		=> 'required',
			'stepsiblings'=> 'required',
			'numposition' => 'required',
		], $this->errmsg1);
		// 
		if ($validator->fails()) {
			return back()->withInput()->withErrors($validator);
		}
		$bd = $request->birthdate;
		$bd = explode('/', $bd);
		$bd = $bd[2] . '-' . $bd[1] . '-' . $bd[0];
		$hobby = $request->hobby ?? null;
		$wishes = $request->wishes ?? null;
		if($hobby) $hb = implode(',', $hobby); else $hb = null;
		if($wishes) $ws = implode(',', $wishes); else $ws = null;
		// 
		$k = $request->siblings;
		if($k == null || $k == '') $k = 0;
		$t = $request->stepsiblings;
		if($t == null || $t == '') $t = 0;
		$ttls = $k + $t;
		Registrant::find($id)->update([
			'email' 			=> $request->email,
			'destination'	=> $request->destination,
			'kknumber' 		=> $request->kknumber,
			'username' 		=> $request->username,
			'name' 				=> $request->name,
			'nickname' 		=> $request->nickname,
			'nisn' 				=> $request->nisn,
			'gender' 			=> $request->gender,
			'bloodtype' 	=> $request->bloodtype ?? null,
			'weight' 			=> $request->weight,
			'height' 			=> $request->height,
			'birthplace' 	=> $request->birthplace,
			'birthdate' 	=> $bd,
			'consulat' 		=> null,
			'hobby' 			=> $hb,
			'wishes'			=> $ws,
			'achievement' => $request->achievement,
			'competition' => $request->competition,
			'siblings' 		=> $k,
			'stepsiblings'=> $t,
			'totalsiblings'	=> $ttls,
			'numposition' => $request->numposition,
			]
		);
		// 
		return back()->withToastSuccess('Biodata berhasil diubah.');
	}

	// siblings
	public function updatesiblings(Request $request)
	{
		if($request->id){
			$this->nextstep($request->id);
			return redirect()->route('registrant.dashboard.continue');
		}
		// dd($request->sibname);
		$validator = Validator::make($request->all(), [
			'sibname.*'	=> 'required',
			'sibnik.*'	=> 'required|size:16',
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
		// 
		$id = Auth::id();
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
		return back()->withToastSuccess('Data saudara berhasil diubah.');
		
	}

	// school
	public function updateschool(Request $request)
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
		$id = Auth::id();
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
			if($request->psnrep == 'true') {
				$s->psnrep	= true;
			} else {
				$s->psnrep = false;
			}
		}
		// 
		$s->save();
		// 
		// 
		return back()->withToastSuccess('Data sekolah berhasil diubah.');
		// 
	}

// ---------------------------------------
public function updateparents(Request $request)
{
	$validator = Validator::make($request->all(), [
		'fname'			=> 'required',
		'fadd'			=> 'required',
		'fprov'			=> 'required',
		'fkab'			=> 'required',
		'fkec'			=> 'required',
		'fkel'			=> 'required',
		'fphone'		=> 'required',
		'fktp'			=> 'required|size:16',
		'fsal'			=> 'required',
		// 
		'mname'			=> 'required',
		'madd'			=> 'required_if:serumah,==,false',
		'mprov'			=> 'required_if:serumah,==,false',
		'mkab'			=> 'required_if:serumah,==,false',
		'mkec'			=> 'required_if:serumah,==,false',
		'mkel'			=> 'required_if:serumah,==,false',
		'mphone'		=> 'required',
		'mktp'			=> 'required|size:16',
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
	$id = Auth::id();
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
	return back()->withToastSuccess('Data orang tua berhasil diubah.');
	
}

}