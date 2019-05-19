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

		{!! Form::open(['action' => ['Admin\NewsArticleController@store'], 'method' => 'POST', 'files' => true]) !!}

			<div class="row p-2 pb-4 m-3 white rounded z-depth-2 coolText4">

				<div class="col-12 d-flex justify-content-between align-items-center">

					<h3 class="p-1 h3-responsive">Create News Article</h3>

				</div>

				<div class="col-12 col-md-10 mx-auto">
					<div class="md-form">
						<div class="file-field">
							<div class="btn btn-primary btn-sm float-left ml-0">
								<span>Choose file</span>
								<input type="file" name="picture">
							</div>
							<div class="file-path-wrapper">
								<input class="file-path validate" type="text" placeholder="Upload your article picture">
							</div>
						</div>

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
						<input type="text" name="title" class="form-control" value="{{ old('title') }}" />

						<label for="title">Title</label>
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
						<textarea type="text" name="article" class="md-textarea form-control" rows="3">{{ old('article') }}</textarea>

						<label for="article">Article</label>
					</div>

					@if($errors->has('owner'))
					<!-- Return error message for owner -->
						<div class="returnError">
							<p class="red-text">{{ $errors->first('owner') }}</p>
						</div>
					@endif
				</div>

				<div class="col-12 col-md-10 mx-auto">
					<div class="row">
						<div class="md-form input-group col-6 m-0">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
							</div>

							<input type="text" name="publish_date" class="form-control" value="{{ \Carbon\Carbon::now()->format('F jS\\, Y') }}" disabled />

							<div class="input-group-append">
								<span class="input-group-text">Publish Date</span>
							</div>
						</div>

						<div class="col-6 d-flex flex-column align-items-center justify-content-center">
							<h4 class="h4-responsive text-center">Publish Now</h4>

							<div class="btn-group">
								<button type="button" class="btn grey publishBtn">
									<input type="checkbox" name="publish" value="Y" hidden />Yes
								</button>
								<button type="button" class="btn publishBtn btn-danger">
									<input type="checkbox" name="publish" value="N" hidden checked />No
								</button>
							</div>
						</div>
					</div>
				</div>

				<div class="col-12 col-md-10 my-4 mx-auto">
					<button class="btn btn-success mx-0" type="submit">Submit Article</button>
				</div>

			</div>

		{!! Form::close() !!}

	</div>

@endsection
