@extends('layouts.app')

@section('styles')
	<style type="text/css">
		.view {
			min-height: initial !important;
		}
		
		#app {
			background: black;
			z-index: -1;
		}
	</style>
@endsection

@section('content')

	<div class="container-fluid playerProfileContainer" style="background: black">

		<div class="row playerBio mb-5">

			<div class="container-fluid">

				<div class="row align-items-center justify-content-center view">

					<div class="col-12 col-md-6">
						<div id="update_pic" class="card">
							<!-- Card Image -->
							<div class="view overlay" style="min-height: initial !important;">
								<img class="mx-auto img-fluid" id="current_pic" src="{{ $playerImage }}" alt="Player Card Image">
							</div>
							
							<!-- Card body -->
							<div id="" class="card-body">
								<h2 class="card-title text-center">
									<span class="">{{ $player->firstname }}</span>
									<span class="">{{ $player->nickname != null ? $player->nickname : "" }}</span>
									<span class="">{{ $player->lastname != null ? $player->lastname : '' }}</span>
								</h2>
								
								<h3 id="player_height" class="text-center">
									<span class=""><b>Height:</b></span>
									<span class="text-muted">{{ $player->height != "" ? $player->height : "N/A" }}</span>
								</h3>
								
								<h3 id="player_height" class="text-center">
									<span class=""><b>Weight:</b></span>
									<span class="text-muted">{{ $player->weight > 0 ? $player->weight . " lbs" : "N/A" }}</span>
								</h3>
								
								<div class="hidden">
									<input class="hidden indPlayer" value="{{ $player->id }}" hidden />
								</div>
							</div>
							
							<!-- Card footer -->
							<div class="rounded-bottom mdb-color lighten-3 text-center">
								<div class="md-form my-3">
									<div class="file-field">
										<div class="btn btn-primary btn-sm float-left">
											<span class="changeSpan">Change Photo</span>
											<input type="file" name="file" id="file">
										</div>
										<div class="file-path-wrapper">
											<input class="file-path validate" type="text" placeholder="Upload your picture">
										</div>
									</div>									
								</div>
								
								<div class="text-center changePlayerImage animated mb-3" data-wow-delay="0.6s">
									<button class="btn stylish-color changePlayerImageBtn" type="button" disabled>Upload New Photo</button>
								</div>
							</div>
						</div>
					</div>

					<div class="col-12 col-md-6 updatePlayerForm">
						{!! Form::open(['action' => ['PlayerProfileController@update', $player->id], 'method' => 'PATCH', 'files' => true, 'class' => 'col-12', 'id' => 'edit_player_bio_form']) !!}
							<div class="row align-items-center justify-content-between">
								<div class="col-6">
									<h2 class="coolText2 white-text"><u>Player Bio</u></h2>
								</div>
								<div class="col-6 text-right">
									<button type="submit" id="editProfile_btn" class="btn btn-lg indigo mx-0 my-3 white-text" value="">Update Profile</button>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<div class="md-form">
										<input type="text" name="firstname" class="white-text form-control" id="firstname" value="{{ old('firstname') ? old('firstname') : $player->firstname }}" />
										
										<label for="firstname">First Name:</label>
									</div>
									
									@if($errors->has('firstname'))
										<!-- Return error message for firstname -->
										<div class="returnError">
											<p class="red-text">{{ $errors->first('firstname') }}</p>
										</div>
									@endif
								</div>
								<div class="col">
									<div class="md-form">
										<input type="text" name="nickname" class="white-text form-control" id="nickname" value="{{ old('nickname') ? old('nickname') : $player->nickname }}" />

										<label for="nickname">Nickname:</label>
									</div>
									
									@if($errors->has('nickname'))
										<!-- Return error message for nickname -->
										<div class="returnError">
											<p class="red-text">{{ $errors->first(nickname) }}</p>
										</div>
									@endif
								</div>
								<div class="col">
									<div class="md-form">
										<input type="text" name="lastname" class="white-text form-control" id="lastname" value="{{ old('lastname') ? old('lastname') : $player->lastname }}" />
										
										<label for="lastname">Last Name:</label>
									</div>
									
									@if($errors->has('lastname'))
										<!-- Return error message for lastname -->
										<div class="returnError">
											<p class="red-text">{{ $errors->first('lastname') }}</p>
										</div>
									@endif
								</div>
							</div>
							
							<div class="md-form">
								<input type="text" name="email" class="white-text form-control" id="email" value="{{ old('email') ? old('email') : $player->user->email }}" />
								
								<label for="dob">Email:</label>
							</div>
							
							@if($errors->has('email'))
								<!-- Return error message for email -->
								<div class="returnError">
									<p class="red-text">{{ $errors->first('email') }}</p>
								</div>
							@endif
							
							<div class="md-form">
								<input type="text" name="dob" id="dob" class="white-text form-control datetimepicker" value="{{ $player->dob }}" />
								
								<label for="dob">Date of Birth:</label>
							</div>
							
							<div class="row">
								<div class="col">
									<div class="md-form">
										<input type="text" name="highschool" class="white-text form-control" id="highschool" value="{{ $player->highschool }}" />
										
										<label for="highschool">High School:</label>
									</div>
								</div>

								<div class="col">
									<div class="md-form">
										<input type="text" name="college" class="white-text form-control" id="college" value="{{ $player->college }}" />

										<label for="college">College:</label>
									</div>
								</div>
							</div>
							
							<div class="row">

								<div class="col">
									<div class="md-form">
										<input type="text" name="height" class="white-text form-control" id="height" value="{{ $player->height }}" />
										
										<label for="height">Height:</label>
									</div>
								</div>

								<div class="col">
									<div class="md-form">
										<input type="number" name="weight" class="white-text form-control" id="weight" value="{{ $player->weight }}" min="0" max="999"/>
										
										<label for="weight">Weight:</label>
									</div>
									
									@if($errors->has('weight'))
										<!-- Return error message for weight -->
										<div class="returnError">
											<p class="red-text">{{ $errors->first('weight') }}</p>
										</div>
									@endif
								</div>
							</div>

							<div class="row">
								<div class="col">
									<div class="md-form">
										<label class="active" for="type">Player Type:</label>
										
										<div class="d-flex flex-wrap-reverse justify-content-around align-items-center">
											<button class="btn col-12 col-md-4 mt-3 white-text playerTypeBtn{{ $player->type == 'bruiser' ? ' green' : ' grey' }}" type="button"><i class="fa fa-bomb" aria-hidden="true"></i>&nbsp;Bruiser
												<input type="checkbox" name="type" class="hidden" value="bruiser" {{ $player->type == 'bruiser' ? 'checked' : '' }} hidden />
											</button>
											
											<button class="btn col-12 col-md-4 mt-3 white-text playerTypeBtn{{ $player->type == 'high_flyer' ? ' green' : ' grey' }}" type="button"><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;High Flyer
												<input type="checkbox" name="type" class="hidden" value="high_flyer" {{ $player->type == 'high_flyer' ? 'checked' : '' }} hidden />
											</button>
											
											<button class="btn col-12 col-md-4 mt-3 white-text playerTypeBtn{{ $player->type == 'magician' ? ' green' : ' grey' }}" type="button"><i class="fa fa-magic" aria-hidden="true"></i>&nbsp;Magician
												<input type="checkbox" name="type" class="hidden" value="magician" {{ $player->type == 'magician' ? 'checked' : '' }} hidden />
											</button>
											
											<button class="btn col-12 col-md-4 mt-3 white-text playerTypeBtn{{ $player->type == 'warden' ? ' green' : ' grey' }}" type="button"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;Warden
												<input type="checkbox" name="type" class="hidden" value="warden" {{ $player->type == 'warden' ? 'checked' : '' }} hidden />
											</button>
											
											<button class="btn col-12 col-md-4 mt-3 white-text playerTypeBtn{{ $player->type == 'sniper' ? ' green' : ' grey' }}" type="button"><i class="fa fa-bullseye" aria-hidden="true"></i>&nbsp;Sniper
												<input type="checkbox" name="type" class="hidden" value="sniper" {{ $player->type == 'sniper' ? 'checked' : '' }} hidden />
											</button>
										</div>
									</div>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
		
		<!-- My player leagues -->
		<div class="row view playerLeagues mb-5">

			<div class="myLeagues col-12">

				<div class="text-center coolText2 white-text">
					<h1 class="h1-responsive display-2">My Leagues</h1>
				</div>

				@if($linkLeague->isNotEmpty())

					@foreach($linkLeague as $newPlayerLeague)

						@if($newPlayerLeague->season->players()->duplicate($player->user->email)->count() == 1)

							<div class="linkLeague row coolText4">
								<div class="col-12 col-md-4 mx-auto my-3 p-3 white rounded z-depth-2">
									<div class="text-center">
										<h2 class="h2-responsive"><i class="fa fa-exclamation red-text" aria-hidden="true"></i>&nbsp;New League Alert&nbsp;<i class="fa fa-exclamation red-text" aria-hidden="true"></i></h2>
									
										<p class="">It looks like you've been added to a league that keeps stats and is associated with ToTheRec. Are you playing in the following leagues?</p>
									</div>
									
									<div class="linkLeagueOptions">
										<div class="">
											<div class="">
												<h3 class="linkLeagueName h3-responsive my-1"><b>League Name:</b> {{ $newPlayerLeague->season->league->name }}</h3>
												
												<h3 class="linkLeagueName h3-responsive my-1"><b>Season:</b> {{ $newPlayerLeague->season->name . ' ' . $newPlayerLeague->season->season . ' ' . $newPlayerLeague->season->year }}</h3>
												
												<h3 class="linkLeagueName my-1 h3-responsive"><b>Team Name:</b> {{ $newPlayerLeague->team->team_name }}</h3>
												
												<h3 class="linkLeagueName my-1 h3-responsive"><b>Player Name:</b> {{ $newPlayerLeague->player_name }}</h3>
											</div>
											<div class="d-flex align-items-center jusify-content-around linkLeagueOption">
												<button class="btn btn-success white-text addLeague">Add</button>
												
												<button class="btn btn-danger white-text declineLeague">Decline</button>
												
												<input type="number" name="player_id" class="hidden" value="{{ $newPlayerLeague->id }}" hidden />
											</div>
										</div>
									</div>
								</div>
							</div>
						@endif

					@endforeach

				@else

					<div class="linkLeague row coolText4">

						<div class="col-12 text-center" id="">
							<h2 class="white-text">There aren't any leagues that you are currently participating in.</h2>
						</div>
					</div>

				@endif

				@if($leagues->isNotEmpty())

					<div class="indProfileLeagues">

						@foreach($leagues as $playerLeagueProfile)

							@php $stats = $playerLeagueProfile->stats()->playerSeasonStats()->first();	@endphp

							@php $playerLeagueImage; @endphp

							@if($playerLeagueProfile->image != null)
								@if(Storage::disk('public')->exists(str_ireplace('storage', '', $playerLeagueProfile->image->path)))
									@php $playerLeagueImage = asset($playerLeagueProfile->image->path); @endphp
								@else
									@php $playerLeagueImage = $defaultImg; @endphp
								@endif
							@else
								@php $playerLeagueImage = $defaultImg; @endphp
							@endif

							<!-- Rotating card -->
							<!--suppress CssInvalidPropertyValue -->
								<div class="card-wrapper mx-auto" style="height: -webkit-fill-available;">
								<div id="card-{{ $loop->iteration }}" class="card-rotating effect__click text-center h-100 w-100">
								
									<!-- Front Side -->
									<div class="face front">
										<!-- Image-->
										<div class="card-up">
											<img  class="card-img-top" src="{{ $playerLeagueImage }}" alt="League Default Picture.">
										</div>

										<!-- Content -->
										<div class="card-body white">
											<h1 class="coolText1 h1-responsive">{{ $playerLeagueProfile->season->league->name }}</h1>
											<h3 class="">{{ $playerLeagueProfile->season->league->commish }}</h3>
											<h3 class="">{{ $playerLeagueProfile->season->league->address }}</h3>
											<h3 class=""><a href="#">{{ $playerLeagueProfile->season->league->leagues_website }}</a></h3>
											<!-- Triggering button -->
											<a class="rotate-btn" data-card="card-{{ $loop->iteration }}"><i class="fa fa-undo"></i> Click here to rotate back</a>
										</div>
									</div>
									<!--./ Front Side /.-->
									
									<!-- Back Side -->
									<div class="face back">
										<!-- Triggering button -->
										<div class="card-body white">
											<a class="rotate-btn" data-card="card-{{ $loop->iteration }}"><i class="fa fa-undo"></i> Click here to rotate back</a>
											<div class="d-flex flex-column flex-md-row align-items-center justify-content-around">
												<div id="view_standings" class="mr-2">
													<table class="table table-responsive table-sm table-striped" id="view_standings_table">
														<thead class="mdb-color darken-3">
															<tr class="text-white">
																<th>Team Name</th>
																<th>Wins</th>
																<th>Losses</th>
																<th>Forfeits</th>
																<th>Win Perc.</th>
																<th>Total Points</th>
															</tr>
														</thead>
														
														<tbody>
															@if($playerLeagueProfile->season->standings == null)
																<tr>
																	<td colspan='5'>No standings to display yet.</td>
																</tr>
															@else
																@foreach($playerLeagueProfile->season->standings as $showStanding)
																	<tr class="linkStandingsTeam">
																		<td>{{ $showStanding->team_name }}</td>
																		<td>{{ $showStanding->team_wins != null ? $showStanding->team_wins : '0' }}</td>
																		<td>{{ $showStanding->team_losses != null ? $showStanding->team_losses : '0' }}</td>
																		<td>{{ $showStanding->team_forfeits != null ? $showStanding->team_forfeits : '0' }}</td>
																		<td>{{ $showStanding->winPERC != null ? $showStanding->winPERC : "0.00" }}</td>
																		<td>{{ $showStanding->team_points != null ? $showStanding->team_points : "TBD" }}</td>
																	</tr>
																@endforeach
															@endif
														</tbody>
													</table>
												</div>
												
												<div class="indProfileLeaguesTeamStats ml-2">
													@if($stats != null)
														<table class="table table-responsive table-sm table-striped" id="view_stats_table">
															<thead class="mdb-color darken-3">
																<tr class="text-white">
																	<th class="" colspan='6'>Stats</th>
																</tr>
															<thead>
															<tbody>
																<tr class="">
																	<th class="">&nbsp;</th>
																	<th class="" colspan=''>PPG</th>
																	<td class="" colspan='3'>{{ $stats->PPG != null ? $stats->PPG : '0' }}</td>
																	<td class="">&nbsp;</td>
																</tr>
																<tr class="">
																	<th class="">&nbsp;</th>
																	<th class="">APG</th>
																	<td class="" colspan='3'>{{ $stats->APG != null ? $stats->APG : '0' }}</td>
																	<td class="">&nbsp;</td>
																</tr>
																<tr class="">
																	<th class="">&nbsp;</th>
																	<th class="">RPG</th>
																	<td class="" colspan='3'>{{ $stats->RPG != null ? $stats->RPG : '0' }}</td>
																	<td class="">&nbsp;</td>
																</tr>
																<tr class="">
																	<th class="">&nbsp;</th>
																	<th class="">SPG</th>
																	<td class="" colspan='3'>{{ $stats->SPG != null ? $stats->SPG : '0' }}</td>
																	<td class="">&nbsp;</td>
																</tr>
																<tr class="">
																	<th class="">&nbsp;</th>
																	<th class="">BPG</th>
																	<td class="" colspan='3'>{{ $stats->BPG != null ? $stats->BPG : '0' }}</td>
																	<td class="">&nbsp;</td>
																</tr>
																<tr class="">
																	<th class="">&nbsp;</th>
																	<th class="">Total PTS</th>
																	<td class="" colspan='3'>{{ $stats->TPTS != null ? $stats->TPTS : '0' }}</td>
																	<td class="">&nbsp;</td>
																</tr>
																<tr class="">
																	<th class="">&nbsp;</th>
																	<th class="">Total 3's</th>
																	<td class="" colspan='3'>{{ $stats->TTHR != null ? $stats->TTHR : '0' }}</td>
																	<td class="">&nbsp;</td>
																</tr>
																<tr class="">
																	<th class="">&nbsp;</th>
																	<th class="">Total AST</th>
																	<td class="" colspan='3'>{{ $stats->TASS != null ? $stats->TASS : '0' }}</td>
																	<td class="">&nbsp;</td>
																</tr>
																<tr class="">
																	<th class="">&nbsp;</th>
																	<th class="">Total RBD</th>
																	<td class="" colspan='3'>{{ $stats->TRBD != null ? $stats->TRBD : '0' }}</td>
																	<td class="">&nbsp;</td>
																</tr>
																<tr class="">
																	<th class="">&nbsp;</th>
																	<th class="">Total STL</th>
																	<td class="" colspan='3'>{{ $stats->TSTL != null ? $stats->TSTL : '0' }}</td>
																	<td class="">&nbsp;</td>
																</tr>
																<tr class="">
																	<th class="">&nbsp;</th>
																	<th class="">Total BLK</th>
																	<td class="" colspan='3'>{{ $stats->TBLK != null ? $stats->TBLK : '0' }}</td>
																	<td class="">&nbsp;</td>
																</tr>
															</tbody>
														</table>
													
													@else
														<ul class="">
															<li class="">No player stats added</li>
														</ul>
													@endif
												</div>
											</div>
										</div>
									</div>
									<!--./ Back Side /.-->
								</div>
							</div>
						@endforeach
					</div>
				@endif
			</div>
		</div>			
		<!--/. My player leagues /.-->
		
		<!-- My player playgrounds -->
		<div class="row view playerPlaygrounds my-5" id="player_playgrounds" style="overflow:visible">
			<div class="myPlayground col-12">
				<div class="text-center coolText2 white-text mb-3">
					<h1 class="indProfileHeader h1-responsive display-2">My Playgrounds</h1>
				</div>
				
				{!! Form::open(['action' => ['PlayerProfileController@update_playgrounds', $player->id], 'method' => 'PATCH']) !!}
					<div class="myPlaygroundClass d-flex flex-column flex-lg-row align-items-center justify-content-between">
						<p class="white-text">List up to 3 of your top places to play for the best runs.</p>
						
						<div class="">
							<button type="submit" class="btn btn-lg green darken-3 white-text">Update Playgrounds</button>
						</div>
					</div>

					<div class="myPlaygroundClass">
						@if($player->playgrounds->isNotEmpty())

							<ol class="white-text myPlaygroundsList">
								<!-- Hidden default list item -->
								<li class="hidden defaultPlaygroundItem" hidden>
									<div class="row">

										<div class="col">
											<div class="md-form">
												<select class="mdb-select md-form" name="rec_name[]" id="select_rec" disabled>
													<option class="blank" disabled selected>------- Select A Rec -------</option>
													@foreach($recs as $rec)
														<option value="{{ str_ireplace(" ", "_", $rec->name) }}">{{ str_ireplace("_", " ", $rec->name) }}</option>
													@endforeach
												</select>

												<label class="mdb-main-label">Blue select</label>
											</div>
										</div>

										<div class="col">
											<div class="md-form white-text">
												<input type="text" name="" class="" value="" />
												<select class="" name="day_name[]" id="select_day" disabled>
													<option class="blank" value="" selected>------- Select A Day -------</option>
													@foreach($days as $day)
														<option class="white-text" value="{{ $day }}">{{ $day }}</option>
													@endforeach
												</select>

												<label for="day_name" class="blue-text">Select A Day</label>
											</div>
										</div>
										<div class="col">
											<div class="md-form">
												<input type="text" name="time[]" class="timepicker form-control white-text" value="" style="padding: 12px 0px;" disabled />
												
												<label for="rec_name" class="white-text">Select A Time</label>
											</div>
										</div>
									</div>
								</li>
						
								@foreach($player->playgrounds as $myPlayground)
									@php
										$time = "";
										$timeArray = explode(':', $myPlayground->time);
										
										if($timeArray[0] > 12) {
											$time = ($timeArray[0] - 12) . ':' . $timeArray[1] . ' PM';
										} elseif($timeArray[0] == '0') {
											$time = '12:' . $timeArray[1] . ' AM';
										} elseif($timeArray[0] == '12') {
											$time = '12:' . $timeArray[1] . ' PM';
										} else {
											$time = $timeArray[0] . ':' . $timeArray[1] . ' AM';
										}
									@endphp

									<li class="">

										<div class="row">

											<div class="col">
												<div class="md-form">
													<select class="mdb-select" name="rec_name[]">
														<option class="blank" value="" selected>------- Select A Rec -------</option>
														@foreach($recs as $rec)
															<option value="{{ str_ireplace(" ", "_", $rec->name) }}"{{ str_ireplace(" ", "_", $rec->name) == $myPlayground->playground ? ' selected' : ''}}>{{ $rec->name }}</option>
														@endforeach
													</select>
													
													<label for="rec_name" class="blue-text active">Select A Gym</label>
												</div>
											</div>

											<div class="col">
												<div class="md-form white-text">
													<select class="mdb-select" name="day_name[]">
														<option class="blank" value="" selected disabled>------- Select A Day -------</option>
														@foreach($days as $day)
															<option class="white-text" value="{{ $day }}"{{ $day == $myPlayground->day ? ' selected' : '' }}>{{ $day }}</option>
														@endforeach
													</select>

													<label for="day_name" class="mdb-main-label">Select A Day</label>
												</div>
											</div>

											<div class="col">
												<div class="md-form">
													<input type="text" name="time[]" class="timepicker form-control white-text" value="{{ $time }}" style="padding: 12px 0px;" />
													
													<label for="rec_name" class="">Select A Time</label>
												</div>
												
												<input type="text" name="playground_id[]" class="hidden" value="{{ $myPlayground->id }}" hidden />
											</div>

										</div>

									</li>

								@endforeach

							</ol>

						@else
							<ul class="">
								@for($i=0; $i < 3; $i++)
									<li class="row">
										<span class="myPlaygroundRank col-md-1">
											<select class="mdb-select md-form" name="">
												<option value="1"{{ $i == "0" ? " selected" : "" }} disabled>1</option>
												<option value="2"{{ $i == "1" ? " selected" : "" }} disabled>2</option>
												<option value="3"{{ $i == "2" ? " selected" : "" }} disabled>3</option>
											</select>
										</span>

										<span class="myPlaygroundRank col-md-4">
											<select class="mdb-select md-form" name="rec_name[]">
												<option class="blank" disabled selected>------- Select A Rec -------</option>

												@foreach($recs as $rec)
													<option value="{{ str_ireplace(" ", "_", $rec->name) }}">{{ str_ireplace("_", " ", $rec->name) }}</option>
												@endforeach
											</select>
										</span>

										<span class="myPlaygroundRank col-md-4">
											<select class="mdb-select md-form" name="day_name[]">
												<option class="blank" disabled selected>------- Select A Day -------</option>

												@foreach($days as $day)
													<option class="white-text" value="{{ $day }}">{{ $day }}</option>
												@endforeach
											</select>
										</span>

										<span class="myPlaygroundRank col-md-2">
											<div class="md-form white-text">
												<input type="text" name="time_name[]" class="form-control timepicker" value="" />

												<label for="input_starttime">------- Select A Time -------</label>
											</div>
										</span>
									</li>
								@endfor
							</ul>
						@endif
					</div>

				{!! Form::close() !!}

			</div>

		</div>
		<!--./ My player playgrounds /.-->
		
		<!-- My Player Videos -->
		<div class="row view playerVideos my-5 pb-5 pb-md-0">
			<div class="col-12">
				<div class="text-center coolText2 white-text">
					<h1 class="indProfileHeader h1-responsive display-2">My Highlight Reel</h1>

					<button class="btn btn-floating addVideo white-text" type="button"><i class="fa fa-plus green" aria-hidden="true"></i></button>
				</div>
				
				<div class="row">
					<div class="col-12">
						<div class="md-form my-4 uploadNewVideo{{ $videos->count() > 0 ? ' hidden' : '' }}">
							<div class="file-field d-flex align-items-center justify-content-between container">
								<div class="btn btn-primary btn-sm col">
									<span class="changeSpan">New Highlight</span>
									
									<input type="file" name="new_video_file" id="new_video_file">
								</div>
								
								<div class="file-path-wrapper col-6 col-md-7 col-lg-8 col-xl-9">
									<input class="file-path validate white-text" type="text" placeholder="Upload A New Highlight">
								</div>
								
								<div class="btn btn-outline-warning btn-sm col addNewVideo">
									<span class="changeSpan addNewVideoBtn">Add Video</span>
								</div>
							</div>
						</div>
					</div>
					
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

							<div class="col-12 col-md-4">
								<div class="myVideo">
									<button class="btn btn-floating position-absolute deletePlayerVideo white-text" type="button" data-toggle="modal" data-target="#modalConfirmDelete">
										<i class="fa fa-minus red" aria-hidden="true"></i>
										
										<input type="checkbox" name="remove_video_id" class="hidden" value="{{ $showVideo->id }}" hidden />
									</button>

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
									<p class="text-center">You currently do not have any videos added to your player profile.</p>
								</div>
							</div>
						</div>

					@endif

				</div>
			</div>
		</div>
		<!--./ My Player Videos /.-->
		
		<!-- Progress Bar Modal -->
		<div class="modal fade" id="progress_modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" data-backdrop="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header justify-content-around align-items-center">
						<h2 class="">Uploading....</h2>
					</div>
					<div class="modal-body">
						<div class="progress" style="height: 20px">
							<div class="progress-bar" id="pro" role="progressbar" style="width: 0%; height: 20px" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!--Modal: modalConfirmDelete-->
	<div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
            <!--Content-->
            <div class="modal-content text-center">
                <!--Header-->
                <div class="modal-header d-flex justify-content-center">
                    <p class="heading">Are you sure you want to delete this video?</p>
                </div>

                <!--Body-->
                <div class="modal-body">
                    <i class="fa fa-times fa-4x animated rotateIn"></i>
                </div>

                <!--Footer-->
                <div class="modal-footer flex-center">
					{!! Form::open(['action' => ['PlayerProfileController@remove_video', 'video' => null], 'method' => 'DELETE']) !!}
						<button type="submit" class="btn btn-outline-danger">Yes</button>
						
						<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">No</button>
					{!! Form::close() !!}
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
	
	<div class="textLoad hidden" hidden></div>
@endsection