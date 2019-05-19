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

	<div class="container">

		{!! Form::open(['action' => ['Admin\PlayerProfilesController@store'], 'method' => 'POST']) !!}

			<div class="row p-2 pb-4 m-3 white rounded z-depth-2 coolText4">

				<div class="col-12 d-flex justify-content-between align-items-center">

					<h3 class="p-1 h3-responsive">Create New Player Profile</h3>

				</div>

				<div class="col-12 col-md-10 mx-auto">
					<div class="md-form">
						<input type="text" name="username" class="form-control" value="{{ old('username') }}" />

						<label for="username">Username</label>

						@if($errors->has('username'))
						<!-- Return error message for name -->
							<div class="returnError">
								<p class="red-text">{{ $errors->first('username') }}</p>
							</div>
						@endif
					</div>
				</div>

				<div class="col-12 col-md-10 mx-auto">
					<div class="md-form">
						<input type="text" name="password" class="form-control" value="{{ old('password') }}" />

						<label for="password">Password</label>

						@if($errors->has('password'))
						<!-- Return error message for name -->
							<div class="returnError">
								<p class="red-text">{{ $errors->first('password') }}</p>
							</div>
						@endif
					</div>
				</div>

				<div class="col-12 col-md-10 mx-auto">
					<div class="md-form">
						<input type="text" name="firstname" class="form-control" value="{{ old('firstname') }}" />

						<label for="firstname">Firstname</label>

						@if($errors->has('firstname'))
						<!-- Return error message for name -->
							<div class="returnError">
								<p class="red-text">{{ $errors->first('firstname') }}</p>
							</div>
						@endif
					</div>
				</div>

				<div class="col-12 col-md-10 mx-auto">
					<div class="md-form">
						<input type="text" name="lastname" class="form-control" value="{{ old('lastname') }}" />

						<label for="lastname">Lastname</label>
					</div>

				@if($errors->has('lastname'))
					<!-- Return error message for nickname -->
						<div class="returnError">
							<p class="red-text">{{ $errors->first('lastname') }}</p>
						</div>
					@endif
				</div>

				<div class="col-12 col-md-10 mx-auto">
					<div class="md-form">
						<input type="text" name="nickname" class="form-control" value="{{ old('nickname') }}" />

						<label for="nickname">NickName</label>
					</div>

					@if($errors->has('nickname'))
					<!-- Return error message for nickname -->
						<div class="returnError">
							<p class="red-text">{{ $errors->first('nickname') }}</p>
						</div>
					@endif
				</div>

				<div class="col-12 col-md-10 mx-auto">
					<div class="md-form">
						<input type="text" name="email" class="form-control" value="{{ old('email') }}" />

						<label for="email">Email</label>
					</div>

					@if($errors->has('email'))
					<!-- Return error message for nickname -->
						<div class="returnError">
							<p class="red-text">{{ $errors->first('email') }}</p>
						</div>
					@endif
				</div>

				<div class="col-12 col-md-10 mx-auto">
					<div class="md-form">
						<input type="text" name="highschool" class="form-control" value="{{ old('highschool') }}" />

						<label for="highschool">High School</label>
					</div>

					@if($errors->has('highschool'))
					<!-- Return error message for owner -->
						<div class="returnError">
							<p class="red-text">{{ $errors->first('highschool') }}</p>
						</div>
					@endif
				</div>

				<div class="col-12 col-md-10 mx-auto">
					<div class="md-form">
						<input type="text" name="college" class="form-control" value="{{ old('college') }}" />

						<label for="college">College</label>
					</div>

					@if($errors->has('college'))
					<!-- Return error message for address -->
						<div class="returnError">
							<p class="red-text">{{ $errors->first('college') }}</p>
						</div>
					@endif
				</div>

				<div class="col-12 col-md-10 mx-auto">
					<div class="md-form">
						<input type="text" name="height" class="form-control" value="{{ old('height') }}" />

						<label for="height">Height</label>
					</div>

					@if($errors->has('height'))
					<!-- Return error message for recs_phone -->
						<div class="returnError">
							<p class="red-text">{{ $errors->first('height') }}</p>
						</div>
					@endif
				</div>

				<div class="col-12 col-md-10 mx-auto">
					<div class="md-form">
						<input type="number" name="weight" class="form-control" value="{{ old('weight') }}" />

						<label for="weight">Weight</label>
					</div>

					@if($errors->has('weight'))
					<!-- Return error message for recs_phone -->
						<div class="returnError">
							<p class="red-text">{{ $errors->first('weight') }}</p>
						</div>
					@endif
				</div>

				<div class="col-12 col-md-10 mx-auto">
					<select class="mdb-select md-form">
						<option value="magician">Magician</option>
						<option value="sniper">Sniper</option>
					</select>

					@if($errors->has('weight'))
					<!-- Return error message for recs_phone -->
						<div class="returnError">
							<p class="red-text">{{ $errors->first('weight') }}</p>
						</div>
					@endif
				</div>

				<div class="col-12 col-md-10 my-4 mx-auto">
					<button class="btn btn-success mx-0" type="submit">Add Player Profile</button>
				</div>

			</div>

		{!! Form::close() !!}

	</div>

@endsection
