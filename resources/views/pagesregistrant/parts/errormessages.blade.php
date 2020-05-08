<div class="ui error message segment">
	<i class="close icon"></i>
	<div class="header">Error! Mohon periksa kembali data yang anda isi.</div>
	<ul class="list">
		@if (count($errors) > 3)
			<li>Setiap kolom yang bertanda bintang ( <strong>*</strong> ) tidak boleh dikosongkan.</li>
			<li>Periksa kembali isi setiap kolom yang ditandai dengan warna merah.</li>
		@else
		@foreach ($errors->all() as $error)
		<li>{!! $error !!}</li>
		@endforeach
		@endif
	</ul>
</div>