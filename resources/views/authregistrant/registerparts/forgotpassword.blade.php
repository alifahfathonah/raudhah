@extends('layouts.semantic')
@section('pagetitle', ' - Lupa Password')
@section('content')
<div class="ui middle aligned center aligned grid">
	<div class="column" style="max-width:600px;padding-top:40px;padding-bottom:40px;">
		<h2 class="ui header">
			<div class="content">
				Lupa Password.
			</div>
		</h2>
		@if($errors->any())
		<div class="ui error message segment left aligned">
			<i class="close icon"></i>
			<div class="header">Error! Mohon periksa kembali data yang anda isi.</div>
			<ul class="list">
				@if (count($errors) > 3)
					<li>Setiap kolom yang bertanda bintang ( <strong>*</strong> ) tidak boleh dikosongkan.</li>
					<li>Periksa kembali isi setiap kolom yang ditandai dengan warna merah.</li>
				@else
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
				@endif
			</ul>
		</div>
		@else
		<div class="ui positive message">
			<p>Isi data-data berikut ini untuk menyetel ulang password anda.</p>
		</div>
		@endif
		
		<form class="ui large form @if ($errors->any()) error @endif" method="POST" action="{{route('registrant.forgot.submit')}}">
			@csrf
			<div class="ui raised segment left aligned">
				{{-- no nisn --}}
				<div class="field @error('nisn') error @enderror required">
					<label>Nomor Induk Sekolah Nasional (NISN)</label>
					<div class="ui left icon input">
						<i class="credit card icon"></i>
						<input type="text" name="nisn" value="{{old('nisn')}}" class="nisn-input">
					</div>
				</div>
				{{-- no kk --}}
				<div class="field @error('kknumber') error @enderror required">
					<label>Nomor Kartu Keluarga</label>
					<div class="ui left icon input">
						<i class="users icon"></i>
						<input type="text" name="kknumber" value="{{old('kknumber')}}" class="numeric-input">
					</div>
				</div>
				{{-- username/NIK --}}
				<div class="field @error('username') error @enderror required">
					<label>Nomor Induk Kependudukan (NIK)</label>
					<div class="ui left icon input">
						<i class="user icon"></i>
						<input type="text" name="username" value="{{old('username')}}" class="numeric-input">
					</div>
				</div>
				
				
				{{-- password baru --}}
				<div class="field @error('password') error @enderror required">
					<label>Password Baru</label>
					<div class="ui left icon input">
						<i class="lock icon"></i>
						<input type="password" name="password" value="{{old('password')}}" id="newpassword">
					</div>
				</div>
				
				<div class="inline field">
					<div class="ui checkbox" id="togglePassword">
						<input type="checkbox" tabindex="0" class="hidden">
						<label>Tampilkan Password</label>
					</div>
				</div>
				
				<div class="ui divider"></div>
				
				<button type="submit" class="ui fluid large negative submit button">Reset Password</button>
			</div>
			
		</form>
		
	</div>
</div>
@endsection

@section('pagescript')
<script>
	$("#togglePassword").click(function(){
		var check = $(this).find('input').is(':checked');
		if(check == false){
			$("#newpassword").attr('type', 'text');
		} else {
			$("#newpassword").attr('type', 'password');
		}
	});
</script>
@endsection