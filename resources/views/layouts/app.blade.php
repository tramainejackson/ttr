<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Favicon -->
	<!-- <link rel="shortcut icon" href="/favicon_jrh.ico" type="image/x-icon">
	<link rel="icon" href="/favicon_jrh.ico" type="image/x-icon"> -->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ToTheRec</title>

    <!-- Styles -->
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Bootstrap core CSS -->
	<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
	<!-- Material Design Bootstrap -->
	<link href="{{ asset('/css/mdb.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/ttr.css') }}" rel="stylesheet">
	
	@if(substr_count(request()->server('HTTP_USER_AGENT'), 'rv:') > 0)
		<link href="{{ asset('/css/myIEcss.css') }}" rel="stylesheet">
	@endif
	
	@yield('addt_style')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg justify-content-between">

			<!-- Branding Image -->
			<a class="navbar-brand" href="{{ route('welcome') }}">{{ config('app.name', 'Laravel') }}</a>
	
			<!-- SideNav slide-out button -->
			<a href="#" data-activates="slide-out" class="btn btn-primary p-3 button-collapse navbar-toggler" data-toggle="collapse" data-target="#app-navbar-collapse" aria-controls="app-navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="sr-only">Toggle Navigation</span>
				<i class="fa fa-bars"></i>
			</a>

			<!-- Sidebar navigation -->
			<div id="slide-out" class="side-nav fixed">
				<ul class="custom-scrollbar">
					<!--/. Side navigation links -->
					<li id="index"><a href="{{ route('welcome') }}">Home</a></li>	
					<li id="rec_li"><a href="{{ route('rec_centers.index') }}">Parks N Recs</a></li>
					<li id="player_li"><a href="{{ route('players.index') }}">Players</a></li>
					<li id="league_li"><a href="{{ route('leagues.index') }}">City Leagues</a></li>			
					<li id="news_li"><a href="news.php">News</a></li>
					<li id="clips_li"><a id="videos_link" href="videos.php">Clips</a></li>
					<li id="contact_li"><a href="{{ route('about') }}">About TTR</a></li>
					
					@if (Auth::guest())
						<li><a href="{{ route('login') }}">Login</a></li>
						<li><a href="{{ route('register') }}">Register</a></li>
					@else
						<li class="">
							<a href="{{ route('logout') }}"
								onclick="event.preventDefault();
										 document.getElementById('logout-form').submit();">
								Logout
							</a>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
						</li>
					@endif
					<!--/. Side navigation links -->
				</ul>
			</div>
			<!--/. Sidebar navigation -->

			<div class="d-none d-lg-flex" id="">
				<!-- Right Side Of Navbar -->
				<ul class="nav navbar-nav navbar-right">
					<!-- Authentication Links -->
					<li  class="nav-item" id="index">
						<a class="nav-link" href="{{ route('welcome') }}">Home</a>
					</li>	
					<li id="rec_li" class="nav-item">
						<a class="nav-link" href="{{ route('rec_centers.index') }}">Parks N Recs</a>
					</li>
					<li id="player_li" class="nav-item">
						<a class="nav-link" href="{{ route('players.index') }}">Players</a>
					</li>
					<li id="league_li" class="nav-item">
						<a class="nav-link" href="{{ route('leagues.index') }}">City Leagues</a>
					</li>
					<li id="news_li" class="nav-item">
						<a class="nav-link" href="news.php">News</a>
					</li>
					<li id="clips_li" class="nav-item">
						<a class="nav-link" id="videos_link" href="videos.php">Clips</a>
					</li>
					<li id="contact_li" class="nav-item">
						<a class="nav-link" href="{{ route('about') }}">About TTR</a>
					</li>
				</ul>
			</div>
			
			<div class="d-none d-lg-flex" id="">
				<ul class="nav navbar-nav navbar-right">
					@if(Auth::guest())
						<!-- Logins -->
						<li class="nav-item">
							<a href="{{ route('login') }}" class="nav-link btn indigo">Login
								<i class="fa fa-user" aria-hidden="true"></i>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('register') }}" class="nav-link btn indigo lighten-1">Register
								<i class="fa fa-user" aria-hidden="true"></i>
							</a>
						</li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								{{ Auth::user() }} <span class="caret"></span>
							</a>

							<ul class="dropdown-menu" role="menu">
								<li>
									<a href="{{ route('logout') }}"
										onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
										Logout
									</a>

									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										{{ csrf_field() }}
									</form>
								</li>
							</ul>
						</li>				
					@endif
				</ul>
			</div>
        </nav>
		
        @yield('content')

		@include("modal")
		
		@include('footer')
    </div>

	<!-- SCRIPTS -->
	<!-- JQuery -->
	<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="/js/popper.min.js"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="/js/bootstrap.min.js"></script>
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="/js/mdb.min.js"></script>
	<script type="text/javascript" src="/js/ttr.js"></script>
	
	@yield('additional_scripts')
</body>
</html>
