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

		{!! Form::open(['action' => ['Admin\WritersProfileController@store'], 'method' => 'POST']) !!}

			<div class="row p-2 pb-4 m-3 white rounded z-depth-2 coolText4">

				<div class="col-12 d-flex justify-content-between align-items-center">

					<h3 class="p-1 h3-responsive">Create New Writer Profile</h3>

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
						<i class="fab fa-facebook prefix fb-ic"></i>
						<input type="text" name="fb" class="form-control white-text" value="{{ old('fb') }}" placeholder="Enter Facebook Profile" />
						<label for="fb">Facebook</label>
					</div>

					@if($errors->has('fb'))
					<!-- Return error message for nickname -->
						<div class="returnError">
							<p class="red-text">{{ $errors->first('fb') }}</p>
						</div>
					@endif
				</div>

				<div class="col-12 col-md-10 mx-auto">
					<div class="md-form">
						<i class="fab fa-twitter prefix tw-ic"></i>
						<input type="text" name="twitter" class="form-control white-text" value="{{ old('twitter') }}" placeholder="Enter Twitter Handle" />
						<label for="twitter">Twitter</label>
					</div>

					@if($errors->has('twitter'))
					<!-- Return error message for owner -->
						<div class="returnError">
							<p class="red-text">{{ $errors->first('twitter') }}</p>
						</div>
					@endif
				</div>

				<div class="col-12 col-md-10 mx-auto">
					<div class="md-form">
						<i class="fab fa-instagram prefix ins-ic"></i>
						<input type="text" name="instagram" class="form-control white-text" value="{{ old('instagram') }}"  placeholder="Enter Instagram Handle"/>
						<label for="instagram">Instagram</label>
					</div>

					@if($errors->has('instagram'))
					<!-- Return error message for address -->
						<div class="returnError">
							<p class="red-text">{{ $errors->first('instagram') }}</p>
						</div>
					@endif
				</div>

				<div class="col-12 col-md-10 mx-auto">

					<div class="md-form">
						<textarea type="text" name="about" class="md-textarea form-control" rows="3">{{ old('about') }}</textarea>

						<label for="about">About Me</label>
					</div>
				</div>

				<div class="col-12 col-md-10 my-4 mx-auto">
					<button class="btn btn-success mx-0" type="submit">Add Writer Profile</button>
				</div>

			</div>

		{!! Form::close() !!}

	</div>

@endsection
