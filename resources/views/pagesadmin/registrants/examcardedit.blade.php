@extends('layouts.admin')
@section('pagetitle', 'Buat Kartu Ujian')
@section('contents')
<div class="row">
	<div class="col-12">
		<div class="card shadow mb-4">
			<!-- Card Header -->
			<div class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-custom">Ubah Kartu Ujian {{$reg->name}}</h6>
				<a href="{{route('admin.registrants', 'all')}}" class="btn btn-dark btn-icon-split btn-sm">
					<span class="icon text-white-50">
						<i class="fas fa-chevron-left"></i>
					</span>
					<span class="text">Kembali</span>
				</a>
			</div>
			<form action="{{route('admin.examcard.update')}}" method="post">
				@csrf
				<input type="hidden" name="idtoupdate" value="{{$reg->id}}">
				<div class="card-body">
					<div class="row">
						<div class="col">
							Kartu ujian yang terakhir dibuat: 
							@foreach ($cardnums as $cardnum)
							<span class="badge badge-pill badge-primary ml-2">{{$cardnum}}</span>
							@endforeach
						</div>
					</div>
					<div class="dropdown-divider"></div>
					{{-- data --}}
					<div class="row">
						<div class="col-md-2 col-sm-12">
							Nama
						</div>
						<div class="col">
							: {{$reg->name}}
						</div>
					</div>
					<div class="row">
						<div class="col-md-2 col-sm-12">
							Jenis Kelamin
						</div>
						<div class="col">
							: {{$reg->gender == 1 ? 'Laki-laki' : 'Perempuan'}}
						</div>
					</div>
					<div class="row">
						<div class="col-md-2 col-sm-12">
							Tingkat
						</div>
						<div class="col">
							: {{$reg->regschool['schlvl']}}
						</div>
					</div>
					<div class="dropdown-divider"></div>
					<div class="row">
						{{-- numchar --}}
						<div class="form-group col-sm-12 col-md-6">
							<label for="numchar">Nomor Kartu Ujian<sup class="text-danger">*</sup></label>
							<input name="numchar" type="text" class="form-control @error('numchar') is-invalid @enderror" value="{{old('numchar', $card->numchar)}}" autofocus>
						</div>
						{{-- foodtable --}}
						<div class="form-group col-sm-12 col-md-6">
							<label for="foodtable">Meja Makan</label>
							<select name="foodtable" id="foodtable" class="form-control @error('foodtable') is-invalid @enderror">
								<option value="" selected disabled></option>
								@foreach ($tables as $t)
								<option value="{{$t->id}}"{{$t->vnow == $t->capacity ? ' disabled' : ''}} {{old('foodtable') == $t->id ? 'selected' : $card->foodtable_id == $t->id ? 'selected' : ''}}>{{$t->name}} - {{$t->capacity - $t->vnow}}/{{$t->capacity}}</option>
								@endforeach
							</select>
						</div>
						
						{{-- building class --}}
						<div class="form-group col-sm-12 col-md-6">
							<label for="builc">Gedung Ruang Kelas</label>
							<select name="builc" id="builc" class="form-control @error('builc') is-invalid @enderror">
								<option value="" selected disabled></option>
								@foreach ($bcs as $bc)
								<option value="{{$bc->id}}" {{$card->classroom->building['id'] == $bc->id ? 'selected' : ''}}>{{$bc->name}}</option>
								@endforeach
							</select>
						</div>
						{{-- classroom --}}
						<div class="form-group col-sm-12 col-md-6">
							<label for="classroom">Ruangan Kelas</label>
							<select name="classroom" id="classroom" class="form-control @error('classroom') is-invalid @enderror">
								<option value="" selected disabled></option>
							</select>
						</div>
						{{-- building dorms --}}
						<div class="form-group col-sm-12 col-md-6">
							<label for="build">Gedung Asrama</label>
							<select name="build" id="build" class="form-control @error('build') is-invalid @enderror">
								<option value="" selected disabled></option>
								@foreach ($bds as $bd)
								<option value="{{$bd->id}}" {{$card->room->building['id'] == $bd->id ? 'selected' : ''}}>{{$bd->name}}</option>
								@endforeach
							</select>
						</div>
						{{-- dormroom --}}
						<div class="form-group col-sm-12 col-md-6">
							<label for="dormroom">Ruangan Asrama</label>
							<select name="dormroom" id="dormroom" class="form-control @error('dormroom') is-invalid @enderror">
								<option value="" selected disabled></option>
							</select>
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
<script>
	
	// get data to payment
	$(document).on("click", "#getDataPayment", function(){
		var id = $(this).data('id');
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			method: "POST",
			url: "{{route('admin.ajax.getpayment')}}",
			data: {
				id: id,
			},
			success: function(res){
				// console.log(res);
				$("#no_trans").html(res.data.paynumber);
				$("#img_trans").attr("src", "{{asset('img/payimgs/')}}/" + res.data.payimg);
				$("#idpayment").val(id);
				if(res.data.isverified == 1) { $("#payfooter").hide(); }
			}
		});
	});
	
	// get data to select
	function ajaxGetRooms(bid, cat, selid){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			
			method: "POST",
			url: "{{route('admin.ajax.getrooms')}}",
			data: {
				bid: bid,
				cat: cat,
			},
			success: function(res){
				$(selid).empty();
				// console.log(res.data);		
				$.each(res.data, function(i, v){
					var disabled = '';
					var selected = '';
					var sisa =  parseInt(v.capacity) - parseInt(v.vnow);
					if(cat == 1){
					var xid = {{$card->classroom_id}};
					} else {
					var xid = {{$card->room_id}};
					}
					if(xid == v.id){ selected = ' selected'};
					if(v.capacity == v.vnow){ disabled = ' disabled' };
					$(selid).append('<option value="'+ v.id +'"'+ disabled +' '+ selected +'>'+ v.name +' - ('+ sisa +'/'+ v.capacity +')</option>');
				});
			},
		});
	}
</script>
@endsection



@section('jsready')

var bc = $("#builc").val();
ajaxGetRooms(bc, 1, "#classroom");

var bd = $("#build").val();
ajaxGetRooms(bd, 2, "#dormroom");

$("#builc").change(function(){
	var val = $(this).val();
	ajaxGetRooms(val, 1, "#classroom");
});
$("#build").change(function(){
	var val = $(this).val();
	ajaxGetRooms(val, 2, "#dormroom");
});

@endsection