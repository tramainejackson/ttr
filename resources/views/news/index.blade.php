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

	<!--Section: Blog v.2-->
	<section class="extra-margins pb-3 wow fadeIn" data-wow-delay="0.3s">
		
		<div class="search_box container mx-auto rgba-black-strong pt-1 pb-3 rounded z-depth-2">
			{!! Form::open(['action' => ['NewsController@search'], 'method' => 'POST']) !!}
				 <div class="md-form input-group">
					<span class="input-group-btn">
						<a href="{{ route('news.index') }}" class="btn btn-outline-success waves-effect my-0 addFilter" type="button">All!</a>
					</span>
					
					<input id="news_search" class="newsSearch form-control added-padding-2 white-text" type="search" name="search" placeholder="Search News Article" value="{{ isset($searchCriteria) ? $searchCriteria : '' }}" />
					
					<span class="input-group-btn">
						<button class="btn btn-outline-warning waves-effect my-0" type="submit">Go!</button>
					</span>
				</div>
			{!! Form::close() !!}
		</div>
		
		<!--Grid row-->
		<div class="row">
			@if($articles->count() > 0)
				<!--Section heading-->
				<h3 class="col-12 text-center font-weight-bold h3 pb-5 pt-3 white-text">Recent posts</h3>

				@foreach($articles as $article)
					<!--Grid column-->
					<div class="col-lg-4 col-md-12 mb-4">

						<!--Card Light-->
						<div class="card">
							<!--Card image-->
							<div class="view overlay">
								<img  class="card-img-top" src="{{ $article->picture !== null ? asset(str_ireplace('public/images', 'storage/images/lg', $article->picture)) : $defaultImg }}" alt="">
								<a>
									<div class="mask rgba-white-slight"></div>
								</a>
							</div>
							<!--/.Card image-->
							<!--Card content-->
							<div class="card-body">
								<!--Social shares button-->
								<a class="activator p-3 mr-2"><i class="fa fa-share-alt"></i></a>
								
								<!--Title-->
								<h4 class="card-title">{{ str_limit($article->title, 50) }}</h4>
								<hr>
								
								<!--Text-->
								<p class="card-text">{{ str_limit($article->article, 125) }}</p>
								
								<a href="{{ route('news.show', ['news' => $article->id]) }}" class="link-text"><h5>Read more <i class="fa fa-chevron-right"></i></h5></a>
							</div>
							<!--/.Card content-->
						</div>
						<!--/.Card Light-->

					</div>
					<!--Grid column-->
				
				@endforeach
			@else
				@isset($searchCriteria)
					<div class="col-12">
						<h2 class="white-text text-center">0 Results Found</h2>
					</div>
				@endisset
			
				<div class="col text-center my-4 white-text coolText4">
					<h1 class="h1-responsive">There aren't any post at this time.</h1>
					<h3 class="h3-responsive">We are currently looking for journalist who love the game of basketball and who follows the sport for all ages to write articles. If this sounds like something you're interest in, please reach out to us.</h3>
				</div>
			@endif
		</div>
		<!--Grid row-->

	</section>
	<!--Section: Blog v.2-->

</div>
@endsection
