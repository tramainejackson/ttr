@extends('layouts.app')

@section('addt_style')
	<style>
		#app {
			background: linear-gradient(rgba(0, 0, 0, 0.35), rgba(0, 0, 0, 0.35)), url("../images/Basketball-Wallpapers-HD-Pictures2.jpg");
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
		<div class="recsPageContainer">
			<div class="">
				<h2 id="rec_page_header" class="page_header">Philly Rec Centers</h2>
			</div>
			<div class="search_box container mx-auto">
				{!! Form::open(['action' => ['RecCenterController@search'], 'method' => 'POST']) !!}
					 <div class="md-form input-group">
						<span class="input-group-btn">
							<a href="{{ route('rec_centers.index') }}" class="btn btn-outline-success waves-effect my-0" type="button">All!</a>
						</span>
						
						<input id="rec_search" class="form-control added-padding-2 white-text" type="search" name="search" placeholder="Search Rec Centers" />
						
						<span class="input-group-btn">
							<button class="btn btn-outline-warning waves-effect my-0" type="submit">Go!</button>
						</span>
					</div>
				{!! Form::close() !!}
			</div>
			
			@if(!request()->query('search'))
				<!--Carousel Wrapper-->
				<div id="multi-item-example" class="carousel slide carousel-multi-item" data-ride="carousel">

					<!--Controls-->
					<div class="controls-top">
						<a class="btn-floating" href="#multi-item-example" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
						<a class="btn-floating" href="#multi-item-example" data-slide="next"><i class="fa fa-chevron-right"></i></a>
					</div>
					<!--/.Controls-->

					<!--Indicators-->
					<ol class="carousel-indicators">
						@for($x=0; $x < count($getRecs); $x+=3)
							<li data-target="#multi-item-example" data-slide-to="{{$x/3}}" class="{{ $x == 0 ? ' active' : '' }}"></li>
						@endfor
					</ol>
					<!--/.Indicators-->

					<!--Slides-->
					<div class="carousel-inner" role="listbox">
						<!--First slide-->
						@for($x=0; $x < count($getRecs); $x+=3)
							<div class="carousel-item{{ $x == 0 ? ' active' : '' }}">
								@isset($getRecs[$x])	
									<div class="col-md-4">
										<div class="card mb-2">
											<div class="view gradient-card-header blue-gradient py-5">
												@if($getRecs[$x]->name != "")
													@if($getRecs[$x]->nickname != "")
														<h1 id="{{ strtolower(str_ireplace(" ", "", $getRecs[$x]->name)) }}" class="recs_header white-text h1-responsive" title="{{ $getRecs[$x]->name }}"><b>"{{ $getRecs[$x]->nickname }}"</b>&nbsp;{{ $getRecs[$x]->name }}</h1>
													@else
														<h1 id="{{ strtolower(str_ireplace(" ", "", $getRecs[$x]->name)) }}" class="recs_header white-text h1-responsive" title="{{ $getRecs[$x]->name }}">{{ $getRecs[$x]->name }}</h1>
													@endif
												@endif
											</div>
											<div class="card-body">
												<div class="recsPage">
													<ul class="recsPageList">
														<li>
															<span class="listLabel">Rec Advisor:</span>
															<span class="listContent" title="{{ $getRecs[$x]->recs_owner }}">{{ $getRecs[$x]->owner != "" ? $getRecs[$x]->owner : "None Available" }}</span>
														</li>
														<li>
															<span class="listLabel">Address:</span>
															<span class="listContent" title="{{ $getRecs[$x]->address }}">{{ $getRecs[$x]->address != "" ? $getRecs[$x]->address : "None Available" }}</span>
														</li>
														<li>
															<span class="listLabel">Website:</span>
															<span class="listContent" title="{{ $getRecs[$x]->website }}">{{ $getRecs[$x]->website != "" ? $getRecs[$x]->website : "None Available" }}</span>
														</li>
														<li>
															<span class="listLabel">Indoor Gym:</span>
															<span class="listContent" title="">{{ $getRecs[$x]->indoor == 1 ? "Yes" : "No" }}</span>
														</li>
														<li>
															<span class="listLabel">Blacktop:</span>
															<span class="listContent" title="">{{ $getRecs[$x]->outdoor == 1 ? "Yes" : "No" }}</span>
														</li>
														<li>
															<span class="listLabel">Cost:</span>
															<span class="listContent" title="">{{ $getRecs[$x]->fee != "" ? "Yes" : "No" }}</span>
														</li>
														<li>
															<span class="listLabel">More Info:</span>
															<span class="listContent" title="{{ $getRecs[$x]->recs_phone }}">{{ $getRecs[$x]->recs_phone }}</span>
														</li>
													</ul>
													@if(in_array(str_ireplace(" ", "_", $getRecs[$x]->recs_name), $fireRecs))
														<span><img src="images/fire.png" class="fireIcon2" /></span>
													@endif
												</div>

											</div>
										</div>
									</div>
								@endisset
								
								@isset($getRecs[$x+1])
									<div class="col-md-4">
										<div class="card mb-2">
											<div class="view gradient-card-header blue-gradient py-5">
												@if($getRecs[$x+1]->name != "")
													@if($getRecs[$x+1]->nickname != "")
														<h1 id="{{ strtolower(str_ireplace(" ", "", $getRecs[$x+1]->name)) }}" class="recs_header white-text h1-responsive" title="{{ $getRecs[$x+1]->name }}"><b>"{{ $getRecs[$x+1]->nickname }}"</b>&nbsp;{{ $getRecs[$x+1]->name }}</h1>
													@else
														<h1 id="{{ strtolower(str_ireplace(" ", "", $getRecs[$x+1]->name)) }}" class="recs_header white-text h1-responsive" title="{{ $getRecs[$x+1]->name }}">{{ $getRecs[$x+1]->name }}</h1>
													@endif
												@endif
											</div>
											<div class="card-body">
												<div class="recsPage">
													<ul class="recsPageList">
														<li>
															<span class="listLabel">Rec Advisor:</span>
															<span class="listContent" title="{{ $getRecs[$x+1]->recs_owner }}">{{ $getRecs[$x+1]->owner != "" ? $getRecs[$x+1]->owner : "None Available" }}</span>
														</li>
														<li>
															<span class="listLabel">Address:</span>
															<span class="listContent" title="{{ $getRecs[$x+1]->address }}">{{ $getRecs[$x+1]->address != "" ? $getRecs[$x+1]->address : "None Available" }}</span>
														</li>
														<li>
															<span class="listLabel">Website:</span>
															<span class="listContent" title="{{ $getRecs[$x+1]->website }}">{{ $getRecs[$x+1]->website != "" ? $getRecs[$x+1]->website : "None Available" }}</span>
														</li>
														<li>
															<span class="listLabel">Indoor Gym:</span>
															<span class="listContent" title="">{{ $getRecs[$x+1]->indoor == 1 ? "Yes" : "No" }}</span>
														</li>
														<li>
															<span class="listLabel">Blacktop:</span>
															<span class="listContent" title="">{{ $getRecs[$x+1]->outdoor == 1 ? "Yes" : "No" }}</span>
														</li>
														<li>
															<span class="listLabel">Cost:</span>
															<span class="listContent" title="">{{ $getRecs[$x+1]->fee != "" ? "Yes" : "No" }}</span>
														</li>
														<li>
															<span class="listLabel">More Info:</span>
															<span class="listContent" title="{{ $getRecs[$x+1]->recs_phone }}">{{ $getRecs[$x+1]->recs_phone }}</span>
														</li>
													</ul>
													@if(in_array(str_ireplace(" ", "_", $getRecs[$x+1]->recs_name), $fireRecs))
														<span><img src="images/fire.png" class="fireIcon2" /></span>
													@endif
												</div>

											</div>
										</div>
									</div>
								@endisset
								
								@isset($getRecs[$x+2])
									<div class="col-md-4">
										<div class="card mb-2">
											<div class="view gradient-card-header blue-gradient py-5">
												@if($getRecs[$x+2]->name != "")
													@if($getRecs[$x+2]->nickname != "")
														<h1 id="{{ strtolower(str_ireplace(" ", "", $getRecs[$x+2]->name)) }}" class="recs_header white-text h1-responsive" title="{{ $getRecs[$x+2]->name }}"><b>"{{ $getRecs[$x+2]->nickname }}"</b>&nbsp;{{ $getRecs[$x+2]->name }}</h1>
													@else
														<h1 id="{{ strtolower(str_ireplace(" ", "", $getRecs[$x+2]->name)) }}" class="recs_header white-text h1-responsive" title="{{ $getRecs[$x+2]->name }}">{{ $getRecs[$x+2]->name }}</h1>
													@endif
												@endif
											</div>
											<div class="card-body">
												<div class="recsPage">
													<ul class="recsPageList">
														<li>
															<span class="listLabel">Rec Advisor:</span>
															<span class="listContent" title="{{ $getRecs[$x+2]->recs_owner }}">{{ $getRecs[$x+2]->owner != "" ? $getRecs[$x+2]->owner : "None Available" }}</span>
														</li>
														<li>
															<span class="listLabel">Address:</span>
															<span class="listContent" title="{{ $getRecs[$x+2]->address }}">{{ $getRecs[$x+2]->address != "" ? $getRecs[$x+2]->address : "None Available" }}</span>
														</li>
														<li>
															<span class="listLabel">Website:</span>
															<span class="listContent" title="{{ $getRecs[$x+2]->website }}">{{ $getRecs[$x+2]->website != "" ? $getRecs[$x+2]->website : "None Available" }}</span>
														</li>
														<li>
															<span class="listLabel">Indoor Gym:</span>
															<span class="listContent" title="">{{ $getRecs[$x+2]->indoor == 1 ? "Yes" : "No" }}</span>
														</li>
														<li>
															<span class="listLabel">Blacktop:</span>
															<span class="listContent" title="">{{ $getRecs[$x+2]->outdoor == 1 ? "Yes" : "No" }}</span>
														</li>
														<li>
															<span class="listLabel">Cost:</span>
															<span class="listContent" title="">{{ $getRecs[$x+2]->fee != "" ? "Yes" : "No" }}</span>
														</li>
														<li>
															<span class="listLabel">More Info:</span>
															<span class="listContent" title="{{ $getRecs[$x+2]->recs_phone }}">{{ $getRecs[$x+2]->recs_phone }}</span>
														</li>
													</ul>
													@if(in_array(str_ireplace(" ", "_", $getRecs[$x+2]->recs_name), $fireRecs))
														<span><img src="images/fire.png" class="fireIcon2" /></span>
													@endif
												</div>

											</div>
										</div>
									</div>
								@endisset
							</div>
						@endfor
						<!--/.First slide-->
					</div>
					<!--/.Slides-->

				</div>
				<!--/.Carousel Wrapper-->
				
				<button id="showAllRecs" class="btn btn-lg mb-4">Show All Rec Centers</button>
				<button id="scroll_to_top"></button>
			@else
				@php $searchResult = 
					App\RecCenter::search(request()->query('search'))->get();
				@endphp
				
				<div class="row white-text text-center">
					<div class="col">
						<h2 class="h2-responsive">{{ $searchResult->count() }} Results Found</h2>
					</div>
				</div>
				<div class="row my-5">
					@foreach($searchResult as $result)
						<div class="col-md-4">
							<div class="card mb-2">
								<div class="view gradient-card-header blue-gradient py-5">
									@if($result->name != "")
										@if($result->nickname != "")
											<h1 id="{{ strtolower(str_ireplace(" ", "", $result->name)) }}" class="recs_header white-text h1-responsive" title="{{ $result->name }}"><b>"{{ $result->nickname }}"</b>&nbsp;{{ $result->name }}</h1>
										@else
											<h1 id="{{ strtolower(str_ireplace(" ", "", $result->name)) }}" class="recs_header white-text h1-responsive" title="{{ $result->name }}">{{ $result->name }}</h1>
										@endif
									@endif
								</div>
								<div class="card-body">
									<div class="recsPage">
										<ul class="recsPageList">
											<li>
												<span class="listLabel">Rec Advisor:</span>
												<span class="listContent" title="{{ $result->recs_owner }}">{{ $result->owner != "" ? $result->owner : "None Available" }}</span>
											</li>
											<li>
												<span class="listLabel">Address:</span>
												<span class="listContent" title="{{ $result->address }}">{{ $result->address != "" ? $result->address : "None Available" }}</span>
											</li>
											<li>
												<span class="listLabel">Website:</span>
												<span class="listContent" title="{{ $result->website }}">{{ $result->website != "" ? $result->website : "None Available" }}</span>
											</li>
											<li>
												<span class="listLabel">Indoor Gym:</span>
												<span class="listContent" title="">{{ $result->indoor == 1 ? "Yes" : "No" }}</span>
											</li>
											<li>
												<span class="listLabel">Blacktop:</span>
												<span class="listContent" title="">{{ $result->outdoor == 1 ? "Yes" : "No" }}</span>
											</li>
											<li>
												<span class="listLabel">Cost:</span>
												<span class="listContent" title="">{{ $result->fee != "" ? "Yes" : "No" }}</span>
											</li>
											<li>
												<span class="listLabel">More Info:</span>
												<span class="listContent" title="{{ $result->recs_phone }}">{{ $result->recs_phone }}</span>
											</li>
										</ul>
										@if(in_array(str_ireplace(" ", "_", $result->recs_name), $fireRecs))
											<span><img src="images/fire.png" class="fireIcon2" /></span>
										@endif
									</div>

								</div>
							</div>
						</div>
					@endforeach
				</div>
			@endif
		</div>
	</div>
@endsection