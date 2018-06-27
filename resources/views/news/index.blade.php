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
		<h3 class="text-center font-weight-bold h3 pb-5 pt-3">Recent posts</h3>

		<!--Grid row-->
		<div class="row">
			@foreach($articles as $article)
				<!--Grid column-->
				<div class="col-lg-4 col-md-12 mb-4">

					<!--Card Light-->
					<div class="card">
						<!--Card image-->
						<div class="view overlay">
							<img  class="card-img-top" src="https://mdbootstrap.com/img/Photos/Lightbox/Original/img%20%28147%29.jpg" alt="">
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
			
		</div>
		<!--Grid row-->

	</section>
	<!--Section: Blog v.2-->

</div>
@endsection
