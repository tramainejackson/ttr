@extends('layouts.app')

@section('content')
	@include('include.functions')

	<div class="container-fluid playerProfileContainer" style="background: black">
		<div class="row">
			{!! Form::open(['action' => ['PlayerProfileController@update', $player->id], 'method' => 'PATCH', 'files' => true, 'class' => 'col-12']) !!}
				<div class="container-fluid">
					<div class="row align-items-center justify-content-center view">
						<div class="offset-1 col-3">
							<div id="update_pic" class="card card-cascade narrower">
								<!-- Card Image -->
								<div class="view overlay" style="min-height: initial !important;">
									<img class="mx-auto" id="current_pic" src="{{ $player->image ? $player->image : '/images/emptyface.jpg' }}" alt="Player Card Image">
								</div>

								<!-- Card body -->
								<div id="" class="card-body">
									<h2 class="card-title text-center">
										<span>{{ $player->firstname }}</span>
										<span>{{ $player->nickname != null ? $player->nickname : "" }}</span>
										<span>{{ $player->lastname != null ? $player->lastname : '' }}</span>
									</h2>
									
									<h3 id="player_height" class="text-center">
										<span class=""><b>Height:</b></span>
										<span class="text-muted">{{ $player->height != "" ? $player->height : "N/A" }}</span>
									</h3>
									
									<h3 id="player_height" class="text-center">
										<span class=""><b>Weight:</b></span>
										<span class="text-muted">{{ $player->weight > 0 ? $player->weight . " lbs" : "N/A" }}</span>
									</h3>
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
												<input class="file-path validate" type="text" placeholder="Upload your file">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="offset-2 col-6 updatePlayerForm">
							<div class="row align-items-center justify-content-between">
								<div class="col-6">
									<h2 class="coolText2 white-text"><u>Player Bio</u></h2>
								</div>
								<div class="col-6 text-right">
									<button type="submit" id="editProfile_btn" class="btn btn-lg indigo mx-0 my-3" value="">Update Profile</button>
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
							
							<div class="md-form">
								<td class="spanLabel"><span>Show Email:</span>
								<div class="btn-group">
									<button type="button" class="btn <?php echo $player->show_email == "Y" ? "btn-success active" : ""; ?>">
										<input type="checkbox" name="show_email" value="Y" hidden <?php echo $player->show_email == "Y" ? "checked" : ""; ?> />Yes
									</button>
									<button type="button" class="btn <?php echo $player->show_email == "N" ? "btn-danger active" : ""; ?> ">
										<input type="checkbox" name="show_email" value="N" hidden <?php echo $player->show_email == "N" ? "checked" : ""; ?> />No
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>

			{!! Form::close() !!}
		</div>
		
		<!-- My player leagues -->
		<div class="current_leagues row view">
			@if($leagues->isEmpty())
				<div class="linkLeaguesDiv col-12">
					<div class="">
						<h2 class="">Add League</h2>
					</div>
					<div class="">
						<p class="">It looks like you've been added to a league that keeps stats and is associated with ToTheRec. Are you playing in any of the following leagues?</p>
					</div>
					<div class="linkLeagueOptions">
						<?php $checkLink = $checkLinks; ?>
						<?php $linkLeague = League_Profile::get_league_by_id($checkLink->get_league_id()); ?>
						<div class="linkLeagueOption">
							<span class="linkLeagueName"><b>League Name:</b> <?php echo $linkLeague->leagues_name; ?></span>
							<button class="btn btn-success addLeague<?php echo $linkLeague->get_league_id(); ?>">Add</button>
							<button class="btn btn-danger declineLeague<?php echo $linkLeague->get_league_id(); ?>">Decline</button>
						</div>
					</div>
				</div>
			@else
				<div class="indProfileLeagues col-12">
					<div class="text-center coolText2 white-text">
						<h1 class="indProfileHeader h1-responsive display-2">My Leagues</h1>
					</div>
					<div class="linkLeagueOptions">
						@foreach($leagues as $playerLeagueProfile)
							@php $linkedLeague = $playerLeagueProfile->league_profile; @endphp
							@php $linkedPlayer = $playerLeagueProfile; @endphp
							@php $linkedPlayerTeam = $playerLeagueProfile->league_team; @endphp
							
							<div class="indProfileLeaguesInfo">
								<div class="">
									<a href="#collapse_{{ str_ireplace(" ", "", strtolower($linkedLeague->leagues_name)) }}" class="indProfileLeaguesLink" data-toggle="collapse"><b>League:</b> {{ $linkedLeague->leagues_name }}</a>
								</div>
								<div id="collapse_{{ str_ireplace(" ", "", strtolower($linkedLeague->leagues_name)) }}" class="collapse">
									@php $getStandings = $linkedLeague->standings; @endphp
									<div id="view_standings" class="indProfileLeaguesTeamStandings">
										<table id="view_standings_table">
											<caption>Standings</caption>
											<tr>
												<th>Team Name</th>
												<th>Wins</th>
												<th>Losses</th>
												<th>Forfeits</th>
												<th>Win Perc.</th>
												<th>Total Points</th>
											</tr>
											@if(empty($getStandings))
												<tr>
													<td colspan='5'>No standings to display yet.</td>
												</tr>
											@else
												@foreach($getStandings as $showStanding)
													<tr class="linkStandingsTeam">
														<td>{{ $showStanding->team_name }}</td>
														<td>{{ $showStanding->team_wins != null ? $showStanding->team_wins : 0 }}</td>
														<td>{{ $showStanding->team_losses != null ? $showStanding->team_losses : 0 }}</td>
														<td>{{ $showStanding->team_forfeits != null ? $showStanding->team_forfeits : 0 }}</td>
														<td><?php echo $showStanding->winPERC != null ? $showStanding->winPERC : "0.00"; ?></td>
														<td><?php echo $showStanding->team_points != null ? $showStanding->team_points : "TBD"; ?></td>
													</tr>
												@endforeach
											@endif
										</table>
									</div>
									<div class="indProfileLeaguesTeamStats">
										@php $getStats = \App\LeagueStat::get_formatted_stats($playerLeagueProfile->id); @endphp
										@if(!empty($getStats))
											<h3 class="">Stats</h3>
											<ul class="">
												<li class=""><span>PPG</span><span><?php echo $getStats->PPG != null ? $getStats->PPG : 0; ?></span></li>
												<li class=""><span>APG</span><span><?php echo $getStats->APG != null ? $getStats->APG : 0; ?></span></li>
												<li class=""><span>RPG</span><span><?php echo $getStats->RPG != null ? $getStats->RPG : 0; ?></span></li>
												<li class=""><span>SPG</span><span><?php echo $getStats->SPG != null ? $getStats->SPG : 0; ?></span></li>
												<li class=""><span>BPG</span><span><?php echo $getStats->BPG != null ? $getStats->BPG : 0; ?></span></li>
												<li class=""><span>Total Points</span><span><?php echo $getStats->TPTS != null ? $getStats->TPTS : 0; ?></span></li>
												<li class=""><span>Total 3's</span><span><?php echo $getStats->TTHR != null ? $getStats->TTHR : 0; ?></span></li>
												<li class=""><span>Total Assist</span><span><?php echo $getStats->TASS != null ? $getStats->TASS : 0; ?></span></li>
												<li class=""><span>Total Rebounds</span><span><?php echo $getStats->TRBD != null ? $getStats->TRBD : 0; ?></span></li>
												<li class=""><span>Total Steals</span><span><?php echo $getStats->TSTL != null ? $getStats->TSTL : 0; ?></span></li>
												<li class=""><span>Total Blocks</span><span><?php echo $getStats->TBLK != null ? $getStats->TBLK : 0; ?></span></li>
											</ul>
										@else
											<ul class="">
												<li class="">No player stats added</li>
											</ul>
										@endif
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			@endif
		</div>			
		<!--/. My player leagues /.-->
		
		<!-- My player playgrounds -->
		<div class="current_leagues row view" id="player_playgrounds">
			<div class="myPlayground col-12">
				<div class="text-center coolText2 white-text mb-3">
					<h1 class="indProfileHeader h1-responsive display-2">My Playgrounds</h1>
				</div>
				<div class="myPlaygroundClass d-flex align-items-center justify-content-between">
					<p class="white-text">List up to 3 of your top places to play for the best runs.</p>
					<button type="button" class="btn btn-lg indigo addPlayground">Add Another Playground</button>
				</div>
				<div class="myPlaygroundClass">
					@if($player->playgrounds->isNotEmpty())
						<ol class="white-text myPlaygroundsList">
							<!-- Hidden default list item -->
							<li class="hidden defaultPlaygroundItem" hidden>
								<div class="row">
									<div class="col">
										<div class="md-form">
											<select class="mdb-select" name="rec_name[]" id="select_rec">
												<option class="blank" value="" selected>------- Select A Rec -------</option>
												@foreach($recs as $rec)
													<option value="{{ str_ireplace(" ", "_", $rec->name) }}">{{ str_ireplace("_", " ", $rec->name) }}</option>
												@endforeach
											</select>
											
											<label for="rec_name" class="blue-text">Select A Location</label>
										</div>
									</div>
									<div class="col">
										<div class="md-form white-text">
											<select class="mdb-select" name="day_name[]" id="select_day">
												<option class="blank" value="" selected>------- Select A Day -------</option>
												@foreach($days as $day)
													<option class="white-text" value="{{ $day->id }}">{{ $day->day_name }}</option>
												@endforeach
											</select>

											<label for="day_name" class="blue-text">Select A Day</label>
										</div>
									</div>
									<div class="col">
										<div class="md-form">
											<input type="text" name="time[]" class="timepicker form-control white-text" value="" style="padding: 12px 0px;" />
											
											<label for="rec_name" class="white-text">Select A Time</label>
										</div>
									</div>
								</div>
							</li>
					
							@foreach($player->playgrounds as $myPlayground)
								<li class="">
									<div class="row">
										<div class="col">
											<div class="md-form">
												<select class="mdb-select" name="rec_name[]">
													<option class="blank" value="" selected>------- Select A Rec -------</option>
													@foreach($recs as $rec)
														<option value="{{ str_ireplace(" ", "_", $rec->name) }}">{{ str_ireplace("_", " ", $rec->name) }}</option>
													@endforeach
												</select>
												
												<label for="rec_name" class="blue-text">Select A Location</label>
											</div>
										</div>
										<div class="col">
											<div class="md-form white-text">
												<select class="mdb-select" name="day_name[]">
													<option class="blank" value="" selected>------- Select A Day -------</option>
													@foreach($days as $day)
														<option class="white-text" value="{{ $day->id }}">{{ $day->day_name }}</option>
													@endforeach
												</select>

												<label for="day_name" class="blue-text">Select A Day</label>
											</div>
										</div>
										<div class="col">
											<div class="md-form">
												<input type="text" name="time[]" class="timepicker form-control white-text" value="{{ $myPlayground->time }}" style="padding: 12px 0px;" />
												
												<label for="rec_name" class="white-text">Select A Time</label>
											</div>
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
										<select class="browser-default" name="" disabled>
											<option value="1" <?php echo $i == "0" ? "selected" : ""; ?>>1</option>
											<option value="2" <?php echo $i == "1" ? "selected" : ""; ?>>2</option>
											<option value="3" <?php echo $i == "2" ? "selected" : ""; ?>>3</option>
										</select>
									</span>
									<span class="myPlaygroundRank col-md-4">
										<select class="browser-default" name="rec_name[]">
											<option class="blank" value="" selected>------- Select A Rec -------</option>
											@foreach($recs as $rec)
												<option value="{{ str_ireplace(" ", "_", $rec->name) }}">{{ str_ireplace("_", " ", $rec->name) }}</option>
											@endforeach
										</select>
									</span>
									<span class="myPlaygroundRank col-md-4">
										<select class="browser-default" name="day_name[]">
											<option class="blank" value="">------- Select A Day -------</option>

											@foreach($days as $day)
												<option value="{{ $day->id }}">{{ $day->day_name }}</option>
											@endforeach
										</select>
									</span>
									<span class="myPlaygroundRank col-md-2">
										<input type="text" name="time_name[]" class="timepicker" value="" />
									</span>
								</li>
							@endfor
						</ul>
					@endif
				</div>
			</div>
		</div>
		<!--./ My player playgrounds /.-->
		
		<!-- My Player Videos -->
		<div class="current_leagues row view">
			<div class="col-12">
				<div class="text-center coolText2 white-text">
					<h1 class="indProfileHeader h1-responsive display-2">My Highlight Reel</h1>
				</div>
				<?php if(!empty($videos)) { ?>
					<?php if(isset($_GET["remove_video"])) { ?>
						<div class="deleteVids">
							<a id="addNewClips_icon" href="player_page.php?add_video=true" title="Add Video"></a>
							<a class="deleteClip" href="player_page.php?remove_video=true" title="Delete Video"></a>
							<div class="editClips_div">
								<form action="delete_video.php" method="post" enctype="multipart/form-data">
									<?php while($showVideo = mysqli_fetch_assoc($videos)) { ?>
										<div class="myVideo">
											<h2>Uploaded: <?php $date = date_create($showVideo["upload_date"]); echo date_format($date, "m/d/y"); ?><span class="myVideoID"><input type="checkbox" name="remove_video_id" class="" value="<?php echo $showVideo["upload_id"]; ?>" /></span></h2>
											<video class="currentVideo">
												<source src="<?php echo $showVideo["file"]; ?>" type="video/mp4">
												<source src="<?php echo $showVideo["file"]; ?>" type="video/ogg">
												<source src="<?php echo $showVideo["file"]; ?>">
												Your browser does not support the video tag.
											</video>
										</div>
									<?php } ?>
									<input type="submit" name="submit" id="updateVideo_btn" value="Remove Selected Videos"/>
								</form>
							</div>
						</div>
					<?php } elseif(isset($_GET["add_video"])) { ?>
						<div class="addVids">
							<a id="addNewClips_icon" href="player_page.php?add_video=true" title="Add Video"></a>
							<a class="deleteClip" href="player_page.php?remove_video=true" title="Delete Video"></a>
							<form action="video_upload.php" method="post" enctype="multipart/form-data">
								<div class="addVideoDiv">
									<span>Add New Video</span>
									<input type="file" name="file" class="" />
								</div>
								<input type="submit" name="submit" id="updateVideo_btn" value="Add New Video"/>
							</form>
						</div>
					<?php } else { ?>
						<div class="updateVids">
							<a id="addNewClips_icon" href="player_page.php?add_video=true" title="Add Video"></a>
							<a class="deleteClip" href="player_page.php?remove_video=true" title="Delete Video"></a>
							<div class="editClips_div">
								@foreach($videos as $showVideo)
									<div class="myVideo">
										<h2>Uploaded: <?php $date = date_create($showVideo["upload_date"]); echo date_format($date, "m/d/y"); ?><span class="myVideoID" hidden></span></h2>
										<video class="currentVideo">
											<source src="{{ $showVideo->file }}" type="video/mp4">
											<source src="{{ $showVideo->file }}" type="video/ogg">
											Your browser does not support the video tag.
										</video>
									</div>
								@endforeach
							</div>	
						</div>
					<?php } ?>
				<?php }	else { ?>
					<?php if(isset($_GET["add_video"])) { ?>
						<div class="addVids">
							<a id="addNewClips_icon" href="player_page.php?add_video=true" title="Add Video"></a>
							<form action="video_upload.php" method="post" enctype="multipart/form-data">
								<div class="addVideoDiv">
									<span>Add New Video</span>
									<input type="file" name="file" class="" />
								</div>
								<input type="submit" name="submit" id="updateVideo_btn" value="Add New Video"/>
							</form>
						</div>
					<?php }	else { ?>
						<div class="updateVids">
							<a id="addNewClips_icon" href="player_page.php?add_video=true" title="Add Video"></a>
							<div class="viewCurrent_clips">
								<div id="noVideos_message">
									<p>You currently do not have any videos added to your player profile.</p>
								</div>
							</div>
						</div>	
					<?php } ?>
				<?php }	 ?>
			</div>
		</div>
		<!--./ My Player Videos /.-->
	</div>
@endsection