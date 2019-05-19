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
			<h2 class="col-4 font-weight-bold h2-responsive text-underline">Messages</h2>

			@if($messages->count() > 0)
				<div class="col-8 coolText4">
					<h3 class="h3-responsive">Total Messages: {{ $messages->count() }}</h3>
				</div>

				<div class="col-12" id="">
					<table class="table table-striped table-responsive-md btn-table white-text">

						<thead>
							<tr>
								<th>Date</th>
								<th>Name</th>
								<th>Email</th>
								<th>Subject</th>
								<th>Message</th>
								<th>Reply</th>
								<th>Delete</th>
							</tr>
						</thead>

						<tbody>

							@foreach($messages as $message)
								<tr>
									<td>{{ $message->created_at->format('m/d/Y') }}</td>
									<td>{{ $message->name }}</td>
									<td>{{ $message->email }}</td>
									<td>{{ $message->subject }}</td>
									<td>{{ $message->message }}</td>
									<td>
										<button type="button" class="btn btn-info btn-sm m-0">Reply</button>
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
					<h3 class="h3-responsive">There aren't any messages at this time.</h3>
				</div>
			@endif
		</div>
		<!--Grid row-->

	</section>
	<!--Section: Messages-->

</div>
@endsection
