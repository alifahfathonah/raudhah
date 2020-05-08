<div class="ui attached segment">
	
	
	@if(Auth::user()->paysubmitted == false)
	
	<form action="{{route('registrant.paystep.two')}}" method="POST" id="form-two" enctype="multipart/form-data">
		@csrf
		<div class="ui segment">
			
			<div class="ui form">

				<div class="ui info message">
					<div class="header">
						Informasi.
					</div>
					Masukkan nomor transaksi atau nomor referensi yang tertera pada struk bukti transaksi anda. Kolom nomor transaksi dapat dikosongkan jika tidak tertera pada struk/bukti transaksi anda (proses verifikasi akan dilakukan secara manual dan lebih lama).
				</div>

				<div class="ui basic segment"></div>

				<div class="fields">
					<div class="three wide field"></div>
					<div class="ten wide field">
						<div class="ui input huge">
							<input type="text" name="paynumber" id="noreff" placeholder="NOMOR TRANSAKSI/REFF" value="{{old('paynumber', '')}}" class="uppercase-input">
						</div>
						<label><a href="#" onclick="modalbt()">Klik untuk melihat contoh Nomor Transaksi.</a></label>
					</div>
				</div>

				<div class="ui basic segment"></div>
				<div class="ui divider"></div>

				<div class="ui info message">
					<div class="header">
						Informasi.
					</div>
					Foto struk atau screenshot bukti transaksi anda lalu unggah menggunakan tombol di bawah ini.
				</div>

				<div class="ui basic segment"></div>
				
				<div class="ui middle aligned center aligned grid container">
					<div class="ui fluid basic segment">
						<input type="file" (change)="fileEvent($event)" class="inputfile" id="payimg" name="payimg" />
						<label for="payimg" class="ui huge positive right floated button">
							<i class="ui upload icon" id="iconuploadimg"></i> 
							<span id="btntext">Unggah Foto Bukti Transaksi</span>
						</label>
					</div>
				</div>
				
				
				<div class="ui basic segment"></div>
				
			</div>
		</div>
		
		<div class="ui segment basic">
			<button class="ui left floated large button" id="back">
				<i class="left arrow icon"></i> Kembali 
			</button>
			<button type="submit" class="ui right floated large button primary">
				Selanjutnya <i class="right arrow icon"></i> 
			</button>
		</div>
		
		
		<div class="ui segment basic"></div>
	</form>
	
	@else

	<div class="ui positive icon message">
		<i class="bell icon"></i>
		<div class="content">
			<div class="header">
				Terima kasih.
			</div>
			Pembayaran anda sedang kami proses. Mohon tunggu paling lama 24 jam dan cek secara berkala pada halaman ini. <a href="#" onclick="location.reload()"><strong>Refresh</strong>.</a>
		</div>
	</div>

	@endif

</div>

@include('sweetalert::alert')