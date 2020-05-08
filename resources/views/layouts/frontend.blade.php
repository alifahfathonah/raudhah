<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<title>{{ $set->name }} @yield('pagetitle')</title>
	<!-- Custom fonts for this template-->
	<link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	
	<!-- Custom styles for this template-->
	<link href="{{asset('front/css/bootstrap.css')}}" rel="stylesheet">
	<link href="{{asset('front/css/mdb.css')}}" rel="stylesheet">
	<link href="{{asset('front/css/addons/steppers.min.css')}}" rel="stylesheet">
	<link href="{{asset('front/css/addons/cards-extended.min.css')}}" rel="stylesheet">
	<link href="{{asset('front/css/modules/animations-extended.min.css')}}" rel="stylesheet">

	<link href="{{asset('front/css/style.css')}}" rel="stylesheet">
</head>
<body>
	
	<!--Navbar-->
	<nav class="navbar navbar-expand-lg navbar-dark teal darken-1">
		
		<!-- Navbar brand -->
		<a class="navbar-brand" href="{{url('/')}}">{{$set->name}}</a>
		
		<!-- Collapse button -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigasi" aria-controls="navigasi" aria-expanded="false"  aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	
	<!-- Collapsible content -->
	<div class="collapse navbar-collapse" id="navigasi">
		
		<!-- Links -->
		<ul class="navbar-nav ml-auto">
			<!-- Authentication Links -->
			@if(!Auth::guard('registrant')->id())
			@if(Request::segment(1) == 'register')
			<li class="nav-item">
				<a class="nav-link" href="{{ route('registrant.login') }}">Login</a>
			</li>
			@endif
			@if(Request::segment(1) == 'login')
			<li class="nav-item">
				<a class="nav-link" href="{{ route('registrant.register') }}">Register</a>
			</li>
			@endif
			@else
			<!-- Dropdown -->
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
				<div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
					<a class="dropdown-item" href="{{route('registrant.dashboard')}}">Dashboard</a>
					<a class="dropdown-item" href="{{route('registrant.logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
					<form id="logout-form" action="{{ route('registrant.logout') }}" method="POST" style="display: none;">
						@csrf
					</form>
				</div>
			</li>
			@endif
			
		</ul>
		
	</div>
	<!-- Collapsible content -->
	
</nav>
<!--/.Navbar-->

@yield('content')

<!-- Custom Javascripts -->
<script src="{{asset('front/js/jquery.js')}}"></script>
<script src="{{asset('front/js/popper.js')}}"></script>
<script src="{{asset('front/js/bootstrap.js')}}"></script>
<script src="{{asset('front/js/mdb.js')}}"></script>
<script src="{{asset('front/js/addons/steppers.min.js')}}"></script>
<script src="{{asset('front/js/modules/animations-extended.min.js')}}"></script>
<script src="{{asset('front/js/modules/forms-free.min.js')}}"></script>
<script src="{{asset('front/js/modules/scrolling-navbar.min.js')}}"></script>
<script src="{{asset('front/js/modules/treeview.min.js')}}"></script>
<script src="{{asset('front/js/modules/wow.min.js')}}"></script>
<script src="{{asset('front/js/modules/material-select-view-renderer.min.js')}}"></script>
<script src="{{asset('front/js/modules/material-select-view.min.js')}}"></script>
<script src="{{asset('front/js/modules/material-select.min.js')}}"></script>

@yield('pagescript')
</body>
</html>