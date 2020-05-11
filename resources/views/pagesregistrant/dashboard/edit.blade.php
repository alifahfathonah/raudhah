@extends('layouts.semantic')
@section('pagetitle', ' - Ubah Data Calon Santri')
@section('content')
@php $d = Auth::user() @endphp
<div class="ui container">
	@if($errors->any())
	@include('pagesregistrant.parts.errormessages')
	@else
	@include('sweetalert::alert')
	<div class="ui warning message icon">
		<i class="info circle icon"></i>
		<div class="content">
			<div class="header">Perhatian</div>
			Semua perubahan data harus sesuai dengan berkas yang akan diserahkan nantinya.
		</div>
	</div>
	@endif
</div>
{{-- step one --}}
<div class="ui container segment">
	<div class="ui basic segment">
		<h2 class="ui header">
			<div class="content">
				<span class="sitecolor">Biodata</span>
				<div class="sub header">Ubah Biodata Diri <span style="text-transform: capitalize">{{strtolower($d->name)}}</span></div>
			</div>
		</h2>
	</div>
	<div class="ui divider"></div>
	<form class="ui form @if ($errors->any()) error @endif" method="POST" action="{{route('registrant.dashboard.update')}}">
		@csrf
		<div class="ui basic segment">
			<input type="hidden" name="years" value="{{$set->years}}">
			
			<div class="three fields">
				<div class="field required @error('nisn') error @enderror">
					<label>Nomor Induk Sekolah Nasional (NISN)</label>
					<input type="text" name="nisn" class="nisn-input" value="{{old('nisn', $d->nisn)}}">
				</div>
				<div class="field required @error('kknumber') error @enderror">
					<label>Nomor KK</label>
					<input type="text" name="kknumber" class="digit-input" value="{{old('kknumber', $d->kknumber)}}">
				</div>
				<div class="field required @error('username') error @enderror" id="username">
					<label>NIK Sesuai KK</label>
					<input type="text" name="username" class="digit-input" value="{{old('username', $d->username)}}" data-content="NIK akan digunakan sebagai username untuk login ke akun anda." data-variation="inverted" data-position="top right">
				</div>
			</div>
			
			<div class="two fields">
				@php $dest = ['Ar-Raudlatul Hasanah Kampus 1 Medan', 'Ar-Raudlatul Hasanah Kampus 2 LUMUT - Tapanuli Tengah',]; @endphp
				<div class="field required">
					<label>Pilihan Pesantren</label>
					<select class="ui dropdown" name="destination">
						@foreach($dest as $dst)
						<option value="{{$dst}}"{{old('destination') == $dst ? ' selected' : $d->destination == $dst ? ' selected' : ''}}>{{$dst}}</option>
						@endforeach
					</select>
				</div>
				<div class="field">
					<label>Alamat Email</label>
					<input type="text" name="email" value="{{old('email', $d->email)}}">
				</div>
				
			</div>
			
			<div class="two fields">
				<div class="field required @error('name') error @enderror">
					<label>Nama Lengkap</label>
					<input type="text" name="name" class="uppercase-input" value="{{old('name', $d->name)}}">
				</div>
				<div class="field required @error('nickname') error @enderror">
					<label>Nama Panggilan</label>
					<input type="text" name="nickname" class="uppercase-input" value="{{old('nickname', $d->nickname)}}">
				</div>
			</div>
			
			<div class="three fields">
				<div class="field required @error('birthplace') error @enderror">
					<label>Tempat Lahir</label>
					<input type="text" name="birthplace" class="uppercase-input" value="{{old('birthplace', $d->birthplace)}}">
				</div>
				<div class="field required @error('birthdate') error @enderror">
					<label>Tanggal Lahir</label>
					<input type="text" name="birthdate" class="date-input" value="{{old('birthdate', date('d/m/Y', strtotime($d->birthdate)))}}">
				</div>
				<div class="field">
					<label>Jenis Kelamin</label>
					<select class="ui dropdown" name="gender">
						<option value="1"{{old('gender') == 1 ? ' selected' : $d->gender == 1 ? ' selected' : ''}}>Laki-laki</option>
						<option value="2"{{old('gender') == 2 ? ' selected' : $d->gender == 2 ? ' selected' : ''}}>Perempuan</option>
					</select>
				</div>
			</div>
			
			<div class="three fields">
				<div class="field">
					<label>Golongan Darah</label>
					<select class="ui selection dropdown" name="bloodtype">
						@if($d->bloodtype == null)
						<option value="" selected disabled>Kosongkan jika tidak tahu</option>
						@endif
						@foreach ($bloodtypes as $bt)
						<option value="{{$bt}}"{{old('bloodtype') == $bt ? ' selected' : $d->bloodtype == $bt ? ' selected' : ''}}>{{$bt}}</option>
						@endforeach
					</select>
				</div>
				<div class="field">
					<label>Berat Badan</label>
					<div class="ui right labeled input">
						<input type="text" name="weight" class="numeric-input" value="{{old('weight', $d->weight)}}">
						<div class="ui basic label">kg</div>
					</div>
				</div>
				<div class="field">
					<label>Tinggi Badan</label>
					<div class="ui right labeled input">
						<input type="text" name="height" class="numeric-input" value="{{old('height', $d->height)}}">
						<div class="ui basic label">cm</div>
					</div>
				</div>
			</div>
			
			<div class="two fields">
				<div class="field">
					@php $hbs = explode(',', $d->hobby); @endphp
					<label>Hobby</label>
					<select class="ui search dropdown" name="hobby[]" multiple="">
						@foreach ($hobbies as $hb)
						<option value="{{$hb}}"{{!old('hobby') ? '' : in_array($hb, old('hobby')) ? ' selected' : in_array($hb, $hbs) ? ' selected' : ''}}>{{$hb}}</option>
						@endforeach
					</select>
				</div>
				<div class="field">
					@php $whs = explode(',', $d->wishes); @endphp
					<label>Cita-cita</label>
					<select class="ui search dropdown" name="wishes[]" multiple="">
						@foreach ($wishes as $ws)
						<option value="{{$ws}}"{{!old('wishes') ? '' : in_array($ws, old('wishes')) ? ' selected' : in_array($ws, $whs) ? ' selected' : ''}}>{{$ws}}</option>
						@endforeach
					</select>
				</div>
			</div>
			
			<div class="fields">
				<div class="four wide field">
					<label>Juara Ke</label>
					<input type="text" name="achievement" class="numeric-input" value="{{old('achievement', $d->achievement)}}">
				</div>
				<div class="twelve wide field">
					<label>Dari Lomba</label>
					<input type="text" name="competition" class="uppercase-input" value="{{old('competition', $d->competition)}}">		
				</div>
			</div>
			
			<div class="field required">
				<label>Jumlah Saudara</label>
				<div class="four fields">
					<div class="field required @error('siblings') error @enderror">
						<div class="ui labeled input">
							<div class="ui basic label">Kandung</div>
							<input type="text" name="siblings" class="numeric-input" value="{{old('siblings', $d->siblings)}}">
						</div>
					</div>
					<div class="field required @error('stepsiblings') error @enderror">
						<div class="ui labeled input">
							<div class="ui basic label">Tiri</div>
							<input type="text" name="stepsiblings" class="numeric-input" value="{{old('stepsiblings', $d->stepsiblings)}}">
						</div>
					</div>
					<div class="field required @error('totalsiblings') error @enderror">
						<div class="ui labeled input">
							<div class="ui basic label">Total</div>
							<input type="text" name="totalsiblings" class="numeric-input" value="{{old('totalsiblings', $d->totalsiblings)}}" readonly>
						</div>
					</div>
					<div class="field required @error('numposition') error @enderror">
						<div class="ui labeled input">
							<div class="ui basic label">Anak Ke</div>
							<input type="text" name="numposition" class="numeric-input" value="{{old('numposition', $d->numposition)}}">
						</div>
					</div>
				</div>
			</div>
			
			<div class="ui divider"></div>
			<button type="submit" class="ui labeled icon positive button">
				<i class="save icon"></i>
				Simpan
			</button>
			
		</div>
	</form>
</div>
{{-- /step one --}}

@if($d->totalsiblings > 0)
<div class="ui basic segment"></div>

{{-- step two --}}
<div class="ui container segment">
	<div class="ui basic segment">
		<h2 class="ui header">
			<div class="content">
				<span class="sitecolor">Saudara</span>
				<div class="sub header">Ubah Data Saudara <span style="text-transform: capitalize">{{strtolower($d->name)}}</span></div>
			</div>
		</h2>
	</div>
	<div class="ui divider"></div>
	<form class="ui form @if ($errors->any()) error @endif" method="POST" action="{{route('registrant.dashboard.updatesiblings')}}">
		@csrf
		<div class="ui basic segment">
			@if($d->totalsiblings == $d->regsibling->count())
			@php 
			$sibname = array(); 
			$sibrel = array(); 
			$sibnik = array(); 
			$sibphone = array(); 
			foreach ($d->regsibling as $rs) {
				$sibname[] = $rs->siblingname;
				$sibrel[] = $rs->siblingrelation;
				$sibnik[] = $rs->siblingnik;
				$sibphone[] = $rs->siblingphone;
			}
			@endphp
			@for ($i = 0; $i < $d->totalsiblings; $i++)
			<div class="fields">
				<div class="five wide field required @error('sibname.' . $i) error @enderror">
					<label>Nama Saudara</label>
					<input type="text" name="sibname[]" class="uppercase-input" value="{{old('sibname.' . $i, $sibname[$i])}}">
				</div>
				<div class="three wide field">
					<label>Hubungan</label>
					<select class="ui dropdown" name="sibrel[]">
						@foreach ($sibrelations as $rel)
						<option value="{{$rel}}"{{old('sibrel.' . $i) == $rel ? ' selected' : $sibrel[$i] == $rel ? ' selected' : ''}}>{{$rel}}</option>
						@endforeach
					</select>
				</div>
				<div class="four wide field required @error('sibnik.' . $i) error @enderror">
					<label>NIK Sesuai KK</label>
					<input type="text" name="sibnik[]" class="digit-input" value="{{old('sibnik.' . $i, $sibnik[$i])}}">		
				</div>
				<div class="four wide field">
					<label>No. Handphone</label>
					<input type="text" name="sibphone[]" class="phone-input" value="{{old('sibphone.' . $i, $sibphone[$i])}}">		
				</div>
			</div>
			@endfor
			
			@else
			<div class="ui negative message">
				<div class="content">
					<div class="header">Perhatian!</div>
					Total jumlah saudara telah diubah, mohon tentukan kembali data saudara calon santri.
				</div>
			</div>
			@for ($i = 0; $i < $d->totalsiblings; $i++)
			<div class="fields">
				<div class="five wide field required @error('sibname.' . $i) error @enderror">
					<label>Nama Saudara</label>
					<input type="text" name="sibname[]" class="uppercase-input" value="{{old('sibname.' . $i, '')}}">
				</div>
				<div class="three wide field">
					<label>Hubungan</label>
					<select class="ui dropdown" name="sibrel[]">
						@foreach ($sibrelations as $rel)
						<option value="{{$rel}}"{{old('sibrel.' . $i) == $rel ? ' selected' : ''}}>{{$rel}}</option>
						@endforeach
					</select>
				</div>
				<div class="four wide field required @error('sibnik.' . $i) error @enderror">
					<label>NIK Sesuai KK</label>
					<input type="text" name="sibnik[]" class="digit-input" value="{{old('sibnik.' . $i, '')}}">		
				</div>
				<div class="four wide field">
					<label>No. Handphone</label>
					<input type="text" name="sibphone[]" class="phone-input" value="{{old('sibphone.' . $i, '')}}">		
				</div>
			</div>
			@endfor
			
			@endif
			
			<div class="ui divider"></div>
			<button type="submit" class="ui labeled icon positive button">
				<i class="save icon"></i>
				Simpan
			</button>
		</div>
	</form>
</div>
@endif
{{-- /step two --}}

<div class="ui basic segment"></div>

{{-- step three --}}
<div class="ui container segment">
	<div class="ui basic segment">
		<h2 class="ui header">
			<div class="content">
				<span class="sitecolor">Sekolah</span>
				<div class="sub header">Ubah Data Asal Sekolah <span style="text-transform: capitalize">{{strtolower($d->name)}}</span></div>
			</div>
		</h2>
	</div>
	<div class="ui divider"></div>
	<form class="ui form @if ($errors->any()) error @endif" method="POST" action="{{route('registrant.dashboard.updateschool')}}">
		@csrf
		<div class="ui basic segment">
			
			<div class="field">
				<div class="fields">
					<div class="four wide field required">
						<label>Lulus Dari Sekolah</label>
						<select class="ui dropdown" name="schfrom">
							<option value="NEGERI"{{old('schfrom') == 'NEGERI' ? ' selected' : $d->regschool['schfrom'] == 'NEGERI' ? ' selected' : ''}}>NEGERI</option>
							<option value="SWASTA"{{old('schfrom') == 'SWASTA' ? ' selected' : $d->regschool['schfrom'] == 'SWASTA' ? ' selected' : ''}}>SWASTA</option>
						</select>
					</div>
					<div class="four wide field required">
						<label>Tingkat</label>
						<select class="ui dropdown" name="schlvl">
							<option value="SD"{{old('schlvl') == 'SD' ? ' selected' : $d->regschool['schlvl'] == 'SD' ? ' selected' : ''}}>SD</option>
							<option value="SMP"{{old('schlvl') == 'SMP' ? ' selected' : $d->regschool['schlvl'] == 'SMP' ? ' selected' : ''}}>SMP</option>
						</select>
					</div>
					<div class="ten wide field required @error('schname') error @enderror">
						<label>Nama Sekolah</label>
						<input type="text" name="schname" class="uppercase-input" value="{{old('schname', $d->regschool['schname'])}}">
					</div>
				</div>
				
				<div class="field required @error('schstreet') error @enderror">
					<label>Alamat Sekolah</label>
					<input type="text" name="schstreet" class="uppercase-input" value="{{old('schstreet', $d->regschool['schstreet'])}}">
				</div>		
				
				<div class="four fields">
					<div class="field required @error('schprov') error @enderror">
						<label>Provinsi</label>
						<select class="ui search dropdown" id="selprov">
							<option selected>{{$d->regschool['schprov']}}</option>
						</select>
					</div>
					<input type="hidden" name="schprov" value="{{old('schprov', $d->regschool['schprov'])}}">
					<div class="field required @error('schkab') error @enderror">
						<label>Kabupaten/Kota</label>
						<select class="ui search dropdown" id="selkab">
							<option selected>{{$d->regschool['schkab']}}</option>
						</select>
					</div>
					<input type="hidden" name="schkab" value="{{old('schkab', $d->regschool['schkab'])}}">
					<div class="field required @error('schkec') error @enderror">
						<label>Kecamatan</label>
						<select class="ui search dropdown" id="selkec">
							<option selected>{{$d->regschool['schkec']}}</option>
						</select>
					</div>
					<input type="hidden" name="schkec" value="{{old('schkec', $d->regschool['schkec'])}}">
					<div class="field required @error('schkel') error @enderror">
						<label>Kelurahan/Desa</label>
						<select class="ui search dropdown" id="selkel">
							<option selected>{{$d->regschool['schkel']}}</option>
						</select>
					</div>
					<input type="hidden" name="schkel" value="{{old('schkel', $d->regschool['schkel'])}}">
				</div>
				
				<div class="two fields">
					<div class="field">
						<label>No. Pokok Sekolah Nasional</label>
						<input type="text" name="schpsn" class="numeric-input" value="{{old('schpsn', $d->regschool['schpsn'])}}">
					</div>
					<div class="field">
						<label>No. Peserta Ujian Negara (UN)</label>
						<input type="text" name="schun" class="numeric-input" value="{{old('schun', $d->regschool['schun'])}}">
					</div>
				</div>
				
				<div class="two fields">
					<div class="field">
						<label>Nomor Ijazah</label>
						<input type="text" name="schijazah" class="numeric-input" value="{{old('schijazah', $d->regschool['schijazah'])}}">
					</div>
					<div class="field">
						<label>Nomor SKHUN</label>
						<input type="text" name="schskhun" class="numeric-input" value="{{old('schskhun', $d->regschool['schskhun'])}}">
					</div>
				</div>
				
				<div class="ui basic segment"></div>
				<div class="inline fields">
					<label>Apakah calon santri yang mendaftar adalah pindahan dari pesantren lain?</label>
					<div class="field">
						<div class="ui radio checkbox"{{old('pindahan') == 'true' ? ' checked' : $d->regschool['pindahan'] == true ? ' checked' : ''}}>
							<input type="radio" name="pindahan" tabindex="0" class="hidden" value="true"{{old('pindahan') == 'true' ? ' checked' : $d->regschool['pindahan'] == true ? ' checked' : ''}} id="pindahantrue">
							<label>YA</label>
						</div>
					</div>
					<div class="field">
						<div class="ui radio checkbox"{{old('pindahan') == 'false' ? ' checked' : $d->regschool['pindahan'] == false ? ' checked' : ''}}>
							<input type="radio" name="pindahan" tabindex="0" class="hidden" value="false"{{old('pindahan') == 'false' ? ' checked' : $d->regschool['pindahan'] == false ? ' checked' : ''}}>
							<label>TIDAK</label>
						</div>
					</div>
				</div>
			</div>
			
			<div class="field" id="form-pindahan">
				<div class="ui basic segment">
					<h4 class="ui horizontal divider header grey"> ISI HANYA JIKA PINDAHAN DARI PESANTREN DAN INGIN NAIK TINGKAT </h4>
				</div>
				
				<div class="field required @error('psnfrom') error @enderror">
					<label>Dari Pesantren</label>
					<input type="text" name="psnfrom" class="uppercase-input" value="{{old('psnfrom', $d->regschool['psnfrom'])}}">
				</div>
				
				<div class="field required @error('psnadd') error @enderror">
					<label>Alamat Pesantren</label>
					<textarea name="psnadd" rows="2" class="uppercase-input">{{old('psnadd', $d->regschool['psnadd'])}}</textarea>
				</div>
				
				<div class="fields">
					<div class="four wide field required">
						<label>Alasan Pindah</label>
						<select class="ui dropdown" name="psnwhy">
							@foreach ($movereasons as $mr)
							<option value="{{$mr}}"{{old('psnwhy') == $mr ? ' selected' : $d->regschool['psnwhy'] == $mr ? ' selected' : ''}}>{{$mr}}</option>
							@endforeach
						</select>
					</div>
					<div class="twelve wide field required @error('psndesc') error @enderror">
						<label>Deskripsi</label>
						<input type="text" name="psndesc" class="uppercase-input" value="{{old('psndesc', $d->regschool['psndesc'])}}">
					</div>
				</div>
				
				<div class="four fields">
					<div class="field required @error('psnup') error @enderror">
						<label>Naik Ke Kelas</label>
						<input type="text" name="psnup" class="numeric-input" value="{{old('psnup', $d->regschool['psnup'])}}">
					</div>
					<div class="field required">
						<label>Tingkat</label>
						<select class="ui dropdown" name="psnlvl">
							<option value="MTS"{{old('psnlvl') == 'MTS' ? ' selected' : $d->regschool['psnlvl'] == 'MTS' ? ' selected' : ''}}>MTS</option>
							<option value="MA"{{old('psnlvl') == 'MA' ? ' selected' : $d->regschool['psnlvl'] == 'MA' ? ' selected' : ''}}>MA</option>
						</select>
					</div>
					<div class="field required @error('psnto') error @enderror">
						<label>Ingin Ke Kelas</label>
						<select class="ui dropdown" name="psnto">
							@for ($i = 2; $i < 5; $i++)
							<option value="{{$i}}"{{old('psnto') == $i ? ' selected' : $d->regschool['psnto'] == $i ? ' selected' : ''}}>{{$i}}</option>		
							@endfor
						</select>
					</div>
					<div class="field required">
						<label>Rapor Pesantren</label>
						<select class="ui dropdown" name="psnrep">
							<option value="true"{{old('psnrep') == 'true' ? ' selected' :  $d->regschool['psnrep'] == true ? ' selected' : ''}}>ADA</option>
							<option value="false"{{old('psnrep') == 'false' ? ' selected' : $d->regschool['psnrep'] == false ? ' selected' : ''}}>TIDAK ADA</option>
						</select>
					</div>
				</div>
			</div>
			
			<div class="ui divider"></div>
			<button type="submit" class="ui labeled icon positive button">
				<i class="save icon"></i>
				Simpan
			</button>
		</div>
	</form>
</div>
{{-- /step three --}}

<div class="ui basic segment"></div>

{{-- step four --}}
<div class="ui container segment">
	<div class="ui basic segment">
		<h2 class="ui header">
			<div class="content">
				<span class="sitecolor">Orang Tua</span>
				<div class="sub header">Ubah Data Orang Tua <span style="text-transform: capitalize">{{strtolower($d->name)}}</span></div>
			</div>
		</h2>
	</div>
	<div class="ui divider"></div>
	<form class="ui form @if ($errors->any()) error @endif" method="POST" action="{{route('registrant.dashboard.updateparents')}}">
		@csrf
		<div class="ui basic segment">
			
			<div class="ui basic segment">
				<h4 class="ui horizontal divider header grey"> DATA AYAH KANDUNG </h4>
			</div>
			
			<div class="field required">
				<label>Nama Lengkap</label>
				<div class="fields">
					<div class="twelve wide field @error('fname') error @enderror">
						<input type="text" name="fname" class="uppercase-input" value="{{old('fname', $d->regparent['fname'])}}">
					</div>
					<div class="four wide field required">
						<select name="flive" class="ui dropdown">
							<option value="true"{{old('flive') == 'true' ? ' selected' : $d->regparent['flive'] == true ? ' selected' : ''}}>MASIH HIDUP</option>
							<option value="false"{{old('flive') == 'false' ? ' selected' : $d->regparent['flive'] == false ? ' selected' : ''}}>SUDAH MENINGGAL</option>
						</select>
					</div>
				</div>
			</div>
			
			<div class="field required @error('fadd') error @enderror">
				<label>Alamat Lengkap</label>
				<input type="text" name="fadd" class="uppercase-input" value="{{old('fadd', $d->regparent['fadd'])}}">
			</div>
			
			<div class="four fields required @error('fprov') error @enderror">
				<div class="field">
					<label>Provinsi</label>
					<select class="ui search dropdown" id="fselprov">
						<option selected>{{$d->regparent['fprov']}}</option>
					</select>
				</div>
				<input type="hidden" name="fprov" value="{{$d->regparent['fprov']}}">
				<div class="field required @error('fkab') error @enderror">
					<label>Kabupaten/Kota</label>
					<select class="ui search dropdown" id="fselkab">
						<option selected>{{$d->regparent['fkab']}}</option>
					</select>
				</div>
				<input type="hidden" name="fkab" value="{{$d->regparent['fkab']}}">
				<div class="field required @error('fkec') error @enderror">
					<label>Kecamatan</label>
					<select class="ui search dropdown" id="fselkec">
						<option selected>{{$d->regparent['fkec']}}</option>
					</select>
				</div>
				<input type="hidden" name="fkec" value="{{$d->regparent['fkec']}}">
				<div class="field required @error('fkel') error @enderror">
					<label>Kelurahan/Desa</label>
					<select class="ui search dropdown" id="fselkel">
						<option selected>{{$d->regparent['fkel']}}</option>
					</select>
				</div>
				<input type="hidden" name="fkel" value="{{$d->regparent['fkel']}}">
			</div>
			
			<div class="two fields">
				<div class="field required @error('fphone') error @enderror">
					<label>Nomor Telepon/HP</label>
					<input type="text" name="fphone" class="phone-input" value="{{old('fphone', $d->regparent['fphone'])}}">
				</div>
				<div class="field">
					<label>Nomor WhatsApp</label>
					<input type="text" name="fwa" class="phone-input" value="{{old('fwa', $d->regparent['fwa'])}}">
				</div>
			</div>
			
			<div class="fields">
				<div class="seven wide field required @error('fktp') error @enderror">
					<label>Nomor KTP</label>
					<input type="text" name="fktp" class="digit-input" value="{{old('fktp', $d->regparent['fktp'])}}">
				</div>
				<div class="three wide field required">
					<label>Pendidikan Terakhir</label>
					<select name="fedu" class="ui dropdown">
						@foreach ($edulevels as $fedu)
						<option value="{{$fedu}}"{{old('fedu') == $fedu ? ' selected' : $d->regparent['fedu'] == $fedu ? ' selected' : ''}}>{{$fedu}}</option>
						@endforeach
					</select>
				</div>
				<div class="three wide field required">
					<label>Agama</label>
					<select name="freli" class="ui dropdown">
						@foreach ($religions as $freli)
						<option value="{{$freli}}"{{old('freli') == $freli ? ' selected' : $d->regparent['freli'] == $freli ? ' selected' : ''}}>{{$freli}}</option>
						@endforeach
					</select>
				</div>
				<div class="three wide field required">
					<label>Status Pernikahan</label>
					<select name="fmari" class="ui dropdown">
						<option value="true"{{old('fmari') == 'true' ? ' selected' : $d->regparent['fmari'] == true ? ' selected' : ''}}>TIDAK CERAI</option>
						<option value="false"{{old('fmari') == 'true' ? ' selected' : $d->regparent['fmari'] == false ? ' selected' : ''}}>BERCERAI</option>
					</select>
				</div>
			</div>
			
			<div class="three fields">
				<div class="field required">
					<label>Pekerjaan</label>
					<select name="fwork" class="ui search dropdown">
						@foreach ($wishes as $fwork)
						<option value="{{$fwork}}"{{old('fwork') == $fwork ? ' selected' : $d->regparent['fwork'] == $fwork ? ' selected' : ''}}>{{$fwork}}</option>
						@endforeach
					</select>
				</div>
				<div class="field required @error('fsal') error @enderror">
					<label>Penghasilan Per Bulan</label>
					<div class="ui labeled input">
						<div class="ui basic label">Rp.</div>
						<input type="text" name="fsal" class="currency-input" value="{{old('fsal', $d->regparent['fsal'])}}">
					</div>
				</div>
				<div class="field">
					<label>Penghasilan Tambahan</label>
					<div class="ui labeled input">
						<div class="ui basic label">Rp.</div>
						<input type="text" name="faddsal" class="currency-input" value="{{old('faddsal', $d->regparent['faddsal'])}}">
					</div>
				</div>
			</div>
			
			
			{{-- ibu --}}
			<div class="ui basic segment">
				<h4 class="ui horizontal divider header grey"> DATA IBU KANDUNG </h4>
			</div>
			
			<div class="field required">
				<label>Nama Lengkap</label>
				<div class="fields">
					<div class="twelve wide field required @error('mname') error @enderror">
						<input type="text" name="mname" class="uppercase-input" value="{{old('mname', $d->regparent['mname'])}}">
					</div>
					<div class="four wide field required">
						<select name="mlive" class="ui dropdown">
							<option value="true"{{old('mlive') == 'true' ? ' selected' : $d->regparent['mlive'] == true ? ' selected' : ''}}>MASIH HIDUP</option>
							<option value="false"{{old('mlive') == 'false' ? ' selected' : $d->regparent['mlive'] == false ? ' selected' : ''}}>SUDAH MENINGGAL</option>
						</select>
					</div>
				</div>
			</div>
			
			{{-- pilihan alamat ibu --}}
			
			<div class="inline fields">
				<label>Alamat Ibu sama dengan Ayah?</label>
				<div class="field">
					<div class="ui radio checkbox"{{$d->regparent['fadd'] == $d->regparent['madd'] ? ' checked' : ''}}>
						<input type="radio" name="serumah" tabindex="0" class="hidden" value="true"{{old('serumah') == 'true' ? ' checked' : $d->regparent['fadd'] == $d->regparent['madd'] ? ' checked' : ''}}>
						<label>YA</label>
					</div>
				</div>
				<div class="field">
					<div class="ui radio checkbox"{{$d->regparent['fadd'] != $d->regparent['madd'] ? ' checked' : ''}}>
						<input type="radio" name="serumah" tabindex="0" class="hidden" value="false"{{old('serumah') == 'false' ? ' checked' : $d->regparent['fadd'] != $d->regparent['madd'] ? ' checked' : ''}} id="serumahfalse">
						<label>TIDAK</label>
					</div>
				</div>
			</div>
			
			{{-- // --}}
			
			<div class="field" id="form-serumah">
				
				<div class="field required @error('madd') error @enderror">
					<label>Alamat Lengkap</label>
					<input type="text" name="madd" class="uppercase-input" value="{{old('madd', $d->regparent['madd'])}}">
				</div>
				
				<div class="four fields">
					<div class="field required @error('mprov') error @enderror">
						<label>Provinsi</label>
						<select class="ui search dropdown" id="mselprov">
							<option selected>{{$d->regparent['mprov']}}</option>
						</select>
					</div>
					<input type="hidden" name="mprov" value="{{$d->regparent['mprov']}}">
					<div class="field required @error('mkab') error @enderror">
						<label>Kabupaten/Kota</label>
						<select class="ui search dropdown" id="mselkab">
							<option selected>{{$d->regparent['mkab']}}</option>
						</select>
					</div>
					<input type="hidden" name="mkab" value="{{$d->regparent['mkab']}}">
					<div class="field required @error('mkec') error @enderror">
						<label>Kecamatan</label>
						<select class="ui search dropdown" id="mselkec">
							<option selected>{{$d->regparent['mkec']}}</option>
						</select>
					</div>
					<input type="hidden" name="mkec" value="{{$d->regparent['mkec']}}">
					<div class="field required @error('mkel') error @enderror">
						<label>Kelurahan/Desa</label>
						<select class="ui search dropdown" id="mselkel">
							<option selected>{{$d->regparent['mkel']}}</option>
						</select>
					</div>
					<input type="hidden" name="mkel" value="{{$d->regparent['mkel']}}">
				</div>
				
			</div>
			
			<div class="two fields">
				<div class="field required @error('mphone') error @enderror">
					<label>Nomor Telepon/HP</label>
					<input type="text" name="mphone" class="phone-input" value="{{old('mphone', $d->regparent['mphone'])}}">
				</div>
				<div class="field">
					<label>Nomor WhatsApp</label>
					<input type="text" name="mwa" class="phone-input" value="{{old('mwa', $d->regparent['mwa'])}}">
				</div>
			</div>
			
			<div class="fields">
				<div class="eight wide field required @error('mktp') error @enderror">
					<label>Nomor KTP</label>
					<input type="text" name="mktp" class="digit-input" value="{{old('mktp', $d->regparent['mktp'])}}">
				</div>
				<div class="four wide field required">
					<label>Pendidikan Terakhir</label>
					<select name="medu" class="ui dropdown">
						@foreach ($edulevels as $medu)
						<option value="{{$medu}}"{{old('medu') == $medu ? ' selected' : $d->regparent['medu'] == $medu ? ' selected' : ''}}>{{$medu}}</option>
						@endforeach
					</select>
				</div>
				<div class="four wide field required">
					<label>Agama</label>
					<select name="mreli" class="ui dropdown">
						@foreach ($religions as $mreli)
						<option value="{{$mreli}}"{{old('mreli') == $mreli ? ' selected' : $d->regparent['mreli'] == $mreli ? ' selected' : ''}}>{{$mreli}}</option>
						@endforeach
					</select>
				</div>
			</div>
			
			<div class="three fields">
				<div class="field required">
					<label>Pekerjaan</label>
					<select name="mwork" class="ui search dropdown">
						@foreach ($wishes as $mwork)
						<option value="{{$mwork}}"{{old('mwork') == $mwork ? ' selected' : $d->regparent['mwork'] == $mwork ? ' selected' : ''}}>{{$mwork}}</option>
						@endforeach
					</select>
				</div>
				<div class="field required @error('msal') error @enderror">
					<label>Penghasilan Per Bulan</label>
					<div class="ui labeled input">
						<div class="ui basic label">Rp.</div>
						<input type="text" name="msal" class="currency-input" value="{{old('msal', $d->regparent['msal'])}}">
					</div>
				</div>
				<div class="field">
					<label>Penghasilan Tambahan</label>
					<div class="ui labeled input">
						<div class="ui basic label">Rp.</div>
						<input type="text" name="maddsal" class="currency-input" value="{{old('maddsal', $d->regparent['maddsal'])}}">
					</div>
				</div>
			</div>
			
			
			<div class="inline fields">
				<label>Apakah yang membiayai orang tua kandung?</label>
				<div class="field">
					<div class="ui radio checkbox"{{old('pembiayaan') == 'true' ? ' checked' : $d->regparent['pembiayaan'] == true ? ' checked' : ''}}>
						<input type="radio" name="pembiayaan" tabindex="0" class="hidden" value="true"{{old('pembiayaan') == 'true' ? ' checked' : $d->regparent['pembiayaan'] == true ? ' checked' : ''}}>
						<label>YA</label>
					</div>
				</div>
				<div class="field">
					<div class="ui radio checkbox"{{old('pembiayaan') == 'false' ? ' checked' : $d->regparent['pembiayaan'] == false ? ' checked' : ''}}>
						<input type="radio" name="pembiayaan" tabindex="0" class="hidden" value="false"{{old('pembiayaan') == 'false' ? ' checked' : $d->regparent['pembiayaan'] == false ? ' checked' : ''}} id="pembiayaanfalse">
						<label>TIDAK</label>
					</div>
				</div>
			</div>
			
			
			<div class="field" id="form-pembiaya">
				<div class="ui basic segment">
					<h4 class="ui horizontal divider header grey"> DATA PEMBIAYA </h4>
				</div>
				
				<div class="fields">
					<div class="eight wide field required @error('donaturname') error @enderror">
						<label>Nama Pembiaya</label>
						<input type="text" name="donaturname" class="uppercase-input" value="{{old('donaturname', $d->regparent['donaturname'])}}">
					</div>
					<div class="four wide field required">
						<label>Hubungan Dengan Pendaftar</label>
						<select name="donaturrels" class="ui dropdown">
							@foreach ($donaturs as $donaturrels)
							<option value="{{$donaturrels}}"{{old('donaturrels') == $donaturrels ? ' selected' : $d->regparent['donaturrels'] == $donaturrels ? ' selected' : ''}}>{{$donaturrels}}</option>
							@endforeach
						</select>
					</div>
					<div class="four wide field required @error('donaturphone') error @enderror">
						<label>No. Handphone/WhatsApp</label>
						<input type="text" name="donaturphone" class="phone-input" value="{{old('donaturphone', $d->regparent['donaturphone'])}}">
					</div>
				</div>
				
				<div class="field required @error('donaturadd') error @enderror">
					<label>Alamat Lengkap</label>
					<input type="text" name="donaturadd" class="uppercase-input" value="{{old('donaturadd', $d->regparent['donaturadd'])}}">
				</div>
				
				<div class="four fields">
					<div class="field required @error('dprov') error @enderror">
						<label>Provinsi</label>
						<select class="ui search dropdown" id="dselprov">
							<option selected>{{$d->regparent['dprov']}}</option>
						</select>
					</div>
					<input type="hidden" name="dprov" value="{{$d->regparent['dprov']}}">
					<div class="field required @error('dkab') error @enderror">
						<label>Kabupaten/Kota</label>
						<select class="ui search dropdown" id="dselkab">
							<option selected>{{$d->regparent['dkab']}}</option>
						</select>
					</div>
					<input type="hidden" name="dkab" value="{{$d->regparent['dkab']}}">
					<div class="field required @error('dkec') error @enderror">
						<label>Kecamatan</label>
						<select class="ui search dropdown" id="dselkec">
							<option selected>{{$d->regparent['dkec']}}</option>
						</select>
					</div>
					<input type="hidden" name="dkec" value="{{$d->regparent['dkec']}}">
					<div class="field required @error('dkel') error @enderror">
						<label>Kelurahan/Desa</label>
						<select class="ui search dropdown" id="dselkel">
							<option selected>{{$d->regparent['dkel']}}</option>
						</select>
					</div>
					<input type="hidden" name="dkel" value="{{$d->regparent['dkel']}}">
				</div>
				
			</div>
			
			<div class="field">
				<div class="ui basic segment">
					<h4 class="ui horizontal divider header grey"> KELENGKAPAN BERKAS </h4>
				</div>
				
				
				<div class="three fields">
					<div class="field">
						<label>Fotocopy Ijazah 3 Lembar</label>
						<select name="berkasijz" class="ui dropdown">
							<option value="true"{{old('berkasijz') == 'true' ? ' selected' : $d->regparent['berkasijz'] == true ? ' selected' : ''}}>ADA</option>
							<option value="false"{{old('berkasijz') == 'false' ? ' selected' : $d->regparent['berkasijz'] == false ? ' selected' : ''}}>TIDAK ADA</option>
						</select>
					</div>
					<div class="field">
						<label>Fotocopy SKHUN 3 Lembar</label>
						<select name="berkasskhun" class="ui dropdown">
							<option value="true"{{old('berkasskhun') == 'true' ? ' selected' : $d->regparent['berkasskhun'] == true ? ' selected' : ''}}>ADA</option>
							<option value="false"{{old('berkasskhun') == 'false' ? ' selected' : $d->regparent['berkasskhun'] == false ? ' selected' : ''}}>TIDAK ADA</option>
						</select>
					</div>
					<div class="field">
						<label>Fotocopy Kartu NISN 1 Lembar</label>
						<select name="berkasnisn" class="ui dropdown">
							<option value="true"{{old('berkasnisn') == 'true' ? ' selected' : $d->regparent['berkasnisn'] == true ? ' selected' : ''}}>ADA</option>
							<option value="false"{{old('berkasnisn') == 'false' ? ' selected' : $d->regparent['berkasnisn'] == false ? ' selected' : ''}}>TIDAK ADA</option>
						</select>
					</div>
				</div>
				<div class="three fields">
					<div class="field">
						<label>Fotocopy Kartu Keluarga 1 Lembar</label>
						<select name="berkaskk" class="ui dropdown">
							<option value="true"{{old('berkaskk') == 'true' ? ' selected' : $d->regparent['berkaskk'] == true ? ' selected' : ''}}>ADA</option>
							<option value="false"{{old('berkaskk') == 'false' ? ' selected' : $d->regparent['berkaskk'] == false ? ' selected' : ''}}>TIDAK ADA</option>
						</select>
					</div>
					<div class="field">
						<label>Fotocopy KTP</label>
						<select name="berkasktp" class="ui dropdown">
							<option value="true"{{old('berkasktp') == 'true' ? ' selected' : $d->regparent['berkasktp'] == true ? ' selected' : ''}}>ADA</option>
							<option value="false"{{old('berkasktp') == 'false' ? ' selected' : $d->regparent['berkasktp'] == false ? ' selected' : ''}}>TIDAK ADA</option>
						</select>
					</div>
					<div class="field">
						<label>Photo Hitam Putih 3x4 6 Lembar</label>
						<select name="berkasfoto" class="ui dropdown">
							<option value="true"{{old('berkasfoto') == 'true' ? ' selected' : $d->regparent['berkasfoto'] == true ? ' selected' : ''}}>ADA</option>
							<option value="false"{{old('berkasfoto') == 'false' ? ' selected' : $d->regparent['berkasfoto'] == false ? ' selected' : ''}}>TIDAK ADA</option>
						</select>
					</div>
				</div>
				<div class="three fields">
					<div class="field">
						<label>Fotocopy Rapor Pesantren</label>
						<select name="berkasrapor" class="ui dropdown">
							<option value="true"{{old('berkasrapor') == 'true' ? ' selected' : $d->regparent['berkasrapor'] == true ? ' selected' : ''}}>ADA</option>
							<option value="false"{{old('berkasrapor') == 'false' ? ' selected' : $d->regparent['berkasrapor'] == false ? ' selected' : ''}}>TIDAK ADA</option>
						</select>
					</div>
					<div class="field">
						<label>Fotocopy SKBB 1 lembar</label>
						<select name="berkasskbb" class="ui dropdown">
							<option value="true"{{old('berkasskbb') == 'true' ? ' selected' : $d->regparent['berkasskbb'] == true ? ' selected' : ''}}>ADA</option>
							<option value="false"{{old('berkasskbb') == 'false' ? ' selected' : $d->regparent['berkasskbb'] == false ? ' selected' : ''}}>TIDAK ADA</option>
						</select>
					</div>
					<div class="field">
						<label>Surat Kesehatan 1 lembar</label>
						<select name="berkaskes" class="ui dropdown">
							<option value="true"{{old('berkaskes') == 'true' ? ' selected' : $d->regparent['berkaskes'] == true ? ' selected' : ''}}>ADA</option>
							<option value="false"{{old('berkaskes') == 'false' ? ' selected' : $d->regparent['berkaskes'] == false ? ' selected' : ''}}>TIDAK ADA</option>
						</select>
					</div>
				</div>
				
				
				<div class="ui divider"></div>
				<button type="submit" class="ui labeled icon positive button">
					<i class="save icon"></i>
					Simpan
				</button>
			</div>
		</div>
	</form>
</div>
{{-- /step four --}}

@endsection

@section('pagescript')
<script>
	$("input[name='pembiayaan']").change(function(){
		var val = $(this).val();
		if(val === 'false'){
			$("#form-pembiaya").show().transition('pulse');
		} else {
			$("#form-pembiaya").hide();
		}
	});
	// 
	$("input[name='serumah']").change(function(){
		var val = $(this).val();
		if(val === 'false'){
			$("#form-serumah").show().transition('pulse');
		} else {
			$("#form-serumah").hide();
		}
	});
	// 
	$("input[name='pindahan']").change(function(){
		var val = $(this).val();
		if(val === 'true'){
			$("#form-pindahan").show().transition('pulse');
		} else {
			$("#form-pindahan").hide();
		}
	});
	
	$("#username").keyup(function(){
		var val = $("input[name='username']").val();
		checkInputAjax('username', val, '#username');
	});
	$("#email").keyup(function(){
		var em = $("input[name='email']").val();
		checkInputAjax('email', em, '#email');
	});
	
	// check input
	function checkInputAjax(field, value, domid) {
		$.ajaxSetup({
			headers: {
				"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
			},
		});
		$.ajax({
			type: "POST",
			url: "{{route('ajax.check.input')}}",
			data: {
				field: field,
				value: value,
			},
			success: function (res) {
				// console.log(res);
				if (res.errors == 'true') {
					$(domid).addClass('error');
				} else {
					$(domid).removeClass('error');
				}
			},
		});
	}
	
	// 
	var k = $("input[name='siblings']");
	var t = $("input[name='stepsiblings']");
	var x = $("input[name='totalsiblings']");
	var a = 0; var b = 0; var c = 0;
	$(k).keyup(function(){
		a = parseInt($(this).val());
		c = a + b;
		if(isNaN(c)) x.val(b+0); else x.val(c);
	});
	$(t).keyup(function(){
		b = parseInt($(this).val());
		c = a + b;
		if(isNaN(c)) x.val(a); else x.val(c);
	});
</script>
@endsection