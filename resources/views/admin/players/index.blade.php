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
			<h2 class="col-4 font-weight-bold h2-responsive text-underline">Players</h2>

			@if($allPlayers->count() > 0)
				<div class="col-8 coolText4">
					<h3 class="h3-responsive">Total Players: {{ $allPlayers->count() }}</h3>
				</div>

				<div class="col-12" id="">
					<table class="table table-striped table-responsive-md btn-table white-text">

						<thead>
							<tr>
								<th></th>
								<th>Created Date</th>
								<th>Name</th>
								<th>Username</th>
								<th>Email</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>

						<tbody>

							@foreach($allPlayers as $player)

								@php

									if($player->image != null) {

										if(!file_exists(str_ireplace('public', 'storage', $player->image->path))) {

											$player->image->path = $defaultImg;
										}
									}

								@endphp

								<tr>
									<td>
										<div id="mdb-lightbox-ui"></div>

										<div class="mdb-lightbox no-margin">

											<figure class="">
												<!--Large image-->
												<a href="{{ $player->image != null ? $player->image->path : $defaultImg }}" data-size="{{ $player->image != null ? '1700x' . $player->image->lg_height : '350x350' }}">
													<!-- Thumbnail-->
													<img src="{{ $player->image != null ? $player->image->path : $defaultImg }}" class="img-fluid z-depth-1 rounded-circle" style="max-height: 150px;">
												</a>
											</figure>
										</div>
									</td>
									<td>{{ $player->created_at->format('m/d/Y') }}</td>
									<td>{{ $player->full_name() }}</td>
									<td>{{ $player->user->username }}</td>
									<td>{{ $player->user->email }}</td>
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
