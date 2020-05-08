
<div class="ui ordered four steps">
	<div class="step teal @if($regstep == 1) active @endif @if($regstep > 1) completed @endif @if($regstep < 1) disabled @endif">
		<div class="content">
			<div class="title">Biodata</div>
			<div class="description">Data diri calon santri.</div>
		</div>
	</div>
	<div class="step @if($regstep == 2) active @endif @if($regstep > 2) completed @endif @if($regstep < 2) disabled @endif">
		<div class="content">
			<div class="title">Saudara</div>
			<div class="description">Data saudara kandung/tiri.</div>
		</div>
	</div>
	<div class="step @if($regstep == 3) active @endif @if($regstep > 3) completed @endif @if($regstep < 3) disabled @endif">
		<div class="content">
			<div class="title">Asal Sekolah</div>
			<div class="description">Tamatan/pindahan sekolah.</div>
		</div>
	</div>
	<div class="step @if($regstep == 4) active @endif @if($regstep > 4) completed @endif @if($regstep < 4) disabled @endif">
		<div class="content">
			<div class="title">Orang Tua</div>
			<div class="description">Data orang tua kandung.</div>
		</div>
	</div>
</div>