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
	<section class="pb-3 wow fadeIn white-text" data-wow-delay="0.3s">

		<!--Grid row-->
		<div class="row my-4">
			<!--Section heading-->
			<h2 class="col-4 font-weight-bold h2-responsive text-underline">News Articles</h2>

			@if($articles->count() > 0)
				<div class="col-8 coolText4">
					<h3 class="h3-responsive">Total Articles: {{ $articles->count() }}</h3>
				</div>

				<div class="col-12" id="">
					<table class="table table-striped table-responsive-md btn-table white-text">

						<thead>
							<tr>
								<th></th>
								<th>Name</th>
								<th>Nickname</th>
								<th>Commish</th>
								<th>Address</th>
								<th>Email</th>
								<th>Website</th>
								<th>Phone Number</th>
								<th>Ref Fee</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>

						<tbody>

							@foreach($articles as $article)

								@php

									if($article->picture != null) {

										if(!file_exists(str_ireplace('public', 'storage', $article->picture))) {

											$article->picture = $defaultImg;
										}
									}

								@endphp

								<tr>
									<td>
										<div id="mdb-lightbox-ui"></div>

										<div class="mdb-lightbox no-margin">

											<figure class="">
												<!--Large image-->
												<a href="{{ $article->picture != null ? $article->picture : $defaultImg }}" data-size="{{ $article->picture != null ? '1700x1080' : '350x350' }}">
													<!-- Thumbnail-->
													<img src="{{ $article->picture != null ? $article->picture : $defaultImg }}" class="img-fluid z-depth-1 rounded-circle" style="max-height: 150px;">
												</a>
											</figure>
										</div>
									</td>
									<td>{{ $article->name }}</td>
									<td>{{ $article->nickname }}</td>
									<td>{{ $article->commish }}</td>
									<td>{{ $article->address }}</td>
									<td>{{ $article->leagues_email }}</td>
									<td><a class="blue-text" href="{{ $article->leagues_website }}">Click Here</a></td>
									<td>{{ $article->phone }}</td>
									<td>{{ $article->ref_fee }}</td>
									<td>
										<button type="button" class="btn btn-warning btn-sm m-0">Edit</button>
									</td>
									<td>
										<button type="button" class="btn btn-red btn-sm m-0">Delete</button>
									</td>
								</tr>
							@endforeach

						</tbody>
					</table>
				</div>

			@else
				<div class="col-8 coolText4">
					<h3 class="h3-responsive">There aren't any news artocles at this time.</h3>
				</div>
			@endif
		</div>
		<!--Grid row-->

	</section>
	<!--Section: Messages-->

</div>
@endsection
