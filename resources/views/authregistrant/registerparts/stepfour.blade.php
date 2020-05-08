<form class="ui form basic segment @if ($errors->any()) error @endif" method="POST" action="{{route('register.step.4')}}">
	@csrf
	<div class="field">
		
		@include('authregistrant.registerparts.errormessages')
		
		<div class="ui basic segment">
			<h4 class="ui horizontal divider header grey"> DATA AYAH KANDUNG </h4>
		</div>
		
		<div class="field required">
			<label>Nama Lengkap</label>
			<div class="fields">
				<div class="twelve wide field @error('fname') error @enderror">
					<input type="text" name="fname" class="uppercase-input" value="{{old('fname', '')}}">
				</div>
				<div class="four wide field required">
					<select name="flive" class="ui dropdown">
						<option value="true"{{old('flive') == 'true' ? ' selected' : ''}}>MASIH HIDUP</option>
						<option value="false"{{old('flive') == 'false' ? ' selected' : ''}}>SUDAH MENINGGAL</option>
					</select>
				</div>
			</div>
		</div>
		
		<div class="field required @error('fadd') error @enderror">
			<label>Alamat Lengkap</label>
			<input type="text" name="fadd" class="uppercase-input" value="{{old('fadd', '')}}">
		</div>
		
		<div class="four fields required @error('fprov') error @enderror">
			<div class="field">
				<label>Provinsi</label>
				<select class="ui search dropdown" id="selprov"></select>
			</div>
			<input type="hidden" name="fprov" value="">
			<div class="field required @error('fkab') error @enderror">
				<label>Kabupaten/Kota</label>
				<select class="ui search dropdown" id="selkab"></select>
			</div>
			<input type="hidden" name="fkab" value="">
			<div class="field required @error('fkec') error @enderror">
				<label>Kecamatan</label>
				<select class="ui search dropdown" id="selkec"></select>
			</div>
			<input type="hidden" name="fkec" value="">
			<div class="field required @error('fkel') error @enderror">
				<label>Kelurahan/Desa</label>
				<select class="ui search dropdown" id="selkel"></select>
			</div>
			<input type="hidden" name="fkel" value="">
		</div>
		
		<div class="two fields">
			<div class="field required @error('fphone') error @enderror">
				<label>Nomor Telepon/HP</label>
				<input type="text" name="fphone" class="phone-input" value="{{old('fphone', '')}}">
			</div>
			<div class="field">
				<label>Nomor WhatsApp</label>
				<input type="text" name="fwa" class="phone-input" value="{{old('fwa', '')}}">
			</div>
		</div>
		
		<div class="fields">
			<div class="seven wide field required @error('fktp') error @enderror">
				<label>Nomor KTP</label>
				<input type="text" name="fktp" class="numeric-input" value="{{old('fktp', '')}}">
			</div>
			<div class="three wide field required">
				<label>Pendidikan Terakhir</label>
				<select name="fedu" class="ui dropdown">
					@foreach ($edulevels as $fedu)
					<option value="{{$fedu}}"{{old('fedu') == $fedu ? ' selected' : ''}}>{{$fedu}}</option>
					@endforeach
				</select>
			</div>
			<div class="three wide field required">
				<label>Agama</label>
				<select name="freli" class="ui dropdown">
					@foreach ($religions as $freli)
					<option value="{{$freli}}"{{old('freli') == $freli ? ' selected' : ''}}>{{$freli}}</option>
					@endforeach
				</select>
			</div>
			<div class="three wide field required">
				<label>Status Pernikahan</label>
				<select name="fmari" class="ui dropdown">
					<option value="true"{{old('fmari') == 'true' ? ' selected' : ''}}>TIDAK CERAI</option>
					<option value="false"{{old('fmari') == 'true' ? ' selected' : ''}}>BERCERAI</option>
				</select>
			</div>
		</div>
		
		<div class="three fields">
			<div class="field required">
				<label>Pekerjaan</label>
				<select name="fwork" class="ui search dropdown">
					@foreach ($wishes as $fwork)
					<option value="{{$fwork}}"{{old('fwork') == $fwork ? ' selected' : ''}}>{{$fwork}}</option>
					@endforeach
				</select>
			</div>
			<div class="field required @error('fsal') error @enderror">
				<label>Penghasilan Per Bulan</label>
				<div class="ui labeled input">
					<div class="ui basic label">Rp.</div>
					<input type="text" name="fsal" class="currency-input" value="{{old('fsal', '')}}">
				</div>
			</div>
			<div class="field">
				<label>Penghasilan Tambahan</label>
				<div class="ui labeled input">
					<div class="ui basic label">Rp.</div>
					<input type="text" name="faddsal" class="currency-input" value="{{old('faddsal', '')}}">
				</div>
			</div>
		</div>
		
		
		{{-- ibu --}}
		<div class="ui basic segment"></div>
		<div class="ui basic segment">
			<h4 class="ui horizontal divider header grey"> DATA IBU KANDUNG </h4>
		</div>
		
		<div class="field required">
			<label>Nama Lengkap</label>
			<div class="fields">
				<div class="twelve wide field required @error('mname') error @enderror">
					<input type="text" name="mname" class="uppercase-input" value="{{old('mname', '')}}">
				</div>
				<div class="four wide field required">
					<select name="mlive" class="ui dropdown">
						<option value="true"{{old('mlive') == 'true' ? ' selected' : ''}}>MASIH HIDUP</option>
						<option value="false"{{old('mlive') == 'false' ? ' selected' : ''}}>SUDAH MENINGGAL</option>
					</select>
				</div>
			</div>
		</div>
		
		{{-- pilihan alamat ibu --}}
		
		<div class="inline fields">
			<label>Alamat Ibu sama dengan Ayah?</label>
			<div class="field">
				<div class="ui radio checkbox">
					<input type="radio" name="serumah" tabindex="0" class="hidden" value="true"{{!old('serumah') ? ' checked' : old('serumah') == 'true' ? ' checked' : ''}}>
					<label>YA</label>
				</div>
			</div>
			<div class="field">
				<div class="ui radio checkbox">
					<input type="radio" name="serumah" tabindex="0" class="hidden" value="false"{{old('serumah') == 'false' ? ' checked' : ''}} id="serumahfalse">
					<label>TIDAK</label>
				</div>
			</div>
		</div>
		
		{{-- // --}}
		
		<div class="field" id="form-serumah">
			
			<div class="field required @error('madd') error @enderror">
				<label>Alamat Lengkap</label>
				<input type="text" name="madd" class="uppercase-input" value="{{old('madd', '')}}">
			</div>
			
			<div class="four fields">
				<div class="field required @error('mprov') error @enderror">
					<label>Provinsi</label>
					<select class="ui search dropdown" id="mselprov"></select>
				</div>
				<input type="hidden" name="mprov" value="">
				<div class="field required @error('mkab') error @enderror">
					<label>Kabupaten/Kota</label>
					<select class="ui search dropdown" id="mselkab"></select>
				</div>
				<input type="hidden" name="mkab" value="">
				<div class="field required @error('mkec') error @enderror">
					<label>Kecamatan</label>
					<select class="ui search dropdown" id="mselkec"></select>
				</div>
				<input type="hidden" name="mkec" value="">
				<div class="field required @error('mkel') error @enderror">
					<label>Kelurahan/Desa</label>
					<select class="ui search dropdown" id="mselkel"></select>
				</div>
				<input type="hidden" name="mkel" value="">
			</div>
			
		</div>
		
		<div class="two fields">
			<div class="field required @error('mphone') error @enderror">
				<label>Nomor Telepon/HP</label>
				<input type="text" name="mphone" class="phone-input" value="{{old('mphone', '')}}">
			</div>
			<div class="field">
				<label>Nomor WhatsApp</label>
				<input type="text" name="mwa" class="phone-input" value="{{old('mwa', '')}}">
			</div>
		</div>
		
		<div class="fields">
			<div class="eight wide field required @error('mktp') error @enderror">
				<label>Nomor KTP</label>
				<input type="text" name="mktp" class="numeric-input" value="{{old('mktp', '')}}">
			</div>
			<div class="four wide field required">
				<label>Pendidikan Terakhir</label>
				<select name="medu" class="ui dropdown">
					@foreach ($edulevels as $medu)
					<option value="{{$medu}}"{{old('medu') == $medu ? ' selected' : ''}}>{{$medu}}</option>
					@endforeach
				</select>
			</div>
			<div class="four wide field required">
				<label>Agama</label>
				<select name="mreli" class="ui dropdown">
					@foreach ($religions as $mreli)
					<option value="{{$mreli}}"{{old('mreli') == $mreli ? ' selected' : ''}}>{{$mreli}}</option>
					@endforeach
				</select>
			</div>
		</div>
		
		<div class="three fields">
			<div class="field required">
				<label>Pekerjaan</label>
				<select name="mwork" class="ui search dropdown">
					@foreach ($wishes as $mwork)
					<option value="{{$mwork}}"{{old('mwork') == $mwork ? ' selected' : ''}}>{{$mwork}}</option>
					@endforeach
				</select>
			</div>
			<div class="field required @error('msal') error @enderror">
				<label>Penghasilan Per Bulan</label>
				<div class="ui labeled input">
					<div class="ui basic label">Rp.</div>
					<input type="text" name="msal" class="currency-input" value="{{old('msal', '')}}">
				</div>
			</div>
			<div class="field">
				<label>Penghasilan Tambahan</label>
				<div class="ui labeled input">
					<div class="ui basic label">Rp.</div>
					<input type="text" name="maddsal" class="currency-input" value="{{old('maddsal', '')}}">
				</div>
			</div>
		</div>
		
		
		<div class="inline fields">
			<label>Apakah yang membiayai orang tua kandung?</label>
			<div class="field">
				<div class="ui radio checkbox">
					<input type="radio" name="pembiayaan" tabindex="0" class="hidden" value="true"{{!old('pembiayaan') ? ' checked' : old('pembiayaan') == 'true' ? ' checked' : ''}}>
					<label>YA</label>
				</div>
			</div>
			<div class="field">
				<div class="ui radio checkbox">
					<input type="radio" name="pembiayaan" tabindex="0" class="hidden" value="false"{{old('pembiayaan') == 'false' ? ' checked' : ''}} id="pembiayaanfalse">
					<label>TIDAK</label>
				</div>
			</div>
		</div>
		
	</div>
	
	<div class="field" id="form-pembiaya">
		<div class="ui basic segment"></div>
		<div class="ui basic segment">
			<h4 class="ui horizontal divider header grey"> DATA PEMBIAYA </h4>
		</div>
		
		<div class="fields">
			<div class="eight wide field required @error('donaturname') error @enderror">
				<label>Nama Pembiaya</label>
				<input type="text" name="donaturname" class="uppercase-input" value="{{old('donaturname', '')}}">
			</div>
			<div class="four wide field required">
				<label>Hubungan Dengan Pendaftar</label>
				<select name="donaturrels" class="ui dropdown">
					@foreach ($donaturs as $donaturrels)
					<option value="{{$donaturrels}}">{{$donaturrels}}</option>
					@endforeach
				</select>
			</div>
			<div class="four wide field required @error('donaturphone') error @enderror">
				<label>No. Handphone/WhatsApp</label>
				<input type="text" name="donaturphone" class="phone-input" value="{{old('donaturphone', '')}}">
			</div>
		</div>
		
		<div class="field required @error('donaturadd') error @enderror">
			<label>Alamat Lengkap</label>
			<input type="text" name="donaturadd" class="uppercase-input" value="{{old('donaturadd', '')}}">
		</div>
		
		<div class="four fields">
			<div class="field required @error('dprov') error @enderror">
				<label>Provinsi</label>
				<select class="ui search dropdown" id="dselprov"></select>
			</div>
			<input type="hidden" name="dprov" value="">
			<div class="field required @error('dkab') error @enderror">
				<label>Kabupaten/Kota</label>
				<select class="ui search dropdown" id="dselkab"></select>
			</div>
			<input type="hidden" name="dkab" value="">
			<div class="field required @error('dkec') error @enderror">
				<label>Kecamatan</label>
				<select class="ui search dropdown" id="dselkec"></select>
			</div>
			<input type="hidden" name="dkec" value="">
			<div class="field required @error('dkel') error @enderror">
				<label>Kelurahan/Desa</label>
				<select class="ui search dropdown" id="dselkel"></select>
			</div>
			<input type="hidden" name="dkel" value="">
		</div>
		
	</div>
	
	<div class="field">
		<div class="ui basic segment"></div>
		<div class="ui basic segment">
			<h4 class="ui horizontal divider header grey"> KELENGKAPAN BERKAS </h4>
		</div>
		
		
		<div class="equal width fields">
			<div class="field">
				<label>Fotocopy Ijazah 3 Lembar</label>
				<select name="berkasijz" class="ui dropdown">
					<option value="true"{{old('berkasijz') == 'true' ? ' selected' : ''}}>ADA</option>
					<option value="false"{{old('berkasijz') == 'false' ? ' selected' : ''}}>TIDAK ADA</option>
				</select>
			</div>
			<div class="field">
				<label>Fotocopy SKHUN 3 Lembar</label>
				<select name="berkasskhun" class="ui dropdown">
					<option value="true"{{old('berkasskhun') == 'true' ? ' selected' : ''}}>ADA</option>
					<option value="false"{{old('berkasskhun') == 'false' ? ' selected' : ''}}>TIDAK ADA</option>
				</select>
			</div>
			<div class="field">
				<label>Fotocopy Kartu NISN 1 Lembar</label>
				<select name="berkasnisn" class="ui dropdown">
					<option value="true"{{old('berkasnisn') == 'true' ? ' selected' : ''}}>ADA</option>
					<option value="false"{{old('berkasnisn') == 'false' ? ' selected' : ''}}>TIDAK ADA</option>
				</select>
			</div>
		</div>
		<div class="equal width fields">
			<div class="field">
				<label>Fotocopy Kartu Keluarga 1 Lembar</label>
				<select name="berkaskk" class="ui dropdown">
					<option value="true"{{old('berkaskk') == 'true' ? ' selected' : ''}}>ADA</option>
					<option value="false"{{old('berkaskk') == 'false' ? ' selected' : ''}}>TIDAK ADA</option>
				</select>
			</div>
			<div class="field">
				<label>Fotocopy KTP</label>
				<select name="berkasktp" class="ui dropdown">
					<option value="true"{{old('berkasktp') == 'true' ? ' selected' : ''}}>ADA</option>
					<option value="false"{{old('berkasktp') == 'false' ? ' selected' : ''}}>TIDAK ADA</option>
				</select>
			</div>
			<div class="field">
				<label>Photo Hitam Putih 3x4 6 Lembar</label>
				<select name="berkasfoto" class="ui dropdown">
					<option value="true"{{old('berkasfoto') == 'true' ? ' selected' : ''}}>ADA</option>
					<option value="false"{{old('berkasfoto') == 'false' ? ' selected' : ''}}>TIDAK ADA</option>
				</select>
			</div>
		</div>
		<div class="equal width fields">
			<div class="field">
				<label>Fotocopy Rapor Pesantren</label>
				<select name="berkasrapor" class="ui dropdown">
					<option value="true"{{old('berkasrapor') == 'true' ? ' selected' : ''}}>ADA</option>
					<option value="false"{{old('berkasrapor') == 'false' ? ' selected' : ''}}>TIDAK ADA</option>
				</select>
			</div>
			<div class="field">
				<label>Fotocopy SKBB 1 lembar</label>
				<select name="berkasskbb" class="ui dropdown">
					<option value="true"{{old('berkasskbb') == 'true' ? ' selected' : ''}}>ADA</option>
					<option value="false"{{old('berkasskbb') == 'false' ? ' selected' : ''}}>TIDAK ADA</option>
				</select>
			</div>
			<div class="field">
				<label>Surat Kesehatan 1 lembar</label>
				<select name="berkaskes" class="ui dropdown">
					<option value="true"{{old('berkaskes') == 'true' ? ' selected' : ''}}>ADA</option>
					<option value="false"{{old('berkaskes') == 'false' ? ' selected' : ''}}>TIDAK ADA</option>
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