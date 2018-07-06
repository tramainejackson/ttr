@extends('layouts.app')

@section('addt_style')
	<style>
		#app {
			background-color: grey;
		}
		
		.view {
			background-size: 100% 100%;
			background-repeat: no-repeat;
			background-position: center center;
		}
	</style>
@endsection

@section('additional_scripts')
	<script type="text/javascript">
		$('nav.navbar').addClass('fixed-top scrolling-navbar');
	</script>
@endsection

@section('content')
	<div class="view" style="background-image: url({{ asset('/images/blacktop.jpg') }})">
		<div class="mask flex-center">
			<div class="container-fluid pb-5">
				<div class="row px-md-5">
					<div class="col-12 text-center">
						<div class="card">
							<div class="card-body">
								<div class="card-title">
									<h2 class="display-2">{{ $rec_center->name }}</h2>
								</div>
								<div class="">
									<ul class="list-unstyled">
										<li>
											<span class="">Rec Advisor:</span>
											<span class="" title="{{ $rec_center->recs_owner }}">{{ $rec_center->owner != "" ? $rec_center->owner : "None Available" }}</span>
										</li>
										<li>
											<span class="">Address:</span>
											<span class="" title="{{ $rec_center->address }}">{{ $rec_center->address != "" ? $rec_center->address : "None Available" }}</span>
										</li>
										<li>
											<span class="">Indoor Gym:</span>
											<span class="" title="">{{ $rec_center->indoor == 1 ? "Yes" : "No" }}</span>
										</li>
										<li>
											<span class="">Blacktop:</span>
											<span class="" title="">{{ $rec_center->outdoor == 1 ? "Yes" : "No" }}</span>
										</li>
										<li>
											<span class="">Cost:</span>
											<span class="" title="">{{ $rec_center->fee != "" ? "Yes" : "No" }}</span>
										</li>
										<li>
											<span class="">More Info:</span>
											<span class="" title="{{ $rec_center->recs_phone }}">{{ $rec_center->recs_phone }}</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection