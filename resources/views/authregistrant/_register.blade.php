@extends('layouts.registrant')
@section('pagetitle', '- Registrasi Online')
@section('content')
<div class="card-columns mx-4 mt-4">
	<!-- data diri -->
	<div class="card shadow-sm mb-4">
		<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary">
			<h6 class="m-0 font-weight-bold text-white">Data Diri</h6>
		</div>
		<div class="card-body">
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-envelope-open-text"></i></div>
					</div>
					<input id="email" type="email" class="form-control @error('email') is-invalid @enderror is-required" name="email" value="{{ old('email') }}" autocomplete="off" placeholder="Alamat Email">
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-lock"></i></div>
					</div>
					<input id="password" type="password" class="form-control @error('password') is-invalid @enderror is-required" name="password" autocomplete="off" placeholder="Login Password">
				</div>
			</div>
			
			<div class="dropdown-divider my-4"></div>
			
			<div class="form-group">
				<input id="kknumber" type="text" class="form-control @error('kknumber') is-invalid @enderror is-required" name="kknumber" value="{{ old('kknumber') }}" autocomplete="off" placeholder="Nomor Kartu Keluarga">
			</div>
			
			<div class="form-group">
				<input id="username" type="text" class="form-control @error('username') is-invalid @enderror is-required" name="username" value="{{ old('username') }}" autocomplete="off" placeholder="NIK Sesuai Kartu Keluarga">
			</div>
			
			<div class="form-group">
				<input id="name" type="text" class="form-control @error('name') is-invalid @enderror is-required" name="name" value="{{ old('name') }}" autocomplete="off" placeholder="Nama Lengkap">
			</div>
			
			<div class="form-group">
				<input id="nickname" type="text" class="form-control @error('nickname') is-invalid @enderror is-required" name="nickname" value="{{ old('nickname') }}" required autocomplete="off" placeholder="Nama Panggilan">
			</div>
			
			<div class="form-group">
				<input id="nisn" type="text" class="form-control @error('nisn') is-invalid @enderror is-required" name="nisn" value="{{ old('nisn') }}" required autocomplete="off" placeholder="Nomor Induk Siswa (NISN)">
			</div>
			
			<div class="form-group">
				<label for="exampleFormControlInput1" class="pb-0 mb-0 text-muted">Jenis Kelamin</label>
				<div class="form-group d-flex justify-content-between">
					<div class="form-check form-check-radio form-check-inline">
						<label class="form-check-label pl-2">
							<input class="form-check-input" type="radio" name="gender" id="genderm" value="1" checked>
							<span class="form-check-sign"></span>
							Laki-laki
						</label>
					</div>
					<div class="form-check form-check-radio form-check-inline">
						<label class="form-check-label pl-2">
							<input class="form-check-input" type="radio" name="gender" id="genderf" value="2">
							<span class="form-check-sign"></span>Perempuan
						</label>
					</div>
				</div>
			</div>
			
			{{-- gol darah --}}
			<div class="form-group row">
				<div class="col-12">
					@php $bloodtypes = array('A', 'B', 'AB', 'O'); @endphp
					<select name="bloodtype" id="bloodtype" class="form-control">
						<option value="" selected disabled>Golongan Darah</option>
						@foreach ($bloodtypes as $bt)
						<option value="{{$bt}}">{{$bt}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-6 input-group">
					<input type="text" name="weight" id="weight" class="form-control" placeholder="Berat Badan">
					<div class="input-group-append">
						<div class="input-group-text">KG</div>
					</div>
				</div>
				<div class="col-6 input-group">
					<input type="text" name="height" id="height" class="form-control" placeholder="Tinggi Badan">
					<div class="input-group-append">
						<div class="input-group-text">CM</div>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<input id="birthplace" type="text" class="form-control @error('birthplace') is-invalid @enderror is-required" name="birthplace" value="{{ old('birthplace') }}" autocomplete="off" placeholder="Tempat Lahir">
			</div>
			
			<div class="form-group">
				<input id="birthdate" type="text" class="form-control @error('birthdate') is-invalid @enderror is-required" name="birthdate" value="{{ old('birthdate') }}" autocomplete="off" placeholder="Tanggal Lahir">
				<small id="birthdateHelp" class="form-text text-muted text-right mr-2">
					Tanggal/Bulan/Tahun
				</small>
			</div>
			
			<div class="dropdown-divider my-4"></div>
			
			{{-- hoby dan cita-cita --}}
			<div class="form-group row">
				<div class="col-6">
					@php $hobbies = array('MEMBACA','BERBURU','BERDAGANG','BERENANG','BERKEMAH','BERSEPEDA','BISNIS','BLOGGING','BOLA VOLI','BOWLING','BULUTANGKIS','CATUR','DESAIN GRAFIS','ELEKTRONIK','FASHION','FOTOGRAFI','FUTSAL','GO KART','GOLF','KALIGRAFI','KANO','KARATE','KERAJINAN (HANDICRAFT)','KOLEKTOR','KOMPUTER','KULINER DAN MEMASAK','MELUKIS','MEMANCING','MENARI','MENEMBAK','MENGAJI','MENULIS','MENUNGGANG KUDA','MENYELAM','MEREKAM VIDEO','MODIFIKASI MOTOR','MOUNTAINEERING','MUSIK','OLAHRAGA MENEMBAK','OTOMOTIF','PANJAT TEBING','PARALAYANG','PECINTA BATU','PERTANIAN','PROGRAMMING','SEPAKBOLA','SKATEBOARDING','SNORKELING','SURFING','TENIS','TINJU','TRAVELING');
					@endphp
					<select name="hobby" id="hobby" class="form-control">
						<option value="" selected disabled>Hobby</option>
						@foreach ($hobbies as $hb)
						<option value="{{$hb}}">{{$hb}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-6">
					@php $wishes = array('AKUNTAN','ANGGOTA BPK','ANGGOTA DPD','ANGGOTA DPRD','ANGGOTA KABINET/KEMENTERIAN','ANGGOTA MAHKAMAH KONSTITUSI','APOTEKER','ARSITEK','BIDAN','BUPATI','BURUH HARIAN LEPAS','BURUH NELAYAN/PERIKANAN','BURUH PETERNAKAN','BURUH TANI/PERKEBUNAN','DOKTER','DOSEN','DUTA BESAR','GUBERNUR','GURU','IMAM MESJID','INDUSTRI','JURU MASAK','KARYAWAN BUMD','KARYAWAN BUMN','KARYAWAN SWASTA','KEPALA DESA','KEPOLISIAN RI','KONSTRUKSI','KONSULTAN','MEKANIK','MENGURUS RUMAH TANGGA','NELAYAN/PERIKANAN','NOTARIS','PANDAI BESI','PEDAGANG','PEDAGANG','PEGAWAI NEGERI SIPIL','PELAJAR/MAHASISWA','PELAUT','PEMBANTU RUMAH TANGGA','PENATA BUSANA','PENATA RAMBUT','PENATA RIAS','PENELITI','PENGACARA','PENJAHIT','PENSIUNAN','PENTERJEMAH','PENYIAR RADIO','PENYIAR TELEVISI','PERANCANG BUSANA','PERANGKAT DESA','PERAWAT','PETANI/PEKEBUN','PETERNAK','PIALANG','PILOT','PRESIDEN','PROMOTOR ACARA','PSIKIATER/PSIKOLOG','SECURITY','SENIMAN','SOPIR','TABIB','TENTARA NASIONAL INDONESIA','TRANSPORTASI','TUKANG BATU','TUKANG CUKUR','TUKANG GIGI','TUKANG KAYU','TUKANG LISTRIK','USTADZ/MUBALIGH','WAKIL BUPATI','WAKIL GUBERNUR','WAKIL PRESIDEN','WAKIL WALIKOTA','WALIKOTA','WARTAWAN','WIRASWASTA');
					@endphp
					<select name="wishes" id="wishes" class="form-control">
						<option value="" selected disabled>Cita-cita</option>
						@foreach ($wishes as $wsh)
						<option value="{{$wsh}}">{{$wsh}}</option>
						@endforeach
					</select>
				</div>
			</div>
			
			{{-- prestasi --}}
			<div class="form-group row">
				<div class="col-4">
					<input type="text" name="achievement" id="achievement" class="form-control" placeholder="Juara Ke">
				</div>
				<div class="col-8">
					<input type="text" name="competition" id="competition" class="form-control" placeholder="Pada Lomba">
				</div>
			</div>
		</div>
	</div>
	
	<!-- data keluarga -->
	<div class="card shadow-sm mb-4">
		<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-success">
			<h6 class="m-0 font-weight-bold text-white">Data Saudara</h6>
		</div>
		<div class="card-body">
			<div class="form-group row">
				<div class="col-6">
					<input id="siblings" type="text" class="form-control @error('siblings') is-invalid @enderror is-required" name="siblings" value="{{ old('siblings') }}" autocomplete="off" placeholder="Saudara Kandung">
				</div>
				<div class="col-6">
					<input id="stepsiblings" type="text" class="form-control @error('stepsiblings') is-invalid @enderror is-required" name="stepsiblings" value="{{ old('stepsiblings') }}" autocomplete="off" placeholder="Saudara Tiri">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-6">
					<input id="numposition" type="text" class="form-control @error('numposition') is-invalid @enderror is-required" name="numposition" value="{{ old('numposition') }}" autocomplete="off" placeholder="Anak Ke">
				</div>
				<div class="col-6">
					<input id="totalsiblings" type="text" class="form-control @error('totalsiblings') is-invalid @enderror is-required" name="totalsiblings" value="{{ old('totalsiblings') }}" autocomplete="off" placeholder="Jumlah Saudara" readonly>
				</div>
			</div>

			<div class="dropdown-divider my-4"></div>

			@php $siblingrelations = array('ADIK','ABANG','KAKAK','ADIK TIRI','ABANG TIRI','KAKAK TIRI'); @endphp
			<div class="form-group row">
				<label for="exampleFormControlInput1" class="pb-0 text-muted col-12">Data Saudara <span id="sibnum">1</span></label>
				<div class="col-12 pb-1">
					<input type="text" name="siblingname[]" id="siblingname-1" class="form-control is-required" placeholder="Nama Lengkap">
				</div>
				<div class="col-12 pb-1">
					<select name="siblingrelation[]" id="siblingrelation-1" class="form-control is-required">
						<option value="" selected disabled>Hubungan</option>
						@foreach ($siblingrelations as $sibrel)
								<option value="{{$sibrel}}">{{$sibrel}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-12 pb-1">
					<input type="text" name="siblingnik[]" id="siblingnik-1" class="form-control is-required" placeholder="NIK Sesuai Kartu Keluarga">
				</div>
				<div class="col-12 pb-1">
					<input type="text" name="siblingphone[]" id="siblingphone-1" class="form-control" placeholder="Nomor Handphone">
				</div>
			</div>

		</div>
	</div>
</div> <!-- /card-columns -->
@endsection


@section('pagescript')
<script>
	var sdrk = 0;
	var sdrt = 0;
	var sdrttl = $("#totalsiblings");
	$("#siblings").change(function(){
		if($(this).val()) sdrk = parseInt($(this).val()); else sdrk = 0;
		if(sdrk > 0 && sdrt == 0) {sdrttl.val(sdrk)}
		else if(sdrk == 0 && sdrt > 0){sdrttl.val(sdrt)}
		else if(sdrk >0 && sdrt > 0) {sdrttl.val(sdrk + sdrt)}
		else {sdrttl.val('')}
	});
	$("#stepsiblings").change(function(){
		if($(this).val()) sdrt = parseInt($(this).val()); else sdrt = 0;
		if(sdrk > 0 && sdrt == 0) {sdrttl.val(sdrk)}
		else if(sdrk == 0 && sdrt > 0){sdrttl.val(sdrt)}
		else if(sdrk >0 && sdrt > 0) {sdrttl.val(sdrk + sdrt)}
		else {sdrttl.val('')}
	});

</script>
@endsection