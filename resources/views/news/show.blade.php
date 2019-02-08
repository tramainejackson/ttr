@extends('layouts.app')

@section('styles')
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

	<!--Section: Blog v.4-->
	<section class="text-center section-blog-fw mt-5 pb-3 wow fadeIn">

		<!--Grid row-->
		<div class="row">
			<div class="col-md-12">
				<!--Featured image-->
				<div class="card card-cascade wider reverse">
					<div class="view overlay">
						<img class="card-img-top img-fluid" src="{{ $article->picture !== null ? asset(str_ireplace('public/images', 'storage/images/lg', $article->picture)) : $defaultImg }}" alt="Wide sample post image">
						<a>
							<div class=""></div>
						</a>
					</div>

					<!--Post data-->
					<div class="card-body text-center">
						<h2><a><strong>{{ $article->title }}</strong></a></h2>
						<p>Written by {{ $article->writer->full_name() }}</p>
						<p class="text-muted m-0">Published: {{ $article->publish_date() }}</p>
					</div>
					<!--Post data-->
				</div>

				<!--Excerpt-->
				<div class="excerpt mt-5 wow fadeIn white-text" data-wow-delay="0.3s">
					<p>{{ $article->article }}</p>

				</div>
			</div>
		</div>
	   <!--Grid row-->

	</section>
	<!--Section: Blog v.4-->

	<hr class="mb-5 mt-4">

	<!--Section: Blog v.2-->
	<section class="extra-margins pb-3 wow fadeIn" data-wow-delay="0.3s">

		<!--Section heading-->
		<h3 class="text-center white-text font-weight-bold h3 pb-5 pt-3">Other Recent Post</h3>

		<!--Grid row-->
		<div class="row">

			@if($recentPost->count() > 0)
				
				@foreach($recentPost as $post)
				
					<!--Grid column-->
					<div class="col-lg-4 col-md-12 mb-4">

						<!--Card Light-->
						<div class="card">
							<!--Card image-->
							<div class="view overlay">
								<img  class="card-img-top img-fluid" src="{{ $post->picture !== null ? asset(str_ireplace('public/images', 'storage/images/lg', $post->picture)) : $defaultImg }}" alt="">
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
								<h4 class="card-title">{{ $post->title }}</h4>
								<hr>
								<!--Text-->
								<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
								<a href="{{ route('news.show', ['news' => $post->id]) }}" class="link-text"><h5>Read more <i class="fa fa-chevron-right"></i></h5></a>
							</div>
							<!--/.Card content-->
						</div>
						<!--/.Card Light-->

					</div>
					<!--Grid column-->
					
				@endforeach
				
			@else
				<div class="col">
					<h2 class="white-text text-center">This Writer doesn't have any other post within the last month.</h2>
				</div>
			@endif
		</div>
		<!--Grid row-->

	</section>
	<!--Section: Blog v.2-->

	<!--Author box-->
	<section>

		<div class="jumbotron author-box px-5 py-4 text-center text-md-left wow fadeIn" data-wow-delay="0.3s">
			<!--Name-->
			<h4 class="font-weight-bold h4 text-center">About author</h4>
			<hr>
			<div class="row">
				<!--Avatar-->
				<div class="col-12 col-sm-2">
					<img src="{{ $article->writer->picture != null ? asset($article->writer->picture) : $defaultImg}}" class="img-fluid rounded-circle z-depth-2">
				</div>
				<!--Author Data-->
				<div class=" col-12 col-sm-10 text-left">
					<p><strong>{{ $article->writer->full_name() }}</strong></p>
					<div class="personal-sm pb-3">
						@if($article->writer->fb !== null)
							<a href="{{ $article->writer->fb }}" class="pr-2 fb-ic" target="_blank"><i class="fa fa-facebook"></i></a>
						@endif
						
						@if($article->writer->twitter !== null)
							<a href="{{ $article->writer->twitter }}" class="pr-2 tw-ic" target="_blank"><i class="fa fa-twitter"></i></a>
						@endif
						
						@if($article->writer->instagram !== null)
							<a href="{{ $article->writer->instagram }}" class="pr-2 ins-ic" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
						@endif
					</div>
					<p>{{ $article->writer->about }}</p>
				</div>
			</div>
		</div>

	</section>
	<!--/.Author box-->

</div>
@endsection
