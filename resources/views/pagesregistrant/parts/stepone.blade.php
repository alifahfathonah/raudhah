<div class="ui two column stackable grid container">
	<div class="column">
		<div class="ui padded segment" style="height: 100%">
			<h2 class="ui header sitecolor">
				<i class="credit card icon"></i>
				<div class="content">
					Pembayaran
				</div>
			</h2>
			<div class="ui divider"></div>
			<div class="ui center aligned basic segment">
				<h3 class="ui grey header left aligned">Lakukan pembayaran sejumlah:</h3>
				<h1 class="ui red header label">Rp. {{number_format($set->cost,0,",",".")}}</h1>
				<div class="ui divider"></div>
				<h3 class="ui grey header left aligned">Ke rekening virtual:</h3>
				<img class="ui centered small image" src="{{asset('img/app/bsm.png')}}" alt="Bank Syariah Mandiri">
				
				
				<h1 class="ui mandiricolor header positive message">
					{{Auth::user()->nova}}
				</h1>
			</div>
		</div>
	</div>
	<div class="column">
		<div class="ui padded segment" style="height: 100%">
			<h2 class="ui header sitecolor">
				<i class="handshake icon"></i>
				<div class="content">
					Verifikasi
				</div>
			</h2>
			<div class="ui divider"></div>
			<div class="ui basic segment">
				<div class="ui info message">
					<div class="ui header">Informasi</div>
					<p>Proses verifikasi akan dilakukan otomatis oleh sistem dalam kurun waktu maksimal 24 jam setelah pembayaran diterima. Silahkan login atau refresh halaman ini secara berkala.</p>
				</div>
				<div class="ui warning message">
					<div class="ui header">Perhatian</div>
					<p>Tetap simpan bukti transaksi anda. Jika dalam 24 jam sistem tidak memverifikasi pembayaran anda, silahkan ajukan permintaan verifikasi manual ke salah satu kontak berikut:</p> 

					<div class="ui basic segments">
						<div class="ui basic segment">
							<h5 class="ui header"><i class="mail icon"></i><div class="content">{{$set->email}}</div></h5> 
						</div>
						<div class="ui basic segment">
							<h5 class="ui header"><i class="phone icon"></i><div class="content">{{$set->phone}}</div></h5>
						</div>
						<div class="ui basic segment">
							<h5 class="ui header"><i class="mobile icon"></i><div class="content">{{$set->mobile}}</div></h5>
						</div>
					</div>

					
					
					
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!--
	
	<img class="ui centered small image" src="{{asset('img/app/bsm.png')}}" alt="Bank Syariah Mandiri">
	
	<span class="ui label red">Rp. {{number_format($set->cost,0,",",".")}}</span>
	
-->
