<div class="ui middle aligned center aligned grid">
	<div class="column" style="max-width:600px;padding-top:40px;padding-bottom:40px;">
		<h2 class="ui header">
			
			<div class="content">
				@if(Request::segment(1) == 'register')
				Registrasi berhasil.
				@else
				Login Calon Santri
				@endif
			</div>
		</h2>
		@if(Request::segment(1) == 'register')
		<div class="ui positive message">
			<p>Silahkan login untuk melanjutkan ke tahapan berikutnya.</p>
		</div>
		@endif
		@if(session('success'))	
		<div class="ui positive message">
			<p>{{session('success')}}</p>
		</div>
		@endif
		@if(session('invalid'))	
		<div class="ui negative message">
			<p>{{session('invalid')}}</p>
		</div>
		@endif
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
		@endif
		<form class="ui large form @if ($errors->any()) error @endif" method="POST" action="{{route('registrant.login.submit')}}">
			@csrf
			<div class="ui raised segment left aligned">
				<div class="field @error('username') error @enderror required">
					<label>NIK Calon Santri</label>
					<div class="ui left icon input">
						<i class="user icon"></i>
						<input type="text" name="username" placeholder="16 digit Nomor Induk Kependudukan" class="digit-input" value="{{old('username')}}" class="numeric-input">
					</div>
				</div>
				<div class="field @error('password') error @enderror required">
					<label>Login Password</label>
					<div class="ui left icon input">
						<i class="lock icon"></i>
						<input type="password" name="password" placeholder="Kata sandi akun">
					</div>
				</div>
				<button type="submit" class="ui fluid large positive submit button">Login</button>
			</div>
			
			
			
		</form>
		
		<div class="ui message">
			Lupa password? <a href="{{route('registrant.forgot')}}">Klik disini.</a>
		</div>
	</div>
</div>