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
			<h2 class="col-4 font-weight-bold h2-responsive text-underline">Player Videos</h2>

			@if($videos->count() > 0)
				<div class="col-8 coolText4">
					<h3 class="h3-responsive">Total Videos: {{ $videos->count() }}</h3>
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

							@foreach($videos as $video)

								<tr>
									<td></td>
									<td>{{ $video->name }}</td>
									<td>{{ $video->nickname }}</td>
									<td>{{ $video->commish }}</td>
									<td>{{ $video->address }}</td>
									<td>{{ $video->leagues_email }}</td>
									<td><a class="blue-text" href="{{ $video->leagues_website }}">Click Here</a></td>
									<td>{{ $video->phone }}</td>
									<td>{{ $video->ref_fee }}</td>
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
					<h3 class="h3-responsive">There aren't any player videsos at this time.</h3>
				</div>
			@endif
		</div>
		<!--Grid row-->

	</section>
	<!--Section: Messages-->

</div>
@endsection
