<!DOCTYPE html>
<html lang="en">
<head>
	<title>{{$card->numchar}}</title>
	<style>
		html, body {
			font-family: Arial, Helvetica, sans-serif;
		}
		.container{
			margin: 2cm;
			padding: 1cm 1cm 0.5cm 1cm;
			border: 1px solid black;
		}
		.kop{
			text-align: center;
			line-height: .2rem;
		}
		.normal-text {
			font-weight: normal;
		}
		.uppercase {
			text-transform: uppercase;
		}
		.capitalize {
			text-transform: capitalize;
		}
		.spacer {
			height: 0.8cm;
		}
		.pas-photo {
			width: 3cm;
			height: 4cm;
			border: 1px solid black;
			margin-left: auto;
			margin-right: auto;
		}
		.pas-photo-text {
			text-align: center;
			padding-top: 1.5cm; 
		}
		table.biodata {
			border: 0;
			font-size: 14pt;
			font-weight: bold;
			width: 100%;
		}
		.colon{
			width: 0.3cm;
		}
		.first-td {
			width: 3.5cm;
		}
		.parentdiv:after {
			content: "";
			display: table;
			clear: both;
		}
		.col{
			border: 1px solid black;
			float: left;
			width: 50%;
		}
		.text-col {
			padding-left: 0.3cm;
		}
		.detail {
			padding-bottom: 0.3cm;
		}
	</style>
</head>
<body>
	
	<div class="container">
		<div class="kop">
			<h2>TANDA PENGENAL</h2>
			<h3 class="normal-text">CALON SANTRI/WATI</h3>
			<h3 class="uppercase">{{$set->prefix ? $set->prefix . ' ' : ''}}{{$set->name}}{{$set->suffix ? ' ' . $set->suffix : ''}}</h3>
			<h3 class="normal-text">MEDAN - SUMATERA UTARA</h3>
		</div>
		<div class="spacer"></div>
		<div class="pas-photo">
			<div class="pas-photo-text">Pas Photo <br> 3 x 4</div>
		</div>
		<div class="spacer"></div>
		<table class="biodata">
			<tr>
				<td class="first-td">No. Ujian</td>
				<td class="colon">:</td>
				<td>{{$card->numchar}}</td>
			</tr>
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td>{{$data->name}}</td>
			</tr>
			<tr>
				<td>Asal Daerah</td>
				<td>:</td>
				<td class="capitalize">{{strtolower($data->regschool['schkab'])}}, {{strtolower($data->regschool['schprov'])}}</td>
			</tr>
		</table>
		
		<div class="spacer"></div>
		
		<div class="parentdiv">
			<div class="col">
				<h3 class="text-col">Ruang Belajar</h3>
				<table class="text-col detail">
					<tr>
						<td>Gedung</td>
						<td>:</td>
						<td>{{$card->classroom->building['name']}}</td>
					</tr>
					<tr>
						<td>Ruang</td>
						<td>:</td>
						<td>{{$card->classroom['name']}}</td>
					</tr>
				</table>
			</div>
			<div class="col">
				<h3 class="text-col">Asrama</h3>
				<table class="text-col detail">
					<tr>
						<td>Gedung</td>
						<td>:</td>
						<td>{{$card->room->building['name']}}</td>
					</tr>
					<tr>
						<td>Ruang</td>
						<td>:</td>
						<td>{{$card->room['name']}}</td>
					</tr>
				</table>
			</div>
		</div>
		
		<div class="meja">
			<h4>No. Meja Makan: {{$card->foodtable['name']}}</h4>
		</div>
		
	</div>
	
</body>
</html>