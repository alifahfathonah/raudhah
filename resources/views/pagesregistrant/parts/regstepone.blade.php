
<form class="ui form basic segment @if ($errors->any()) error @endif" method="POST" action="{{route('register.step.1')}}">
	@csrf
	<div class="field">
		
		@if($errors->any())
		@include('pagesregistrant.parts.errormessages')
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
				<label>NISN Sesuai Rapor</label>
				<input type="text" name="nisn" class="nisn-input" value="{{old('nisn', '')}}" placeholder="10 digit Nomor Induk Siswa Nasional">
				<small><a href="https://referensi.data.kemdikbud.go.id/nisn/index.php/Cindex/formcaribynama" target="_blank">Klik disini untuk pencarian online.</a></small>
			</div>
			<div class="field required @error('kknumber') error @enderror">
				<label>Nomor KK</label>
				<input type="text" name="kknumber" class="digit-input" value="{{old('kknumber', '')}}" placeholder="16 digit Nomor Kartu Keluarga">
			</div>
		</div>
		<div class="two fields">
			<div class="field required @error('username') error @enderror" id="username">
				<label>NIK Sesuai KK</label>
				<input type="text" name="username" class="digit-input" value="{{old('username', '')}}" data-content="NIK akan digunakan sebagai username untuk login ke akun anda." data-variation="inverted" data-position="top right" placeholder="16 digit Nomor Induk Kependudukan">
			</div>
			<div class="field required @error('password') error @enderror">
				<label>Password</label>
				<input type="password" name="password" id="password" data-content="Password akan digunakan sebagai kata sandi akun anda." data-variation="inverted" data-position="top right" placeholder="Kata sandi untuk akun pendaftaran">
			</div>
		</div>
		<div class="two fields">
			@php $dest = ['RAUDHAH 1 - MEDAN', 'RAUDHAH 2 - LUMUT (TAPANULI TENGAH)',]; @endphp
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
				<input type="text" name="email" value="{{old('email', '')}}" placeholder="Kosongkan jika tidak ada">
			</div>
			
		</div>
		
		<div class="two fields">
			<div class="field required @error('name') error @enderror">
				<label>Nama Lengkap</label>
				<input type="text" name="name" class="uppercase-input" value="{{old('name', '')}}" placeholder="Nama calon santri sesuai ijazah">
			</div>
			<div class="field required @error('nickname') error @enderror">
				<label>Nama Panggilan</label>
				<input type="text" name="nickname" class="uppercase-input" value="{{old('nickname', '')}}" placeholder="Nama panggilan sehari-hari">
			</div>
		</div>
		
		<div class="three fields">
			<div class="field required @error('birthplace') error @enderror">
				<label>Tempat Lahir</label>
				<input type="text" name="birthplace" class="uppercase-input" value="{{old('birthplace', '')}}" placeholder="Nama kota/daerah kelahiran">
			</div>
			<div class="field required @error('birthdate') error @enderror">
				<label>Tanggal Lahir</label>
				<input type="text" name="birthdate" class="date-input" value="{{old('birthdate', '')}}" placeholder="Tanggal/Bulan/Tahun">
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
					<option value="" selected disabled>Kosongkan jika tidak tahu</option>
					@foreach ($bloodtypes as $bt)
					<option value="{{$bt}}"{{old('bloodtype') == $bt ? ' selected' : ''}}>{{$bt}}</option>
					@endforeach
				</select>
			</div>
			<div class="field">
				<label>Berat Badan</label>
				<div class="ui right labeled input">
					<input type="text" name="weight" class="numeric-input" value="{{old('weight', '')}}" placeholder="Kosongkan jika tidak tahu">
					<div class="ui basic label">kg</div>
				</div>
			</div>
			<div class="field">
				<label>Tinggi Badan</label>
				<div class="ui right labeled input">
					<input type="text" name="height" class="numeric-input" value="{{old('height', '')}}" placeholder="Kosongkan jika tidak tahu">
					<div class="ui basic label">cm</div>
				</div>
			</div>
		</div>
		
		<div class="two fields">
			<div class="field">
				<label>Hobby</label>
				<select class="ui search dropdown" name="hobby[]" multiple="">
					<option value="" selected disabled>Kosongkan jika tidak ada</option>
					@foreach ($hobbies as $hb)
					<option value="{{$hb}}"{{!old('hobby') ? '' : in_array($hb, old('hobby')) ? ' selected' : ''}}>{{$hb}}</option>
					@endforeach
				</select>
			</div>
			<div class="field">
				<label>Cita-cita</label>
				<select class="ui search dropdown" name="wishes[]" multiple="">
					<option value="" selected disabled>Kosongkan jika tidak ada</option>
					@foreach ($wishes as $ws)
					<option value="{{$ws}}"{{!old('wishes') ? '' : in_array($ws, old('wishes')) ? ' selected' : ''}}>{{$ws}}</option>
					@endforeach
				</select>
			</div>
		</div>
		
		<div class="fields">
			<div class="four wide field">
				<label>Juara Ke</label>
				<input type="text" name="achievement" class="numeric-input" value="{{old('achievement', '')}}" placeholder="Nomor peringkat">
			</div>
			<div class="twelve wide field">
				<label>Dari Lomba</label>
				<input type="text" name="competition" class="uppercase-input" value="{{old('competition', '')}}" placeholder="Nama lomba/kompetisi">		
			</div>
		</div>
		
		
		<div class="field required">
			<label>Jumlah Saudara</label>
			<div class="four fields">
				<div class="field required @error('siblings') error @enderror">
					<div class="ui labeled input">
						<div class="ui basic label">Kandung</div>
						<input type="text" name="siblings" class="numeric-input" value="{{old('siblings', '')}}" placeholder="Isi 0 jika tidak ada">
					</div>
				</div>
				<div class="field required @error('stepsiblings') error @enderror">
					<div class="ui labeled input">
						<div class="ui basic label">Tiri</div>
						<input type="text" name="stepsiblings" class="numeric-input" value="{{old('stepsiblings', '')}}" placeholder="Isi 0 jika tidak ada">
					</div>
				</div>
				<div class="field required @error('totalsiblings') error @enderror">
					<div class="ui labeled input">
						<div class="ui basic label">Total</div>
						<input type="text" name="totalsiblings" class="numeric-input" value="{{old('totalsiblings', '')}}" readonly placeholder="Saudara kandung + tiri">
					</div>
				</div>
				<div class="field required @error('numposition') error @enderror">
					<div class="ui labeled input">
						<div class="ui basic label">Anak Ke</div>
						<input type="text" name="numposition" class="numeric-input" value="{{old('numposition', '')}}" placeholder="Isi 1 jika anak tunggal">
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
