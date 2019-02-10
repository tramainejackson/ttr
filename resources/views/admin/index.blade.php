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

	<!--Section: Messages-->
	<section class="extra-margins pb-3 wow fadeIn" data-wow-delay="0.3s">

		<!--Grid row-->
		<div class="row">
			<!--Section heading-->
			<h3 class="col-12 text-center font-weight-bold h3 pb-5 pt-3 white-text">Messages</h3>

		@if($messages->count() > 0)

			@foreach($messages as $message)
				<!--Grid column-->
					<div class="col-lg-4 col-md-12 mb-4">

						<!--Card Light-->
						<div class="card">
							<!--Card image-->
							<div class="view overlay">
								<img  class="card-img-top" src="" alt="">
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
								<h4 class="card-title">{{ str_limit($message->title, 50) }}</h4>
								<hr>

								<!--Text-->
								<p class="card-text">{{ str_limit($message->article, 125) }}</p>

								<a href="{{ route('news.show', ['news' => $message->id]) }}" class="link-text"><h5>Read more <i class="fa fa-chevron-right"></i></h5></a>
							</div>
							<!--/.Card content-->
						</div>
						<!--/.Card Light-->

					</div>
					<!--Grid column-->

				@endforeach
			@else
				<div class="col text-center my-4 white-text coolText4">
					<h1 class="h1-responsive">There aren't any messages at this time.</h1>
				</div>
			@endif
		</div>
		<!--Grid row-->

	</section>
	<!--Section: Messages-->

	<!--Section: Players-->
	<section class="extra-margins pb-3 wow fadeIn" data-wow-delay="0.3s">
		
		<!--Grid row-->
		<div class="row">
			<!--Section heading-->
			<h3 class="col-12 text-center font-weight-bold h3 pb-5 pt-3 white-text">Players</h3>

			@if($players->count() > 0)

				@foreach($players as $player)
					<!--Grid column-->
					<div class="col-lg-4 col-md-12 mb-4">

						<!--Card Light-->
						<div class="card">
							<!--Card image-->
							<div class="view overlay">
								<img  class="card-img-top" src="" alt="">
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
								<h4 class="card-title">{{ str_limit($player->title, 50) }}</h4>
								<hr>
								
								<!--Text-->
								<p class="card-text">{{ str_limit($player->article, 125) }}</p>
								
								<a href="{{ route('news.show', ['news' => $player->id]) }}" class="link-text"><h5>Read more <i class="fa fa-chevron-right"></i></h5></a>
							</div>
							<!--/.Card content-->
						</div>
						<!--/.Card Light-->

					</div>
					<!--Grid column-->
				
				@endforeach
			@else
				<div class="col text-center my-4 white-text coolText4">
					<h1 class="h1-responsive">There aren't players at this time.</h1>
				</div>
			@endif
		</div>
		<!--Grid row-->

	</section>
	<!--Section: Players-->

	<!--Section: Videos-->
	<section class="extra-margins pb-3 wow fadeIn" data-wow-delay="0.3s">

		<!--Grid row-->
		<div class="row">
			<!--Section heading-->
			<h3 class="col-12 text-center font-weight-bold h3 pb-5 pt-3 white-text">Player Videos</h3>

		@if($videos->count() > 0)

			@foreach($videos as $video)
				<!--Grid column-->
					<div class="col-lg-4 col-md-12 mb-4">

						<!--Card Light-->
						<div class="card">
							<!--Card image-->
							<div class="view overlay">
								<img  class="card-img-top" src="" alt="">
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
								<h4 class="card-title">{{ str_limit($video->title, 50) }}</h4>
								<hr>

								<!--Text-->
								<p class="card-text">{{ str_limit($video->article, 125) }}</p>

								<a href="{{ route('news.show', ['news' => $video->id]) }}" class="link-text"><h5>Read more <i class="fa fa-chevron-right"></i></h5></a>
							</div>
							<!--/.Card content-->
						</div>
						<!--/.Card Light-->

					</div>
					<!--Grid column-->

				@endforeach
			@else
				<div class="col text-center my-4 white-text coolText4">
					<h1 class="h1-responsive">There aren't any player videos at this time.</h1>
				</div>
			@endif
		</div>
		<!--Grid row-->

	</section>
	<!--Section: Videos-->

	<!--Section: Leagues-->
	<section class="extra-margins pb-3 wow fadeIn" data-wow-delay="0.3s">

		<!--Grid row-->
		<div class="row">
			<!--Section heading-->
			<h3 class="col-12 text-center font-weight-bold h3 pb-5 pt-3 white-text">City Leagues</h3>

		@if($leagues->count() > 0)

			@foreach($leagues as $league)
				<!--Grid column-->
					<div class="col-lg-4 col-md-12 mb-4">

						<!--Card Light-->
						<div class="card">
							<!--Card image-->
							<div class="view overlay">
								<img  class="card-img-top" src="" alt="">
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
								<h4 class="card-title">{{ str_limit($league->title, 50) }}</h4>
								<hr>

								<!--Text-->
								<p class="card-text">{{ str_limit($league->article, 125) }}</p>

								<a href="{{ route('news.show', ['news' => $league->id]) }}" class="link-text"><h5>Read more <i class="fa fa-chevron-right"></i></h5></a>
							</div>
							<!--/.Card content-->
						</div>
						<!--/.Card Light-->

					</div>
					<!--Grid column-->

				@endforeach
			@else
				<div class="col text-center my-4 white-text coolText4">
					<h1 class="h1-responsive">There aren't any city leagues at this time.</h1>
				</div>
			@endif
		</div>
		<!--Grid row-->

	</section>
	<!--Section: Leagues-->

	<!--Section: Rec Centers-->
	<section class="extra-margins pb-3 wow fadeIn" data-wow-delay="0.3s">

		<!--Grid row-->
		<div class="row">
			<!--Section heading-->
			<h3 class="col-12 text-center font-weight-bold h3 pb-5 pt-3 white-text">Rec Centers</h3>

		@if($recs->count() > 0)

			@foreach($recs as $rec)
				<!--Grid column-->
					<div class="col-lg-4 col-md-12 mb-4">

						<!--Card Light-->
						<div class="card">
							<!--Card image-->
							<div class="view overlay">
								<img  class="card-img-top" src="" alt="">
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
								<h4 class="card-title">{{ str_limit($rec->title, 50) }}</h4>
								<hr>

								<!--Text-->
								<p class="card-text">{{ str_limit($rec->article, 125) }}</p>

								<a href="{{ route('news.show', ['news' => $rec->id]) }}" class="link-text"><h5>Read more <i class="fa fa-chevron-right"></i></h5></a>
							</div>
							<!--/.Card content-->
						</div>
						<!--/.Card Light-->

					</div>
					<!--Grid column-->

				@endforeach
			@else
				<div class="col text-center my-4 white-text coolText4">
					<h1 class="h1-responsive">There aren't any rec centers at this time.</h1>
				</div>
			@endif
		</div>
		<!--Grid row-->

	</section>
	<!--Section: Rec Centers-->

	<!--Section: Writers-->
	<section class="extra-margins pb-3 wow fadeIn" data-wow-delay="0.3s">

		<!--Grid row-->
		<div class="row">
			<!--Section heading-->
			<h3 class="col-12 text-center font-weight-bold h3 pb-5 pt-3 white-text">Writers</h3>

		@if($writers->count() > 0)

			@foreach($writers as $writer)
				<!--Grid column-->
					<div class="col-lg-4 col-md-12 mb-4">

						<!--Card Light-->
						<div class="card">
							<!--Card image-->
							<div class="view overlay">
								<img  class="card-img-top" src="" alt="">
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
								<h4 class="card-title">{{ str_limit($writer->title, 50) }}</h4>
								<hr>

								<!--Text-->
								<p class="card-text">{{ str_limit($writer->article, 125) }}</p>

								<a href="{{ route('news.show', ['news' => $writer->id]) }}" class="link-text"><h5>Read more <i class="fa fa-chevron-right"></i></h5></a>
							</div>
							<!--/.Card content-->
						</div>
						<!--/.Card Light-->

					</div>
					<!--Grid column-->

				@endforeach
			@else
				<div class="col text-center my-4 white-text coolText4">
					<h1 class="h1-responsive">There aren't any writers at this time.</h1>
				</div>
			@endif
		</div>
		<!--Grid row-->

	</section>
	<!--Section: Writers-->

	<!--Section: New Articles-->
	<section class="extra-margins pb-3 wow fadeIn" data-wow-delay="0.3s">

		<!--Grid row-->
		<div class="row">
			<!--Section heading-->
			<h3 class="col-12 text-center font-weight-bold h3 pb-5 pt-3 white-text">News Articles</h3>

			@if($articles->count() > 0)

				@foreach($articles as $article)
				<!--Grid column-->
					<div class="col-lg-4 col-md-12 mb-4">

						<!--Card Light-->
						<div class="card">
							<!--Card image-->
							<div class="view overlay">
								<img  class="card-img-top" src="" alt="">
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
				<div class="col text-center my-4 white-text coolText4">
					<h1 class="h1-responsive">There aren't any news articles at this time.</h1>
				</div>
			@endif
		</div>
		<!--Grid row-->

	</section>
	<!--Section: New Articles-->

	<!--Section: Settings-->
	<!--Section: Settings-->

</div>
@endsection
