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
	<div class="container" id="">
		<div class="row my-3">
			<div class="col text-right">
				<button class="btn btn-primary">Total Articles <span class="white rounded-circle px-1 text-dark">{{ $totalArticles }}</span></button>
			</div>
			<div class="col">
				<button class="btn btn-primary">Published Articles <span class="white rounded-circle px-1 text-dark">{{ $publishedArticles }}</span></button>
			</div>
		</div>
		
		@if($writer->post()->unpublished()->count() > 0)
			<div class="row">
				<!-- All unpublished articles -->
				<div class="col-12 coolText4">
					<h1 class="p-1 text-center yellow lighten-3 rounded z-depth-3"><i class="fa fa-exclamation-triangle orange-text" aria-hidden="true"></i>&nbsp;You have unpublished articles &nbsp;<i class="fa fa-exclamation-triangle orange-text" aria-hidden="true"></i></h1>
				</div>
				
				@foreach($writer->post()->unpublished() as $article)
				
					<!--Grid column-->
					<div class="col-lg-4 col-md-12 mb-4">

						<!--Card Light-->
						<div class="card">
							<!--Card image-->
							<div class="view overlay">
								<img  class="card-img-top img-fluid" src="{{ $article->picture !== null ? asset(str_ireplace('public/images', 'storage/images/lg', $article->picture)) : $defaultImg }}" alt="">
								<a>
									<div class="mask rgba-white-slight"></div>
								</a>
							</div>
							<!--/.Card image-->
							<!--Card content-->
							<div class="card-body">
								<!--Title-->
								<h4 class="card-title">{{ $article->title }}</h4>
								<hr>
								<!--Text-->
								<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
								<a href="{{ route('news.edit', ['news' => $article->id]) }}" class="link-text"><h5>Edit <i class="fa fa-chevron-right"></i></h5></a>
							</div>
							<!--/.Card content-->
						</div>
						<!--/.Card Light-->

					</div>
					<!--Grid column-->
				@endforeach
				<!--./All unpublished articles-->
			</div>
			
			<hr/>
		@endif
			
		@if($writer->post()->published()->count() > 0)
			<div class="row">
				<!-- All published articles -->
				@if($writer->post()->unpublished()->count() > 0)
					<div class="col-12 coolText4">
						<h1 class="p-1 text-center white rounded z-depth-3">Published Articles</h1>
					</div>
				@endif
				
				@foreach($writer->post()->published() as $article)
					<!--Grid column-->
					<div class="col-lg-4 col-md-12 mb-4">

						<!--Card Light-->
						<div class="card">
							<!--Card image-->
							<div class="view overlay">
								<img  class="card-img-top img-fluid" src="{{ $article->picture !== null ? asset(str_ireplace('public/images', 'storage/images/lg', $article->picture)) : $defaultImg }}" alt="">
								<a>
									<div class="mask rgba-white-slight"></div>
								</a>
							</div>
							<!--/.Card image-->
							<!--Card content-->
							<div class="card-body">
								<!--Title-->
								<h4 class="card-title">{{ $article->title }} - <span class="text-muted">{{ $article->publish_date() }}</span></h4>
								<hr>
								<!--Text-->
								<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
								<a href="{{ route('news.edit', ['news' => $article->id]) }}" class="link-text"><h5>Edit <i class="fa fa-chevron-right"></i></h5></a>
							</div>
							<!--/.Card content-->
						</div>
						<!--/.Card Light-->

					</div>
					<!--Grid column-->
					
				@endforeach
				<!--./All published articles-->
			</div>
		@endif
	</div>
@endsection
