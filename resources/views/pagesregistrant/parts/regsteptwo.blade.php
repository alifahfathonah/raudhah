
@if ($data->totalsiblings > 0)
<form class="ui form basic segment @if ($errors->any()) error @endif" method="POST" action="{{route('register.step.2')}}">
	@csrf
	<div class="field">
		
		@include('pagesregistrant.parts.errormessages')
		
		@for ($i = 0; $i < $data->totalsiblings; $i++)
		
		
			
			<div class="fields">
				<div class="five wide field required @error('sibname.' . $i) error @enderror">
					<label>Nama Saudara</label>
					<input type="text" name="sibname[]" class="uppercase-input" value="{{old('sibname.' . $i, '')}}" placeholder="Nama lengkap saudara {{$i+1}}">
				</div>
				<div class="three wide field">
					<label>Hubungan</label>
					<select class="ui dropdown" name="sibrel[]">
						@foreach ($sibrelations as $rel)
						<option value="{{$rel}}"{{old('sibrel.' . $i) == $rel ? ' selected' : ''}}>{{$rel}}</option>
						@endforeach
					</select>
				</div>
				<div class="four wide field required @error('sibnik.' . $i) error @enderror">
					<label>NIK Sesuai KK</label>
					<input type="text" name="sibnik[]" class="digit-input" value="{{old('sibnik.' . $i, '')}}" placeholder="16 digit NIK Saudara">		
				</div>
				<div class="four wide field">
					<label>No. Handphone</label>
					<input type="text" name="sibphone[]" class="phone-input" value="{{old('sibphone.' . $i, '')}}" placeholder="Kosongkan jika tidak ada">		
				</div>
			</div>
		
		
		@endfor
		
		<div class="ui basic segment">
			<button type="submit" class="ui submit right floated primary button large">
				Selanjutnya <i class="right arrow icon"></i> 
			</button>
		</div>
		
		<div class="ui basic segment"></div>
	</div>
</form>


@else

<div class="ui message success">
	<div class="header">Anda tidak perlu mengisi data saudara, silahkan lewati tahapan ini.</div>
</div>

<div class="ui segment basic">
	<a href="#" class="ui right floated large button primary" onclick="event.preventDefault();document.getElementById('formskipsteptwo').submit();">
		Selanjutnya <i class="right arrow icon"></i> 
	</a>
</div>
<form action="{{route('register.step.2')}}" method="post" style="display: none" id="formskipsteptwo">
@csrf
<input type="hidden" value="{{Auth::id()}}" name="id">
</form>

<div class="ui segment basic"></div>

@endif