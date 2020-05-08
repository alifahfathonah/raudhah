@extends('layouts.admin')
@section('pagetitle', 'Data Meja Makan')
@section('contents')

<div class="row">
	{{-- form tambah meja makan --}}
	<div class="col-sm-12 col-md-4">
		<div class="card shadow mb-4">
			<!-- Card Header -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-custom">Input Data Meja Makan</h6>
			</div>
			<form action="{{route('admin.tables.store')}}" method="post" id="formFoodTables">
				@csrf
				<!-- Card Body -->
				<div class="card-body">
					{{-- name --}}
					<div class="form-group">
						<label for="name">Nomor/Nama Meja Makan<sup class="text-danger">*</sup></label>
						<input name="name" type="text" id="name" class="form-control @error('name') is-invalid @enderror inp-name" value="{{old('name')}}">
					</div>
					{{-- capacity --}}
					<div class="form-group">
						<label for="capacity">Kapasitas Meja<sup class="text-danger">*</sup></label>
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
	
	{{-- list meja makan --}}
	<div class="col-sm-12 col-md-8">
		<div class="card shadow mb-4">
			<!-- Card Header -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-custom">Data Meja Makan</h6>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<ul class="list-group">
					@if ($tables->count() == 0)
					<li class="list-group-item"><small>Tidak ada data meja makan.</small></li>
					@else
					@foreach ($tables as $table)
					<li class="list-group-item d-flex justify-content-between align-items-center">
						<div>
							<span class="font-weight-bold">{{$table->name}}</span>, kapasitas {{$table->capacity}} orang.
						</div>
						<div class="btn-group btn-group-sm" role="group">
							<button type="button" class="btn btn-success" onclick="edittable({{$table->id}}, '{{$table->name}}', {{$table->capacity}})">
								<i class="fas fa-edit"></i>
							</button>
							<a href="{{route('admin.tables.destroy', $table->id)}}" class="btn btn-danger">
								<i class="fas fa-trash"></i>
							</a>
						</div>
					</li>
					@endforeach
					@endif
				</ul>
			</div>
		</div>
	</div>
	{{-- /row --}}
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
	
	// edit table
	function edittable(id, nm, cp){
		$(".inp-name").val(nm);
		$(".inp-capacity").val(cp);
		$("#idtoupdate").val(id);
		$("#btntext").html('Ubah');
		$("#btnCancel").removeAttr('style');
		$("#formFoodTables").attr("action", "{{route('admin.tables.update')}}");
	}
	// button cancel
	$("#btnCancel").click(function(e){
		e.preventDefault();
		$(".inp-name").val('');
		$(".inp-capacity").val('');
		$("#idtoupdate").val('');
		$("#btntext").html('Simpan');
		$("#formFoodTables").attr("action", "{{route('admin.tables.store')}}");
		$("#btnCancel").attr('style', 'display:none');
	});
</script>	
@endsection