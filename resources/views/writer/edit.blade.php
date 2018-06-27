@extends('layouts.app')

@section('addt_style')
	<style>
		#app {
			background: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.35)), url(/images/newspaper.gif);
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
		<div class="container-fluid" id="leaguesProfileContainer">
		<div class="row">
			<div class="col-12 col-md-12 mx-auto">
				{!! Form::open(['action' => ['WriterProfileController@update', $writer->id], 'method' => 'PATCH', 'files' => true]) !!}
					<div class="row">
						<div class="col-5 my-3 mx-auto">
							<div id="update_pic" class="card card-cascade mx-auto">
								<!--Card Image-->
									<div class="view" style="min-height: initial !important;">
										<img id="current_pic" class="card-img-top" src="{{ $writer->picture != null ? asset($writer->picture) : '/images/commissioner.jpg' }}">
									</div>
								<!--./Card Image/.-->
								
								<!--Card Body-->
									<div class="card-body">
										<!--Title-->
										<h1 class="card-title coolText1 text-center">{{ $writer->full_name() }}</h1>
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
					<div class="updateLeagueForm">
						<div class="row">
							<div class="col">
								<div class="md-form">
									<input type="text" name="firstname" class="form-control white-text" id="firstname" value="{{ $writer->firstname }}" placeholder="Firstname" />
									
									<label for="firstname">Firstname</label>
								</div>
							</div>
							<div class="col">
								<div class="md-form">
									<input type="text" name="lastname" class="form-control white-text" id="lastname" placeholder="Lastname" value="{{ $writer->lastname }}" />

									<label for="lastname">Lastname</label>
								</div>
							</div>
						</div>
						
						<div class="md-form">
							<textarea type="text" name="about" class="md-textarea form-control white-text" id="about" placeholder="About Me" >{{ $writer->about }}</textarea>

							<label for="about">About Me</label>
						</div>

						<div class="md-form">
							<button type="submit" name="submit" class="btn btn-lg green m-0" id="" value="">Update Profile</button>
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@endsection
