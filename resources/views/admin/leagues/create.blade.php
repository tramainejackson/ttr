@extends('layouts.app')

@section('styles')
	<style>
		#app {
			background: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.35)), url('/images/newspaper.gif');
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

	<div class="container">

		{!! Form::open(['action' => ['Admin\LeagueProfilesController@store'], 'method' => 'POST', 'files' => true]) !!}

			<div class="row p-2 pb-4 m-3 white rounded z-depth-2 coolText4">

				<div class="col-12 d-flex justify-content-between align-items-center">

					<h3 class="p-1 h3-responsive">Create New League Profile</h3>

				</div>

				<div class="col-12 col-md-10 mx-auto">
					<div class="md-form">
						<input type="text" name="name" class="form-control" value="{{ old('name') }}" />

						<label for="name">League Name</label>

						@if($errors->has('name'))
						<!-- Return error message for name -->
							<div class="returnError">
								<p class="red-text">{{ $errors->first('name') }}</p>
							</div>
						@endif
					</div>
				</div>

				<div class="col-12 col-md-10 mx-auto">
					<div class="md-form">
						<input type="text" name="commish" class="form-control" value="{{ old('commish') }}" />

						<label for="commish">Commissioner Name</label>
					</div>

					@if($errors->has('commish'))
					<!-- Return error message for owner -->
						<div class="returnError">
							<p class="red-text">{{ $errors->first('commish') }}</p>
						</div>
					@endif
				</div>

				<div class="col-12 col-md-10 mx-auto">
					<div class="md-form">
						<input type="text" name="address" class="form-control" value="{{ old('address') }}" />

						<label for="address">Address</label>
					</div>

					@if($errors->has('address'))
					<!-- Return error message for address -->
						<div class="returnError">
							<p class="red-text">{{ $errors->first('address') }}</p>
						</div>
					@endif
				</div>

				<div class="col-12 col-md-10 mx-auto">
					<div class="md-form">
						<input type="text" name="recs_phone" class="form-control" value="{{ old('phone') }}" />

						<label for="recs_phone">Phone Number</label>
					</div>

					@if($errors->has('recs_phone'))
					<!-- Return error message for recs_phone -->
						<div class="returnError">
							<p class="red-text">{{ $errors->first('recs_phone') }}</p>
						</div>
					@endif
				</div>

				<div class="md-form">
					<input type="text" name="leagues_email" class="form-control white-text" id="leagues_email" value="{{ old('leagues_email') }}" placeholder="Enter Leagues Email Address" />

					<label for="leagues_email">League Email</label>
				</div>

				<div class="md-form">
					<input type="text" name="leagues_website" class="form-control white-text" id="leagues_website" value="{{ old('leagues_website') }}" placeholder="Enter League Website" />

					<label for="leagues_website">League Website</label>
				</div>

				<div class="md-form input-group my-5">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
					</div>

					<input type="number" name="leagues_fee" class="form-control white-text" id="league_fee" value="{{ old('leagues_fee') }}" placeholder="Enter League Entry Fee" step="0.01" />

					<div class="input-group-append">
						<span class="input-group-text">Per Team</span>
					</div>

					<label for="leagues_fee">Entry Fee</label>
				</div>

				@if($errors->has('leagues_fee'))
				<!-- Return error message for leagues_fee -->
					<div class="returnError">
						<p class="red-text">{{ $errors->first('leagues_fee') }}</p>
					</div>
				@endif

				<div class="md-form input-group mb-5">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
					</div>

					<input type="number" class="form-control white-text" name="ref_fee" id="ref_fee" value="{{ old('ref_fee')  }}" placeholder="Enter League Ref Fee"  step="0.01" />

					<div class="input-group-append">
						<span class="input-group-text">Per Game</span>
					</div>

					<label for="ref_fee">Ref Fee</label>
				</div>

				@if($errors->has('ref_fee'))
				<!-- Return error message for ref_fee -->
					<div class="returnError">
						<p class="red-text">{{ $errors->first('ref_fee') }}</p>
					</div>
				@endif

				<div class="md-form mb-5">
					@php $ages = find_ages(); @endphp

					<div class="row">
						@foreach($ages as $age)
							<div class="col-6 col-md-3">
								<button type="button" class="btn btn-lg mx-0 w-100 white-text ageBtnSelect grey">{{ str_ireplace("_", " ", ucwords($age)) }}
									<input type="checkbox" class="hidden" name="age[]" value="{{ $age }}" hidden />
								</button>
							</div>
						@endforeach
					</div>

					<label for="leagues_ages">League Ages</label>
				</div>

				<div class="md-form">
					@php $getComp = find_competitions(); @endphp

					<div class="row">
						@foreach($getComp as $comp)
							<div class="col-6 col-lg-3">
								<button class="btn btn-lg gray mx-0 w-100 white-text compBtnSelect grey" type="button">{{ str_ireplace("_", " ", ucwords($comp)) }}
									<input type="checkbox" class="hidden" name="leagues_comp[]" value="{{ $comp }}" hidden />
								</button>
							</div>
						@endforeach
					</div>

					<label for="leagues_comp">League Competition</label>
				</div>

				<div class="col-12 col-md-10 my-4 mx-auto">
					<button class="btn btn-success mx-0" type="submit">Add Rec Center</button>
				</div>

			</div>

		{!! Form::close() !!}

	</div>

@endsection
