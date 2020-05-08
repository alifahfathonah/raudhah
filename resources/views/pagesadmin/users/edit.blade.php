@extends('layouts.admin')
@section('pagetitle', 'Ubah Data Pegawai')
@section('contents')
<div class="row">
	<div class="col-12">
		<div class="card shadow mb-4">
			<!-- Card Header -->
			<div class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-custom">Ubah Data Pegawai</h6>
				<a href="{{route('admin.users')}}" class="btn btn-dark btn-icon-split btn-sm">
					<span class="icon text-white-50">
						<i class="fas fa-chevron-left"></i>
					</span>
					<span class="text">Kembali</span>
				</a>
			</div>
			<form action="{{route('admin.users.update')}}" method="post">
				@csrf
				<!-- Card Body -->
				<div class="card-body">
					<div class="row">
						<input type="hidden" name="idtoupdate" value="{{$user->id}}">
						{{-- name --}}
						<div class="form-group col-sm-12 col-md-6">
							<label for="name">Nama Lengkap<sup class="text-danger">*</sup></label>
							<input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{old('name') ? old('name') : $user->name}}" autocomplete="name" autofocus>
						</div>
						{{-- username --}}
						<div class="form-group col-sm-12 col-md-6">
							<label for="username">Login Username<sup class="text-danger">*</sup></label>
							<input name="username" type="text" class="form-control @error('username') is-invalid @enderror" id="username" aria-describedby="usernameHelp" value="{{old('username') ? old('username') : $user->username}}" autocomplete="username">
							<small id="usernameHelp" class="form-text text-muted">Nama pengguna yang dipakai untuk login.</small>
						</div>
					</div>
					<div class="row">
						{{-- email --}}
						<div class="form-group col-sm-12 col-md-6">
							<label for="email">Alamat Email</label>
							<input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{old('email') ? old('email') : $user->email}}" autocomplete="email">
						</div>
						{{-- phone --}}
						<div class="form-group col-sm-12 col-md-6">
							<label for="phone">Nomor Telepon</label>
							<input name="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" value="{{old('phone') ? old('phone') : $user->phone}}" autocomplete="phone">
						</div>
					</div>
					
				</div>
				<!-- Card Footer -->
				<div class="card-footer d-flex justify-content-between">
					<div class="form-inline">
						@if (Auth::user()->role == 1)
						<div class="form-group my-0 mr-4">
							<select name="role" id="role" class="custom-select custom-select-sm">
								<option value="1"{{$user->role == 1 ? ' selected' : ''}}>Superadmin</option>
								<option value="2"{{$user->role == 2 ? ' selected' : ''}}>Supervisor</option>
								<option value="3"{{$user->role == 3 ? ' selected' : ''}}>Administrator</option>
							</select>
						</div>
						@else
						<input type="hidden" name="role" value="{{$user->role}}">
						@endif
						<div class="form-group my-0">
							<button type="button" class="btn btn-flat text-info btn-sm changepass" data-toggle="modal" data-target="#gantiPassword" data-id="{{$user->id}}" data-nama="{{$user->name}}">Ganti password?</button>
						</div>
					</div>
					<div>
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


<!-- Modal Change Password -->
<div class="modal fade" id="gantiPassword" tabindex="-1" role="dialog" aria-labelledby="gantiPasswordLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="gantiPasswordLabel">Ganti Password <span class="username"></span></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{route('admin.users.changepass')}}" method="post">
				@csrf
				<div class="modal-body">
					<div class="row">
						<input type="hidden" value="" name="id" id="idtochange">
						{{-- old password --}}
						<div class="form-group col-sm-12">
							<label for="oldpassword">Password Lama<sup class="text-danger">*</sup></label>
							<input name="oldpassword" type="password" class="form-control @error('oldpassword') is-invalid @enderror" id="oldpassword" autocomplete="new-password">
						</div>
						{{-- password --}}
						<div class="form-group col-sm-12">
							<label for="password">Password Baru<sup class="text-danger">*</sup></label>
							<input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" autocomplete="new-password">
						</div>
						{{-- password confirmation --}}
						<div class="form-group col-sm-12">
							<label for="password-confirm">Konfirmasi Password Baru<sup class="text-danger">*</sup></label>
							<input name="password_confirmation" type="password" class="form-control @error('password') is-invalid @enderror" id="password-confirm" autocomplete="new-password">
						</div>
						
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary btn-icon-split btn-sm" data-dismiss="modal">
						<span class="icon text-white-50">
							<i class="fas fa-times"></i>
						</span>
						<span class="text">Cancel</span>
					</button>
					<input type="hidden" value="" name="idtodelete" id="idtodelete">
					<button type="submit" class="btn btn-info btn-icon-split btn-sm">
						<span class="icon text-white-50">
							<i class="fas fa-edit"></i>
						</span>
						<span class="text">Ubah</span>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection

@section('pagescript')
<script>
	$(document).on("click", ".changepass", function () {
		var id 	= $(this).data('id');
		var name = $(this).data('nama');
		$(".modal-body #idtochange").val(id);
		$(".username").html(name);
	});
</script>
@endsection