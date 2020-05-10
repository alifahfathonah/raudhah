@extends('layouts.admin')
@section('pagetitle', 'Data Pegawai')
@section('contents')
<div class="row">
	<div class="col-12">
		<div class="card shadow mb-4">
			<!-- Card Header -->
			<div class="card-header{{Auth::user()->role <= 2 ? ' py-2 d-flex flex-row align-items-center justify-content-between' : ''}}">
				<h6 class="m-0 font-weight-bold text-custom">Data Pegawai</h6>
				@if(Auth::user()->role <= 2)
				<a href="{{route('admin.users.create')}}" class="btn btn-info btn-icon-split btn-sm">
					<span class="icon text-white-50">
						<i class="fas fa-plus"></i>
					</span>
					<span class="text">Tambah</span>
				</a>
				@endif
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<div class="table-responsive">
					<table id="dataTable" class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Nama</th>
								<th>Username</th>
								<th>Email</th>
								<th>Telepon</th>
								<th>Role</th>
								<th>Opsi</th>
							</tr>
						</thead>
						@php $no = 1 @endphp
						<tbody>
							@foreach ($users as $user)
							<tr>
								<td>{{$no++}}</td>
								<td>{{$user->name}}</td>
								<td>{{$user->username}}</td>
								<td>{{$user->email}}</td>
								<td>{{$user->phone ? $user->phone : '-'}}</td>
								<td>
									@switch($user->role)
									@case(1)
									<span class="text-danger">Superadmin</span>
									@break
									@case(2)
									<span class="text-primary">Supervisor</span>
									@break
									@default
									<span class="text-secondary">Administrator</span>
									@endswitch
								</td>
								<td>
									@php $role = Auth::user()->role; $idlo = Auth::id(); @endphp
									<div class="btn-group" role="group" aria-label="Basic example">
										
										@if($idlo == $user->id || $role <= 2 && $user->role != 1)
										<a href="{{route('admin.users.edit', $user->id)}}" class="btn btn-success btn-sm">
											<i class="fas fa-fw fa-edit"></i>
										</a>
										@endif
										
										@if($idlo != $user->id && $role <=2 && $user->role != 1)
										<a href="#" class="btn btn-danger btn-sm usertodelete" data-toggle="modal" data-target="#userDelete" data-id="{{$user->id}}" data-nama="{{$user->name}}">
											<i class="fas fa-fw fa-trash"></i>
										</a>
										@endif
										
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="userDelete" tabindex="-1" role="dialog" aria-labelledby="userDeleteLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="userDeleteLabel">Hapus data <span class="username"></span></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Data pegawai yang dihapus tidak dapat dikembalikan lagi! Apakah anda yakin ingin menghapus data pegawai <span class="text-danger username"></span>?</p>
			</div>
			<div class="modal-footer">
				<form action="{{route('admin.users.destroy')}}" method="post">
					@csrf
					<button type="button" class="btn btn-secondary btn-icon-split btn-sm" data-dismiss="modal">
						<span class="icon text-white-50">
							<i class="fas fa-times"></i>
						</span>
						<span class="text">Cancel</span>
					</button>
					<input type="hidden" value="" name="idtodelete" id="idtodelete">
					<button type="submit" class="btn btn-danger btn-icon-split btn-sm">
						<span class="icon text-white-50">
							<i class="fas fa-trash"></i>
						</span>
						<span class="text">Hapus</span>
					</button>
				</form>
			</div>
		</div>
	</div>
</div>


@endsection


@section('pagescript')
<script>
	$(document).on("click", ".usertodelete", function () {
		var id 	= $(this).data('id');
		var name = $(this).data('nama');
		$(".modal-footer #idtodelete").val(id);
		$(".username").html(name);
	});
</script>
@endsection