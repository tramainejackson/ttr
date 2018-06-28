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

		<!--Section heading-->
		<h3 class="text-center font-weight-bold h3 pb-5 pt-3 white-text">Recent posts</h3>

		<!--Grid row-->
		<div class="row">
			@if($articles->count() > 0)
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
								<h4 class="card-title">{{ $article->title }}</h4>
								<hr>
								<!--Text-->
								<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
								<a href="{{ route('news.show', ['news' => $article->id]) }}" class="link-text"><h5>Read more <i class="fa fa-chevron-right"></i></h5></a>
							</div>
							<!--/.Card content-->
						</div>
						<!--/.Card Light-->

					</div>
					<!--Grid column-->
				
				@endforeach
			@else
				<div class="col text-center my-4">
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
