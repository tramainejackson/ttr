<?php require_once("../include/initialize.php"); ?>
<?php require_once("../include/header.php"); ?>
<body id="container-fluid">
	<?php include("modal.php"); ?>
	<?php include("menu.php"); ?>
	<?php require_once("../public/about.html"); ?>
	<div id="video_div">
		<video loop="true" autoplay="true" muted="true">
			<source src="../videos/ChosenLeague.mp4" type="video/mp4">
		</video>
	</div>	
	<div class="content">
		<div class="calendars">
			<?php include("2016_calendar.php"); ?>
			<?php include("2017_calendar.php"); ?>			
		</div>
		<div class="searches">
			<div class="searchesBgrd"></div>
			<div class="searchesHeader">
				<h2 class="">Check Out the Leagues and Rec Centers Around the City</h2>
			</div>
			<div class="list">
				<table class="list2">
					<tr>
						<th class="search_list_header"><a class="search_list_link" href="leagues.php">City Leagues</a></th>
					</tr>
					<?php $getLeagues = League_Profile::get_leagues(); ?>					
					<?php if(empty($getLeagues)) { ?>
						<tr class="noLeaguesRow"><td>No Leagues Have Been Added Yet. Click <a class="noLeaguesLink" href="register.php?league_reg=true">here</a> to add your league.</td></tr>
					<?php } else { ?>
						<?php foreach($getLeagues as $league) { ?>
							<tr class="<?php echo str_ireplace(" ", "_", $league->leagues_name); ?>">
								<td>
									<a class="quick_league"><?php echo ucwords(strtolower($league->leagues_name)); ?></a>
									<div class="leagueDiv">
										<div class="leagueDivHeader">
											<h2 class=""><?php echo ucwords($league->leagues_name); ?></h2>
										</div>
										<div class="leagueDivContent">
											<div class="leagueProfile">
												<span class="leagueProfileSub leagueProfileContent">Leagues Owner:</span>
												<span class="leagueProfileInfo leagueProfileContent"><?php echo $league->leagues_commish != "" ? $league->leagues_commish : "Call or See Website For More Info"; ?></span>
											</div>
										</div>
										<div class="leagueDivContent">
											<div class="leagueProfile">
												<span class="leagueProfileSub leagueProfileContent">Address:</span>
												<span class="leagueProfileInfo leagueProfileContent"><?php echo $league->leagues_address != "" ? $league->leagues_address : "Call or See Website For More Info"; ?></span>
											</div>
										</div>
										<div class="leagueDivContent">
											<div class="leagueProfile">
												<span class="leagueProfileSub leagueProfileContent">Phone:</span>
												<span class="leagueProfileInfo leagueProfileContent"><?php echo $league->leagues_phone != "" ? $league->leagues_phone : "Call or See Website For More Info"; ?></span>
											</div>
										</div>
										<div class="leagueDivContent">
											<div class="leagueProfile">
												<span class="leagueProfileSub leagueProfileContent">Email:</span>
												<span class="leagueProfileInfo leagueProfileContent"><?php echo $league->leagues_email != "" ? $league->leagues_email : "Call or See Website For More Info"; ?></span>
											</div>
										</div>
										<?php if($league->leagues_website != "") { ?>
											<div class="leagueDivContent">
												<div class="leagueProfile">
													<span class="leagueProfileSub leagueProfileContent">Website:</span>
													<span class="leagueProfileInfo leagueProfileContent"><?php echo $league->leagues_website != "" ? $league->leagues_website : "Call or See Website For More Info"; ?></span>
												</div>
											</div>
										<?php } ?>
										<div class="leagueDivContent">
											<div class="leagueProfile">
												<span class="leagueProfileSub leagueProfileContent">Competition:</span>
												<span class="leagueProfileInfo leagueProfileContent"><?php echo $league->leagues_comp != "" ? ucwords($league->leagues_comp) : "Call or See Website For More Info"; ?></span>
											</div>
										</div>
										<div class="leagueDivContent">
											<div class="leagueProfile">
												<span class="leagueProfileSub leagueProfileContent">Ages:</span>
												<span class="leagueProfileInfo leagueProfileContent"><?php echo $league->leagues_age != "" ? ucwords(str_ireplace("_", " ", str_ireplace(" ", ", ", $league->leagues_age))) : "Call or See Website For More Info"; ?></span>
											</div>
										</div>
										<div class="leagueDivContent">
											<div class="leagueProfile">
												<span class="leagueProfileSub leagueProfileContent">Entry Fee:</span>
												<span class="leagueProfileInfo leagueProfileContent"><?php echo $league->leagues_fee != "" ? "$".$league->leagues_fee : "Call or See Website For More Info"; ?></span>
											</div>
										</div>
										<div class="leagueDivContent">
											<div class="leagueProfile">
												<span class="leagueProfileSub leagueProfileContent">Referee Fee:</span>
												<span class="leagueProfileInfo leagueProfileContent"><?php echo $league->ref_fee != "" ? "$".$league->ref_fee : "Call or See Website For More Info"; ?></span>
											</div>
										</div>
										<?php if($league->ttr_league_site != "") { ?>
											<div class="leagueDivContent">
												<div class="leagueProfile">
													<span class="leagueProfileSub leagueProfileContent">TTR Site:</span>
													<span class="leagueProfileInfo leagueProfileContent"><?php echo $league->ttr_league_site != "" ? $league->ttr_league_site : "Call or See Website For More Info"; ?></span>
												</div>
											</div>
										<?php } ?>
										<?php if($league->ttr_email != "") { ?>
											<div class="leagueDivContent">
												<div class="leagueProfile">
													<span class="leagueProfileSub leagueProfileContent">TTR Email:</span>
													<span class="leagueProfileInfo leagueProfileContent"><?php echo $league->ttr_email != "" ? $league->ttr_email : "Call or See Website For More Info"; ?></span>
												</div>
											</div>
										<?php } ?>
									</div>	
								</td>
							</tr>
						<?php } ?>
					<?php } ?>
				</table>
			</div>
			<div class="list" id="recs_list_div">
				<table class="list1">
					<tr>
						<th class="search_list_header"><a class="search_list_link" id="recs_link" href="recs.php">Rec Centers</a></th>
					</tr>
					<?php $getRecs = Rec_Center::get_rec_centers(); ?>
					<?php $fireRecs = Player_Profile::get_fire_recs(); ?>
					<?php foreach ($getRecs as $showRec) { ?>
						<tr>
							<td>
								<?php if(in_array(str_ireplace(" ", "_", $showRec->recs_name), $fireRecs)) { ?>
									<span><img src="images/fire.png" class="fireIcon1" /></span>
									<span><img src="images/fire.png" class="fireIcon2" /></span>
								<?php }?>
								<a class="quick_rec"><?php echo $showRec->recs_name; ?></a>
								<div class="recDiv">
									<div class="recDivHeader">
										<h2 class=""><?php echo $showRec->recs_name; ?><span><?php echo $showRec->recs_nickname != "" ? $showRec->recs_nickname : ""; ?><span></h2>
									</div>
									<div class="recDivContent">
										<div class="recProfile">
											<span class="recProfileSub recProfileContent">Rec Owner:</span>
											<span class="recProfileInfo recProfileContent"><?php echo $showRec->recs_owner == "" ? $showRec->recs_owner : "Call or See Website For More Info"; ?></span>
										</div>
										<div class="recProfile">
											<span class="recProfileSub recProfileContent">Address:</span>
											<span class="recProfileInfo recProfileContent"><?php echo $showRec->recs_address == "" ? $showRec->recs_address : "Call or See Website For More Info"; ?></span>
										</div>
										<div class="recProfile">
											<span class="recProfileSub recProfileContent">Phone:</span>
											<span class="recProfileInfo recProfileContent"><?php echo $showRec->recs_phone; ?></span>
										</div>
										<?php if($showRec->recs_website != "") { ?>
											<div class="recProfile">
												<span class="recProfileSub recProfileContent">Website:</span>
												<span class="recProfileInfo recProfileContent"><?php echo $showRec->recs_website == "" ? $showRec->recs_website : "No Website"; ?></span>
											</div>
										<?php } ?>
										<div class="recProfile">
											<span class="recProfileSub recProfileContent">Indoor/Outdoor Court:</span>
											<span class="recProfileInfo recProfileContent">
												<?php if($showRec->indoor == 1 && $showRec->outdoor == 1) { ?>
													<?php echo "Yes/Yes"; ?>
												<?php } elseif($showRec->indoor == 1 && $showRec->outdoor == 0) { ?>
													<?php echo "Yes/No"; ?>
												<?php } elseif($showRec->indoor == 0 && $showRec->outdoor == 1) { ?>
													<?php echo "No/Yes"; ?>
												<?php } else { ?>
													<?php echo "No/No"; ?>
												<?php } ?>
											</span>
										</div>
										<div class="recProfile">
											<span class="recProfileSub recProfileContent">Entry Fee:</span>
											<span class="recProfileInfo recProfileContent"><?php echo $showRec->fee; ?></span>
										</div>
									</div>
									<div class="recDivFooter">
										
									</div>
								</div>
							</td>
						</tr>
					<?php } ?>
				</table>	
			</div>
		</div>			
		<div class="media" id="twitterFeed">
			<div class="">
				<h2 id="twitter">Twitter Feed</h2>
				<h4 class="">Join the conversation #sixers, #phillyhoops, #totherec</h4>
			</div>
			<div class="row">
				<div class="feed col-md-4 col-sm-3">
					<a class="twitter-timeline"  href="https://twitter.com/hashtag/Phillyhoops" data-widget-id="784071520561881088">#Phillyhoops Tweets</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				</div>
				<div class="feed col-md-4 col-sm-3">
					<a class="twitter-timeline"  href="https://twitter.com/hashtag/sixers" data-widget-id="784069581954551808">#sixers Tweets</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				</div>
				<div class="feed col-md-4 col-sm-3">
					<a class="twitter-timeline"  href="https://twitter.com/hashtag/ToTheRec" data-widget-id="784071799776616448">#ToTheRec Tweets</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				</div>
			</div>
		</div>
	</div>
	<?php require_once("../include/footer.php"); ?>
	<script type="text/javascript">
		/*$(document).ready(function() {
			var searchedWinLoc = $(".searches").offset();
			var searchedHight = $(".searches").height();
			var currentY = 0;
			//Move background for searches on scroll
			$(window).scroll(function() {
				var startScroll = Number(searchedWinLoc.top) - Number(screen.height);
				var endScroll = Number(searchedWinLoc.top) + Number(searchedHight);
				var newPos = 5;
				//Start scroll once it reaches the searches area
				if(Number(window.pageYOffset) >= startScroll && Number(window.pageYOffset) <= endScroll) {
					st = $(this).scrollTop();
					if(st < currentY) {
						$(".searchesBgrd").css({backgroundPositionY:"-="+newPos+"%"});
					} else {
						$(".searchesBgrd").css({backgroundPositionY:"+="+newPos+"%"});
					}
					currentY = st;
				}
			});
		});*/
	</script>
</body>
</html>