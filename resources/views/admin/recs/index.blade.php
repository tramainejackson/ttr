@extends('layouts.app')

@section('styles')
	<style>
		#app {
			background: url("/images/Basketball-Wallpapers-HD-Pictures2.jpg");
			background-size: 100% 100%;
			background-repeat: no-repeat;
			background-position: 100% 0%;
			background-attachment: fixed;
			z-index: -1;
		}
	</style>
@endsection

@section('scripts')
	<script type="text/javascript">
        $('nav').addClass('rgba-stylish-strong');
	</script>
@endsection

@section('content')
	<div class="container-fluid rgba-stylish-strong">

		<div class="">
			
			<div class="row playerVideos py-3">
				<div class="col-12">
					<div class="text-center coolText2 white-text">
						<h1 class="indProfileHeader h1-responsive display-2">Recreation Centers</h1>
					</div>
				</div>
			</div>
					
			<!--  Rec Centers -->
			<div class="container-fluid">

				<div class="row">

					@foreach($recs as $rec)

						<div class="col-12 col-md-6 col-xl-3 mb-4 d-flex align-items-stretch justify-content-around">

							<!-- Card -->
							<div class="card card-cascade w-100">

								<!-- Card image -->
								<div class="view view-cascade gradient-card-header blue-gradient">

									<h2 class="card-header-title mb-3">{{ $rec->name }}</h2>

								</div>

								<!-- Card content -->
								<div class="card-body card-body-cascade text-center">

									<!-- Text -->
									<p class="card-text">{{ $rec->name }}</p>
									<p class="card-text">{{ $rec->nickname }}</p>
									<p class="card-text">{{ $rec->owner }}</p>
									<p class="card-text">{{ $rec->address }}</p>
									<p class="card-text">{{ $rec->website }}</p>
									<p class="card-text">{{ $rec->recs_phone }}</p>
									<p class="card-text">{{ $rec->indoor }}</p>
									<p class="card-text">{{ $rec->outdoor }}</p>
									<p class="card-text">{{ $rec->fee }}</p>
									<p class="card-text">{{ $rec->additional_info }}</p>

									<!-- Link -->
									<a href="{{ route('admin.recs.edit', ['rec' => $rec->id]) }}" class="orange-text d-flex flex-row-reverse p-2">
										<h5 class="waves-effect waves-light">Edit<i class="fas fa-angle-double-right ml-2"></i></h5>
									</a>

								</div>

							</div>

						</div>

					@endforeach

				</div>

			</div>
			<!--./ Rec Centers /.-->

		</div>

	</div>
@endsection