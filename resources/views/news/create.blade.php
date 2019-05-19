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
	<div class="row my-3">
		<div class="col text-right">
			<button class="btn btn-primary">Total Articles <span class="white rounded-circle px-1 text-dark">{{ $totalArticles }}</span></button>
		</div>
		<div class="col">
			<button class="btn btn-primary">Published Articles <span class="white rounded-circle px-1 text-dark">{{ $publishedArticles }}</span></button>
		</div>
	</div>
	
	{!! Form::open(['action' => ['NewsArticleController@store'], 'method' => 'POST', 'files' => true]) !!}
		<div class="row p-2 pb-4 m-3 white rounded z-depth-2 coolText4">
			<div class="col-12 d-flex justify-content-between align-items-center">
				<h3 class="p-1 h3-responsive">Create New Article</h3>
				
				<div class="md-form col-6 col-xl-4">
					<div class="file-field">
						<div class="btn btn-primary btn-sm float-left">
							<span>Choose file</span>
							<input type="file" name="picture">
						</div>
						<div class="file-path-wrapper">
						   <input class="file-path validate" type="text" placeholder="Upload your article picture">
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-10 mx-auto">
				<div class="md-form">
					<input type="text" name="title" class="form-control" value="{{ old('title') }}" />
					
					<label for="title">Title</label>
				</div>
			</div>
			<div class="col-12 col-md-10 mx-auto mb-3">
				<div class="md-form">
					<textarea type="text" name="article" class="md-textarea form-control" rows="3">{{ old('article') }}</textarea>
					
					<label for="article">Article</label>
				</div>
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
