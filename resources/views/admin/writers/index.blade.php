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
			<h2 class="col-4 font-weight-bold h2-responsive text-underline">Writers</h2>

			@if($writers->count() > 0)
				<div class="col-8 coolText4">
					<h3 class="h3-responsive">Total Writers: {{ $writers->count() }}</h3>
				</div>

				<div class="col-12" id="">
					<table class="table table-striped table-responsive-md btn-table white-text">

						<thead>
							<tr>
								<th></th>
								<th>Name</th>
								<th>Username</th>
								<th>Email</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>

						<tbody>

							@foreach($writers as $writer)

								@php

									if($writer->image != null) {

										if(!file_exists(str_ireplace('public', 'storage', $writer->image->path))) {

											$writer->image->path = $defaultImg;
										}
									}

								@endphp

								<tr>
									<td>
										<div id="mdb-lightbox-ui"></div>

										<div class="mdb-lightbox no-margin">

											<figure class="">
												<!--Large image-->
												<a href="{{ $writer->picture != null ? $writer->picture : $defaultImg }}" data-size="{{ $writer->picture != null ? '1700x1080' : '350x350' }}">
													<!-- Thumbnail-->
													<img src="{{ $writer->picture != null ? $writer->picture : $defaultImg }}" class="img-fluid z-depth-1 rounded-circle" style="max-height: 150px;">
												</a>
											</figure>
										</div>
									</td>
									<td>{{ $writer->full_name() }}</td>
									<td>{{ $writer->user->username }}</td>
									<td>{{ $writer->user->email }}</td>
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
					<h3 class="h3-responsive">There aren't any players at this time.</h3>
				</div>
			@endif
		</div>
		<!--Grid row-->

	</section>
	<!--Section: Messages-->

</div>
@endsection
