@extends('layouts.app')

@section('additional_scripts')
	<script type="text/javascript">
		$('nav.navbar').addClass('fixed-top scrolling-navbar');
	</script>
@endsection

@section('content')
	<div class="container-fluid">
		<div class="row welcomeVideo">
			<div class="col">
				<div class="jumbotron">
					<video loop="true" autoplay="true" muted="true">
						<source src="/videos/ChosenLeague.mp4" type="video/mp4">
					</video>
				</div>
			</div>
		</div>
		<div class="searches row py-5">
			<div class="searchesHeader col-12">
				<h2 class="coolText4 h2-responsive mx-2 p-4 rgba-stylish-strong text-center white-text">Check Out the Leagues and Rec Centers Around the City</h2>
			</div>
			
			<!-- City Leagues Section -->
			<div class="col-12 col-md mb-4" id="leagues_list_div">
				<div class="card">
					<div class="card-body">
						<div class="table-wrapper-2">
							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<th class="search_list_header"><a class="search_list_link text-center d-block coolText1 display-4 white-text" href="{{ route('leagues.index') }}">City Leagues</a></th>
									</tr>
								</thead>
								<tbody>
									@if(empty($getLeagues))
										<tr class="noLeaguesRow"><td>No Leagues Have Been Added Yet. Click <a class="noLeaguesLink" href="register.php?league_reg=true">here</a> to add your league.</td></tr>
									@else
										@foreach($getLeagues as $league)
											<tr class="{{ str_ireplace('', '_', $league->name) }}">
												<td class="text-center">
													<a href="{{ route('league.index', ['league' => str_ireplace(" ", "", strtolower($league->name))]) }}" class="quick_league">{{ ucwords(strtolower($league->name)) }}</a>
												</td>
											</tr>
										@endforeach
									@endif
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- /City Leagues Section -->
			
			<!-- City Rec Centers Section -->
			<div class="col-12 col-md mb-4" id="recs_list_div">
				<div class="card">
					<div class="card-body">
						<div class="table-wrapper-2">
							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<th class="search_list_header"><a class="search_list_link text-center d-block coolText1 display-4 white-text" id="recs_link" href="recs.php">Rec Centers</a></th>
									</tr>
								</thead>
								<tbody>
									@foreach($getRecs as $showRec)
										<tr>
											<td class="text-center{{ in_array(str_ireplace(' ', '_', $showRec->recs_name), $fireRecs) ? ' d-flex align-items-center justify-content-between' : '' }}">
												@if(in_array(str_ireplace(" ", "_", $showRec->name), $fireRecs))
													<span><img src="/images/fire.png" class="fireIcon1" /></span>
												@endif
												
												<a href="{{ route('rec_centers.show', ['rec_center' => $showRec->id]) }}" class="quick_rec">{{ $showRec->name }}</a>
												
												@if(in_array(str_ireplace(" ", "_", $showRec->name), $fireRecs))
													<span><img src="/images/fire.png" class="fireIcon2" /></span>
												@endif
												
												<div class="recDiv">
													<div class="recDivHeader">
														<h2 class="">{{ $showRec->recs_name }}<span>{{ $showRec->nickname != "" ? $showRec->nickname : "" }}<span></h2>
													</div>
												</div>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>	
						</div>
					</div>
				</div>
			</div>
			<!-- /City Rec Centers Section -->
		</div>
		
		<!-- Social Media Section -->
		<div class="socialMedia py-4 mb-5" id="twitterFeed">
			<div class="text-center">
				<h2 class="coolText1 display-3 twitterHeader">Tweetted</h2>
				<h4 class="">Join the conversation #sixers, #phillyhoops, #totherec</h4>
			</div>
			
			<div class="d-flex flex-column flex-md-row align-items-center justify-content-around text-center">
				<div class="feed col-12 col-md-4">
					<a class="twitter-timeline"  href="https://twitter.com/hashtag/Phillyhoops" data-widget-id="784071520561881088">#Phillyhoops Tweets</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				</div>
				<div class="feed col-12 col-md-4">
					<a class="twitter-timeline"  href="https://twitter.com/hashtag/sixers" data-widget-id="784069581954551808">#sixers Tweets</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				</div>
				<div class="feed col-12 col-md-4">
					<a class="twitter-timeline"  href="https://twitter.com/hashtag/ToTheRec" data-widget-id="784071799776616448">#ToTheRec Tweets</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				</div>
			</div>
		</div>
		<!-- /Social Media Section -->
	</div>
@endsection