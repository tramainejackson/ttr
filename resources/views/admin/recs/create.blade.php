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

		{!! Form::open(['action' => ['Admin\RecCenterController@store'], 'method' => 'POST', 'files' => true]) !!}

			<div class="row p-2 pb-4 m-3 white rounded z-depth-2 coolText4">

				<div class="col-12 d-flex justify-content-between align-items-center">

					<h3 class="p-1 h3-responsive">Create New Rec Center</h3>

				</div>

				<div class="col-12 col-md-10 mx-auto">
					<div class="md-form">
						<input type="text" name="name" class="form-control" value="{{ old('name') }}" />

						<label for="name">Name</label>

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
						<input type="text" name="owner" class="form-control" value="{{ old('owner') }}" />

						<label for="owner">Owner</label>
					</div>

					@if($errors->has('owner'))
					<!-- Return error message for owner -->
						<div class="returnError">
							<p class="red-text">{{ $errors->first('owner') }}</p>
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

				<div class="col-12 col-md-10 mx-auto mb-3">
					<div class="md-form">
						<textarea type="text" name="additional_info" class="md-textarea form-control" rows="3">{{ old('additional_info') }}</textarea>

						<label for="additional_info">Addt Info</label>
					</div>

					@if($errors->has('additional_info'))
					<!-- Return error message for additional_info -->
						<div class="returnError">
							<p class="red-text">{{ $errors->first('additional_info') }}</p>
						</div>
					@endif
				</div>

				<div class="col-12 col-md-10 mx-auto">
					<div class="row">
						<div class="md-form input-group col-6 m-0">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-dollar-sign" aria-hidden="true"></i></span>
							</div>

							<input type="number" name="fee" class="form-control" step="0.01" value="{{ old('fee') }}" placeholder="0.00" />

							@if($errors->has('fee'))
							<!-- Return error message for fee -->
								<div class="returnError">
									<p class="red-text">{{ $errors->first('fee') }}</p>
								</div>
							@endif
						</div>
					</div>
				</div>

				<div class="col-12 col-md-10 my-4 mx-auto">
					<button class="btn btn-success mx-0" type="submit">Add Rec Center</button>
				</div>

			</div>

		{!! Form::close() !!}

	</div>

@endsection
