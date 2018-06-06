@extends('layouts.app')

@section('addt_style')
	<style>
		#app {
			background: linear-gradient(rgba(0, 0, 0, 0.35), rgba(0, 0, 0, 0.35)), url(/images/mybackground1.png);
			background-size: 100% 100%;
			background-repeat: no-repeat;
			background-position: 100% 0%;
			background-attachment: fixed;
			z-index: -1;
		}
	</style>
@endsection

@section('content')
	<div class="container-fluid">
		@foreach($leagues as $league)
			<div class="row position-relative my-5 white-text">
				<div class="col">
					<div class="">
						<h2 class="h2-responsive">{{ $league->name }}</h2>
						<h2 class="h2-responsive">{{ $league->commish }}</h2>
						<h2 class="h2-responsive">{{ $league->address }}</h2>
						<h2 class="h2-responsive">{{ $league->phone }}</h2>
						<h2 class="h2-responsive">{{ $league->leagues_email }}</h2>
						<h2 class="h2-responsive">{{ $league->leagues_website }}</h2>
					</div>

					<div class="">
						<h2 class="">Active Seasons</h2>
						<h3 class="">League Photo</h3>
					</div>
					
					<div class="">
						<h1 class="">Age Levels</h1>
						<ul class="">
							<li class=""></li>
						</ul>
					</div>
					
					<div class="">
						<h1 class="">Competition Levels</h1>
						<ul class="">
							<li class=""></li>
						</ul>
					</div>
				</div>
			</div>
		@endforeach
	</div>
@endsection