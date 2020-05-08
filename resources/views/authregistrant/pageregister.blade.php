@extends('layouts.semantic')
@section('pagetitle', ' - Registrasi Calon Santri')
@section('content')
@php $segment = Request::segment(2); @endphp
<div class="ui container">
	<div class="ui piled segment">
		<div class="ui ribbon label"><i class="phone icon"></i>{{$set->phone}} | <i class="mail icon"></i>{{$set->email}}</div>
		
		<div class="ui basic segment stackable center aligned middle aligned grid">
			<div class="three wide column">
				<img class="ui middle aligned center aligned small image" src="{{asset('img/app/' . $set->logo)}}">
			</div>
			<div class="twelve wide column">
				<div class="ui middle aligned">
					<h2 class="ui header">
						FORMULIR DATA PRIBADI CALON SANTRI/SANTRIWATI<br>
						KMI {{$set->prefix ? strtoupper($set->prefix) . ' ' : ''}}{{strtoupper($set->name)}} <br>
						TAHUN PELAJARAN {{$set->years}}
					</h2>
					<h4 class="ui header">
						{{$set->address}} - {{$set->city}}, {{$set->postal}}
					</h4>
				</div>
			</div>
		</div>

		<div class="ui divider"></div>
		
		
		@if ($set->registration == false)
		<div class="ui placeholder segment">
			
			<div class="ui icon header red">
				<i class="frown outline icon"></i>
				Pendaftaran online telah ditutup. Silahkan <a href="{{route('registrant.login')}}">login</a> ke akun anda jika telah mendaftar.
			</div>
			
		</div>
		
		@else
		
		@include('authregistrant.registerparts.stepper')
		@if ($segment == 1) @include('authregistrant.registerparts.stepone') @endif
		@if ($segment == 2) @include('authregistrant.registerparts.steptwo') @endif
		@if ($segment == 3) @include('authregistrant.registerparts.stepthree') @endif
		@if ($segment == 4) @include('authregistrant.registerparts.stepfour') @endif
		@if ($segment == 5) @include('authregistrant.registerparts.stepfive') @endif
		
		@endif
		
	</div>
</div>


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