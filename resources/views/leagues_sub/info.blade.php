@extends('layouts.app')

@section('content')
	@include('include.functions')

	<div class="container-fluid bgrd3">
		<div class="row">
			<div class="col-12 col-md-10 mx-auto leagueContactInfo">
				{!! Form::open(['action' => ['LeagueProfileController@update', 'league' => $league->id], 'method' => 'PATCH', 'files' => true]) !!}
					<div class="row">
						<div class="col-12 col-md-10 col-lg-8 col-xl-6 my-3 mx-auto">
							<div id="update_pic" class="card card-cascade mx-auto">
								<!--Card Image-->
									<div class="view" style="min-height: initial !important;">
										<img id="current_pic" class="card-img-top" src="{{ $league->picture != null ? asset($league->picture) : '/images/commissioner.jpg' }}">
									</div>
								<!--./Card Image/.-->
								
								<!--Card Body-->
									<div class="card-body">
										<!--Title-->
										<h1 class="card-title coolText1 text-center">{{ $league->name }}</h1>
									</div>
								<!--./Card Body/.-->
								
								<!--Card Footer/.-->
									<div class="card-footer grey">
										<div class="md-form">
											<div class="file-field">
												<div class="btn btn-primary btn-sm float-left">
													<span class="changeSpan">Change Photo</span>
													<input type="file" name="profile_photo" id="file">
												</div>
												<div class="file-path-wrapper">
													<input class="file-path validate" type="text" placeholder="Upload your file">
												</div>
											</div>
										</div>
									</div>
								<!--./Card Footer/.-->
							</div>
						</div>
					</div>
					<div class="updateLeagueForm">
						<div class="updateLeagueInputs rgba-white-strong px-5 py-3 rounded" id="">
							<div class="md-form">
								<input type="text" name="name" class="form-control" id="name" value="{{ $league->name }}" />

								<label for="name">League Name</label>

								@if ($errors->has('name'))
									<span class="help-block">
										<strong>{{ $errors->first('name') }}</strong>
									</span>
								@endif
							</div>
							<div class="md-form">
								<input type="text" name="commish" class="form-control" id="commish" placeholder="Commissioner" value="{{ $league->commish }}" />

								<label for="commish">Commissioner</label>

								@if ($errors->has('commish'))
									<span class="help-block">
										<strong>{{ $errors->first('commish') }}</strong>
									</span>
								@endif
							</div>
							<div class="md-form">
								<input type="text" name="leagues_address" class="form-control" id="leagues_address" placeholder="Address" value="{{ $league->address }}" />

								<label for="leagues_address">League Address</label>
							</div>
							<div class="md-form">
								<input type="text" name="leagues_phone" class="form-control" id="leagues_phone" placeholder="Phone" value="{{ $league->phone }}" />

								<label for="leagues_phone">League Phone</label>
							</div>
							<div class="md-form pb-2">
								<input type="text" name="leagues_email" class="form-control" id="leagues_email" value="{{ $league->leagues_email }}" />

								<label for="leagues_email">League Email</label>
							</div>

							<div class="md-form input-group pb-3">
								<div class="input-group-prepend">
									<span class="input-group-text coolText4">http://www.</span>
								</div>

								<input type="text" name="leagues_website" class="form-control" id="leagues_website" value="{{ $league->leagues_website }}" placeholder="League Website" />

								<label for="leagues_website">League Website</label>
							</div>

							<div class="md-form input-group pb-3">
								<div class="input-group-prepend">
									<span class=" input-group-text"><i class="fas fa-dollar-sign"></i></span>
								</div>

								<input type="number" name="leagues_fee" class="form-control" id="league_fee" value="{{ $league->leagues_fee }}" step="0.01" placeholder="League Entry Fee" />

								<div class="input-group-prepend">
									<span class="input-group-text coolText4">Per Team</span>
								</div>

								<label for="leagues_fee">Entry Fee</label>

								@if ($errors->has('leagues_fee'))
									<span class="help-block">
										<strong>{{ $errors->first('leagues_fee') }}</strong>
									</span>
								@endif
							</div>
							<div class="md-form input-group mb-5 pb-3">
								<div class="input-group-prepend">
									<span class=" input-group-text"><i class="fas fa-dollar-sign"></i></span>
								</div>

								<input type="number" class="form-control" class="form-control" name="ref_fee" id="ref_fee" value="{{ $league->ref_fee }}" step="0.01" placeholder="League Referee Fee" />

								<div class="input-group-prepend">
									<span class="input-group-text coolText4">Per Game</span>
								</div>

								<label for="ref_fee">Ref Fee</label>

								@if ($errors->has('ref_fee'))
									<span class="help-block">
										<strong>{{ $errors->first('ref_fee') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="section text-center mt-5">
							<h2 class="h2-responsive coolText4">Select Your Leagues Ages and Competition Levels</h2>
						</div>
						
						<div class="md-form mb-5">
							@php $ages = find_ages(); @endphp
							@php $ageArray =  explode(" ", $league->age); @endphp
							<div class="row">
								@foreach($ages as $age)
									<div class="col-6 col-xl-3">
										<button type="button" class="btn btn-lg mx-0 w-100 white-text ageBtnSelect{{ in_array($age, $ageArray) ? ' blue ' : ' grey' }}">{{ str_ireplace("_", " ", ucwords($age)) }}
											<input type="checkbox" class="hidden" name="age[]" value="{{ $age }}" hidden{{ in_array($age, $ageArray) ? ' checked ' : '' }}/>
										</button>
									</div>
								@endforeach
							</div>
						</div>
						<div class="md-form">
							@php $getComp = find_competitions(); @endphp
							@php $compArray =  explode(" ", $league->comp); @endphp
							<div class="row">
								@foreach($getComp as $comp)
									<div class="col-12 col-md-6">
										<button class="btn btn-lg mx-0 w-100 white-text compBtnSelect{{ in_array($comp, $compArray) ? ' orange' : ' grey' }}" type="button">{{ str_ireplace("_", " ", ucwords($comp)) }}
											<input type="checkbox" class="hidden" name="leagues_comp[]" value="{{ $comp }}" hidden{{ in_array($comp, $compArray) ? ' checked ' : '' }}/>
										</button>
									</div>
								@endforeach
							</div>
						</div>
						<div class="md-form">
							<button type="submit" name="submit" class="btn btn-lg green m-0 white-text" id="" value="">Update League</button>
						</div>
					</div>
				{!! Form::close() !!}
			</div>
				
				<!-- Dropdown button to show the league rules
				<button class="mb-4" id="league_rules_btn">SEE LEAGUE RULES</button>

			<div class="col-12">
				<div id="leagues_rules">
					<h2>Leagues Rules</h2>
					<ul>
						<li>All teams must arrive 15 minutes before their scheduled game time.</li>
						<li>All players must wear their teams jersey. If a player does not have a jersey, that player will not be allowed to play.</li>
						<li>If teams aren't present 10 minutes after their scheduled game time they will be issued a forfeit.</li>
						<li>Ref fees will be collected at halftime of every game.</li>
						<li>After 5 fouls a player fouls out.</li>
						<li>20 minutes halves with a running clock except the last 2 minutes of each half.</li>
						<li>Each team has 4 timeouts per game.</li>
						<li>Each overtime period will be 3 minutes</li>
					</ul>
				</div>
			</div> -->
		</div>
	</div>
@endsection
