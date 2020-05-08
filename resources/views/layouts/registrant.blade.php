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
	<link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
	<link href="{{asset('css/sb-admin-custom.css')}}" rel="stylesheet">
	<link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
	<link href="{{asset('css/custom-front.css')}}" rel="stylesheet">
</head>
<body>
	
	<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
		<div class="container">
			<a class="navbar-brand" href="{{url('/')}}">
				<img src="{{asset('img/app/'. $set->logo)}}" alt="" height="24" class="mr-2">
				{{$set->name}}
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				{{-- <i class="navbar-toggler-icon fas fa-bars text-white"></i> --}}
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ml-auto">
					<!-- Authentication Links -->
					@if(!Auth::guard('registrant')->id())
					@if(Request::segment(1) == 'register')
					<li class="nav-item">
						<a href="{{ route('registrant.login') }}" class="nav-link">Login</a>
					</li>
					@endif
					@if(Request::segment(1) == 'login')
					<li class="nav-item">
						<a href="{{ route('registrant.register') }}" class="nav-link">Register</a>
					</li>
					@endif
					@else
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							{{ Auth::guard('registrant')->user()->name }}
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<a class="dropdown-item" href="{{route('registrant.dashboard')}}">Dashboard</a>
							<a class="dropdown-item" href="{{ route('registrant.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
							<form id="logout-form" action="{{ route('registrant.logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</div>
					</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>	
	
	
	<main class="py-2">
		@yield('content')
	</main>
	
	<!-- Footer -->
	<footer class="sticky-footer bg-white">
		<div class="container my-auto">
			<div class="copyright text-center my-auto">
				<span>Copyright &copy; {{date('Y')}} - <a class="text-decoration-none" href="{{$set->web}}">{{$set->prefix}} {{$set->name}} {{$set->suffix}}</a></span>
			</div>
		</div>
	</footer>
	
	<!-- Scripts -->
	<!-- Bootstrap core JavaScript-->
	<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
	<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
	
	<!-- Core plugin JavaScript-->
	<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
	<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
	
	<!-- Custom scripts for all pages-->
	<script src="{{asset('js/sb-admin-2.min.js')}}"></script>
	@yield('pagescript')
</body>
</html>
