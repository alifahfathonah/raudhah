@extends('layouts.semantic')
@section('pagetitle', ' - Dashboard Calon Santri')

@section('content')

<div class="ui basic segment"></div>

<div class="ui container raised segment">
	
	<div class="ui basic segment">
		<h2 class="ui header">Selamat datang, {{ucwords(strtolower(Auth::user()->name))}}.</h2>
		<div class="sub header">Berikut ini panduan tahapan lanjutan proses pendaftaran calon santri baru {{$set->prefix ? $set->prefix.' ' : ''}}{{$set->name}}{{$set->suffix ? ' '.$set->suffix : ''}}.</div>
	</div>
	
	<div class="ui divider"></div>
	
	@php $s = Auth::user()->regstep['steppay']; @endphp
	
	<div class="ui three top attached steps">
		<div class="step @if($s == 1) active @endif @if($s > 1) completed @endif @if($s < 1) disabled @endif">
			<i class="payment icon"></i>
			<div class="content">
				<div class="title">Pembayaran</div>
				<div class="description">Pembayaran uang pendaftaran.</div>
			</div>
		</div>
		<div class="step @if($s == 2) active @endif @if($s > 2) completed @endif @if($s < 2) disabled @endif">
			<i class="handshake icon"></i>
			<div class="content">
				<div class="title">Verifikasi</div>
				<div class="description">Verifikasi pembayaran.</div>
			</div>
		</div>
		<div class="step @if($s == 3) active @endif @if($s > 3) completed @endif @if($s < 3) disabled @endif">
			<i class="download icon"></i>
			<div class="content">
				<div class="title">Download</div>
				<div class="description">Download kartu ujian.</div>
			</div>
		</div>
	</div>
	
	{{-- step 1 --}}
	@if($s == 1)
	@include('pagesregistrant.parts.stepone')
	@endif
	
	{{-- step 2 --}}
	@if($s == 2)
	@include('pagesregistrant.parts.steptwo')
	@endif
	
	{{-- step 3 --}}
	@if($s == 3)
	@include('pagesregistrant.parts.stepthree')
	@endif
	
	<div class="ui modal" id="modalBT">
		<div class="header">Contoh Nomor Transaksi</div>
		<div class="segment middle aligned">
			<div class="image content">
				<img class="ui fluid image" src="{{asset('img/app/norefsample.png')}}">
				<div class="description">
					<p></p>
				</div>
			</div>
		</div>
	</div>
	
	@endsection
	
	@section('pagescript')
	<script>
		$("#back").click(function(e){
			e.preventDefault();
			$("#form-two").attr("action", "{{route('registrant.paystep.back')}}").submit();
		});
		
		function modalbt(){
			$("#modalBT").modal('show');
		}
		
		$("#payimg").change(function(e){
			e.preventDefault();
			var file = $(this).val();
			var filename = file.split(/(\\|\/)/g).pop();
			$("#btntext").html(filename);
			$("#iconuploadimg").removeClass("upload");
			$("#iconuploadimg").addClass("check");
		});
	</script>
	@endsection
	
	
	
	
	
	{{-- 
		<div class="ui warning message">
			<div class="header">
				Penting!
			</div>
			Pastikan anda melakukan transfer melalui ATM atau Mobile Banking dikarenakan proses verifikasi pembayaran menggunakan <strong>NOMOR TRANSAKSI</strong> atau <strong>NOMOR REFERENSI</strong> yang tertera pada bukti transfer tersebut. <a href="#" onclick="modalbt()">Contoh nomor transaksi pada bukti transfer</a>.
		</div>		
		
		--}}