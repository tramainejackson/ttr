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

		{!! Form::open(['action' => ['NewsController@store'], 'method' => 'POST', 'files' => true]) !!}

			<div class="row p-2 pb-4 m-3 white rounded z-depth-2 coolText4">

				<div class="col-12 d-flex justify-content-between align-items-center">

					<h3 class="p-1 h3-responsive">Create New Rec Center</h3>

				</div>

				<div class="col-12 col-md-10 mx-auto">
					<div class="md-form">
						<input type="text" name="name" class="form-control" value="{{ old('name') }}" />

						<label for="title">Name</label>
					</div>
				</div>

				<div class="col-12 col-md-10 mx-auto">
					<div class="md-form">
						<input type="text" name="nickname" class="form-control" value="{{ old('nickname') }}" />

						<label for="title">NickName</label>
					</div>
				</div>

				<div class="col-12 col-md-10 mx-auto">
					<div class="md-form">
						<input type="text" name="owner" class="form-control" value="{{ old('owner') }}" />

						<label for="title">Owner</label>
					</div>
				</div>

				<div class="col-12 col-md-10 mx-auto">
					<div class="md-form">
						<input type="text" name="address" class="form-control" value="{{ old('address') }}" />

						<label for="title">Address</label>
					</div>
				</div>

				<div class="col-12 col-md-10 mx-auto">
					<div class="md-form">
						<input type="text" name="phone" class="form-control" value="{{ old('phone') }}" />

						<label for="title">Phone Number</label>
					</div>
				</div>

				<div class="col-12 col-md-10 mx-auto mb-3">
					<div class="md-form">
						<textarea type="text" name="article" class="md-textarea form-control" rows="3">{{ old('additional_info') }}</textarea>

						<label for="additional_info">Addt Info</label>
					</div>
				</div>

				<div class="col-12 col-md-10 mx-auto">
					<div class="row">
						<div class="md-form input-group col-6 m-0">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-dollar-sign" aria-hidden="true"></i></span>
							</div>

							<input type="number" name="fee" class="form-control" step="0.01" value="{{ old('fee') }}" placeholder="0.00" />

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
