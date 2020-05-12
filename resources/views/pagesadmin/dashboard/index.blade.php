@extends('layouts.admin')
@section('contents')
<!-- Content Row -->

<div class="row">
	@php
	$datas = array(
	array('dark', 'user-friends', 'Pendaftar', $registrants->count(), 'Calon Santri'),
	array('success', 'user-check', 'Verified', $verified->count(), 'Pembayaran Terverifikasi'),
	array('secondary', 'user-lock', 'Pending', $pending->count(), 'Pembayaran Pending'),
	);
	@endphp
	@foreach ($datas as $data)
	
	<div class="col-lg-4 mb-4">
		<div class="card border-left-{{$data[0]}} shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-{{$data[0]}} text-uppercase mb-1">{{$data[2]}}</div>
						<div class="h1 mb-0 font-weight-bold text-gray-800">{{$data[3]}}</div>
						<div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">{{$data[4]}}</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-{{$data[1]}} fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endforeach
</div>


<div class="row">
	@php
	$danas = array(
	array('info', 'money-bill-wave', 'Saldo', 'Rp. ' . number_format($set['cost'] * $verified->count(),0,",","."), 'Dana Terkumpul'),
	array('danger', 'user-cog', 'Waiting', $verified->count() - $examcards->count(), 'Menunggu Kartu Ujian'),
	);
	@endphp
	@foreach ($danas as $dana)
	
	<div class="col-lg-6 mb-4">
		<div class="card border-left-{{$dana[0]}} shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-{{$dana[0]}} text-uppercase mb-1">{{$dana[2]}}</div>
						<div class="h1 mb-0 font-weight-bold text-gray-800">{{$dana[3]}}</div>
						<div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">{{$dana[4]}}</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-{{$dana[1]}} fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endforeach
</div>

<div class="row">
	
	@php
	$cards = array(
	// color, icon, title, number, desc
	array('primary', 'user', 'Pegawai', $users->count(), 'Akun pegawai'),
	array('success', 'school', 'Gedung', $buildings->count(), 'Gedung Pesantren'),
	array('info', 'warehouse', 'Asrama', $rooms->count(), 'Ruangan Asrama'),
	array('warning', 'store-alt', 'Kelas', $classrooms->count(), 'Ruangan Belajar'),
	);
	@endphp
	
	@foreach ($cards as $card)
	<div class="col-lg-3 col-md-6 mb-4">
		<div class="card border-left-{{$card[0]}} shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-{{$card[0]}} text-uppercase mb-1">{{$card[2]}}</div>
						<div class="h1 mb-0 font-weight-bold text-gray-800">{{$card[3]}}</div>
						<div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">{{$card[4]}}</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-{{$card[1]}} fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endforeach
	
</div>
@endsection