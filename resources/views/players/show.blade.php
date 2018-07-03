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

	<div class="container my-3">
		<a href="javascript:history.back();" class="btn">Back</a>
		
		<!--Section: Team v.1-->
		<section class="text-center team-section">

			<!--Grid row-->
			<div class="row text-center">

				<!--Grid column-->
				<div class="col-md-12 mb-4">

					<div class="avatar mx-auto">
						<img src="{{ $player->image ? asset($player->image->path) : $defaultImg }}" class="img-fluid rounded-circle z-depth-1" alt="First sample avatar image">
					</div>
					
					<h2 class="h2-responsive my-3 font-weight-bold white-text">
					  <strong>{{ $player->nickname != "" ? $player->firstname . " \"". $player->nickname ."\" " . $player->lastname : $player->full_name() }}</strong>
					</h2>
					
					<h5 class="font-weight-bold teal-text mb-4">{{ $player->type !== null ? ucwords(str_ireplace("_", "", $player->type)) : '' }}</h5>

				</div>
				<!--Grid column-->

			</div>
			<!--Grid row-->

		</section>
		<!--Section: Team v.1-->

		<!--Section: Tabs-->
		<section>

			<ul class="nav md-pills pills-default d-flex justify-content-center">
				<li class="nav-item">
					<a class="nav-link white-text" data-toggle="tab" href="#panel1" role="tab">
						<strong>Leagues</strong>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link white-text" data-toggle="tab" href="#panel2" role="tab">
						<strong>Videos</strong>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link white-text" data-toggle="tab" href="#panel3" role="tab">
						<strong>Playgrounds</strong>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link white-text show active" data-toggle="tab" href="#panel4" role="tab">
						<strong>Bio</strong>
					</a>
				</li>
			</ul>

			<!-- Tab panels -->
			<div class="tab-content">

				<!--Panel 1-->
				<div class="tab-pane fade" id="panel1" role="tabpanel">
				
					<br/>

					@if($player->leagues()->acceptedProfile()->count() > 0)
						<div class="playerLeagues row">
							<h2 class="col-12">Leagues I'm Playing In</h2>

							@foreach($player->leagues()->acceptedProfile() as $playerSeasonInfo)
								<div class="playerProfileLeaguesInfo col-12 col-md-6">
									<div class="p-2 rounded border z-depth-2 rgba-mdb-color-strong">
										<a href="{{ route('league.index', ['league' => str_ireplace(" ", "", strtolower($playerSeasonInfo->season->league->name))]) }}" class="indProfileLeaguesLink d-block text-center p-3 rgba-white-strong rounded-top"><b>League:</b> {{ $playerSeasonInfo->season->league->name }}</a>

									
										<div id="{{ str_ireplace(" ", "", strtolower($playerSeasonInfo->season->name)) }}" class="">
											
											@php $getStandings = $playerSeasonInfo->season->standings; @endphp
											
											<h3 class="h3-responsive text-center text-underline">Team Records</h3>
											
											<div id="view_standings" class="playerProfileLeaguesTeamStandings">
												<table class="table" id="">
													<thead>
														<tr>
															<th>Team Name</th>
															<th>Wins</th>
															<th>Losses</th>
															<th>Forfeits</th>
															<th>Win Perc.</th>
															<th>Total Points</th>
														</tr>
													</thead>
													
													<tbody>
														@if(empty($getStandings))
															<tr>
																<td colspan='5'>No standings to display yet.</td>
															</tr>
														@else
															@foreach($getStandings as $showStanding)
																<tr class="{{ $showStanding->league_team_id == $playerSeasonInfo->league_team_id ? 'blue' : '' }}">
																	<td>{{ $showStanding->team_name }}</td>
																	
																	<td>{{ $showStanding->team_wins != null ? $showStanding->team_wins : 0 }}</td>
																	
																	<td>{{ $showStanding->team_losses != null ? $showStanding->team_losses : 0 }}</td>
																	
																	<td>{{ $showStanding->team_forfeits != null ? $showStanding->team_forfeits : 0 }}</td>
																	
																	<td>{{ $showStanding->winPERC != null ? $showStanding->winPERC : "0.00" }}</td>
																	
																	<td>{{ $showStanding->team_points != null ? $showStanding->team_points : "TBD" }}</td>
																</tr>
															@endforeach
														@endif
													</tbody>
												</table>
											</div>
											
											<div class="playerProfileLeaguesTeamStats">
												@php $getStats = $playerSeasonInfo->stats()->playerSeasonStats()->get()->first(); @endphp
												
												<h3 class="h3-responsive text-center text-underline">Season Stats</h3>

												<table class="table table-responsive" id="view_stats_table">
													@if(!empty($getStats))
														<thead>
															<tr>
																<th>PPG</th>
																<th>APG</th>
																<th>RPG</th>
																<th>SPG</th>
																<th>BPG</th>
																<th>PTS</th>
																<th>3's</th>
																<th>AST</th>
																<th>RBD</th>
																<th>STL</th>
																<th>BLK</th>
															</tr>
														</thead>
														
														
														<tbody>
															<tr>
																<td>{{ $getStats->PPG != null ? $getStats->PPG : "0.00" }}</td>
																<td>{{ $getStats->APG != null ? $getStats->APG : "0.00" }}</td>
																<td>{{ $getStats->RPG != null ? $getStats->RPG : "0.00" }}</td>
																<td>{{ $getStats->SPG != null ? $getStats->SPG : "0.00" }}</td>
																<td>{{ $getStats->BPG != null ? $getStats->BPG : "0.00" }}</td>
																<td>{{ $getStats->TPTS != null ? $getStats->TPTS : "0" }}</td>
																<td>{{ $getStats->TTHR != null ? $getStats->TTHR : "0" }}</td>
																<td>{{ $getStats->TASS != null ? $getStats->TASS : "0" }}</td>
																<td>{{ $getStats->TRBD != null ? $getStats->TRBD : "0" }}</td>
																<td>{{ $getStats->TSTL != null ? $getStats->TSTL : "0" }}</td>
																<td>{{ $getStats->TBLK != null ? $getStats->TBLK : "0" }}</td>
															</tr>
														</tbody>
													@else
														<tr>
															<td class="">No player stats added</td>
														</tr>
													@endif
												</table>
											</div>
											<div class="playerProfileLeaguesLink">
												<a href="{{ route('season.show', ['league' => str_ireplace(" ", "", strtolower($playerSeasonInfo->season->league->name)), 'season' => str_ireplace(" ", "", strtolower($playerSeasonInfo->season->name))]) }}" class="" target="_blank">Go To League Site</a>
											</div>
										</div>
									</div>
								</div>
							@endforeach
						</div>
					@endif

				</div>
				<!--/.Panel 1-->

				<!--Panel 2-->
				<div class="tab-pane fade" id="panel2" role="tabpanel">
				
					<br>

					<!--Section: Team v.3-->
					<section class="section team-section pb-4">

						<h2 class="playerPageVideosHeader">Highlights</h2>
			
						@if($player->videos->count() > 0)
							<div class="">
								@foreach($player->videos as $showVideo)
									<div class="playerPageVideo ">
										<h2>Uploaded:<span class="myVideoID" hidden>{{ $showVideo->id }}</span></h2>
										<video class="currentVideo">
											<source src="{{ $showVideo->file }}" type="video/mp4">
											<source src="{{ $showVideo->file }}" type="video/ogg">
											Your browser does not support the video tag.
										</video>
									</div>
								@endforeach
							</div>
						@else
							<div class="">
								<h3 class="h3-responsive">This Player Hasn't Decided To Showcase Their Skills Yet. No Highlights To Show</h3>
							</div>
						@endif

					</section>
					<!--Section: Team v.3-->
				
				</div>
				<!--/.Panel 2-->

				<!--Panel 3-->
				<div class="tab-pane fade" id="panel3" role="tabpanel">
					
					<br>

					@if($player->playgrounds->isNotEmpty())
						<div class="playerPlaygrounds">
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
								
								<div class="row">
									<div class="col">
										<h2 class="">{{ str_ireplace('_', ' ', $myPlayground->playground) }}</h2>
									</div>
									<div class="col">
										<h2 class="">{{ ucfirst($myPlayground->playground) }}</h2>
									</div>
									<div class="col">
										<h2 class="">{{ $time }}</h2>
									</div>
								</div>
							@endforeach
						</div>
					@endif
				</div>
				<!--/.Panel 3-->

				<!--Panel 4-->
				<div class="tab-pane fade show active" id="panel4" role="tabpanel">
					
					<br/>
					
					<h3 id="contact_header2" class="">{!! $player->height != "" ? "<span>Height: " . $player->height . "</span>" : "" . $player->weight > 0 ? "<span>Weight: " . $player->weight . " lbs.</span>" : "" !!}</h3>

					<b>High School:</b>
					{{ $player->highschool != "" ? $player->highschool : "No HS Entered" }}
					
					<b>College:</b>
					{{ $player->college != "" ? $player->college : "No College Entered" }}
					
					<b>Age:</b>
					{{ $player->dob != 0 ? $player->get_player_age() : "No DOB Entered" }}

						@if($player->show_email == "Y")
							<tr>
								<td><b>Email:</b></td>
								<td>{{ $player->email != "" ? $player->email : "No Email Address Entered" }}</td>
							</tr>
						@endif
				</div>
				<!--/.Panel 4-->

			</div>

		</section>
		<!--Section: Tabs-->

	</div>
@endsection