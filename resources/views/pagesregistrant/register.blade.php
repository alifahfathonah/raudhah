@extends('layouts.semantic')
@section('pagetitle', ' - Registrasi Calon Santri')
@section('content')

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
			
			<div class="ui icon header">
				<i class="cogs icon"></i>
				<h2 style="color:red !important">{{$set->message}}</h2>
				<span>Silahkan <a href="{{route('registrant.login')}}">login</a> ke akun anda jika telah mendaftar.</span>
			</div>
			
		</div>
		
		@else
		
		{{-- stepper --}}
		
		<div class="ui ordered four steps">
			<div class="step teal active">
				<div class="content">
					<div class="title">Biodata</div>
					<div class="description">Data diri calon santri.</div>
				</div>
			</div>
			<div class="step disabled">
				<div class="content">
					<div class="title">Saudara</div>
					<div class="description">Data saudara kandung/tiri.</div>
				</div>
			</div>
			<div class="step disabled">
				<div class="content">
					<div class="title">Asal Sekolah</div>
					<div class="description">Tamatan/pindahan sekolah.</div>
				</div>
			</div>
			<div class="step disabled">
				<div class="content">
					<div class="title">Orang Tua</div>
					<div class="description">Data orang tua kandung.</div>
				</div>
			</div>
		</div>
		
		
		
		@include('pagesregistrant.parts.regstepone')
		
		@endif
		
	</div>
</div>


@endsection

@section('pagescript')
<script>
	$("#username").keyup(function(){
		var val = $("input[name='username']").val();
		checkInputAjax('username', val, '#username');
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