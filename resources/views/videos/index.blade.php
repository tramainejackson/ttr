@extends('layouts.app')

@section('styles')
	<style>
		#app {
			background: url("../images/Basketball-Wallpapers-HD-Pictures2.jpg");
			background-size: 100% 100%;
			background-repeat: no-repeat;
			background-position: 100% 0%;
			background-attachment: fixed;
			z-index: -1;
		}
	</style>
@endsection

@section('scripts')
	<script type="text/javascript">
        $('nav').addClass('rgba-stylish-strong');
	</script>
@endsection

@section('content')
	<div class="container-fluid rgba-stylish-strong">
		<div class="videosPageContainer">
			
			<div class="row playerVideos py-3">
				<div class="col-12">
					<div class="text-center coolText2 white-text">
						<h1 class="indProfileHeader h1-responsive display-2">The Highlight Reel</h1>
					</div>
				</div>
				
				<div class="player_type_filter mb-2 col-12 d-flex justify-content-around align-items-center flex-column flex-md-row">
					<a href="{{ route('players.index', ['filter' => 'bruiser']) }}" class="btn{{ request()->query('filter') == 'bruiser' ? ' red lighten-1' : ' blue-grey' }}" type="button"><i class="fa fa-bomb" aria-hidden="true"></i>&nbsp;Bruiser</a>
					<a href="{{ route('players.index', ['filter' => 'high_flyer']) }}" class="btn{{ request()->query('filter') == 'high_flyer' ? ' red lighten-1' : ' blue-grey' }}" type="button"><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;High Flyer</a>
					<a href="{{ route('players.index', ['filter' => 'magician']) }}" class="btn{{ request()->query('filter') == 'magician' ? ' red lighten-1' : ' blue-grey' }}" type="button"><i class="fa fa-magic" aria-hidden="true"></i>&nbsp;Magician</a>
					<a href="{{ route('players.index', ['filter' => 'warden']) }}" class="btn{{ request()->query('filter') == 'warden' ? ' red lighten-1' : ' blue-grey' }}" type="button"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;warden</a>
					<a href="{{ route('players.index', ['filter' => 'sniper']) }}" class="btn{{ request()->query('filter') == 'sniper' ? ' red lighten-1' : ' blue-grey' }}" type="button"><i class="fa fa-bullseye" aria-hidden="true"></i>&nbsp;Sniper</a>
				</div>
			</div>
					
			<!--  Player Videos -->
			<div class="container-fluid">
				<div class="row">		
					@if($videos->count() > 0)

						@foreach($videos as $showVideo)

							@php $playerVideo; @endphp

							@if($showVideo->path != null)
								@if(Storage::disk('public')->exists(str_ireplace('storage', '', $showVideo->path)))
									@php $playerVideo = asset($showVideo->path); @endphp
								@else
									@php $playerVideo = asset('/images/video_not_found.png'); @endphp
								@endif
							@else
								@php $playerVideo = asset('/images/video_not_found.png'); @endphp
							@endif

							<div class="col-12 col-md-6 col-xl-3 mb-4 d-flex align-items-stretch justify-content-around">
								<div class="myVideo">
									<div class="white">
										<p class="text-center p-1 rgba-blue-grey-strong white-text coolText4">Uploaded: {{ $showVideo->uploaded() }}</p>
										
										<h2 class="h2-responsive">
											<a href="{{ route('players.show', ['player' => $showVideo->player->id]) }}">{{ $showVideo->player->full_name() }}</a>

											@if($showVideo->player->type !== null)
												@if($showVideo->player->type == 'magician')
													<span class="position-absolute font-small left mt-n2 pl-2 position-absolute position-top top"><i class="fa fa-magic" aria-hidden="true"></i></span>
												@elseif($showVideo->player->type == 'bruiser')
													<span class="position-absolute font-small left mt-n2 pl-2 position-absolute position-top top"><i class="fa fa-bomb" aria-hidden="true"></i></span>
												@elseif($showVideo->player->type == 'warden')
													<span class="position-absolute font-small left mt-n2 pl-2 position-absolute position-top top"><i class="fa fa-lock" aria-hidden="true"></i></span>
												@elseif($showVideo->player->type == 'high_flyer')
													<span class="position-absolute font-small left mt-n2 pl-2 position-absolute position-top top"><i class="fa fa-rocket" aria-hidden="true"></i></span>
												@elseif($showVideo->player->type == 'sniper')
													<span class="position-absolute font-small left mt-n2 pl-2 position-absolute position-top top"><i class="fa fa-bullseye" aria-hidden="true"></i></span>
												@endif
											@endif

										</h2>
									</div>

									@if($playerVideo == asset('/images/video_not_found.png'))
										<video class="" width="320" height="240" poster="{{ $playerVideo }}" controls>
											<source src="">
											Your browser does not support the video tag.
										</video>
									@else
										<video class="" width="320" height="240" controls>
											<source src="{{ $playerVideo }}">
											Your browser does not support the video tag.
										</video>
									@endif

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
			</div>
			<!--./ Player Videos /.-->
		</div>
	</div>
@endsection