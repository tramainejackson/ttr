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
	<div class="container-fluid">
		<div class="videosPageContainer">
			
			<div class="row playerVideos my-3">
				<div class="col-12">
					<div class="text-center coolText2 white-text">
						<h1 class="indProfileHeader h1-responsive display-2">The Highlight Reel</h1>
					</div>
				</div>
				
				<div class="player_type_filter mb-2 col-12 d-flex justify-content-around align-items-center">
					<a href="{{ route('players.index', ['filter' => 'bruiser']) }}" class="btn{{ request()->query('filter') == 'bruiser' ? ' red lighten-1' : ' blue-grey' }}" type="button"><i class="fa fa-bomb" aria-hidden="true"></i>&nbsp;Bruiser</a>
					<a href="{{ route('players.index', ['filter' => 'high_flyer']) }}" class="btn{{ request()->query('filter') == 'high_flyer' ? ' red lighten-1' : ' blue-grey' }}" type="button"><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;High Flyer</a>
					<a href="{{ route('players.index', ['filter' => 'magician']) }}" class="btn{{ request()->query('filter') == 'magician' ? ' red lighten-1' : ' blue-grey' }}" type="button"><i class="fa fa-magic" aria-hidden="true"></i>&nbsp;Magician</a>
					<a href="{{ route('players.index', ['filter' => 'warden']) }}" class="btn{{ request()->query('filter') == 'warden' ? ' red lighten-1' : ' blue-grey' }}" type="button"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;warden</a>
					<a href="{{ route('players.index', ['filter' => 'sniper']) }}" class="btn{{ request()->query('filter') == 'sniper' ? ' red lighten-1' : ' blue-grey' }}" type="button"><i class="fa fa-bullseye" aria-hidden="true"></i>&nbsp;Sniper</a>
				</div>
			</div>
					
			<!--  Player Videos -->
			<div class="row">						
				@if($videos->count() > 0)
					@foreach($videos as $showVideo)
						<div class="col-12 col-md-4 mb-4">
							<div class="myVideo">
								<div class="white">
									<p class="">Uploaded: {{ $showVideo->uploaded() }}</h2>
									<h2 class="h2-responsive">{{ $showVideo->player->firstname }}</p>
								</div>
								<video class="" width="320" height="240" controls>
									<source src="{{ asset($showVideo->path) }}">
									Your browser does not support the video tag.
								</video>
							</div>
						</div>
					@endforeach
				@else
					<div class="col-12 updateVids">
						<a id="addNewClips_icon" href="player_page.php?add_video=true" title="Add Video"></a>
						<div class="viewCurrent_clips">
							<div id="noVideos_message">
								<p class="text-center">No Videos Have Been Added Yet.</p>
							</div>
						</div>
					</div>
				@endif
			</div>
			<!--./ Player Videos /.-->
		</div>
	</div>
@endsection