@extends('layouts.app')

@section('content')
	@include('include.functions')

	<div class="container-fluid playerProfileContainer" style="background: black">
		<div class="row">
			{!! Form::open(['action' => ['PlayerProfileController@update', $player->id], 'method' => 'PATCH', 'files' => true, 'class' => 'w-100']) !!}
				<div class="container-fluid">
					<div class="row align-items-center justify-content-center">
						<div class="col-6">
							<div id="update_pic" class="card card-cascade narrower">
								<!-- Card Image -->
								<div class="view overlay" style="min-height: initial !important;">
									<img class="card-img-top" id="current_pic" src="{{ $player->image ? $player->image : '/images/emptyface.jpg' }}" alt="Player Card Image">
								</div>

								<!-- Card body -->
								<div id="" class="card-body">
									<h1 class="">
										<span>{{ $player->firstname }}</span>
										<span>{{ $player->nickname != "" ? $player->nickname : "" }}</span>
									</h1>
									<h1 id="" class="playerPageLastNameHeader">
										<span>{{ $player->lastname }}</span>
										<span>{{ $player->height != "" ? "Height: " . $player->height : "" }}</span>
										<span>{{ $player->weight > 0 ? "Weight: " . $player->weight . " lbs" : "" }}</span>
									</h1>
								</div>
								
								<!-- Card footer -->
								<div class="rounded-bottom mdb-color lighten-3 text-center pt-3">
									<ul class="list-unstyled list-inline font-small">
										<li class="list-inline-item pr-2 white-text"><i class="fa fa-clock-o pr-1"></i>05/10/2015</li>
										<li class="list-inline-item pr-2"><a href="#" class="white-text"><i class="fa fa-comments-o pr-1"></i>12</a></li>
										<li class="list-inline-item pr-2"><a href="#" class="white-text"><i class="fa fa-facebook pr-1"> </i>21</a></li>
										<li class="list-inline-item"><a href="#" class="white-text"><i class="fa fa-twitter pr-1"> </i>5</a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-6 updatePlayerForm">
							<div class="row">
								<div class="col-12">
									<h2 class="coolText2 white-text"><u>Player Bio</u></h2>
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
				
				<button type="submit" id="editProfile_btn" class="btn indigo" value="">Update Profile</button>
			{!! Form::close() !!}
		</div>
		
		<!-- My player leagues -->
		@if($leagues->isEmpty())
			<div class="current_leagues">
				<div class="linkLeaguesDiv">
					<div class="">
						<h2 class="">Add League</h2>
					</div>
					<div class="">
						<p class="">It looks like you've been added to a league that keeps stats and is associated with ToTheRec. Are you playing in any of the following leagues?</p>
					</div>
					<div class="linkLeagueOptions">
						<?php if(is_object($checkLinks)) { ?>
							<?php $checkLink = $checkLinks; ?>
							<?php $linkLeague = League_Profile::get_league_by_id($checkLink->get_league_id()); ?>
							<div class="linkLeagueOption">
								<span class="linkLeagueName"><b>League Name:</b> <?php echo $linkLeague->leagues_name; ?></span>
								<button class="btn btn-success addLeague<?php echo $linkLeague->get_league_id(); ?>">Add</button>
								<button class="btn btn-danger declineLeague<?php echo $linkLeague->get_league_id(); ?>">Decline</button>
							</div>
						<?php } elseif(is_array($checkLinks)) { ?>
							<?php foreach($checkLinks as $checkLink) { ?>
								<?php $linkLeague = League_Profile::get_league_by_id($checkLink->get_league_id()); ?>
								<div class="linkLeagueOption">
									<span class="linkLeagueName"><b>League Name:</b> <?php echo $linkLeague->leagues_name; ?></span>
									<button class="btn btn-success addLeague<?php echo $linkLeague->get_league_id(); ?>">Add</button>
									<button class="btn btn-danger declineLeague<?php echo $linkLeague->get_league_id(); ?>">Decline</button>
								</div>
							<?php } ?>
						<?php } ?>
					</div>
				</div>
			</div>
		@else
			<div class="currentLeagues">
				<div class="indProfileLeagues">
					<div class="">
						<h1 class="indProfileHeader">My Leagues</h1>
					</div>
					<div class="linkLeagueOptions">
						@foreach($leagues as $playerLeagueProfile)
							@php $linkedLeague = $playerLeagueProfile->league_profile; @endphp
							@php $linkedPlayer = $playerLeagueProfile; @endphp
							@php $linkedPlayerTeam = $playerLeagueProfile->league_team; @endphp
							
							<div class="indProfileLeaguesInfo">
								<div class="">
									<a href="#collapse_<?php echo str_ireplace(" ", "", strtolower($linkedLeague->leagues_name)); ?>" class="indProfileLeaguesLink" data-toggle="collapse"><b>League:</b> <?php echo $linkedLeague->leagues_name; ?></a>
								</div>
								<div id="collapse_<?php echo str_ireplace(" ", "", strtolower($linkedLeague->leagues_name)); ?>" class="collapse">
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
														<td><?php echo $showStanding->team_name; ?></td>
														<td><?php echo $showStanding->team_wins != null ? $showStanding->team_wins : 0; ?></td>
														<td><?php echo $showStanding->team_losses != null ? $showStanding->team_losses : 0; ?></td>
														<td><?php echo $showStanding->team_forfeits != null ? $showStanding->team_forfeits : 0; ?></td>
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
			</div>			
		@endif
		<!--/. My player leagues /.-->
		
		<!-- My player playgrounds -->
		<div class="row">
			<div class="myPlayground">
				<h1 class="indProfileHeader">My Playground</h1>
				<div class="myPlaygroundClass">
					<p class="">List up to 3 of your top places to play for the best runs.</p>
				</div>
				<div class="myPlaygroundClass">
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
				</div>
			</div>
		</div>
		<!--./ My player playgrounds /.-->
		
		<!-- My Player Videos -->
		<div class="">
			<?php if(!empty($videos)) { ?>
				<?php if(isset($_GET["remove_video"])) { ?>
					<div class="deleteVids">
						<h1 class="indProfileHeader">My Highlight Reel</h1>
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
						<h1 class="indProfileHeader">My Highlight Reel</h1>
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
						<h1 class="indProfileHeader">My Highlight Reel</h1>
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
						<h1 class="indProfileHeader">My Highlight Reel</h1>
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
						<h1 class="indProfileHeader">My Highlight Reel</h1>
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
		<!--./ My Player Videos /.-->
	</div>
@endsection