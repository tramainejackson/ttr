@extends('layouts.app')

@section('styles')
	<style>
		#app {
			background: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.35)), url('/images/newspaper.gif');
			background-size: 100% 100%;
			background-repeat: no-repeat;
			background-position: 100% 0%;
			background-attachment: fixed;
			z-index: -1;
		}
	</style>
@endsection

@section('content')

<div class="container">

	<!--Section: Messages-->
	<section class="pb-3 wow fadeIn white-text" data-wow-delay="0.3s">

		<!--Grid row-->
		<div class="row my-4">
			<!--Section heading-->
			<h2 class="col-4 font-weight-bold h2-responsive text-underline">Messages</h2>

			@if($messages->count() > 0)
				<div class="col-8 coolText4">
					<h3 class="h3-responsive">Total Messages: {{ $messages->count() }}</h3>
					<a href="{{ route('admin.messages.index') }}" class='btn btn-default' type='button'>View/Edit</a>
				</div>
			@else
				<div class="col-8 coolText4">
					<h3 class="h3-responsive">There aren't any messages at this time.</h3>
				</div>
			@endif
		</div>
		<!--Grid row-->

	</section>
	<!--Section: Messages-->

	<!--Section: Players-->
	<section class="pb-3 wow fadeIn white-text" data-wow-delay="0.3s">
		
		<!--Grid row-->
		<div class="row my-4">
			<!--Section heading-->
			<h2 class="col-4 h2-responsive font-weight-bold text-underline">Players</h2>

			@if($players->count() > 0)
				<div class="col-8 coolText4">
					<h3 class="h3-responsive">Total Players: {{ $players->count() }}</h3>
					<a href="{{ route('admin.players.create') }}" class='btn btn-blue-grey' type='button'>Create/Add New</a>
					<a href="{{ route('admin.players.index') }}" class='btn btn-default' type='button'>View/Edit</a>
				</div>
			@else
				<div class="col-8 coolText4">
					<a href="{{ route('admin.players.create') }}" class='btn btn-blue-grey' type='button'>Create/Add New</a>
					<h3 class="h3-responsive">There aren't players at this time.</h3>
				</div>
			@endif

		</div>
		<!--Grid row-->

	</section>
	<!--Section: Players-->

	<!--Section: Videos-->
	<section class="pb-3 wow fadeIn white-text" data-wow-delay="0.3s">

		<!--Grid row-->
		<div class="row my-4">
			<!--Section heading-->
			<h2 class="col-4 h2-responsive font-weight-bold text-underline">Player Videos</h2>

			@if($videos->count() > 0)
				<div class="col-8 coolText4">
					<h3 class="h3-responsive">Total Players Videos: {{ $videos->count() }}</h3>
					<a href="{{ route('admin.videos.index') }}" class='btn btn-default' type='button'>View/Edit</a>
				</div>
			@else
				<div class="col-8 coolText4">
					<h3 class="h3-responsive">There aren't any player videos at this time.</h3>
				</div>
			@endif
		</div>
		<!--Grid row-->

	</section>
	<!--Section: Videos-->

	<!--Section: Leagues-->
	<section class="pb-3 wow fadeIn white-text" data-wow-delay="0.3s">

		<!--Grid row-->
		<div class="row my-4">
			<!--Section heading-->
			<h2 class="col-4 h2-responsive font-weight-bold text-underline">City Leagues</h2>

			@if($leagues->count() > 0)
				<div class="col-8 coolText4">
					<h3 class="h3-responsive">Total City Leagues: {{ $leagues->count() }}</h3>
					<a href="{{ route('admin.leagues.create') }}" class='btn btn-blue-grey' type='button'>Create/Add New</a>
					<a href="{{ route('admin.leagues.index') }}" class='btn btn-default' type='button'>View/Edit</a>
				</div>
			@else
				<div class="col-8 coolText4">
					<a href="{{ route('admin.leagues.create') }}" class='btn btn-blue-grey' type='button'>Create/Add New</a>
					<h3 class="h3-responsive">There aren't any city leagues at this time.</h3>
				</div>
			@endif
		</div>
		<!--Grid row-->

	</section>
	<!--Section: Leagues-->

	<!--Section: Rec Centers-->
	<section class="pb-3 wow fadeIn white-text" data-wow-delay="0.3s">

		<!--Grid row-->
		<div class="row my-4">
			<!--Section heading-->
			<h2 class="col-4 h2-responsive font-weight-bold text-underline">Rec Centers</h2>

			@if($recs->count() > 0)
				<div class="col-8 coolText4">
					<h3 class="h3-responsive">Total Rec Centers: {{ $recs->count() }}</h3>
					<a href="{{ route('admin.recs.create') }}" class='btn btn-blue-grey' type='button'>Create/Add New</a>
					<a href="{{ route('admin.recs.index') }}" class='btn btn-default' type='button'>View/Edit</a>
				</div>
			@else
				<div class="col-8 coolText4">
					<a href="{{ route('admin.recs.create') }}" class='btn btn-blue-grey' type='button'>Create/Add New</a>
					<h3 class="h3-responsive">There aren't any rec centers at this time.</h3>
				</div>
			@endif
		</div>
		<!--Grid row-->

	</section>
	<!--Section: Rec Centers-->

	<!--Section: Writers-->
	<section class="pb-3 wow fadeIn white-text" data-wow-delay="0.3s">

		<!--Grid row-->
		<div class="row my-4">
			<!--Section heading-->
			<h2 class="col-4 h2-responsive font-weight-bold text-underline">Writers</h2>

			@if($writers->count() > 0)
				<div class="col-8 coolText4">
					<h3 class="h3-responsive">Total Writers: {{ $writers->count() }}</h3>
					<a href="{{ route('admin.writers.create') }}" class='btn btn-blue-grey' type='button'>Create/Add New</a>
					<a href="{{ route('admin.writers.index') }}" class='btn btn-default' type='button'>View/Edit</a>
				</div>
			@else
				<div class="col-8 coolText4">
					<a href="{{ route('admin.writers.create') }}" class='btn btn-blue-grey' type='button'>Create/Add New</a>
					<h3 class="h3-responsive">There aren't any writers at this time.</h3>
				</div>
			@endif
		</div>
		<!--Grid row-->

	</section>
	<!--Section: Writers-->

	<!--Section: New Articles-->
	<section class="pb-3 wow fadeIn white-text" data-wow-delay="0.3s">

		<!--Grid row-->
		<div class="row my-4">
			<!--Section heading-->
			<h2 class="col-4 h2-responsive font-weight-bold text-underline">News Articles</h2>

			@if($articles->count() > 0)
				<div class="col-8 coolText4">
					<h3 class="h3-responsive">Total News Articles: {{ $articles->count() }}</h3>
					<a href="{{ route('admin.news.create') }}" class='btn btn-blue-grey' type='button'>Create/Add New</a>
					<a href="{{ route('admin.news.index') }}" class='btn btn-default' type='button'>View/Edit</a>
				</div>
			@else
				<div class="col-8 coolText4">
					<h3 class="h3-responsive">There aren't any news articles at this time.</h3>
					<a href="{{ route('admin.news.create') }}" class='btn btn-blue-grey' type='button'>Create/Add New</a>
				</div>
			@endif
		</div>
		<!--Grid row-->

	</section>
	<!--Section: New Articles-->

	<!--Section: Settings-->
	<!--Section: Settings-->

</div>
@endsection
