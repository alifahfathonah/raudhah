

<form class="ui form basic segment @if ($errors->any()) error @endif" method="POST" action="{{route('register.step.3')}}">
	@csrf
	<div class="field">
		
		@include('pagesregistrant.parts.errormessages')
		
		<div class="fields">
			<div class="four wide field required">
				<label>Lulus Dari Sekolah</label>
				<select class="ui dropdown" name="schfrom">
					<option value="NEGERI"{{old('schfrom') == 'NEGERI' ? ' selected' : ''}}>NEGERI</option>
					<option value="SWASTA"{{old('schfrom') == 'SWASTA' ? ' selected' : ''}}>SWASTA</option>
				</select>
			</div>
			<div class="four wide field required">
				<label>Tingkat</label>
				<select class="ui dropdown" name="schlvl">
					<option value="SD"{{old('schlvl') == 'SD' ? ' selected' : ''}}>SD</option>
					<option value="SMP"{{old('schlvl') == 'SMP' ? ' selected' : ''}}>SMP</option>
				</select>
			</div>
			<div class="ten wide field required @error('schname') error @enderror">
				<label>Nama Sekolah</label>
				<input type="text" name="schname" class="uppercase-input" value="{{old('schname', '')}}" placeholder="Nama sekolah asal">
			</div>
		</div>
		
		<div class="field required @error('schstreet') error @enderror">
			<label>Alamat Sekolah</label>
			<input type="text" name="schstreet" class="uppercase-input" value="{{old('schstreet', '')}}" placeholder="Nama jalan, nomor, lingkungan/wilayah">
		</div>		
		
		<div class="four fields">
			<div class="field required @error('schprov') error @enderror">
				<label>Provinsi</label>
				<select class="ui search dropdown" id="selprov">
					<option value="" selected disabled>Pilih Provinsi</option>
				</select>
			</div>
			<input type="hidden" name="schprov" value="">
			<div class="field required @error('schkab') error @enderror">
				<label>Kota/Kabupaten</label>
				<select class="ui search dropdown" id="selkab">
					<option value="" selected disabled>Pilih Kota/Kabupaten</option>
				</select>
			</div>
			<input type="hidden" name="schkab" value="">
			<div class="field required @error('schkec') error @enderror">
				<label>Kecamatan</label>
				<select class="ui search dropdown" id="selkec">
					<option value="" selected disabled>Pilih Kecamatan</option>
				</select>
			</div>
			<input type="hidden" name="schkec" value="">
			<div class="field required @error('schkel') error @enderror">
				<label>Desa/Kelurahan</label>
				<select class="ui search dropdown" id="selkel">
					<option value="" selected disabled>Pilih Desa/Kelurahan</option>
				</select>
			</div>
			<input type="hidden" name="schkel" value="">
		</div>
		
		<div class="two fields">
			<div class="field">
				<label>No. Pokok Sekolah Nasional</label>
				<input type="text" name="schpsn" class="numeric-input" value="{{old('schpsn', '')}}" placeholder="Kosongkan jika tidak ada">
			</div>
			<div class="field">
				<label>No. Peserta Ujian Negara (UN)</label>
				<input type="text" name="schun" class="numeric-input" value="{{old('schun', '')}}" placeholder="Kosongkan jika tidak ada">
			</div>
		</div>
		
		<div class="two fields">
			<div class="field">
				<label>Nomor Ijazah</label>
				<input type="text" name="schijazah" class="numeric-input" value="{{old('schijazah', '')}}" placeholder="Kosongkan jika tidak ada">
			</div>
			<div class="field">
				<label>Nomor SKHUN</label>
				<input type="text" name="schskhun" class="numeric-input" value="{{old('schskhun', '')}}" placeholder="Kosongkan jika tidak ada">
			</div>
		</div>
		
		<div class="ui basic segment"></div>
		<div class="inline fields">
			<label>Apakah calon santri yang mendaftar adalah pindahan dari pesantren lain?</label>
			<div class="field">
				<div class="ui radio checkbox">
					<input type="radio" name="pindahan" tabindex="0" class="hidden" value="true"{{old('pindahan') == 'true' ? ' checked' : ''}} id="pindahantrue">
					<label>YA</label>
				</div>
			</div>
			<div class="field">
				<div class="ui radio checkbox">
					<input type="radio" name="pindahan" tabindex="0" class="hidden" value="false"{{!old('pindahan') ? ' checked' : old('pindahan') == 'false' ? ' checked' : ''}}>
					<label>TIDAK</label>
				</div>
			</div>
		</div>
		
	</div>
	
	<div class="field" id="form-pindahan">
		
		<div class="ui basic segment">
			<h4 class="ui horizontal divider header grey"> ISI HANYA JIKA PINDAHAN DARI PESANTREN DAN INGIN NAIK TINGKAT </h4>
		</div>
		
		<div class="field required @error('psnfrom') error @enderror">
			<label>Dari Pesantren</label>
			<input type="text" name="psnfrom" class="uppercase-input" value="{{old('psnfrom', '')}}" placeholder="Nama pesantren">
		</div>
		
		<div class="field required @error('psnadd') error @enderror">
			<label>Alamat Pesantren</label>
			<textarea name="psnadd" rows="2" class="uppercase-input" placeholder="Alamat lengkap pesantren asal">{{old('psnadd', '')}}</textarea>
		</div>
		
		<div class="fields">
			<div class="four wide field required">
				<label>Alasan Pindah</label>
				<select class="ui dropdown" name="psnwhy">
					@foreach ($movereasons as $mr)
					<option value="{{$mr}}"{{old('psnwhy') == $mr ? ' selected' : ''}}>{{$mr}}</option>
					@endforeach
				</select>
			</div>
			<div class="twelve wide field required @error('psndesc') error @enderror">
				<label>Deskripsi</label>
				<input type="text" name="psndesc" class="uppercase-input" value="{{old('psndesc', '')}}" placeholder="Penjelasan detail alasan pindah">
			</div>
		</div>
		
		<div class="four fields">
			<div class="field required @error('psnup') error @enderror">
				<label>Naik Ke Kelas</label>
				<input type="text" name="psnup" class="numeric-input" value="{{old('psnup', '')}}" placeholder="Tujuan kelas">
			</div>
			<div class="field required">
				<label>Tingkat</label>
				<select class="ui dropdown" name="psnlvl">
					<option value="MTS"{{old('psnlvl') == 'MTS' ? ' selected' : ''}}>MTS</option>
					<option value="MA"{{old('psnlvl') == 'MA' ? ' selected' : ''}}>MA</option>
				</select>
			</div>
			<div class="field required @error('psnto') error @enderror">
				<label>Ingin Ke Kelas</label>
				<select class="ui dropdown" name="psnto">
					@for ($i = 2; $i < 5; $i++)
					<option value="{{$i}}"{{old('psnto') == $i ? ' selected' : ''}}>{{$i}}</option>		
					@endfor
				</select>
			</div>
			<div class="field required">
				<label>Rapor Pesantren</label>
				<select class="ui dropdown" name="psnrep">
					<option value="true"{{old('psnrep') == 'true' ? ' selected' : ''}}>ADA</option>
					<option value="false"{{old('psnrep') == 'false' ? ' selected' : ''}}>TIDAK ADA</option>
				</select>
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