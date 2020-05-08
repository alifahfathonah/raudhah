<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="author" content="Khairi Ibnutama,S.Kom., M.Kom.">
	<meta name="description" content="">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="{{asset('semantic/css/semantic.css')}}">
	<link rel="stylesheet" href="{{asset('semantic/css/custom.css')}}">
	<title>{{$set->name}} @yield('pagetitle')</title>
</head>
<body>
	
	@include('authregistrant.registerparts.navbar')

	
	@yield('content')
	
	
	<script src="{{asset('semantic/js/jquery.min.js')}}"></script>
	<script src="{{asset('semantic/js/semantic.js')}}"></script>
	<script src="{{asset('semantic/js/cleave/cleave.min.js')}}"></script>
	<script src="{{asset('semantic/js/cleave/phone-type-formatter.id.js')}}"></script>
	<script src="{{asset('semantic/js/ajaxwilayah.js')}}"></script>
	<script>
		// document ready
		$(document).ready(function(){
			
			$('.message .close').on('click', function() {
				$(this).closest('.message').transition('fade');
			});
			$('select.dropdown').dropdown();
			$('#logoutmenu').dropdown();
			$('.ui.radio.checkbox').checkbox();
			$('.ui.checkbox').checkbox();
			// $("#form-pembiaya").hide();
			if($("#pindahantrue").is(":checked")){
				$("#form-pindahan").show();
			} else {
				$("#form-pindahan").hide();
			}
			if($("#pembiayaanfalse").is(":checked")){
				$("#form-pembiaya").show();
			} else {
				$("#form-pembiaya").hide();
			}
			if($("#serumahfalse").is(":checked")){
				$("#form-serumah").show();
			} else {
				$("#form-serumah").hide();
			}
			
			// get token api
			$.ajax({
				type: "GET",
				url: "https://x.rajaapi.com/poe",
				dataType: "json",
				success: function(res){
					getProvinsi(res.token);
				},
			});
			
		});
		// cleave numeric
		$('.numeric-input').toArray().forEach(function(field){
			new Cleave(field, {
				numeral: true,
				numericOnly: true,
				delimiter: ''
			});
		});
		// cleave digit
		$('.digit-input').toArray().forEach(function(field){
			new Cleave(field, {
				numericOnly: true,
				blocks: [16],
			});
		});
		// cleave nisn
		$('.nisn-input').toArray().forEach(function(field){
			new Cleave(field, {
				numericOnly: true,
				blocks: [10],
			});
		});
		// cleave currency
		$('.currency-input').toArray().forEach(function(field){
			new Cleave(field, {
				numeral: true,
				numeralDecimalMark: ',',
				delimiter: '.'
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
		// popup
		$("#password").popup();
		$("input[name='username']").popup();
	</script>
	
	@yield('pagescript')

	
</body>
</html>