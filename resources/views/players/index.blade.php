@extends('layouts.app')

@section('content')
	@include('include.functions')
	
	<div class="container-fluid">

		<div id="backgroundImageP"></div>

		<h2 id="player_page_header" class="page_header">ToTheRec Players</h2>
		<div class="alphabetClass">
			@php $showLetter = find_alphabet(); @endphp
			@for($i=0; $i < count($showLetter); $i++)
				@php $getPlayersWithLastName = \App\PlayerProfile::get_player_profiles_by_letter(strtolower($showLetter[$i])); @endphp
				@if(!empty($getPlayersWithLastName))
					<div class="hasPlayers">
						<a href="players.php?filter={{ strtolower($showLetter[$i]) }}">{{ $showLetter[$i] }}</a>
					</div>
				@else
					<div class="noPlayers">
						<a href="#">{{ $showLetter[$i] }}</a>
					</div>
				@endif
			@endfor
		</div>
		<div class="search_box">
			<input class="player_search" name="search" type="search" placeholder="Search Player"/>				
			<a class="addFilter" href="#">Search</a>
		</div>
		@php $recentPlayers = \App\PlayerProfile::find_recent_added_players(); @endphp
		@foreach($recentPlayers as $showPlayer)
			<div class="playersPage">
				<div class="playerPicture">
					<div style="background-image:url(../uploads/{{ $showPlayer->picture }})" class=""></div>
				</div>
				<div class="playerNameHeader">
					<div class="">
						<h2 class="">
							@php $nickname = $showPlayer->nickname != "" ? "\"".$showPlayer->nickname."\"" : " "; @endphp
							{{ $nickname }}
						</h2>
					</div>
					<div class="">
						<h2 class="">
							{{ $showPlayer->firstname . " " .  $showPlayer->lastname }}
						</h2>
					</div>
				</div>
				<div class="playerBio">
					<ul>
						@php $checkVideoCount = \App\PlayerProfile::find_player_videos_by_id($showPlayer->get_player_id()); @endphp
						
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
					<a href="{{ route('players.show', ['player' => $showPlayer->id]) }}">Go To Profile</a>
				</div>
			</div>
		@endforeach
	</div>
@endsection