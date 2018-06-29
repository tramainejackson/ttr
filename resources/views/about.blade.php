@extends('layouts.app')

@section('addt_style')
	<style>
		#app {
			background: linear-gradient(rgba(0, 0, 0, 0.35), rgba(0, 0, 0, 0.35)), url("../images/Basketball-Wallpapers-HD-Pictures2.jpg");
			background-size: 100% 100%;
			background-repeat: no-repeat;
			background-position: 100% 0%;
			background-attachment: fixed;
			z-index: -1;
		}
	</style>
@endsection

@section('content')
	<div class="container white-text" id="about_ttr">
		<div class="row">
			<div class="col-12">
				<h1 class="h1-responsive">About ToTheRec</h1>
			</div>
			
			<div class="col-12">
				<h4 class="h4-responsive p-2">To all the basketball players in the Philly, South Jersey or Deleware area! This site is going to be for you.
				Let me know what you want to see from the site.</h4>
			</div>
			
			<div class="col-12">
				<h4 class="h4-responsive p-2">Shoot me some ideas of what else you would like to see. If you know a rec center that has open gym, or where the real players play, shoot me the information
				and we'll get it added so you know where others are playing.</h4>
			</div>
			
			<div class="col-12">
				<h4 class="h4-responsive p-2">If you're playing in a basketball league, no matter the age, and they aren't keeping stats online. Let them know to check out the site. They can keeps stats and schedules on the leagues site.</h4>
			</div>
		</div>	
		
		<hr/>
		
		<div class="row mb-4">
			<div class="col-12">
				<h1 class="h1-responsive">Contact Us</h1>
			</div>
			<div class="col-12 d-flex align-items-center justify-content-around">
				<div class="phoneContact">
					<i class="fa fa-phone-square" aria-hidden="true"></i>
					<span>267.879.4089</span>
				</div>
				<div class="emailContact">
					<a href="mailto:totherec@gmail.com" class="white-text">
						<i class="fa fa-envelope-square" aria-hidden="true"></i>
						<span>totherec@gmail.com</span>
					</a>
				</div>
			</div>
		</div>
	</div>
@endsection