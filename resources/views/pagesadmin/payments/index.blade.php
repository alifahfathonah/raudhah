@extends('layouts.admin')
@section('pagetitle', 'Data Pembayaran')
@section('contents')

<div class="row">
	
	
	<div class="col-sm-12 col-md-4">
		
		<div class="row">
			<div class="col-12 mb-4">
				
				<div class="card border-left-success shadow h-100 py-2">
					<div class="card-body">
						
						<div class="row no-gutters align-items-center" id="cardExcel" style="cursor:pointer">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-gray-800 text-uppercase mb-1">Click untuk Import</div>
								<div class="h1 mb-0 font-weight-bold text-success">File Excel</div>
								<div class="text-xs font-weight-bold text-secondary text-uppercase mb-1" id="textFileExcel"></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-file-excel fa-4x text-gray-300" id="iconExcel"></i>
							</div>
						</div>
						<div class="row mt-2" id="btnUploadExcel" style="display:none">
							<div class="col">
								<button class="btn btn-success btn-block">Upload</button>
							</div>
						</div>
						<div class="dropdown-divider"></div>
						<div class="row mt-4">
							<div class="col">
								<i class="fas fa-download mr-2"></i>
								<a class="text-decoration-none font-weight-bold" href="{{asset('contoh_format_data_transaksi.xlsx')}}">Download Contoh File Excel</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<form action="{{route('admin.payments.excelstore')}}" method="post" enctype="multipart/form-data" id="formExcel">
			@csrf
			<div class="inputfileexcel">
				<input type="file" name="fileexcel" id="fileExcel">
			</div>
		</form>
		
		
		{{-- form tambah pembayaran --}}
		<div class="card shadow mb-4">
			<!-- Card Header -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-custom">Manual Input Data Bank</h6>
			</div>
			
			@php $today = date('d/m/Y'); @endphp
			<form action="{{route('admin.payments.store')}}" method="post">
				@csrf
				<!-- Card Body -->
				<div class="card-body">
					{{-- paydate --}}
					<div class="form-group">
						<label for="paydate">Tanggal Transfer<sup class="text-danger">*</sup></label>
						<input name="paydate" type="text" id="paydate" class="form-control @error('paydate') is-invalid @enderror" value="{{old('paydate')}}">
					</div>
					{{-- paynumber --}}
					<div class="form-group">
						<label for="paynumber">16 Digit Nomor Virtual Account<sup class="text-danger">*</sup></label>
						<input name="paynumber" type="text" id="paynumber" class="form-control @error('paynumber') is-invalid @enderror" value="{{old('paynumber')}}">
					</div>
					{{-- paynominal --}}
					<div class="form-group">
						<label for="paynominal">Nominal Transfer</label>
						<input name="paynominal" type="text" id="paynominal" class="form-control @error('paynominal') is-invalid @enderror" value="{{old('paynominal')}}">
					</div>
				</div>
				
				<div class="card-footer d-flex justify-content-end">
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
	
	{{-- col tabel kanan --}}
	<div class="col-sm-12 col-md-8">
		<div class="card shadow mb-4">
			<!-- Card Header -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-custom">Data Pembayaran Bank</h6>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<table id="dataTable" class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Tanggal</th>
							<th>No. Virtual Account</th>
							<th>Nominal Transfer</th>
							@if(Auth::user()->role == 2)
							<th>Aksi</th>
							@endif
						</tr>
					</thead>
					@php $no = 1 @endphp
					<tbody>
						@foreach ($payments as $payment)
						<tr>
							<td>{{$no++}}</td>
							<td>{{date('d/m/Y', strtotime($payment->paydate))}}</td>
							<td class="{{$payment->status ? 'text-success' : ''}}">{{$payment->paynumber}}</td>
							<td class="text-right{{$payment->paynominal < $set->cost ? ' text-danger' : ''}}">{{$payment->paynominal}}</td>
							@if(Auth::user()->role == 2)
							<td class="d-flex justify-content-end">
								<div class="btn-group" role="group" aria-label="Basic example">
									<a href="#" class="btn btn-danger btn-sm paymenttodelete" data-toggle="modal" data-target="#paymentDelete" data-id="{{$payment->id}}" data-nama="{{$payment->paynumber}}">
										<i class="fas fa-fw fa-trash"></i>
									</a>
								</div>
							</td>
							@endif
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
	
	{{-- /row --}}
</div>



<!-- Modal Delete -->
<div class="modal fade" id="paymentDelete" tabindex="-1" role="dialog" aria-labelledby="paymentDeleteLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="paymentDeleteLabel">Hapus data <span class="paymentname"></span></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Data transfer yang dihapus tidak dapat dikembalikan lagi! Apakah anda yakin ingin menghapus data transfer dengan nomor referensi <span class="text-danger paymentname"></span>?</p>
			</div>
			<div class="modal-footer">
				<form action="{{route('admin.payments.destroy')}}" method="post">
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
<script src="{{asset('vendor/cleave/cleave.min.js')}}"></script>
<script>
	// cleave date
	new Cleave('#paydate', {
		date: true,
		datePattern: ['d', 'm', 'Y']
	});
	// cleave nominal
	var cleave = new Cleave('#paynominal', {
		numeral: true,
		numeralThousandsGroupStyle: 'thousand',
		prefix: 'Rp ',
		noImmediatePrefix: true,
		rawValueTrimPrefix: true,
		numeralDecimalMark: ',',
		delimiter: '.'
	});
	// cleave va
	
	var cleave = new Cleave("#paynumber", {
		numericOnly: true,
		blocks: [16],
	});
	
	// file excel input
	$("#cardExcel").click(function(e){
		e.stopPropagation();
		$("#fileExcel").trigger('click');
		// alert('a');
	});
	$("#fileExcel").change(function(e){
		e.preventDefault();
		var file = $(this).val();
		var filename = file.split(/(\\|\/)/g).pop();
		$("#textFileExcel").html(filename);
		$("#iconExcel").removeClass('text-gray-300');
		$("#iconExcel").addClass('text-success');
		$("#btnUploadExcel").show();
	});
	$("#btnUploadExcel").click(function(){
		$("#formExcel").submit();
	});
	$(document).on("click", ".paymenttodelete", function () {
		var id 	= $(this).data('id');
		var name = $(this).data('nama');
		$(".modal-footer #idtodelete").val(id);
		$(".paymentname").html(name);
	});
</script>	
@endsection