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
			<h2 class="col-4 font-weight-bold h2-responsive text-underline">Recreation Centers</h2>

			@if($recs->count() > 0)
				<div class="col-8 coolText4">
					<h3 class="h3-responsive">Total Rec Centers: {{ $recs->count() }}</h3>
				</div>

				<div class="col-12" id="">
					<table class="table table-striped table-responsive-md btn-table white-text">

						<thead>
							<tr>
								<th></th>
								<th>Name</th>
								<th>Nickname</th>
								<th>Owner</th>
								<th>Address</th>
								<th>Website</th>
								<th>Phone Number</th>
								<th>Addt Info</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>

						<tbody>

							@foreach($recs as $rec)

								<tr>
									<td>
										<!-- Thumbnail-->
										<img src="{{ $defaultImg }}" class="img-fluid z-depth-1 rounded-circle" style="max-height: 150px;" />
									</td>
									<td>{{ $rec->name }}</td>
									<td>{{ $rec->nickname }}</td>
									<td>{{ $rec->owner }}</td>
									<td>{{ $rec->address }}</td>
									<td><a class="blue-text" href="{{ $rec->website }}">Click Here</a></td>
									<td>{{ $rec->recs_phone }}</td>
									<td>{{ $rec->additional_info }}</td>
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
