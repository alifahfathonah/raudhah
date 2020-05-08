
<form class="ui form basic segment @if ($errors->any()) error @endif" method="POST" action="{{route('register.step.1')}}">
	@csrf
	<div class="field">
		
		@if($errors->any())
		@include('authregistrant.registerparts.errormessages')
		@else
		<div class="ui icon message info">
			<i class="close icon"></i>
			<i class="info circle icon"></i>
			<div class="content">
				<div class="header">
					Informasi.
				</div>
				<p>Sebelum melakukan pengisian formulir, mohon persiapkan berkas-berkas yang berupa: <strong>Kartu Keluarga</strong>, <strong>KTP Wali</strong>, serta <strong>Berkas Kelulusan Calon Santri</strong></p>
			</div>
		</div>
		@endif
		<input type="hidden" name="years" value="{{$set->years}}">
		
		<div class="two fields">
			<div class="field required @error('nisn') error @enderror">
				<label>Nomor Induk Sekolah Nasional (NISN)</label>
				<input type="text" name="nisn" class="numeric-input" value="{{old('nisn', '')}}">
			</div>
			<div class="field required @error('kknumber') error @enderror">
				<label>Nomor KK</label>
				<input type="text" name="kknumber" class="numeric-input" value="{{old('kknumber', '')}}">
			</div>
		</div>
		<div class="two fields">
			<div class="field required @error('username') error @enderror" id="username">
				<label>NIK Sesuai KK</label>
				<input type="text" name="username" class="numeric-input" value="{{old('username', '')}}" data-content="NIK akan digunakan sebagai username untuk login ke akun anda." data-variation="inverted" data-position="top right">
			</div>
			<div class="field required @error('password') error @enderror">
				<label>Password</label>
				<input type="password" name="password" id="password" data-content="Password akan digunakan sebagai kata sandi akun anda." data-variation="inverted" data-position="top right">
			</div>
		</div>
		<div class="two fields">
			@php $dest = ['Ar-Raudlatul Hasanah Kampus 1 Medan', 'Ar-Raudlatul Hasanah Kampus 2 LUMUT - Tapanuli Tengah',]; @endphp
			<div class="field required">
				<label>Pilihan Pesantren</label>
				<select class="ui dropdown" name="destination">
					@foreach($dest as $dst)
					<option value="{{$dst}}"{{old('destination') == $dst ? ' selected' : ''}}>{{$dst}}</option>
					@endforeach
				</select>
			</div>
			<div class="field">
				<label>Alamat Email</label>
				<input type="text" name="email" value="{{old('email', '')}}">
			</div>
			
		</div>
		
		<div class="two fields">
			<div class="field required @error('name') error @enderror">
				<label>Nama Lengkap</label>
				<input type="text" name="name" class="uppercase-input" value="{{old('name', '')}}">
			</div>
			<div class="field required @error('nickname') error @enderror">
				<label>Nama Panggilan</label>
				<input type="text" name="nickname" class="uppercase-input" value="{{old('nickname', '')}}">
			</div>
		</div>
		
		<div class="three fields">
			<div class="field required @error('birthplace') error @enderror">
				<label>Tempat Lahir</label>
				<input type="text" name="birthplace" class="uppercase-input" value="{{old('birthplace', '')}}">
			</div>
			<div class="field required @error('birthdate') error @enderror">
				<label>Tanggal Lahir</label>
				<input type="text" name="birthdate" class="date-input" value="{{old('birthdate', '')}}">
			</div>
			<div class="field">
				<label>Jenis Kelamin</label>
				<select class="ui dropdown" name="gender">
					<option value="1"{{old('gender') == 1 ? ' selected' : ''}}>Laki-laki</option>
					<option value="2"{{old('gender') == 2 ? ' selected' : ''}}>Perempuan</option>
				</select>
			</div>
		</div>
		
		<div class="three fields">
			<div class="field">
				<label>Golongan Darah</label>
				<select class="ui selection dropdown" name="bloodtype">
					@foreach ($bloodtypes as $bt)
					<option value="{{$bt}}"{{old('bloodtype') == $bt ? ' selected' : ''}}>{{$bt}}</option>
					@endforeach
				</select>
			</div>
			<div class="field">
				<label>Berat Badan</label>
				<div class="ui right labeled input">
					<input type="text" name="weight" class="numeric-input" value="{{old('weight', '')}}">
					<div class="ui basic label">kg</div>
				</div>
			</div>
			<div class="field">
				<label>Tinggi Badan</label>
				<div class="ui right labeled input">
					<input type="text" name="height" class="numeric-input" value="{{old('height', '')}}">
					<div class="ui basic label">cm</div>
				</div>
			</div>
		</div>
		
		<div class="two fields">
			<div class="field">
				<label>Hobby</label>
				<select class="ui search dropdown" name="hobby" multiple="">
					@foreach ($hobbies as $hb)
					<option value="{{$hb}}"{{!old('hobby') ? '' : in_array($hb, old('hobby')) ? ' selected' : ''}}>{{$hb}}</option>
					@endforeach
				</select>
			</div>
			<div class="field">
				<label>Cita-cita</label>
				<select class="ui search dropdown" name="wishes[]" multiple="">
					@foreach ($wishes as $ws)
					<option value="{{$ws}}"{{!old('wishes') ? '' : in_array($ws, old('wishes')) ? ' selected' : ''}}>{{$ws}}</option>
					@endforeach
				</select>
			</div>
		</div>
		
		<div class="fields">
			<div class="four wide field">
				<label>Juara Ke</label>
				<input type="text" name="achievement" class="numeric-input" value="{{old('achievement', '')}}">
			</div>
			<div class="twelve wide field">
				<label>Dari Lomba</label>
				<input type="text" name="competition" class="uppercase-input" value="{{old('competition', '')}}">		
			</div>
		</div>
		
		
		<div class="field required">
			<label>Jumlah Saudara</label>
			<div class="four fields">
				<div class="field required @error('siblings') error @enderror">
					<div class="ui labeled input">
						<div class="ui basic label">Kandung</div>
						<input type="text" name="siblings" class="numeric-input" value="{{old('siblings', '')}}">
					</div>
				</div>
				<div class="field required @error('stepsiblings') error @enderror">
					<div class="ui labeled input">
						<div class="ui basic label">Tiri</div>
						<input type="text" name="stepsiblings" class="numeric-input" value="{{old('stepsiblings', '')}}">
					</div>
				</div>
				<div class="field required @error('totalsiblings') error @enderror">
					<div class="ui labeled input">
						<div class="ui basic label">Total</div>
						<input type="text" name="totalsiblings" class="numeric-input" value="{{old('totalsiblings', '')}}" readonly>
					</div>
				</div>
				<div class="field required @error('numposition') error @enderror">
					<div class="ui labeled input">
						<div class="ui basic label">Anak Ke</div>
						<input type="text" name="numposition" class="numeric-input" value="{{old('numposition', '')}}">
					</div>
				</div>
			</div>
		</div>
		
	</div>
	
	
	
	<div class="ui basic segment">
		<button type="submit" class="ui submit right floated primary button large">
			Selanjutnya <i class="right arrow icon"></i> 
		</button>
	</div>
	
	<div class="ui basic segment"></div>
</form>
