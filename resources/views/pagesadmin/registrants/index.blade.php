@extends('layouts.admin')
@section('pagetitle', 'Data Semua Pendaftar')
@section('contents')

<!-- Modal Help -->
<div class="modal fade" id="modalHelp" tabindex="-1" role="dialog" aria-labelledby="modalHelpLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalHelpLabel">Bantuan Keterangan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Badge</th>
							<th scope="col">Keterangan</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><span class="badge badge-success badge-pill">Verified</span></td>
							<td>Pendaftar yang telah teverifikasi pembayarannya.</td>
						</tr>
						<tr>
							<td><span class="badge badge-secondary badge-pill">Manual</span></td>
							<td>Pendaftar yang telah diverifikasi manual oleh Supervisor.</td>
						</tr>
						<tr>
							<td><span class="badge badge-secondary badge-pill">Auto</span></td>
							<td>Pendaftar yang telah diverifikasi otomatis oleh sistem.</td>
						</tr>
						<tr>
							<td><span class="badge badge-warning badge-pill">Pending</span></td>
							<td>Pendaftar yang masih menunggu verifikasi pembayaran.</td>
						</tr>
						<tr>
							<td><span class="badge badge-danger badge-pill">Incomplete</span></td>
							<td>Pendaftar yang belum melengkapi semua tahapan/step pendaftaran.</td>
						</tr>
						<tr>
							<td><span class="badge badge-primary badge-pill">Complete</span></td>
							<td>Pendaftar yang telah melengkapi semua tahapan/step pendaftaran.</td>
						</tr>
						<tr>
							<td>
								<a href="#" class="btn btn-icon-split btn-sm btn-secondary">
									<span class="icon"><i class="fas fa-clipboard"></i></span>
									<span class="text">X000</span>
								</a>
							</td>
							<td>Tombol untuk mengubah kartu ujian calon santri yang telah dibuat.</td>
						</tr>
						<tr>
							<td>
								<a href="#" class="btn btn-sm btn-dark">
									<i class="fas fa-print"></i>
								</a>
							</td>
							<td>Tombol untuk mencetak kartu ujian calon santri yang telah dibuat.</td>
						</tr>
						<tr>
							<td>
								<a href="#" class="btn btn-success btn-sm">
									<i class="fas fa-user"></i>
								</a>
							</td>
							<td>Tombol untuk mencetak formulir pendaftaran yang diisi calon santri.</td>
						</tr>
						<tr>
							<td>
								<a href="#" class="btn btn-primary btn-sm">
									<i class="fas fa-clipboard-list"></i>
								</a>
							</td>
							<td>Tombol untuk membuat kartu ujian bagi calon santri yang sudah terverifikasi.</td>
						</tr>
						<tr>
							<td>
								<a href="#" class="btn btn-warning btn-sm">
									<i class="fas fa-check"></i>
								</a>
							</td>
							<td>Tombol verifikasi manual pembayaran calon santri (khusus Supervisor).</td>
						</tr>
						<tr>
							<td>
								<a href="#" class="btn btn-danger btn-sm">
									<i class="fas fa-trash"></i>
								</a>
							</td>
							<td>Tombol hapus data calon santri (khusus Supervisor).</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

{{-- information --}}
<div class="alert alert-info mb-5 alert-dismissible fade show" role="alert">
	<h4 class="alert-heading">Informasi!</h4>
	<p>Pendaftar dapat mendownload <b>Kartu Ujian</b> dan <b>File Materi</b> hanya jika pembayaran sudah terverifikasi <b>DAN</b> Kartu Ujian sudah dibuat.</p>
	<hr>
	<p class="mb-0">Pastikan semua pendaftar yang terverifikasi sudah memiliki kartu ujian dalam 24 jam.</p>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

<div class="row">
	<div class="col-12">
		<div class="card shadow mb-4">
			<!-- Card Header -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				@if (Request::segment(3) == 'all')
				<h6 class="m-0 font-weight-bold text-custom">Data Semua Calon Santri</h6>
				@endif
				@if (Request::segment(3) == 'pending')
				<h6 class="m-0 font-weight-bold text-custom">Data Calon Santri Terdaftar</h6>
				@endif
				@if (Request::segment(3) == 'verified')
				<h6 class="m-0 font-weight-bold text-custom">Data Calon Santri Terverifikasi</h6>
				@endif
				<div class="d-flex justify-content-between">
					<button class="btn btn-icon-split btn-sm btn-info mx-2" data-toggle="modal" data-target="#modalHelp">
						<span class="icon">
							<i class="fas fa-question-circle"></i>
						</span>
						<span class="text">Bantuan</span>
					</button>
					{{-- export exccel --}}
					<div class="dropdown">
						<button class="btn btn-icon-split btn-sm btn-success dropdown-toggle" type="button" id="exportExcel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="icon">
								<i class="fas fa-file-excel"></i>
							</span>
							<span class="text">Export Excel</span>
						</button>
						<div class="dropdown-menu" aria-labelledby="exportExcel">
							<a class="dropdown-item" href="{{route('admin.registrants.export.all')}}">Seluruh Data Pendaftar</a>
							<a class="dropdown-item" href="{{route('admin.registrants.export.verified')}}">Data Pendaftar Terverifikasi</a>
							<a class="dropdown-item" href="{{route('admin.registrants.export.pending')}}">Data Pendaftar Pending</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="{{route('admin.registrants.export.rh1')}}">Data Pendaftar RAUDHAH-1</a>
							<a class="dropdown-item" href="{{route('admin.registrants.export.rh2')}}">Data Pendaftar RAUDHAH-2</a>
						</div>
					</div>
				</div>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<div class="table-responsive">
					<table id="dataTable" class="table table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>NIK</th>
								<th>Nama</th>
								<th>JK</th>
								<th>Asal Sekolah</th>
								<th>Orang Tua</th>
								<th>Opsi</th>
							</tr>
						</thead>
						@php $no = 1 @endphp
						<tbody>
							@foreach ($regs as $r)
							<tr>
								<td>{{$no++}}</td>
								{{--  --}}
								<td>
									{{$r->username}}<br>
									@if($r->isverified == true)
									<span class="badge badge-success badge-pill">Verified</span>
									@if($r->manualverify == true)
									<span class="badge badge-secondary badge-pill">Manual</span>
									@else
									<span class="badge badge-secondary badge-pill">Auto</span>
									@endif
									@else
									<span class="badge badge-warning badge-pill">Pending</span>
									@if($r->regstep['stepreg'] <= 4)
									<span class="badge badge-danger badge-pill">Incomplete</span>
									@else
									<span class="badge badge-primary badge-pill">Complete</span>
									@endif
									@endif
									<hr>
									@if($r->examcard['numchar'])
									
									<a href="{{route('admin.examcard.edit', $r->id)}}" class="btn btn-icon-split btn-sm btn-secondary">
										<span class="icon"><i class="fas fa-clipboard"></i></span>
										<span class="text">{{$r->examcard['numchar']}}</span>
									</a>
									<a href="{{route('admin.examcard.view', $r->id)}}" target="_blank" class="btn btn-sm btn-dark">
										<i class="fas fa-print"></i>
									</a>
									@endif
									
								</td>
								{{--  --}}
								<td>
									{{$r->name}}<br>
									<small class="text-muted sub-title font-weight-light">
										{{$r->birthplace}}, {{date('d/m/Y', strtotime($r->birthdate))}}
									</small>
									<hr>
									<small>Nomor Virtual Account: </small><br>
									<strong>{{$r->nova}}</strong>
								</td>
								<td class="font-weight-bold">{{$r->gender == 1 ? 'L' : 'P'}}</td>
								{{--  --}}
								<td>
									{{$r->regschool['schname']}}<br>
									<small class="text-muted sub-title font-weight-light">{{$r->regschool['schkab']}} - {{$r->regschool['schprov']}}</small>
									<hr>
									<small>Tingkat: </small><br>
									<strong>{{$r->regschool['schlvl']}}</strong><br>
									<small>Pilihan Pesantren: </small><br>
									<strong>@if(strstr($r->destination, 'LUMUT')) RAUDHAH-2 @else RAUDHAH-1 @endif</strong>
								</td>
								{{--  --}}
								<td>
									{{$r->regparent['fname']}}<br>
									<small class="text-muted sub-title font-weight-light">
										<i class="fas fa-phone-alt"></i>	{{$r->regparent['fphone']}}
									</small>
									<hr>
									{{$r->regparent['mname']}}<br>
									<small class="text-muted sub-title font-weight-light">
										<i class="fas fa-phone-alt"></i>	{{$r->regparent['mphone']}} 
									</small>
								</td>
								{{--  --}}
								<td>
									<div class="btn-group" role="group">
										<a href="{{route('admin.registrants.profile', $r->id)}}" target="_blank" class="btn btn-success btn-sm">
											<i class="fas fa-user"></i>
										</a>
										@if($r->isverified == true && $r->examcard == null)
										<a href="{{route('admin.examcard.set', $r->id)}}" class="btn btn-primary btn-sm">
											<i class="fas fa-clipboard-list"></i>
										</a>
										@endif
										@if(Auth::user()->role == 2)
										@if($r->isverified == false)
										<a href="#" class="btn btn-warning btn-sm" id="setManualVerification" data-toggle="modal" data-target="#manualVerification" data-id="{{$r->id}}">
											<i class="fas fa-check"></i>
										</a>
										@endif
										<a href="#" class="btn btn-danger btn-sm" id="deleteRegistrant" data-toggle="modal" data-target="#modalDeleteRegistrant" data-id="{{$r->id}}" data-nik="{{$r->username}}" data-nama="{{$r->name}}">
											<i class="fas fa-trash"></i>
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
		</div><!-- /card -->
	</div>
</div>


@if(Auth::user()->role == 2)
<!-- Modal verifikasi manual -->
<div class="modal fade" id="manualVerification" tabindex="-1" role="dialog" aria-labelledby="manualVerificationLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-danger" id="manualVerificationLabel">Perhatian!</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Anda yakin ingin melakukan verifikasi pembayaran secara manual? <span class="text-danger">Aksi ini akan di catat oleh sistem untuk mencegah penyalahgunaan hak akses</span>.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-icon-split btn-sm" data-dismiss="modal">
					<span class="icon text-white-50">
						<i class="fas fa-times"></i>
					</span>
					<span class="text">Batalkan</span>
				</button>
				<button type="button" class="btn btn-primary btn-icon-split btn-sm" onclick="event.preventDefault();document.getElementById('manualverif').submit();">
					<span class="icon text-white-50">
						<i class="fas fa-user-check"></i>
					</span>
					<span class="text">Konfirmasi</span>
				</button>
			</div>
			<form action="{{route('admin.registrants.manual')}}" method="post" style="display:none" id="manualverif">
				@csrf
				<input type="hidden" name="idtoverif" id="idtoverif" value="">
			</form>
		</div>
		
	</div>
</div>

<!-- Modal delete registrant -->
<div class="modal fade" id="modalDeleteRegistrant" tabindex="-1" role="dialog" aria-labelledby="modalDeleteRegistrantLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-danger" id="modalDeleteRegistrantLabel">Perhatian!</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				@if($set->registration == true)
				<p>Penghapusan data calon santri tidak dapat dilakukan selama pendaftaran masih dibuka. Hal ini dilakukan untuk mencegah konflik dalam menentukan nomor Virtual Account pendaftar baru.<br>Silahkan tutup sementara pendaftaran dari menu pengaturan.</p>
				@else
				<p>Anda yakin ingin data calon santri bernama <span class="text-danger data-nama"></span> dengan NIK <span class="text-danger data-nik"></span>? <br>Data yang telah dihapus tidak akan dapat dikembalikan lagi!</p>
				@endif
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-icon-split btn-sm" data-dismiss="modal">
					<span class="icon text-white-50">
						<i class="fas fa-times"></i>
					</span>
					<span class="text">Batalkan</span>
				</button>
				@if($set->registration == true)
				<a href="{{route('admin.settings')}}" class="btn btn-info btn-icon-split btn-sm">
					<span class="icon text-white-50">
						<i class="fas fa-cog"></i>
					</span>
					<span class="text">Pengaturan</span>
				</a>
				@else
				<button type="button" class="btn btn-danger btn-icon-split btn-sm" onclick="event.preventDefault();document.getElementById('deleteregistrant').submit();">
					<span class="icon text-white-50">
						<i class="fas fa-trash"></i>
					</span>
					<span class="text">HAPUS</span>
				</button>
				@endif
			</div>
			<form action="{{route('admin.registrants.destroy')}}" method="post" style="display:none" id="deleteregistrant">
				@csrf
				<input type="hidden" name="idtodelete" id="idtodelete" value="">
			</form>
		</div>
		
	</div>
</div>

@endif

@endsection

@section('jsready')
$(document).on("click", "#setManualVerification", function(){
	var id = $(this).data("id");
	$("#idtoverif").val(id);
});
$(document).on("click", "#deleteRegistrant", function(){
	var id = $(this).data("id");
	var nama = $(this).data("nama");
	var nik = $(this).data("nik");
	$("#idtodelete").val(id);
	$(".data-nik").html(nik);
	$(".data-nama").html(nama);
});
@endsection

