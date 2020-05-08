@extends('layouts.admin')
@section('pagetitle', 'Data Asrama')
@section('contents')

<div class="row">
	{{-- form tambah ruangan --}}
	<div class="col-sm-12 col-md-4">
		<div class="card shadow mb-4">
			<!-- Card Header -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-custom">Input Data Asrama</h6>
			</div>
			<form action="{{route('admin.rooms.store')}}" method="post" id="formRoom">
				@csrf
				<!-- Card Body -->
				<div class="card-body">
					{{-- building --}}
					<div class="form-group">
						<label for="building">Nama Gedung<sup class="text-danger">*</sup></label>
						<select name="building" class="form-control @error('building') is-invalid @enderror inp-building" id="building" aria-describedby="buildingHelp"{{$buildings->count() == 0 ? ' disabled' : ''}}>
							<option value="" disabled selected>{{$buildings->count() == 0 ? 'Gedung masih kosong.' : 'Pilih nama gedung.'}}</option>
							@foreach ($buildings as $building)
							<option value="{{$building->id}}"{{old('building') == $building->id ? ' selected' : ''}}>{{$building->name}}</option>
							@endforeach
						</select>
					</div>
					{{-- name --}}
					<div class="form-group">
						<label for="name">Nama Ruangan<sup class="text-danger">*</sup></label>
						<input name="name" type="text" id="name" class="form-control @error('name') is-invalid @enderror inp-name" value="{{old('name')}}">
					</div>
					{{-- capacity --}}
					<div class="form-group">
						<label for="capacity">Kapasitas Ruangan<sup class="text-danger">*</sup></label>
						<input name="capacity" type="text" id="capacity" class="form-control @error('capacity') is-invalid @enderror inp-capacity" value="{{old('capacity')}}" aria-describedby="capacityHelp">
						<small id="capacityHelp" class="form-text text-muted">Jumlah santri yang dapat ditampung.</small>
					</div>
					{{-- hidden id --}}
					<input type="hidden" name="idtoupdate" value="" id="idtoupdate">
				</div>
				<div class="card-footer d-flex justify-content-end">
					<button type="button" class="btn btn-secondary btn-icon-split btn-sm mr-2" id="btnCancel" style="display:none">
						<span class="icon text-white-50">
							<i class="fas fa-times"></i>
						</span>
						<span class="text">Batal</span>
					</button>
					<button type="submit" class="btn btn-info btn-icon-split btn-sm">
						<span class="icon text-white-50">
							<i class="fas fa-check"></i>
						</span>
						<span class="text" id="btntext">Simpan</span>
					</button>
				</div>
			</form>
		</div>
	</div>
	
	{{-- list ruangan --}}
	<div class="col-sm-12 col-md-8">
		<div class="card shadow mb-4">
			<!-- Card Header -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-custom">Data Asrama</h6>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<form action="{{route('admin.buildings.store')}}" method="post" class="pb-4 pt-2">
					@csrf
					<input type="hidden" name="category" value="2">
					<div class="row">
						<div class="col-12 d-flex justify-content-between">
							{{-- name --}}
							<input name="name" type="text" id="name" class="form-control mr-2 @error('name') is-invalid @enderror" value="{{old('name')}}" placeholder="Tambah Nama Gedung">
							<button type="submit" class="btn btn-info">
								<i class="fas fa-plus"></i>
							</button>
						</div>
					</div>
				</form>
				@if ($buildings->count() == 0)
				<p class="text-center">Tentukan nama gedung melalui form di atas.</p>
				@else
				<ul class="list-group">
					@foreach ($buildings as $building)
					<li class="list-group-item list-group-item-info d-flex justify-content-between align-items-center">
						<span class="font-weight-bold">{{$building->name}}</span>
						<button type="button" class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#deleteBuilding" data-id="{{$building->id}}" data-name="{{$building->name}}">
							<i class="fas fa-trash"></i>
						</button>
					</li>
					@if ($building->room->count() == 0)
					<li class="list-group-item"><small class="ml-4">Tidak ada data ruangan pada gedung {{$building->name}}.</small></li>
					@else
					@foreach ($building->room as $room)
					<li class="list-group-item d-flex justify-content-between align-items-center">
						<div class="ml-4">
							<span class="font-weight-bold">{{$room->name}}</span>, kapasitas {{$room->capacity}} orang.
						</div>
						<div class="btn-group btn-group-sm" role="group">
							<button type="button" class="btn btn-success" onclick="editroom({{$room->id}}, {{$room->building_id}}, '{{$room->name}}', {{$room->capacity}})">
								<i class="fas fa-edit"></i>
							</button>
							<a href="{{route('admin.rooms.destroy', $room->id)}}" class="btn btn-danger">
								<i class="fas fa-trash"></i>
							</a>
						</div>
					</li>
					@endforeach
					@endif
					@endforeach
				</ul>
				@endif
			</div>
		</div>
	</div>
	{{-- /row --}}
</div>

{{-- modal deleteBuilding --}}
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="deleteBuildingLabel" id="deleteBuilding" >
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="deleteBuildingLabel">Hapus Data Gedung</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Menghapus data gedung akan ikut menghapus semua ruangan yang terkait dengannya. Anda yakin ingin menghapus gedung <span class="font-weight-bold text-danger" id="buildingName"></span>?</p>
			</div>
			<div class="modal-footer">
				<form action="{{route('admin.buildings.destroy')}}" method="post">
					@csrf
					<input type="hidden" name="idtodelete" id="idtodelete" value="">
					<button type="button" class="btn btn-secondary btn-sm btn-icon-split" data-dismiss="modal">
						<span class="icon text-white-50">
							<i class="fas fa-times"></i>
						</span>
						<span class="text">Batal</span>
					</button>
					<button type="submit" class="btn btn-danger btn-sm btn-icon-split">
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
<script src="{{asset('vendor/cleave/cleave.min.js')}}"></script>
<script>
	// cleave capacity
	var cleave = new Cleave('#capacity', {
		numeral: true,
		numeralThousandsGroupStyle: 'none'
	});
	
	// edit room
	function editroom(id, b, nm, cp){
		$(".inp-building").val(b);
		$(".inp-name").val(nm);
		$(".inp-capacity").val(cp);
		$("#idtoupdate").val(id);
		$("#btntext").html('Ubah');
		$("#btnCancel").removeAttr('style');
		$("#formRoom").attr("action", "{{route('admin.rooms.update')}}");
	}
	// button cancel
	$("#btnCancel").click(function(e){
		e.preventDefault();
		$(".inp-building").val('');
		$(".inp-name").val('');
		$(".inp-capacity").val('');
		$("#idtoupdate").val('');
		$("#btntext").html('Simpan');
		$("#formRoom").attr("action", "{{route('admin.rooms.store')}}");
		$("#btnCancel").attr('style', 'display:none');
	});
	
	// modal deleteBuilding
	$('#deleteBuilding').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		var id = button.data('id');
		var nm = button.data('name');
		var modal = $(this)
		modal.find('#buildingName').text(nm);
		modal.find('#idtodelete').val(id);
	})
</script>	
@endsection