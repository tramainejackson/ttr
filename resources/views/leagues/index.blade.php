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
	@include('include.functions')
	
	<div class="container-fluid">
		<div class="search_box container mx-auto">
			{!! Form::open(['action' => ['LeagueProfileController@search'], 'method' => 'POST']) !!}
				 <div class="md-form input-group">
					<span class="input-group-btn">
						<a href="{{ route('leagues.index') }}" class="btn btn-outline-success waves-effect my-0 addFilter" type="button">All!</a>
					</span>
					
					<input id="leagues_search" class="leagueSearch form-control added-padding-2 white-text" type="search" name="search" placeholder="Search Leagues" />
					
					<span class="input-group-btn">
						<button class="btn btn-outline-warning waves-effect my-0" type="submit">Go!</button>
					</span>
				</div>
			{!! Form::close() !!}
		</div>
		
		<div class="row">
			<div class="col text-center white-text d-none d-lg-block">
				<h3 class="h3-responsive">Filter By League Ages</h3>
			</div>
		</div>
		
		<div class="league_type_filter mb-5 d-none d-lg-flex justify-content-around align-items-center">
			<a href="{{ route('leagues.index', ['filter' => '10_and_under']) }}" class="btn{{ request()->query('filter') == '10_and_under' ? ' red lighten-1' : ' blue-grey' }}" type="button">10&nbsp;&nbsp;<i class="fa fa-long-arrow-down" aria-hidden="true"></i></a>
			
			<a href="{{ route('leagues.index', ['filter' => '12_and_under']) }}" class="btn{{ request()->query('filter') == '12_and_under' ? ' red lighten-1' : ' blue-grey' }}" type="button">12&nbsp;&nbsp;<i class="fa fa-long-arrow-down" aria-hidden="true"></i></a>
			
			<a href="{{ route('leagues.index', ['filter' => '14_and_under']) }}" class="btn{{ request()->query('filter') == '14_and_under' ? ' red lighten-1' : ' blue-grey' }}" type="button">14&nbsp;&nbsp;<i class="fa fa-long-arrow-down" aria-hidden="true"></i></a>
			
			<a href="{{ route('leagues.index', ['filter' => '16_and_under']) }}" class="btn{{ request()->query('filter') == '16_and_under' ? ' red lighten-1' : ' blue-grey' }}" type="button">16&nbsp;&nbsp;<i class="fa fa-long-arrow-down" aria-hidden="true"></i></a>
			
			<a href="{{ route('leagues.index', ['filter' => '18_and_under']) }}" class="btn{{ request()->query('filter') == '18_and_under' ? ' red lighten-1' : ' blue-grey' }}" type="button">18&nbsp;&nbsp;<i class="fa fa-long-arrow-down" aria-hidden="true"></i></a>
			
			<a href="{{ route('leagues.index', ['filter' => 'unlimited']) }}" class="btn{{ request()->query('filter') == 'unlimited' ? ' red lighten-1' : ' blue-grey' }}" type="button">Unlimited</a>
			
			<a href="{{ route('leagues.index', ['filter' => '30_and_over']) }}" class="btn{{ request()->query('filter') == '30_and_over' ? ' red lighten-1' : ' blue-grey' }}" type="button">30&nbsp;&nbsp;<i class="fa fa-long-arrow-up" aria-hidden="true"></i></a>
			
			<a href="{{ route('leagues.index', ['filter' => '50_and_over']) }}" class="btn{{ request()->query('filter') == '50_and_over' ? ' red lighten-1' : ' blue-grey' }}" type="button">50&nbsp;&nbsp;<i class="fa fa-long-arrow-up" aria-hidden="true"></i></a>
		</div>
		
		@isset($searchCriteria)
			<div class="col-12">
				<h2 class="white-text text-center"><i class="fa fa-exclamation" aria-hidden="true"></i>&nbsp;Search results for '{{ $searchCriteria }}'&nbsp;<i class="fa fa-exclamation" aria-hidden="true"></i></h2>
			</div>
		@endisset
		
		@if(request()->query('filter'))
			<div class="col-12">
				<h2 class="white-text text-center"><i class="fa fa-exclamation" aria-hidden="true"></i>&nbsp;Showing {{ ucwords(str_ireplace('_', ' ', request()->query('filter'))) }} Leagues&nbsp;<i class="fa fa-exclamation" aria-hidden="true"></i></h2>
			</div>
		@endif
		
		@if($leagues->count() > 0)
			@foreach($leagues as $league)
				<div class="row position-relative my-5 white-text">
					<div class="col-12 col-md-8 mx-auto">
						<div class="card card-image mb-3" style="background-image: url({{ $league->picture != null ? route('sub_photo', ['picture' => $league->picture]) : $defaultImg }});">
							<div class="text-white text-left d-flex flex-column align-items-center rgba-black-strong p-2 p-lg-5">
								<div class="">
									@if($league->seasons()->active()->get()->isNotEmpty())
										@foreach($league->seasons()->active()->get() as $season)
											<a href="{{ route('season.show', ['league' => str_ireplace(" ", "", strtolower($season->league->name)), 'season' => str_ireplace(" ", "", strtolower($season->name))]) }}" class="btn success-color">{{ $season->name }}</a>
										@endforeach
									@endif
								</div>
								
								<div class="mt-3 p-lg-2 rgba-black-light coolText3 rounded z-depth-1-half">
									<h2 class="h2-responsive">League Name: {{ $league->name }}</h2>
									
									<h2 class="h2-responsive">Commission Name: {{ $league->commish }}</h2>
									
									@if($league->address !== null)
										<h2 class="h2-responsive">Address: {{ $league->address }}</h2>
									@endif
									
									@if($league->phone !== null)
										<h2 class="h2-responsive">Phone: {{ $league->phone }}</h2>
									@endif
									
									@if($league->leagues_email !== null)
										<h2 class="h2-responsive">Email: {{ $league->leagues_email }} <button class="btn black white-text" type="button"><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp;Send Email</button></h2>
									@endif
								</div>

								
								<hr/>
								
								<div class="d-flex justify-content-between flex-column flex-xl-row my-4">
									<div class="col-12 col-xl-6">
										<h1 class="h1-responsive">Ages</h1>
										<div class="row">
											@foreach(find_ages() as $age)
												<div class="col-6 my-1">
													<button class="btn btn rounded btn-block{{  str_contains($league->age, $age) ? ' default-color' : ' grey' }}" type="button">{{ str_ireplace('_', ' ', $age) }}</button>
												</div>
											@endforeach
										</div>
									</div>
									
									<div class="col-12 col-xl-6">
										<h1 class="h1-responsive">Competition</h1>
										
										<div class="row">
											@foreach(find_competitions() as $comp)
												<div class="col-6 my-1">
													<button class="btn btn rounded btn-block{{  str_contains($league->comp, $comp) ? ' primary-color' : ' grey' }}" type="button">{{ str_ireplace('_', ' ', $comp) }}</button>
												</div>
											@endforeach
										</div>
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
		@else
			@isset($searchCriteria)
				<div class="col-12">
					<h2 class="white-text text-center">0 Results Found</h2>
				</div>
			@endisset
			
			@if(request()->query('filter'))
				<div class="col-12">
					<h2 class="white-text text-center">0 Results Found</h2>
				</div>
			@endif
		@endif
	</div>
@endsection