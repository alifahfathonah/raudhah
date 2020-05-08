@extends('layouts.admin')
@section('pagetitle', 'Tambah Data Pegawai')
@section('contents')
<div class="row">
	<div class="col-12">
		<div class="card shadow mb-4">
			<!-- Card Header -->
			<div class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-custom">Tambah Data Pegawai</h6>
				<a href="{{route('admin.users')}}" class="btn btn-dark btn-icon-split btn-sm">
					<span class="icon text-white-50">
						<i class="fas fa-chevron-left"></i>
					</span>
					<span class="text">Kembali</span>
				</a>
			</div>
			<form action="{{route('admin.users.store')}}" method="post">
				@csrf
				<!-- Card Body -->
				<div class="card-body">
					<div class="row">
						{{-- name --}}
						<div class="form-group col-sm-12 col-md-4">
							<label for="name">Nama Lengkap<sup class="text-danger">*</sup></label>
							<input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{old('name')}}" autocomplete="name" autofocus>
						</div>
						{{-- email --}}
						<div class="form-group col-sm-12 col-md-4">
							<label for="email">Alamat Email</label>
							<input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{old('email')}}" autocomplete="email">
						</div>
						{{-- phone --}}
						<div class="form-group col-sm-12 col-md-4">
							<label for="phone">Nomor Telepon</label>
							<input name="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" value="{{old('phone')}}" autocomplete="phone">
						</div>
					</div>
					<div class="row">
						{{-- username --}}
						<div class="form-group col-sm-12 col-md-4">
							<label for="username">Login Username<sup class="text-danger">*</sup></label>
							<input name="username" type="text" class="form-control @error('username') is-invalid @enderror" id="username" aria-describedby="usernameHelp" value="{{old('username')}}" autocomplete="username">
							<small id="usernameHelp" class="form-text text-muted">Nama pengguna yang dipakai untuk login.</small>
						</div>
						{{-- password --}}
						<div class="form-group col-sm-12 col-md-4">
							<label for="password">Password<sup class="text-danger">*</sup></label>
							<input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" autocomplete="new-password">
						</div>
						{{-- password confirmation --}}
						<div class="form-group col-sm-12 col-md-4">
							<label for="password-confirm">Konfirmasi Password<sup class="text-danger">*</sup></label>
							<input name="password_confirmation" type="password" class="form-control @error('password') is-invalid @enderror" id="password-confirm" autocomplete="new-password">
						</div>
						
					</div>
					
				</div>
				<!-- Card Footer -->
				@if(Auth::user()->role == 1)
				<div class="card-footer d-flex justify-content-between">
					<div class="form-group my-0">
						<select name="role" id="role" class="custom-select custom-select-sm">
							<option value="1">Superadmin</option>
							<option value="2">Supervisor</option>
							<option value="3" selected>Administrator</option>
						</select>
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
				@else
				<div class="card-footer d-flex justify-content-end">
					<input type="hidden" name="role" value="3">
					<button type="submit" class="btn btn-info btn-icon-split btn-sm">
						<span class="icon text-white-50">
							<i class="fas fa-check"></i>
						</span>
						<span class="text">Simpan</span>
					</button>
				</div>
				@endif
			</form>
		</div>
	</div>
</div>
@endsection