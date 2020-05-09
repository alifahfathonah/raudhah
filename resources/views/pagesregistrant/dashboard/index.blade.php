@extends('layouts.semantic')
@section('pagetitle', ' - Dashboard Calon Santri')

@section('content')

<div class="ui basic segment"></div>

<div class="ui container raised segment">
	
	<div class="ui basic segment">
		<div class="ui header">
			<div class="content">
				Selamat datang, <span class="sitecolor">{{ucwords(strtolower(Auth::user()->name))}}</span>
				<div class="sub header">Untuk proses pembayaran uang pendaftaran, silahkan ikuti tahapan-tahapan yang tertera di bawah ini.</div>
			</div>
		</div>
	</div>
	
	<div class="ui divider"></div>
	
	@php
	//$s = Auth::user()->regstep['steppay']; 
	$v = Auth::user()->isverified;
	@endphp
	
	@if(Auth::user()->isverified == true && Auth::user()->regstep['steppay'] == 2)
	{{-- @if(Auth::user()->isverified == true) --}}
	{{-- verified --}}
	@include('pagesregistrant.parts.steptwo')
	@else
	{{-- new account --}}
	@include('pagesregistrant.parts.stepone')

	@endif
	
	@endsection
	