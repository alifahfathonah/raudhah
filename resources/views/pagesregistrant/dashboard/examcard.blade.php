<!DOCTYPE html>
<html lang="en">
<head>
	<title>{{$card->numchar}}</title>
	<style>
		html{ width: 100%; height: 100%; padding: 0; margin: 0;}
		html, body { font-family: Arial, Helvetica, sans-serif; font-size: 10pt;}
		@page { size: 8.5cm 12cm; }
		.outer-border { border: 2pt solid black; width: 100%; height: 99%; position: absolute; top: 0; left: 0; z-index: -1;}
		.main-container { margin: 0.4cm; padding: 0 }
		.header-container { text-align: center; line-height: 1; border-bottom: 2pt solid black; padding-bottom: 0.1cm}
		.header-1 { font-size: 14pt; font-weight: bold; }
		.header-2 { font-size: 12pt; line-height: 1.2}
		.header-3 { text-transform: uppercase; font-weight: bold; font-size: 10pt; }
		.header-4 { font-size: 10pt }
		.photo-container { width: 85pt; height: 113.3pt; border: 2pt double black; margin-top: 0.2cm; margin-left: auto; margin-right: auto;}
		.photo-text { margin-top: 1cm; text-align: center; font-size: 10pt}
		.biodata-container { margin-top: 0.3cm; }
		.table-biodata { width: 100%; font-weight: bold; font-size: 10pt; }
		.table-biodata tr td { vertical-align: text-top }
		.table-biodata tr td:first-child { width: 1%; white-space: nowrap}
		.two-dots { width: 1%; white-space: nowrap; padding-right: 2pt; padding-left: 5pt}
		.table-biodata tr td:last-child { border-bottom: 1pt solid black;}
		.colon { width: 0%;}
		.room-container { border: 1pt solid black; margin-top: 0.3cm; font-size: 9pt}
		.table-room { width: 100%; text-align: left; padding-left: 0}
		.table-room tr td { padding-bottom: 0.1cm; padding-top: 0.1cm }
		.room-data { line-height: 1 }
		.col-left { border-right: 1pt solid black; width: 50%}
		.col-title { font-weight: bold; text-transform: uppercase; padding: 0.2cm; text-decoration: underline}
		.col-subtitle { padding-left: 0.2cm }
		.col-data { padding-left: 0.2cm; font-weight: bold; text-transform: uppercase; }
		.table-container { margin: 0; padding: 0; position: absolute; bottom: -10pt; left: 12pt; text-transform: uppercase; font-weight: bold; font-size: 9pt}
		.table-text { border: 1pt solid black; padding: 2pt }
		.years-container {position: absolute; bottom: -10pt; right: 12pt; text-align: right; color: gray}
		
	</style>
</head>
<body>
	<div class="outer-border"><img src="{{public_path('img/app/bgcard.jpg')}}" alt=""></div>
	<div class="main-container">
		{{-- header --}}
		<div class="header-container">
			<span class="header-1">TANDA PENGENAL</span>
			<br>
			<span class="header-2">CALON SANTRI/WATI</span>
			<br>
			<span class="header-3">{{$set->prefix ? $set->prefix . ' ' : ''}}{{$set->name}}{{$set->suffix ? ' ' . $set->suffix : ''}}</span>
			<br>
			<span class="header-4">Medan - Sumatera Utara</span>
		</div>
		{{-- photo --}}
		<div class="photo-container">
			<div class="photo-text">
				PAS PHOTO<br>3X4
			</div>
		</div>
		{{-- data diri --}}
		<div class="biodata-container">
			<table class="table-biodata" cellspacing="0">
				<tr>
					<td>NO. UJIAN</td>
					<td class="two-dots">:</td>
					<td>{{$card->numchar}}</td>
				</tr>
				<tr>
					<td>NAMA</td>
					<td class="two-dots">:</td>
					<td>{{$data->name}}</td>
				</tr>
				<tr>
					<td>ASAL</td>
					<td class="two-dots">:</td>
					<td>{{$data->regschool['schkab']}}</td>
				</tr>
			</table>
		</div>
		{{-- data ruang --}}
		<div class="room-container">
			<table class="table-room" cellspacing="0" cellpadding="0">
				<tr>
					<td class="col-left">
						<span class="col-title">Ruang Belajar</span><br>
						<small class="col-subtitle">Gedung:</small><br>
						<span class="col-data">{{$card->classroom->building['name']}}</span><br>
						<span class="col-data">RUANGAN {{$card->classroom['name']}}</span>
					</td>
					<td>
						<span class="col-title">Asrama</span><br>
						<small class="col-subtitle">Gedung:</small><br>
						<span class="col-data">{{$card->room->building['name']}}</span><br>
						<span class="col-data">RUANGAN {{$card->room['name']}}</span>
					</td>
				</tr>
			</table>
		</div>
		{{-- nomor meja --}}
		<div class="table-container">
			No. Meja Makan: <span class="table-text">{{$card->foodtable['name']}}</span>
		</div>
		{{-- thn ajaran --}}
		<div class="years-container">
			PPSB {{substr($set->years, 5)}}
		</div>
		
		
	</div>
</body>
</html>