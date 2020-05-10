@extends('layouts.admin')
@section('pagetitle', 'Pengaturan Aplikasi')
@section('contents')

<div class="row">
	<div class="col-12">
		<div class="card shadow mb-4">
			<!-- Card Header -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-custom">Pengaturan Pendaftaran Online</h6>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<form>
					@csrf
					<input type="hidden" id="ajaxid" value="{{$setting->id}}">
					{{-- registration --}}
					<div class="form-group row">
						<label for="registration" class="col-sm-3 col-form-label">Buka pendaftaran?</label>
						<div class="col-sm-9 d-flex align-items-center">
							<div class="custom-control custom-switch">
								<input name="registration" type="checkbox" class="custom-control-input" id="registration"{{$setting->registration ? ' checked' : ''}}>
								<label class="pl-2 custom-control-label{{$setting->registration ? ' text-success' : ' text-danger'}}" for="registration" id="statusreg">{{$setting->registration ? 'Pendaftaran online telah dibuka.' : 'Pendaftaran online telah ditutup.'}}</label>
							</div>
						</div>
					</div>
				</form>
				<form action="{{route('admin.settings.update.closemessage')}}" method="post">
					@csrf
					<input type="hidden" name="id" value="{{$setting->id}}">
					<div class="form-group row">
						<label for="closemessage" class="col-sm-3 col-form-label">Pesan Yang Ditampilkan</label>
						<div class="col-sm-9">
							<textarea name="closemessage" id="closemessage" rows="3" class="form-control">{{$setting->message}}</textarea>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-12 d-flex align-items-center justify-content-end">
							<button type="submit" class="btn btn-info btn-icon-split btn-sm">
								<span class="icon text-white-50">
									<i class="fas fa-check"></i>
								</span>
								<span class="text">Simpan</span>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card shadow mb-4">
			<!-- Card Header -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-custom">Pengaturan Biaya Pendaftaran</h6>
			</div>
			<form action="{{route('admin.settings.update.cost')}}" method="post">
				@csrf
				<!-- Card Body -->
				<div class="card-body">
					<input type="hidden" name="id" value="{{$setting->id}}">
					{{-- years --}}
					<div class="form-group row">
						<label for="years" class="col-sm-3 col-form-label">Tahun Ajaran<sup class="text-danger">*</sup></label>
						<div class="col-sm-9">
							<input name="years" type="text" class="form-control @error('years') is-invalid @enderror" id="years" value="{{old('years') ? old('years') : $setting->years}}">
						</div>
					</div>
					{{-- cost --}}
					<div class="form-group row">
						<label for="cost" class="col-sm-3 col-form-label">Biaya Pendaftaran<sup class="text-danger">*</sup></label>
						<div class="col-sm-9">
							<input name="cost" type="text" class="form-control" id="cost" value="{{old('cost') ? old('cost') : $setting->cost == 0 ? '' : $setting->cost}}">
						</div>
					</div>
					{{-- virtual accound --}}
					<div class="form-group row">
						<label for="nova" class="col-sm-3 col-form-label">12 Digit Awal Virtual Account<sup class="text-danger">*</sup></label>
						<div class="col-sm-9">
							<input name="nova" type="text" class="form-control" id="nova" value="{{old('nova', $setting->nova)}}">
						</div>
					</div>
				</div>
				<div class="card-footer d-flex justify-content-end">
					<button type="submit" class="btn btn-info btn-icon-split btn-sm">
						<span class="icon text-white-50">
							<i class="fas fa-check"></i>
						</span>
						<span class="text">Simpan</span>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>


<div class="row">
	<div class="col-12">
		<div class="card shadow mb-4">
			<!-- Card Header -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-custom">Pengaturan Data Aplikasi</h6>
			</div>
			<!-- Card Body -->
			<form action="{{route('admin.settings.update')}}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="card-body">
					<input type="hidden" name="id" value="{{$setting->id}}">
					{{-- logo --}}
					<div class="form-group row">
						<label for="prefix" class="col-sm-3 col-form-label">Logo Institusi</label>
						<div class="col-sm-9">
							<div class="custom-file">
								<input type="file" name="logo" class="custom-file-input" id="logo">
								<label class="custom-file-label" for="logo">Pilih file</label>
							</div>
						</div>
					</div>
					{{-- prefix --}}
					<div class="form-group row">
						<label for="prefix" class="col-sm-3 col-form-label">Nama Awalan Institusi</label>
						<div class="col-sm-9">
							<input name="prefix" type="text" class="form-control" id="prefix" value="{{old('prefix') ? old('prefix') : $setting->prefix}}">
						</div>
					</div>
					{{-- name --}}
					<div class="form-group row">
						<label for="name" class="col-sm-3 col-form-label">Nama Institusi<sup class="text-danger">*</sup></label>
						<div class="col-sm-9">
							<input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{old('name') ? old('name') : $setting->name}}">
						</div>
					</div>
					{{-- suffix --}}
					<div class="form-group row">
						<label for="suffix" class="col-sm-3 col-form-label">Nama Akhiran Institusi</label>
						<div class="col-sm-9">
							<input name="suffix" type="text" class="form-control" id="suffix" value="{{old('suffix') ? old('suffix') : $setting->suffix}}">
						</div>
					</div>
					{{-- shorts --}}
					<div class="form-group row">
						<label for="shorts" class="col-sm-3 col-form-label">Singkatan/Nickname Institusi</label>
						<div class="col-sm-9">
							<input name="shorts" type="text" class="form-control" id="shorts" value="{{old('shorts') ? old('shorts') : $setting->shorts}}">
						</div>
					</div>
					{{-- company --}}
					<div class="form-group row">
						<label for="company" class="col-sm-3 col-form-label">Nama Yayasan</label>
						<div class="col-sm-9">
							<input name="company" type="text" class="form-control" id="company" value="{{old('company') ? old('company') : $setting->company}}">
						</div>
					</div>
					{{-- address --}}
					<div class="form-group row">
						<label for="address" class="col-sm-3 col-form-label">Alamat Institusi<sup class="text-danger">*</sup></label>
						<div class="col-sm-9">
							<textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" rows="3">{{old('address') ? old('address') : $setting->address}}</textarea>
						</div>
					</div>
					{{-- city --}}
					<div class="form-group row">
						<label for="city" class="col-sm-3 col-form-label">Kota<sup class="text-danger">*</sup></label>
						<div class="col-sm-9">
							<input name="city" type="text" class="form-control @error('city') is-invalid @enderror" id="city" value="{{old('city') ? old('city') : $setting->city}}">
						</div>
					</div>
					{{-- postal --}}
					<div class="form-group row">
						<label for="postal" class="col-sm-3 col-form-label">Kode Pos</label>
						<div class="col-sm-9">
							<input name="postal" type="text" class="form-control" id="postal" value="{{old('postal') ? old('postal') : $setting->postal}}">
						</div>
					</div>
					{{-- email --}}
					<div class="form-group row">
						<label for="email" class="col-sm-3 col-form-label">Alamat Email<sup class="text-danger">*</sup></label>
						<div class="col-sm-9">
							<input name="email" type="text" class="form-control @error('email') is-invalid @enderror" id="email" value="{{old('email') ? old('email') : $setting->email}}">
						</div>
					</div>
					{{-- phone --}}
					<div class="form-group row">
						<label for="phone" class="col-sm-3 col-form-label">Nomor Telepon<sup class="text-danger">*</sup></label>
						<div class="col-sm-9">
							<input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" value="{{old('phone') ? old('phone') : $setting->phone}}">
						</div>
					</div>
					{{-- mobile --}}
					<div class="form-group row">
						<label for="mobile" class="col-sm-3 col-form-label">Mobile / WhatsApp</label>
						<div class="col-sm-9">
							<input name="mobile" type="text" class="form-control" id="mobile" value="{{old('mobile') ? old('mobile') : $setting->mobile}}">
						</div>
					</div>
					{{-- fax --}}
					<div class="form-group row">
						<label for="fax" class="col-sm-3 col-form-label">Faksimile</label>
						<div class="col-sm-9">
							<input name="fax" type="text" class="form-control" id="fax" value="{{old('fax') ? old('fax') : $setting->fax}}">
						</div>
					</div>
					{{-- web --}}
					<div class="form-group row">
						<label for="web" class="col-sm-3 col-form-label">Alamat Website</label>
						<div class="col-sm-9">
							<input name="web" type="text" class="form-control" id="web" value="{{old('web') ? old('web') : $setting->web}}">
						</div>
					</div>
					{{-- fb --}}
					<div class="form-group row">
						<label for="fb" class="col-sm-3 col-form-label">Alamat Profil Facebook</label>
						<div class="col-sm-9">
							<input name="fb" type="text" class="form-control" id="fb" value="{{old('fb') ? old('fb') : $setting->fb}}">
						</div>
					</div>
					{{-- ig --}}
					<div class="form-group row">
						<label for="ig" class="col-sm-3 col-form-label">Alamat Profil Instagram</label>
						<div class="col-sm-9">
							<input name="ig" type="text" class="form-control" id="ig" value="{{old('ig') ? old('ig') : $setting->ig}}">
						</div>
					</div>
					{{-- tw --}}
					<div class="form-group row">
						<label for="tw" class="col-sm-3 col-form-label">Alamat Profil Twitter</label>
						<div class="col-sm-9">
							<input name="tw" type="text" class="form-control" id="tw" value="{{old('tw') ? old('tw') : $setting->tw}}">
						</div>
					</div>
				</div>
				<div class="card-footer d-flex justify-content-end">
					<button type="submit" class="btn btn-info btn-icon-split btn-sm">
						<span class="icon text-white-50">
							<i class="fas fa-check"></i>
						</span>
						<span class="text">Simpan</span>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>


@endsection
@section('pagescript')
<script src="{{asset('vendor/cleave/cleave.min.js')}}"></script>
<script>
	// cleave years
	var cleave = new Cleave('#years', {
		blocks: [4, 4],
		numericOnly: true,
		delimiter: '/',
	});
	// cleave cost
	var cleave = new Cleave('#cost', {
		numeral: true,
		numeralThousandsGroupStyle: 'thousand',
		prefix: 'Rp ',
		noImmediatePrefix: true,
		rawValueTrimPrefix: true,
		numeralDecimalMark: ',',
		delimiter: '.'
	});
	// cleave nova
	var cleave = new Cleave('#nova', {
		numericOnly: true,
		blocks: [5, 7],
		delimiter: '-',
	});
	
	// display filename on input file
	$('#logo').on('change',function(){
		//get the file name
		var fileName = $(this).val();
		//replace the "Choose a file" label
		$(this).next('.custom-file-label').html(fileName);
	});
	
	// ajax open/close registration setting
	$('#registration').change(function(e){
		if($(this).is(":checked")){
			var val = 't';
		} else {
			var val = 'f';
		}
		e.preventDefault();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url: "{{ route('admin.ajax.registration.toggle') }}",
			method: 'post',
			data: {
				id	: $('#ajaxid').val(),
				reg	: val,
			},
			success: function(result){
				// console.log(result);
				if(result.reg === 't'){
					$("#statusreg").html('Pendaftaran online telah dibuka.');
					$("#statusreg").removeClass("text-danger");
					$("#statusreg").addClass("text-success");
				} else {
					$("#statusreg").html('Pendaftaran online telah ditutup.');
					$("#statusreg").removeClass("text-success");
					$("#statusreg").addClass("text-danger");
				}
			}
		});
	});
</script>
@endsection