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
	{!! Form::open(['action' => ['NewsController@update', 'news' => $article->id], 'method' => 'PATCH', 'files' => true]) !!}
		<div class="row p-2 pb-4 m-3 white rounded z-depth-2 coolText4">
			<div class="col-12 d-flex justify-content-between align-items-center">
				<h3 class="p-1 h3-responsive align-self-start">Edit Article</h3>
				
				<div class="col-6 col-xl-4">
					<div class="col-12">
						<img src="{{ $article->picture !== null ? asset(str_ireplace('public/images', 'storage/images/sm', $article->picture)) : $defaultImg }}" class="img-fluid img-thumbnail" />
					</div>
					
					<div class="md-form col-12">
						<div class="file-field">
							<div class="btn btn-primary btn-sm float-left">
								<span>Choose file</span>
								<input type="file" name="picture">
							</div>
							<div class="file-path-wrapper">
							   <input class="file-path validate" type="text" placeholder="Change article picture">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-10 mx-auto">
				<div class="md-form">
					<input type="text" name="title" class="form-control" value="{{ $article->title }}" />
					
					<label for="title">Title</label>
				</div>
			</div>
			<div class="col-12 col-md-10 mx-auto mb-3">
				<div class="md-form">
					<textarea type="text" name="article" class="md-textarea form-control" rows="3">{{ $article->article }}</textarea>
					
					<label for="article">Article</label>
				</div>
			</div>
			<div class="col-12 col-md-10 mx-auto">
				<div class="row">
					<div class="md-form input-group col-6">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
						</div>
						
						<input type="text" name="publish_date" class="form-control" value="{{ \Carbon\Carbon::now()->format('F jS\\, Y') }}" disabled />
						
						<div class="input-group-append">
							<span class="input-group-text">Publish Date</span>
						</div>
					</div>
					
					<div class="col-6 d-flex flex-column align-items-center justify-content-center">
						<h4 class="h4-responsive text-center">Publish</h4>
						
						<div class="btn-group">
							<button type="button" class="btn publishBtn{{ $article->publish == 'Y' ? ' btn-success active' : ' grey' }}">
								<input type="checkbox" name="publish" value="Y" hidden{{ $article->publish == 'Y' ? ' checked' : '' }} />Yes
							</button>
							<button type="button" class="btn publishBtn{{ $article->publish == 'N' ? ' btn-danger active' : ' grey' }}">
								<input type="checkbox" name="publish" value="N" hidden{{ $article->publish == 'N' ? ' checked' : '' }} />No
							</button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-10 mt-4 mx-auto">
				<button class="btn btn-success mx-0" type="submit">Update Article</button>
			</div>
			<div class="col-12 col-md-10 mb-4 mx-auto">
				<button class="btn btn-danger mx-0" type="button" data-toggle="modal" data-target="#modalConfirmDelete">Delete Article</button>
			</div>
		</div>
	{!! Form::close() !!}
	
	<!-- Delete confirmation modal -->
	<div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
            <!--Content-->
            <div class="modal-content text-center">
                <!--Header-->
                <div class="modal-header d-flex justify-content-center">
                    <p class="heading">Are you sure?</p>
                </div>

                <!--Body-->
                <div class="modal-body">
                    <i class="fa fa-times fa-4x animated rotateIn"></i>
                </div>

                <!--Footer-->
                <div class="modal-footer flex-center">
					{!! Form::open(['action' => ['NewsController@destroy', 'news' => $article->id], 'method' => 'DELETE']) !!}
						<button type="submit" class="btn btn-outline-danger">Yes</button>
                   
						<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">No</button>
					{!! Form::close() !!}
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
</div>
@endsection
