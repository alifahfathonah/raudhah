@extends('layouts.frontend')
@section('pagetitle', '- Registrasi Online')
@section('content')
<input type="hidden" type="text" id="tokenapi" value="">
<!-- Card -->
<div class="card card-cascade wider reverse mb-5">
	
	<!-- Card image -->
	<div class="view view-cascade overlay">
		<img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Slides/img%20(70).jpg" alt="Card image cap" style="height: 250px; box-fit: cover">
		<a href="#!">
			<div class="mask rgba-white-slight"></div>
		</a>
	</div>
	
	<!-- Card content -->
	<div class="card-body card-body-cascade">
		<!-- Title -->
		<h4 class="card-title">
			<strong>Formulir Pendaftaran Calon Santri</strong>
		</h4>
		@php
		$step = Request::segment(2);
		@endphp
		<form role="form" action="" method="post" id="formreg">
			@csrf
			<ul class="stepper linear mx-4">
				
				<li class="step{{$step == 1 ? ' active' : ''}}">
					<div data-step-label="Isi sesuai data kependudukan." class="step-title waves-effect waves-dark">Data Diri</div>
					<div class="step-new-content">
						
						@include('authregistrant.registerparts.stepone')
						
						<div class="step-actions mt-4">
							<button class="waves-effect waves-dark btn btn-primary next-step ml-auto" data-feedback="processStepOne">SELANJUTNYA</button>
						</div>
					</div>
				</li>
				
				<li class="step{{$step == 2 ? ' active' : ''}}">
					<div class="step-title waves-effect waves-dark">Data Saudara</div>
					<div class="step-new-content">
						
						@include('authregistrant.registerparts.steptwo')
						
						<div class="step-actions mt-4">
							<button class="waves-effect waves-dark btn btn-secondary previous-step">KEMBALI</button>
							<button class="waves-effect waves-dark btn btn-primary next-step ml-auto" data-feedback="processStepTwo">SELANJUTNYA</button>
						</div>
					</div>
				</li>
				
				<li class="step{{$step == 3 ? ' active' : ''}}">
					<div class="step-title waves-effect waves-dark">Data Asal Sekolah</div>
					<div class="step-new-content">
						
						@include('authregistrant.registerparts.stepthree')
						
						<div class="step-actions mt-4">
							<button class="waves-effect waves-dark btn btn-secondary previous-step">KEMBALI</button>
							<button class="waves-effect waves-dark btn btn-primary next-step ml-auto" data-feedback="processStepThree">SELANJUTNYA</button>
						</div>
					</div>
				</li>
				
				<li class="step">
					<div class="step-title waves-effect waves-dark">Step 3</div>
					<div class="step-new-content">
						Finish!
						<div class="step-actions">
							<button class="waves-effect waves-dark btn btn-sm btn-primary m-0 mt-4" type="button">SUBMIT</button>
						</div>
					</div>
				</li>
				
				
			</ul>
		</form>
	</div>
</div>


@endsection

@section('pagescript')
<script src="{{asset('vendor/cleave/cleave.min.js')}}"></script>
<script src="{{asset('vendor/cleave/phone-type-formatter.id.js')}}"></script>
<script src="{{asset('front/js/ajaxregister.js')}}"></script>
<script>
	
	
	// cleave numeric
	$('.numeric-input').toArray().forEach(function(field){
		new Cleave(field, {
			numeral: true,
			numericOnly: true,
			delimiter: ''
		});
	});
	// cleave date
	$('.date-input').toArray().forEach(function(field){
		new Cleave(field, {
			date: true,
			datePattern: ['d', 'm', 'Y']
		});
	});
	// cleave phone
	$('.phone-input').toArray().forEach(function(field){
		new Cleave(field, {
			phone: true,
			phoneRegionCode: 'ID',
		});
	});
	// text uppercase
	$(".uppercase-input").keyup(function () {
		this.value = this.value.toLocaleUpperCase();
	});
	// siblings
	var sdrk = 0;
	var sdrt = 0;
	var sdrttl = $("#totalsiblings");
	$("#siblings").keyup(function(){
		if($(this).val()) sdrk = parseInt($(this).val()); else sdrk = 0;
		if(sdrk > 0 && sdrt == 0) {sdrttl.val(sdrk)}
		else if(sdrk == 0 && sdrt > 0){sdrttl.val(sdrt)}
		else if(sdrk >0 && sdrt > 0) {sdrttl.val(sdrk + sdrt)}
		else {sdrttl.val(0)}
	});
	$("#stepsiblings").keyup(function(){
		if($(this).val()) sdrt = parseInt($(this).val()); else sdrt = 0;
		if(sdrk > 0 && sdrt == 0) {sdrttl.val(sdrk)}
		else if(sdrk == 0 && sdrt > 0){sdrttl.val(sdrt)}
		else if(sdrk >0 && sdrt > 0) {sdrttl.val(sdrk + sdrt)}
		else {sdrttl.val(0)}
	});
	
	
	// 
	function processStepOne() {
		// 
		$("#formreg").attr('action', '{{route('register.step.one')}}');
		$("#formreg").submit();
	}
	function processStepTwo() {
		// 
		$("#formreg").attr('action', '{{route('register.step.two')}}');
		$("#formreg").submit();
	}
	function processStepThree() {
		// 
		$("#formreg").attr('action', '{{route('register.step.three')}}');
		$("#formreg").submit();
	}
	
	// document ready
	$(document).ready(function () {
		$('.stepper').mdbStepper();
		$('.mdb-select').materialSelect();
		
		// get token api
		$.ajax({
			type: "GET",
			url: "https://x.rajaapi.com/poe",
			dataType: "json",
			success: function(res){
				getProvinsi(res.token);
			},
		});
		
		// ---
	});
</script>

<script>
	
	// get provinsi
	function getProvinsi(token){
		$.ajax({
			type: "GET",
			url: "https://x.rajaapi.com/MeP7c5ne"+ token +"/m/wilayah/provinsi",
			dataType: "json",
			success: function(provs) {
				// console.log(provs.data);
				$.each(provs.data, function(i, v){
					$("#schprov").append('<option selected disabled></option><option value="'+ v.id +'">'+ v.name +'</option>');
				})
			}
		});
		
		$("#schprov").change(function(){
			$("#schkab").empty();
			$("#schkec").empty();
			$("#schdesa").empty();
			var id = $(this).val();
			getKabupaten(token, id);
		});
		$("#schkab").change(function(){
			$("#schkec").empty();
			$("#schdesa").empty();
			var id = $(this).val();
			getKecamatan(token, id);
		});
		$("#schkec").change(function(){
			$("#schkel").empty();
			var id = $(this).val();
			getKelurahan(token, id);
		});
	}
	// get kabupaten
	function getKabupaten(token, id){
		$.ajax({
			type: "GET",
			url: "https://x.rajaapi.com/MeP7c5ne"+ token +"/m/wilayah/kabupaten?idpropinsi="+ id,
			dataType: "json",
			success: function(kabs) {
				$.each(kabs.data, function(i, v){
					$("#schkab").append('<option selected disabled></option><option value="'+ v.id +'">'+ v.name +'</option>');
				});
				$("#schkab").materialSelect();
			}
		});
	}
	// get kecamatan
	function getKecamatan(token, id){
		$.ajax({
			type: "GET",
			url: "https://x.rajaapi.com/MeP7c5ne"+ token +"/m/wilayah/kecamatan?idkabupaten="+ id,
			dataType: "json",
			success: function(kecs) {
				$.each(kecs.data, function(i, v){
					$("#schkec").append('<option selected disabled></option><option value="'+ v.id +'">'+ v.name +'</option>');
				});
				$("#schkec").materialSelect();
			}
		});
	}
	// get desa
	function getKelurahan(token, id){
		$.ajax({
			type: "GET",
			url: "https://x.rajaapi.com/MeP7c5ne"+ token +"/m/wilayah/kelurahan?idkecamatan=" + id,
			dataType: "json",
			success: function(kels) {
				$.each(kels.data, function(i, v){
					$("#schkel").append('<option selected disabled></option><option value="'+ v.id +'">'+ v.name +'</option>');
				});
				$("#schkel").materialSelect();
			}
		});
	}
</script>
@endsection
