@extends('layouts.app')

@section('styles')
	<style>
		#app {
			background: url('/images/basketball_office.jpg');
			background-size: 100% 100%;
			background-repeat: no-repeat;
			background-position: 100% 0%;
			background-attachment: fixed;
			z-index: -1;
		}

		.md-form .prefix.active, .md-form label.active {
			color: whitesmoke !important;
		}
	</style>
@endsection

@section('scripts')
	<script type="text/javascript">
		// Add baground color to navigation
        $('nav').addClass('rgba-stylish-strong');

        // Add the active class for the select item labels
		$('.md-form label[for="leagues_comp"], .md-form label[for="leagues_ages"]').addClass('active');
	</script>
@endsection

@section('content')

	@include('include.functions')


	<div class="container-fluid rgba-stylish-strong" id="leaguesProfileContainer">

		<div class="row" id="">
			{{--	<a href="{{ route('sub_profile', ['user' => Auth::user()]) }}" target="_blank" class="btn btn-primary">Test Link</a>--}}
		</div>

		<div class="row">
			<div class="col-12 col-md-12 mx-auto">
				{!! Form::open(['action' => ['LeagueProfileController@update', $league->id], 'method' => 'PATCH', 'files' => true]) !!}
					<div class="row">
						<div class="col-5 my-3 mx-auto">
							<div id="update_pic" class="card card-cascade mx-auto">
								<!--Card Image-->
									<div class="view" style="min-height: initial !important;">
										<img id="current_pic" class="card-img-top" src="{{ $league->leagues_picture != null ? asset($league->leagues_picture) : '/images/commissioner.jpg' }}">
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
													<input type="file" name="file" id="file">
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
					
					<div class="container pb-4">
						<div class="row">
							<div class="col">
								<div class="md-form">
									<input type="text" name="leagues_name" class="form-control white-text" id="leagues_name" value="{{ $league->name }}" />
									
									<label for="leagues_name">League Name</label>
								</div>
								<div class="md-form">
									<input type="text" name="leagues_commish" class="form-control white-text" id="leagues_commish" placeholder="Commissioner" value="{{ $league->commish }}" />

									<label for="leagues_commish">Commissioner</label>
								</div>
								<div class="md-form">
									<input type="text" name="leagues_address" class="form-control white-text" id="leagues_address" placeholder="Address" value="{{ $league->address }}" />

									<label for="leagues_address">League Address</label>
								</div>
								<div class="md-form">
									<input type="text" name="leagues_phone" class="form-control white-text" id="leagues_phone" placeholder="Phone" value="{{ $league->phone }}" />

									<label for="leagues_phone">League Phone</label>
								</div>
								<div class="md-form">
									<input type="text" name="leagues_email" class="form-control white-text" id="leagues_email" value="{{ $league->leagues_email }}" placeholder="Enter Leagues Email Address" />

									<label for="leagues_email">League Email</label>
								</div>
								<div class="md-form">
									<input type="text" name="leagues_website" class="form-control white-text" id="leagues_website" value="{{ $league->leagues_website }}" placeholder="Enter League Website" />

									<label for="leagues_website">League Website</label>
								</div>
								<div class="md-form input-group my-5">
									<div class="input-group-prepend">
										<i class="fas fa-dollar-sign"></i>
									</div>

									<input type="number" name="leagues_fee" class="form-control white-text" id="league_fee" value="{{ $league->leagues_fee }}"  step="0.01" />

									<div class="input-group-append">
										<span class="input-group-text">Per Team</span>
									</div>

									<label for="leagues_fee">Entry Fee</label>
								</div>
								<div class="md-form input-group mb-5">
									<div class="input-group-prepend">
										<i class="fas fa-dollar-sign"></i>
									</div>

									<input type="number" class="form-control white-text" name="ref_fee" id="ref_fee" value="{{ $league->ref_fee }}" step="0.01" />

									<div class="input-group-append">
										<span class="input-group-text">Per Game</span>
									</div>

									<label for="ref_fee">Ref Fee</label>
								</div>
								<div class="md-form mb-5">
									@php $ages = find_ages(); @endphp
									@php $ageArray =  explode(" ", $league->age); @endphp
									<div class="row">
										@foreach($ages as $age)
											<div class="col-6 col-md-3">
												<button type="button" class="btn btn-lg mx-0 w-100 ageBtnSelect{{ in_array($age, $ageArray) ? ' blue ' : ' grey' }}">{{ str_ireplace("_", " ", ucwords($age)) }}
													<input type="checkbox" class="hidden" name="age[]" value="{{ $age }}" hidden{{ in_array($age, $ageArray) ? ' checked ' : '' }}/>
												</button>
											</div>
										@endforeach
									</div>

									<label for="leagues_ages">League Ages</label>
								</div>
								<div class="md-form">
									@php $getComp = find_competitions(); @endphp
									@php $compArray =  explode(" ", $league->comp); @endphp
									<div class="row">
										@foreach($getComp as $comp)
											<div class="col-6 col-lg-3">
												<button class="btn btn-lg gray mx-0 w-100 compBtnSelect{{ in_array($comp, $compArray) ? ' orange' : ' grey' }}" type="button">{{ str_ireplace("_", " ", ucwords($comp)) }}
													<input type="checkbox" class="hidden" name="leagues_comp[]" value="{{ $comp }}" hidden{{ in_array($comp, $compArray) ? ' checked ' : '' }}/>
												</button>
											</div>
										@endforeach
									</div>
									
									<label for="leagues_comp">League Competition</label>
								</div>
								<div class="md-form">
									<button type="submit" name="submit" class="btn btn-lg green m-0" id="" value="">Update League</button>
								</div>
							</div>
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection