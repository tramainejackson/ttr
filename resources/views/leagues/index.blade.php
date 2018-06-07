@extends('layouts.app')

@section('addt_style')
	<style>
		#app {
			background: linear-gradient(rgba(0, 0, 0, 0.35), rgba(0, 0, 0, 0.35)), url(/images/mybackground1.png);
			background-size: 100% 100%;
			background-repeat: no-repeat;
			background-position: 100% 0%;
			background-attachment: fixed;
			z-index: -1;
		}
	</style>
@endsection

@section('content')
	<div class="container-fluid">
		@foreach($leagues as $league)
			<div class="row position-relative my-5 white-text">
				<div class="col-12 col-md-8 mx-auto">
					<div class="card card-image mb-3" style="background-image: url({{ $league->picture != null ? $league->picture : $defaultImg }});">
						<div class="text-white text-center d-flex flex-column align-items-center rgba-black-strong py-5 px-4">
							<div class="">
								<h2 class="h2-responsive">League Name {{ $league->name }}</h2>
								<h2 class="h2-responsive">Commission Name{{ $league->commish }}</h2>
								<h2 class="h2-responsive">League Address{{ $league->address }}</h2>
								<h2 class="h2-responsive">League Phone {{ $league->phone }}</h2>
								<h2 class="h2-responsive">League Email Address{{ $league->leagues_email }} <button class="btn black white-text" type="button"><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp;Send Email</button></h2>
							</div>

							<div class="">
								@if($league->seasons()->active()->get()->isNotEmpty())
									<h2 class="h2-responsive">Active Seasons</h2>
									@foreach($league->seasons()->active()->get() as $season)
										<button class="btn btn-lg success-color" type="button">{{ $season->name }}</button>
									@endforeach
								@else
									<h2 class="h2-responsive">No Active Seasons</h2>
								@endif
							</div>
							
							<div class="d-flex justify-content-between my-4">
								<div class="col">
									<h1 class="">Age Levels</h1>
									<ul class="list-unstyled">
										@foreach($league->ages() as $age)
											<li class="list-inline-item"><button class="btn btn rounded default-color" type="button">{{ str_ireplace('_', ' ', $age) }}</button></li>
										@endforeach
									</ul>
								</div>
								
								<div class="col">
									<h1 class="">Competition Levels</h1>
									<ul class="list-unstyled">
										@foreach($league->comps() as $comp)
											<li class="list-inline-item"><button class="btn btn rounded primary-color" type="button">{{ str_ireplace('_', ' ', $comp) }}</button></li>
										@endforeach
									</ul>
								</div>
							</div>
							
							@if($league->leagues_website != null)
								<a href="{{ $league->leagues_website }}" class="btn btn-lg secondary-color">View Website</a>
							@endif
						</div>
					</div>
				</div>
			</div>
		@endforeach
	</div>
@endsection