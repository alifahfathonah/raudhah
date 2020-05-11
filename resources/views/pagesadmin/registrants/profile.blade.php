<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>{{$d->nova}}</title>
	<style>
		.main-table{
			width: 100%
		}
		.kop { line-height: 1.2 }
		.parent-div { height: 2cm }
		.parent-div:after { content: "";display: table;clear: both; }
		.col { float: left; }
		.col-left { width: 2cm }
		.col-right { padding-left: 1cm; padding-top: -0.4cm }
		.no-ujian { border: 1px solid black; display: inline-block; padding: 0.1cm 0.4cm 0 0.4cm; float: right; margin: 0.5cm 0}
		.line-height-1 { line-height: 0.1 }
		.data-table { width: 100% }
		.data-group { clear: both; margin-top: 1cm}
		.leading { width: 38%; white-space: nowrap; padding-right: 0.5cm}
		.data-table tr td:last-child { border-bottom: 1px solid black; }
		.table-sibling {width: 100%; border: 1px solid black; text-align: left}
		.table-sibling tr td { border: 1px solid black; padding: 1px}
		.tr { font-weight: bold}
	</style>
</head>
<body>
	
	<div class="parent-div">
		<div class="col col-left">
			<img src="{{public_path('img/app/' . $set->logo)}}" alt="" style="width: 2cm">
		</div>
		<div class="col col-right">
			<h4 class="kop">FORMULIR DATA PRIBADI CALON SANTRI/SANTRIWATI 
				<br>	KMI {{$set->prefix ? strtoupper($set->prefix) . ' ' : ''}}{{strtoupper($set->name)}}
				<br>TAHUN AJARAN {{$set->years}}</h4>
			</div>
		</div>
	</div>
	
	<div class="no-ujian">
		<h4 class="line-height-1">NOMOR UJIAN </h4>
		<h2 class="line-height-1">{{$d->examcard['numchar']}}</h2>
	</div>
	
	<div class="data-group">
		<h4 class="line-height-1">DATA PRIBADI PENDAFTAR</h4>
		<table class="data-table">
			<tr>
				<td>PILIHAN PESANTREN</td>
				<td>:</td>
				<td>{{strtoupper($d->destination)}}</td>
			</tr>
			<tr>
				<td class="leading">NAMA LENGKAP SESUAI IJAZAH</td>
				<td style="width:1%">:</td>
				<td>{{$d->name}}</td>
			</tr>
			<tr>
				<td>PANGGILAN</td>
				<td>:</td>
				<td>{{$d->nickname}}</td>
			</tr>
			<tr>
				<td>NO. KARTU KELUARGA</td>
				<td>:</td>
				<td>{{$d->kknumber}}</td>
			</tr>
			<tr>
				<td>NIK. PENDAFTAR</td>
				<td>:</td>
				<td>{{$d->username}}</td>
			</tr>
			<tr>
				<td>NISN</td>
				<td>:</td>
				<td>{{$d->nisn}}</td>
			</tr>
			<tr>
				<td>JENIS KELAMIN</td>
				<td>:</td>
				<td>{{$d->gender == 1 ? 'LAKI-LAKI' : 'PEREMPUAN'}}</td>
			</tr>
			<tr>
				<td>GOLONGAN DARAH</td>
				<td>:</td>
				<td>{{$d->bloodtype}}</td>
			</tr>
			<tr>
				<td>TINGGI / BERAT BADAN</td>
				<td>:</td>
				<td>{{$d->height}} CM / {{$d->weight}} KG</td>
			</tr>
			<tr>
				<td>TEMPAT, TANGGAL LAHIR</td>
				<td>:</td>
				<td>{{$d->birthplace}}, {{date('d-m-Y', strtotime($d->birthdate))}}</td>
			</tr>
			<tr>
				<td>HOBBY</td>
				<td>:</td>
				<td>{{str_replace(',',', ', $d->hobby)}}</td>
			</tr>
			<tr>
				<td>CITA-CITA</td>
				<td>:</td>
				<td>{{str_replace(',',', ', $d->wishes)}}</td>
			</tr>
			<tr>
				<td>ANAK KE</td>
				<td>:</td>
				<td>{{$d->numposition}} DARI {{$d->totalsiblings + 1}} BERSAUDARA</td>
			</tr>
			<tr>
				<td>JUMLAH SAUDARA</td>
				<td>:</td>
				<td>{{$d->siblings}} KANDUNG, {{$d->stepsiblings}} TIRI</td>
			</tr>
		</table>
	</div>
	
	<div class="data-group">
		<h4 class="line-height-1">DATA SAUDARA</h4>
		<table class="table-sibling" cellspacing="0" cellpadding="1">
			<tr class="tr">
				<td>NO.</td>
				<td>NAMA LENGKAP</td>
				<td>HUBUNGAN</td>
				<td>NIK</td>
				<td>NO. HANDPHONE</td>
			</tr>
			@if ($d->totalsiblings == 0)
			<tr>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
			</tr>
			@else
			@php $no = 1 @endphp
			@foreach($d->regsibling as $s)
			<tr>
				<td>{{$no++}}</td>
				<td>{{$s->siblingname}}</td>
				<td>{{$s->siblingrelation}}</td>
				<td>{{$s->siblingnik}}</td>
				<td>{{$s->siblingphone}}</td>
			</tr>
			@endforeach
			@endif
		</table>
	</div>

	<div class="data-group">
		<h4 class="line-height-1">DATA ASAL SEKOLAH</h4>
		<table class="data-table">
			<tr>
				<td class="leading">LULUS DARI & NAMA SEKOLAH</td>
				<td style="width:1%">:</td>
				<td>{{$d->regschool['schfrom']}} - {{$d->regschool['schname']}}</td>
			</tr>
			<tr>
				<td>ALAMAT SEKOLAH</td>
				<td>:</td>
				<td>{{$d->regschool['schstreet']}}</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>{{$d->regschool['schkel']}}, KECAMATAN {{$d->regschool['schkec']}}</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>{{$d->regschool['schkab']}} - PROVINSI {{$d->regschool['schprov']}}</td>
			</tr>
			<tr>
				<td>NO. POKOK SEKOLAH NASIONAL</td>
				<td>:</td>
				<td>{{$d->regschool['schpsn']}}</td>
			</tr>
			<tr>
				<td>NO. PESERTA UJIAN NEGARA (UN)</td>
				<td>:</td>
				<td>{{$d->regschool['schun']}}</td>
			</tr>
			<tr>
				<td>NO. IJAZAH</td>
				<td>:</td>
				<td>{{$d->regschool['schijazah']}}</td>
			</tr>
			<tr>
				<td>NO. SKHUN</td>
				<td>:</td>
				<td>{{$d->regschool['schskhun']}}</td>
			</tr>
		</table>
	</div>

	@if($d->regschool['pindahan'] == true)
	<div class="data-group">
		<h4 class="line-height-1">PINDAHAN DARI PESANTREN</h4>
		<table class="data-table">
			<tr>
				<td>NAMA PESANTREN</td>
				<td style="width:1%">:</td>
				<td>{{$d->regschool['psnfrom']}}</td>
			</tr>
			<tr>
				<td>ALAMAT PESANTREN</td>
				<td>:</td>
				<td>{{$d->regschool['psnadd']}}</td>
			</tr>
			<tr>
				<td class="leading">FAKTOR PENYEBAB PINDAH</td>
				<td>:</td>
				<td>{{$d->regschool['psnwhy']}}</td>
			</tr>
			<tr>
				<td class="leading">DESKRIPSI ALASAN</td>
				<td>:</td>
				<td>{{$d->regschool['psndesc']}}</td>
			</tr>
			<tr>
				<td>STATUS KENAIKAN</td>
				<td>:</td>
				<td>NAIK KE KELAS {{$d->regschool['psnup']}}, TINGKAT {{$d->regschool['psnlvl']}}, INGIN KE KELAS {{$d->regschool['psnto']}}.</td>
			</tr>
			<tr>
				<td>RAPORT PESANTREN</td>
				<td>:</td>
				<td>{{$d->regschool['psnrep'] == true ? 'ADA' : 'TIDAK ADA'}}</td>
			</tr>
		</table>
	</div>
	@endif

	<div class="data-group">
		<h4 class="line-height-1">DATA ORANG TUA KANDUNG</h4>
		<table class="data-table">
			<tr>
				<td class="leading">NAMA AYAH KANDUNG</td>
				<td style="width: 1%">:</td>
				<td>{{$d->regparent['flive'] == false ? '(ALM.) ' : ''}}{{$d->regparent['fname']}}</td>
			</tr>
			<tr>
				<td>ALAMAT DOMISILI</td>
				<td>:</td>
				<td>{{$d->regparent['fadd']}}</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>{{$d->regparent['fkel']}}, KECAMATAN {{$d->regparent['fkec']}}</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>{{$d->regparent['fkab']}} - PROVINSI {{$d->regparent['fprov']}}</td>
			</tr>
			<tr>
				<td>NO. HP / WHATSAPP</td>
				<td>:</td>
				<td>{{$d->regparent['fphone']}} / {{$d->regparent['fwa'] ?? '-'}}</td>
			</tr>
			<tr>
				<td>NO. KTP</td>
				<td>:</td>
				<td>{{$d->regparent['fktp']}}</td>
			</tr>
			<tr>
				<td>PENDIDIKAN TERAKHIR</td>
				<td>:</td>
				<td>{{$d->regparent['fedu']}}</td>
			</tr>
			<tr>
				<td>PEKERJAAN</td>
				<td>:</td>
				<td>{{$d->regparent['fwork']}}</td>
			</tr>
			<tr>
				<td>PENGHASILAN UTAMA/BULAN</td>
				<td>:</td>
				<td>Rp. {{$d->regparent['fsal']}}</td>
			</tr>
			<tr>
				<td>PENGHASILAN TAMBAHAN</td>
				<td>:</td>
				<td>Rp. {{$d->regparent['faddsal'] ?? 0}}</td>
			</tr>
			<tr>
				<td>AGAMA</td>
				<td>:</td>
				<td>{{$d->regparent['freli']}}</td>
			</tr>
			<tr>
				<td>STATUS PERNIKAHAN</td>
				<td>:</td>
				<td>{{$d->regparent['fmari'] == true ? 'MENIKAH' : 'BERCERAI'}}</td>
			</tr>
			<tr>
				<td>NAMA IBU KANDUNG</td>
				<td>:</td>
				<td>{{$d->regparent['mlive'] == false ? '(ALMH.) ' : ''}}{{$d->regparent['mname']}}</td>
			</tr>
			<tr>
				<td>ALAMAT DOMISILI</td>
				<td>:</td>
				<td>{{$d->regparent['madd']}}</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>{{$d->regparent['mkel']}}, KECAMATAN {{$d->regparent['mkec']}}</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>{{$d->regparent['mkab']}} - PROVINSI {{$d->regparent['mprov']}}</td>
			</tr>
			<tr>
				<td>NO. HP / WHATSAPP</td>
				<td>:</td>
				<td>{{$d->regparent['mphone']}} / {{$d->regparent['mwa'] ?? '-'}}</td>
			</tr>
			<tr>
				<td>NO. KTP</td>
				<td>:</td>
				<td>{{$d->regparent['mktp']}}</td>
			</tr>
			<tr>
				<td>PENDIDIKAN TERAKHIR</td>
				<td>:</td>
				<td>{{$d->regparent['medu']}}</td>
			</tr>
			<tr>
				<td>PEKERJAAN</td>
				<td>:</td>
				<td>{{$d->regparent['mwork']}}</td>
			</tr>
			<tr>
				<td>PENGHASILAN UTAMA/BULAN</td>
				<td>:</td>
				<td>Rp. {{$d->regparent['msal']}}</td>
			</tr>
			<tr>
				<td>PENGHASILAN TAMBAHAN</td>
				<td>:</td>
				<td>Rp. {{$d->regparent['maddsal'] ?? 0}}</td>
			</tr>
			<tr>
				<td>AGAMA</td>
				<td>:</td>
				<td>{{$d->regparent['mreli']}}</td>
			</tr>
		</table>
	</div>
	
	@if($d->regparent['pembiayaan'] == false)
	<div class="data-group">
		<h4 class="line-height-1">DATA YANG MEMBIAYAI</h4>
		<table class="data-table">
			<tr>
				<td class="leading">NAMA YANG MEMBIAYAI</td>
				<td style="width: 1%">:</td>
				<td>{{$d->regparent['donaturname']}}</td>
			</tr>
			<tr>
				<td>ALAMAT DOMISILI SESUAI KTP</td>
				<td>:</td>
				<td>{{$d->regparent['donaturadd']}}</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>{{$d->regparent['dkel']}}, KECAMATAN {{$d->regparent['dkec']}}</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>{{$d->regparent['dkab']}} - PROVINSI {{$d->regparent['dprov']}}</td>
			</tr>
			<tr>
				<td>HUBUNGAN DGN. PENDAFTAR</td>
				<td>:</td>
				<td>{{$d->regparent['donaturrels']}}</td>
			</tr>
			<tr>
				<td>NO. HANDPHONE / WHATSAPP</td>
				<td>:</td>
				<td>{{$d->regparent['donaturphone']}}</td>
			</tr>
		</table>
	</div>
	@endif

	<div class="data-group">
		<h4 class="line-height-1">KELENGKAPAN BERKAS PENDAFTARAN</h4>
		<table class="data-table">
			<tr>
				<td class="leading">FC. IJAZAH 3 LBR.</td>
				<td style="width: 1%">:</td>
				<td>{{$d->regparent['berkasijz'] == true ? 'ADA' : 'TIDAK ADA'}}</td>
			</tr>
			<tr>
				<td>FC. SKHUN 3 LBR.</td>
				<td>:</td>
				<td>{{$d->regparent['berkasskhun'] == true ? 'ADA' : 'TIDAK ADA'}}</td>
			</tr>
			<tr>
				<td>FC. KARTU NISN 1 LBR.</td>
				<td>:</td>
				<td>{{$d->regparent['berkasnisn'] == true ? 'ADA' : 'TIDAK ADA'}}</td>
			</tr>
			<tr>
				<td>FC. KARTU KELUARGA 1 LBR.</td>
				<td>:</td>
				<td>{{$d->regparent['berkaskk'] == true ? 'ADA' : 'TIDAK ADA'}}</td>
			</tr>
			<tr>
				<td>FC. KTP ORANG TUA</td>
				<td>:</td>
				<td>{{$d->regparent['berkasktp'] == true ? 'ADA' : 'TIDAK ADA'}}</td>
			</tr>
			<tr>
				<td>PAS PHOTO H/P 3X4 6 LBR.</td>
				<td>:</td>
				<td>{{$d->regparent['berkasfoto'] == true ? 'ADA' : 'TIDAK ADA'}}</td>
			</tr>
			<tr>
				<td>FC. RAPORT PESANTREN</td>
				<td>:</td>
				<td>{{$d->regparent['berkasrapor'] == true ? 'ADA' : 'TIDAK ADA'}}</td>
			</tr>
			<tr>
				<td>FC. SKBB 1 LBR.</td>
				<td>:</td>
				<td>{{$d->regparent['berkasskbb'] == true ? 'ADA' : 'TIDAK ADA'}}</td>
			</tr>
			<tr>
				<td>SURAT KESEHATAN</td>
				<td>:</td>
				<td>{{$d->regparent['berkaskes'] == true ? 'ADA' : 'TIDAK ADA'}}</td>
			</tr>
		</table>
	</div>

	<table style="width: 100%; margin-top:2cm">
		<tr>
			<td style="width: 65%"></td>
			<td style="text-align:center">
			Medan, {{date('d-m-Y', strtotime(today()))}}<br>
			Calon {{$d->gender == 1 ? 'Santri' : 'Santriwati'}},<br>
			<p style="padding-top: 1.5cm; font-weight:bold;">( <span style="text-decoration: underline">{{$d->name}}</span> )</p>
			</td>
		</tr>
	</table>

</body>
</html>