@extends('layouts.app')

@section('addt_style')
	<style type="text/css">
		.view {
			min-height: initial !important;
		}
		
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
	@include('include.functions')
	
	<div class="container-fluid" id="players_page">

		<h2 id="player_page_header" class="page_header">ToTheRec Players</h2>

		<div class="search_box container mx-auto">
			{!! Form::open(['action' => ['PlayerProfileController@search'], 'method' => 'POST']) !!}
				 <div class="md-form input-group">
					<span class="input-group-btn">
						<a href="{{ route('players.index') }}" class="btn btn-outline-success waves-effect my-0 addFilter" type="button">All!</a>
					</span>
					
					<input id="player_search" class="playerSearch form-control added-padding-2 white-text" type="search" name="search" placeholder="Search Players" />
					
					<span class="input-group-btn">
						<button class="btn btn-outline-warning waves-effect my-0" type="submit">Go!</button>
					</span>
				</div>
			{!! Form::close() !!}
		</div>
		
		<div class="player_type_filter mb-5 d-flex flex-column flex-md-row justify-content-around align-items-center">
			<a href="{{ route('players.index', ['filter' => 'bruiser']) }}" class="btn{{ request()->query('filter') == 'bruiser' ? ' red lighten-1' : ' blue-grey' }}" type="button"><i class="fa fa-bomb" aria-hidden="true"></i>&nbsp;Bruiser</a>
			<a href="{{ route('players.index', ['filter' => 'high_flyer']) }}" class="btn{{ request()->query('filter') == 'high_flyer' ? ' red lighten-1' : ' blue-grey' }}" type="button"><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;High Flyer</a>
			<a href="{{ route('players.index', ['filter' => 'magician']) }}" class="btn{{ request()->query('filter') == 'magician' ? ' red lighten-1' : ' blue-grey' }}" type="button"><i class="fa fa-magic" aria-hidden="true"></i>&nbsp;Magician</a>
			<a href="{{ route('players.index', ['filter' => 'warden']) }}" class="btn{{ request()->query('filter') == 'warden' ? ' red lighten-1' : ' blue-grey' }}" type="button"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;warden</a>
			<a href="{{ route('players.index', ['filter' => 'sniper']) }}" class="btn{{ request()->query('filter') == 'sniper' ? ' red lighten-1' : ' blue-grey' }}" type="button"><i class="fa fa-bullseye" aria-hidden="true"></i>&nbsp;Sniper</a>
		</div>
		<div class="row">
			@isset($recentPlayers)
				@foreach($recentPlayers as $showPlayer)
					<!-- Recently Added Profiles -->
					<div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-2">
						<div class="card card-cascade narrower">

							<!--Card image-->
							<div class="view overlay">
								<img src="{{ $showPlayer->image != null ? asset($showPlayer->image->path) : $defaultImg }}" class="" />
								<a href="#!">
									<div class="mask rgba-white-slight"></div>
								</a>
							</div>
							<!--/.Card image-->

							<!--Card content-->
							<div class="card-body">
								<!--Title-->
								<h2 class="card-title text-center"><strong>{{ $showPlayer->full_name() }}</strong></h2>
								
								<!--Add Nickname if available-->
								@if($showPlayer->nickname != "")
									<h4 class="indigo-text text-center"><i class="fa fa-quote-left" aria-hidden="true"></i><strong>{{ $showPlayer->nickname }}</strong><i class="fa fa-quote-right" aria-hidden="true"></i></h4>
								@endif
								
								<div class="playerBio">
									<ul>
										@php $checkVideoCount = $showPlayer->videos->count(); @endphp
										
										@if($showPlayer->height != "")
											<li class='playerBioItem'>
												<span class='label'>Height:</span>
												<span class='labelContent'>{{ $showPlayer->height }}</span>
											</li>
										@endif
										
										@if($showPlayer->weight > 0)
											<li class='playerBioItem'>
												<span class='label'>Weight:</span>
												<span class='labelContent'>{{ $showPlayer->weight }}</span>
											</li>
										@endif
										
										@if($showPlayer->highschool != "")
											<li class='playerBioItem' title='{{ $showPlayer->highschool }}'>
												<span class='label'>HS:</span>
												<span class='labelContent'>{{ $showPlayer->highschool }}</span>
											</li>
										@endif
										
										@if($showPlayer->college != "")
											<li class='playerBioItem' title='{{ $showPlayer->college }}'>
												<span class='label'>College:</span>
												<span class='labelContent'>{{ $showPlayer->college }}</span>
											</li>
										@endif
										
										@if(!empty($checkVideoCount))
											<li class='playerBioItem'>
												<span class='label'>Highlights:</span>
												<span class='labelContent'>{{ count($checkVideoCount) }}</span>
											</li>
										@endif
									</ul>
								</div>
								<div class="playerFooter">
									<a class="btn btn-primary" href="{{ route('players.show', ['player' => $showPlayer->id]) }}">See Profile</a>
								</div>
							</div>
							<!--Card content-->
						</div>
					</div>
				@endforeach
			@endisset
			
			@isset($searchCriteria)
				<div class="col-12">
					<h2 class="white-text text-center"><i class="fa fa-exclamation" aria-hidden="true"></i>&nbsp;Search results for '{{ $searchCriteria }}'&nbsp;<i class="fa fa-exclamation" aria-hidden="true"></i></h2>
				</div>
			@endisset
			
			@if(request()->query('filter'))
				<div class="col-12 my-3">
					<h2 class="white-text text-center"><i class="fa fa-exclamation" aria-hidden="true"></i>&nbsp;Showing {{ ucwords(str_ireplace('_', ' ', request()->query('filter'))) }} Players&nbsp;<i class="fa fa-exclamation" aria-hidden="true"></i></h2>
				</div>
			@endif
				
			@if($allPlayers->count() > 0)
				@foreach($allPlayers as $player)
					
					<!-- Show all the players -->
					<div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
						<div class="card card-cascade narrower">

							<!--Card image-->
							<div class="view">
								<img class="mx-auto img-fluid" src="{{ $player->image != null ? asset($player->image->path) : $defaultImg }}" class="" />

								<div class="mask rgba-white-slight d-flex align-items-end justify-content-center">
									<a class="btn btn-primary" href="{{ route('players.show', ['player' => $player->id]) }}">See Profile</a>
								</div>
							</div>
							<!--/.Card image-->

							<!--Card content-->
							<div class="card-body">
								<!--Title-->
								<h2 class="card-title text-center"><strong>{{ $player->full_name() }}</strong></h2>
								
								<!--Add Nickname if available-->
								@if($player->nickname != "")
									<h4 class="indigo-text text-center"><i class="fa fa-quote-left" aria-hidden="true"></i><strong>{{ $player->nickname }}</strong><i class="fa fa-quote-right" aria-hidden="true"></i></h4>
								@endif
								
								<div class="playerBio">
									<ul>
										@php $checkVideoCount = $player->videos->count(); @endphp
										
										@if($player->height != "")
											<li class='playerBioItem'>
												<span class='label'>Height:</span>
												<span class='labelContent'>{{ $player->height }}</span>
											</li>
										@endif
										
										@if($player->weight > 0)
											<li class='playerBioItem'>
												<span class='label'>Weight:</span>
												<span class='labelContent'>{{ $player->weight }}</span>
											</li>
										@endif
										
										@if($player->highschool != "")
											<li class='playerBioItem' title='{{ $player->highschool }}'>
												<span class='label'>HS:</span>
												<span class='labelContent'>{{ $player->highschool }}</span>
											</li>
										@endif
										
										@if($player->college != "")
											<li class='playerBioItem' title='{{ $player->college }}'>
												<span class='label'>College:</span>
												<span class='labelContent'>{{ $player->college }}</span>
											</li>
										@endif
										
										@if(!empty($checkVideoCount))
											<li class='playerBioItem'>
												<span class='label'>Highlights:</span>
												<span class='labelContent'>{{ count($checkVideoCount) }}</span>
											</li>
										@endif
									</ul>
								</div>
								<div class="playerFooter"></div>
							</div>
							<!--Card content-->
						</div>
					</div>
				@endforeach
			@else
				@isset($searchCriteria)
					<div class="col-12">
						<h2 class="white-text text-center">0 Results Found</h2>
					</div>
				@endisset
				
				@if(request()->query('filter'))
					<div class="col-12">
						<h2 class="white-text text-center">0 Results Found</h2>
					</div>
				@endif
			@endif
		</div>
	</div>
@endsection