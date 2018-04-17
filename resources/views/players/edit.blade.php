@extends('layouts.app')

@section('content')
	@include('include.functions')
	
	<div class="container-fluid playerProfileContainer">
		<div class="">
			{!! Form::open(['action' => ['PlayerProfileController@store'], 'method' => 'PATCH', 'files' => true]) !!}
				<div class="updatePage" id="updateBio">
					<div id="update_pic" class="updatePlayerForm">
						<img id="current_pic" src="{{ $player->picture }}">
						<span class="changeSpan">Change Photo</span>
						<input type="file" name="file" id="file">
					</div>
					<div id="player_page_name_header" class="updatePlayerForm">
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
					<div class="updatePlayerForm">
						<table id="update_form_table">
							<tr><td class="spanLabel"><span>First Name:</span></td><td><input type="text" name="firstname" id="firstname" value="<?php echo $player->firstname; ?>" placeholder="Enter Firstname" /></td></tr>
							<tr><td class="spanLabel"><span>Last Name:</span></td><td><input type="text" name="lastname" id="lastname" value="<?php echo $player->lastname; ?>" placeholder="Enter Lastname" /></td></tr>
							<tr><td class="spanLabel"><span>Nickname:</span></td><td><input type="text" name="nickname" id="nickname" value="<?php echo $player->nickname; ?>" placeholder="Enter Nickname" /></td></tr>
							<tr><td class="spanLabel"><span>Date of Birth:</span></td><td><input type="date" name="dob" id="dob" value="<?php echo $player->dob; ?>" placeholder="Select DOB" /></td></tr>
							<tr><td class="spanLabel"><span>Email Address:</span></td><td><input type="text" name="email" id="email" value="<?php echo $player->email; ?>" placeholder="Enter Email Address" required /></td></tr>
							<tr><td class="spanLabel"><span>College:</span></td><td><input type="text" name="college" id="college" value="<?php echo $player->college; ?>" placeholder="Enter College" /></td></tr>
							<tr><td class="spanLabel"><span>High School:</span></td><td><input type="text" name="highschool" id="highschool" value="<?php echo $player->highschool; ?>" placeholder="Enter High School" /></td></tr>
							<tr><td class="spanLabel"><span>Height:</span></td><td><input type="text" name="height" id="height" value="<?php echo $player->height; ?>" placeholder="Enter Height" /></td></tr>
							<tr><td class="spanLabel"><span>Weight:</span></td><td><input type="number" name="weight" id="weight" value="<?php echo $player->weight > 0 ? $player->weight : ""; ?>" placeholder="Enter Weight" min="0" max="999"/></td></tr>	
							<tr>
								<td class="spanLabel"><span>Show Email:</span></td>
								<td>
									<div class="btn-group">
										<button type="button" class="btn <?php echo $player->show_email == "Y" ? "btn-success active" : ""; ?>">
											<input type="checkbox" name="show_email" value="Y" hidden <?php echo $player->show_email == "Y" ? "checked" : ""; ?> />Yes
										</button>
										<button type="button" class="btn <?php echo $player->show_email == "N" ? "btn-danger active" : ""; ?> ">
											<input type="checkbox" name="show_email" value="N" hidden <?php echo $player->show_email == "N" ? "checked" : ""; ?> />No
										</button>
									</div>
								</td>
							</tr>	
						</table>
					</div>
				</div>
				<div class="myPlayground">
					<div class="">
						<?php $playgrounds = explode("; ", $player->player_playground); ?>
						<h1 class="indProfileHeader">My Playground</h1>
						<div class="myPlaygroundClass">
							<p class="">List your top 3 places to play for the best runs.</p>
						</div>
						<div class="myPlaygroundClass">
							<ul class="">
								<?php for($i=0; $i < 3; $i++) { ?>
									<li class="row">
										<span class="myPlaygroundRank col-md-1">
											<select class="" name="" disabled>
												<option value="1" <?php echo $i == "0" ? "selected" : ""; ?>>1</option>
												<option value="2" <?php echo $i == "1" ? "selected" : ""; ?>>2</option>
												<option value="3" <?php echo $i == "2" ? "selected" : ""; ?>>3</option>
											</select>
										</span>
										<span class="myPlaygroundRank col-md-4">
											<select class="" name="rec_name[]">
												<option class="blank" value="" selected>------- Select A Rec -------</option>
												@for($ii=0; $ii < count($recs); $ii++)
													<?php $playgroundInfo = explode(" ", $playgrounds[$i]); ?>
													@if($playgrounds[$i] != "")
														<option value="<?php echo str_ireplace(" ", "_", $recs[$ii]->recs_name); ?>" <?php echo str_ireplace(" ", "_", $recs[$ii]->recs_name) == $playgroundInfo[0] ? "selected" : ""; ?>><?php echo str_ireplace("_", " ", $recs[$ii]->recs_name); ?></option>
													@else
														<option value="<?php echo str_ireplace(" ", "_", $recs[$ii]->recs_name); ?>"><?php echo str_ireplace("_", " ", $recs[$ii]->recs_name); ?></option>
													@endif
												@endfor
											</select>
										</span>
										<span class="myPlaygroundRank col-md-4">
											<select class="" name="day_name[]">
												<option class="blank" value="">------- Select A Day -------</option>
												
												@for($ii=0; $ii < count($days); $ii++)
													<?php $playgroundInfo = explode(" ", $playgrounds[$i]); ?>
													<?php if($playgrounds[$i] != "") { ?>
														<option value="<?php echo $days[$ii]; ?>" <?php echo $days[$ii] == $playgroundInfo[1] ? "selected" : ""; ?>><?php echo $days[$ii]; ?></option>
													<?php } else { ?>
														<option value="<?php echo $days[$ii]; ?>"><?php echo $days[$ii]; ?></option>
													<?php } ?>
												@endfor

											</select>
										</span>
										<span class="myPlaygroundRank col-md-2">
											<select class="" name="time_name[]">
												<option class="blank" value="">--- Select A Time ---</option>
												<?php for($ii=0; $ii < count($times); $ii++) { ?>
													<?php $playgroundInfo = explode(" ", $playgrounds[$i]); ?>
													<?php if($playgrounds[$i] != "") { ?>
														<option value="<?php echo $times[$ii]; ?>" <?php echo $times[$ii] == $playgroundInfo[2] ? "selected" : ""; ?>><?php echo $times[$ii]; ?></option>
													<?php } else { ?>
														<option value="<?php echo $times[$ii]; ?>"><?php echo $times[$ii]; ?></option>
													<?php } ?>
												<?php } ?>
											</select>
										</span>
										<span class="myPlaygroundRank col-md-1">
											<select class="" name="time_of_day[]">
												<?php $playgroundInfo2 = explode(" ", $playgrounds[$i]); ?>
												<?php if($playgrounds[$i] != "") { ?>
													<option value="AM" <?php echo $playgroundInfo2[3] == "AM" ? "selected" : ""; ?>>AM</option>
													<option value="PM" <?php echo $playgroundInfo2[3] == "PM" ? "selected" : ""; ?>>PM</option>
												<?php } else { ?>
													<option value="AM">AM</option>
													<option value="PM">PM</option>
												<?php } ?>
											</select>
										</span>
									</li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
				<input type="submit" name="submit" id="editProfile_btn" value="Update My Profile">
			</form>
		</div>
		<div class="">
			<?php $getPlayerVideos = Video::find_player_videos_by_id($player->get_player_id()); ?>
			<?php if(!empty($getPlayerVideos)) { ?>
				<?php if(isset($_GET["remove_video"])) { ?>
					<div class="deleteVids">
						<h1 class="indProfileHeader">My Highlight Reel</h1>
						<a id="addNewClips_icon" href="player_page.php?add_video=true" title="Add Video"></a>
						<a class="deleteClip" href="player_page.php?remove_video=true" title="Delete Video"></a>
						<div class="editClips_div">
							<form action="delete_video.php" method="post" enctype="multipart/form-data">
								<?php while($showVideo = mysqli_fetch_assoc($getPlayerVideos)) { ?>
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
							<?php while($showVideo = mysqli_fetch_assoc($getPlayerVideos)) { ?>
								<div class="myVideo">
									<h2>Uploaded: <?php $date = date_create($showVideo["upload_date"]); echo date_format($date, "m/d/y"); ?><span class="myVideoID" hidden><?php echo $showVideo["upload_id"]; ?></span></h2>
									<video class="currentVideo">
										<source src="<?php echo $showVideo["file"]; ?>" type="video/mp4">
										<source src="<?php echo $showVideo["file"]; ?>" type="video/ogg">
										Your browser does not support the video tag.
									</video>
								</div>
							<?php } ?>
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
		<?php $checkLinks = League_Player::link_player_accounts($player->email); ?>
		<?php if(!empty($checkLinks)) { ?>
			<?php if($player->ttr_player == "N") { ?>
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
			<?php } elseif($player->ttr_player == "Y") { ?>
				<?php $playerLeaguesInfo = explode(";", $player->ttr_player_info); ?>
				<div class="currentLeagues">
					<div class="indProfileLeagues">
						<div class="">
							<h1 class="indProfileHeader">My Leagues</h1>
						</div>
						<div class="linkLeagueOptions">
							<?php if(is_string($playerLeaguesInfo)) { ?>
								<?php $checkLink = $checkLinks; ?>
								<?php $linkLeagues= League_Profile::get_league_by_id($checkLink->get_league_id()); ?>
								<div class="linkLeagueOption">
									<span class="linkLeagueName"><b>League Name:</b> <?php echo $linkLeague->leagues_name; ?></span>
									<button class="btn btn-success linkLeagueBtn">Add</button>
									<button class="btn btn-danger linkLeagueBtn">Decline</button>
								</div>
							<?php } elseif(is_array($playerLeaguesInfo)) { ?>
								<?php foreach($playerLeaguesInfo as $getLeaguesInfo) { ?>
									<?php if(!empty($getLeaguesInfo)) { ?>
										<?php $sepInfo = explode("_", $getLeaguesInfo); ?>
										<?php $leaguesID = str_ireplace("League", "", $sepInfo[0]); ?>
										<?php $leaguesPlayerID = str_ireplace("Player", "", $sepInfo[1]); ?>
										<?php $linkedLeague = !isset($sepInfo[2]) ? League_Profile::get_league_by_id($leaguesID) : ""; ?>
										<?php $linkedPlayer = !isset($sepInfo[2]) ? League_Player::get_ttr_player_by_id($leaguesID, $leaguesPlayerID) : ""; ?>
										<?php $linkedPlayerTeam = !isset($sepInfo[2]) ? League_Team::get_team_by_id($leaguesID, $linkedPlayer->get_leagues_teams_id()) : ""; ?>
										
										<?php // '$sepInfo[2]' indicates that a league was declined ?>
										<?php if(!isset($sepInfo[2])) { ?>
											<div class="indProfileLeaguesInfo">
												<div class="">
													<a href="#collapse_<?php echo str_ireplace(" ", "", strtolower($linkedLeague->leagues_name)); ?>" class="indProfileLeaguesLink" data-toggle="collapse"><b>League:</b> <?php echo $linkedLeague->leagues_name; ?></a>
												</div>
												<div id="collapse_<?php echo str_ireplace(" ", "", strtolower($linkedLeague->leagues_name)); ?>" class="collapse">
													<?php $getStandings = League_Standings::get_league_standings($linkedPlayer->get_league_id()); ?>
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
															<?php if(empty($getStandings)) { ?>
																<tr>
																	<td colspan='5'>No standings to display yet.</td>
																</tr>
															<?php } else { ?>
																<?php if(is_array($getStandings)) { ?>
																	<?php foreach($getStandings as $showStanding) { ?>
																		<tr class="<?php echo $showStanding->get_team_id() == $linkedPlayer->get_leagues_teams_id() ? "linkStandingsTeam" : ""; ?>">
																			<td><?php echo $showStanding->team_name; ?></td>
																			<td><?php echo $showStanding->team_wins != null ? $showStanding->team_wins : 0; ?></td>
																			<td><?php echo $showStanding->team_losses != null ? $showStanding->team_losses : 0; ?></td>
																			<td><?php echo $showStanding->team_forfeits != null ? $showStanding->team_forfeits : 0; ?></td>
																			<td><?php echo $showStanding->winPERC != null ? $showStanding->winPERC : "0.00"; ?></td>
																			<td><?php echo $showStanding->team_points != null ? $showStanding->team_points : "TBD"; ?></td>
																		</tr>
																	<?php } ?>
																<?php } elseif(is_object($getStandings)) { ?>
																	<?php $showStanding = $getStandings; ?>
																	<tr class="<?php echo $showStanding->get_team_id() == $linkedPlayer->get_leagues_teams_id() ? "linkStandingsTeam" : ""; ?>">
																		<td><?php echo $showStanding->team_name; ?></td>
																		<td><?php echo $showStanding->team_wins != null ? $showStanding->team_wins : 0; ?></td>
																		<td><?php echo $showStanding->team_losses != null ? $showStanding->team_losses : 0; ?></td>
																		<td><?php echo $showStanding->team_forfeits != null ? $showStanding->team_forfeits : 0; ?></td>
																		<td><?php echo $showStanding->winPERC != null ? $showStanding->winPERC : "0.00"; ?></td>
																		<td><?php echo $showStanding->team_points != null ? $showStanding->team_points : "TBD"; ?></td>
																	</tr>
																<?php } ?>
															<?php } ?>
														</table>
													</div>
													<div class="indProfileLeaguesTeamStats">
														<?php $getStats = League_Stats::get_player_stats_by_id($leaguesID, $leaguesPlayerID); ?>
														<?php if(!empty($getStats)) { ?>
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
														<?php } else { ?>
															<ul class="">
																<li class="">No player stats added</li>
															</ul>
														<?php } ?>
													</div>
												</div>
											</div>
										<?php } else { ?>
										<?php } ?>
									<?php } ?>
								<?php } ?>
							<?php } else { ?>
							<?php } ?>
						</div>
					</div>
				</div>			
			<?php } ?>
		<?php } ?>
	</div>
@endsection