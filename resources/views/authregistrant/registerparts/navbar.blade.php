<div class="ui large top attached container stackable menu">
	
	<div class="item">
		<img src="{{asset('img/app/' . $set->logo)}}">
	</div>
	<div class="header item sitecolor">
		{{$set->name}}
	</div>
	@if(Auth::user())
	<a class="ui item" href={{route('registrant.dashboard')}}>
		<i class="home icon"></i>
		Beranda
	</a>
	@endif
	
	
	<div class="right menu">
		@if(!Auth::guard('registrant')->id())
		@if(Request::segment(1) == '')
		<a class="ui item" href="{{ route('registrant.login') }}"><i class="sign in alternate icon"></i> Login</a>
		@endif
		@if(Request::segment(1) == 'login')
		<a class="ui item" href="{{ route('registrant.register') }}"><i class="share square icon"></i> Register</a>
		@endif
		@if(Request::segment(1) == 'forgot')
		<a class="ui item" href="{{ route('registrant.register') }}"><i class="share square icon"></i> Register</a>
		<a class="ui item" href="{{ route('registrant.login') }}"><i class="sign in alternate icon"></i> Login</a>
		@endif
		@else
		@if(Auth::user()->regstep['stepreg'] > 4)
		<a href="{{route('registrant.dashboard.edit')}}" class="ui item">
			<i class="edit icon"></i>
			Ubah Data
		</a>
		@endif
		<a href="#" class="ui item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
			<i class="power icon"></i>
			Logout
		</a>
		<form id="logout-form" action="{{ route('registrant.logout') }}" method="POST" style="display: none;">
			@csrf
		</form>
		
		
		
		@endif
	</div>
</div>