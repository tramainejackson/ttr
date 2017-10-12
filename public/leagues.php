<?php require_once("../include/initialize.php"); ?>
<?php require_once("../include/header.php"); ?>
<body>
	<div id="backgroundImageL"></div>
	<?php require_once("../public/modal.php"); ?>
	<?php require_once("../public/menu.php"); ?>
	<?php require_once("../public/about.html"); ?>
	<div class="container-fluid">
		<?php if(isset($_GET["age"])) { ?>
			<div id="leagues">
				<?php $ages = array("10", "12", "14", "16", "18", "30", "50", "unlimited"); ?>
				<h2>City Leagues <span class="switchFilterOption"><a href="leagues.php?comp=false" class="">Switch To Comp</a></span></h2>
				<?php for($i=0; $i<count($ages); $i++) { ?>
					<ul class="leagues_select" id="under<?php echo $ages[$i]; ?>">
						<?php if($ages[$i] == "30" || $ages[$i] == "50") { ?>
						<?php $getAgeLimit = League_Profile::get_leagues_by_age($ages[$i]); ?>
							<li class="comp_age<?php echo $ages[$i]; ?> comp_age_levels"><span class="leagues_arrows">-</span><span class="leagues_age_header"><?php echo $ages[$i]; ?> and Over</span><span class="leagues_arrows">-</span></li>
							<?php if(!empty($getAgeLimit)) { ?>	
								<?php if(is_object($getAgeLimit)) { ?>
									<?php $leagueByAge = $getAgeLimit; ?>
									<li class="leagues_link"><a class="over<?php echo $ages[$i]; ?>_link" href="leagues.php?age=<?php echo $ages[$i]; ?>&league=<?php echo str_ireplace(" ", "_", $leagueByAge->leagues_name); ?>&leagueID=<?php echo $leagueByAge->get_league_id(); ?>"><?php echo ucwords(strtolower($leagueByAge->leagues_name)); ?></a></li>
								<?php } elseif(is_array($getAgeLimit)) { ?>
									<?php foreach($getAgeLimit as $leaguesByAge) { ?>
										<li class="leagues_link"><a class="over<?php echo $ages[$i]; ?>_link" href="leagues.php?age=<?php echo $ages[$i]; ?>&league=<?php echo str_ireplace(" ", "_", $leaguesByAge->leagues_name); ?>&leagueID=<?php echo $leaguesByAge->get_league_id(); ?>"><?php echo ucwords(strtolower($leaguesByAge->leagues_name)); ?></a></li>
									<?php } ?>
								<?php } ?>
							<?php } else { ?>
								<li class="leagues_link"><a href="#">No leagues have been added yet for this age range</a></li>
							<?php } ?>
						<?php } elseif($ages[$i] == "unlimited") { ?>
							<?php $getAgeLimit = League_Profile::get_leagues_by_age($ages[$i]); ?>
							<li class="comp_age<?php echo $ages[$i]; ?> comp_age_levels"><span class="leagues_arrows">-</span><span class="leagues_age_header"><?php echo ucfirst($ages[$i]); ?></span><span class="leagues_arrows">-</span></li>
							<?php if(!empty($getAgeLimit)) { ?>						
								<?php if(is_object($getAgeLimit)) { ?>
									<?php $leagueByAge = $getAgeLimit; ?>
									<li class="leagues_link"><a class="unlimited_link" href="leagues.php?age=<?php echo $ages[$i]; ?>&league=<?php echo str_ireplace(" ", "_", $leagueByAge->leagues_name); ?>&leagueID=<?php echo $leagueByAge->get_league_id(); ?>"><?php echo ucwords(strtolower($leagueByAge->leagues_name)); ?></a></li>
								<?php } elseif(is_array($getAgeLimit)) { ?>
									<?php foreach($getAgeLimit as $leaguesByAge) { ?>
										<li class="leagues_link"><a class="unlimited_link" href="leagues.php?age=<?php echo $ages[$i]; ?>&league=<?php echo str_ireplace(" ", "_", $leaguesByAge->leagues_name); ?>&leagueID=<?php echo $leaguesByAge->get_league_id(); ?>"><?php echo ucwords(strtolower($leaguesByAge->leagues_name)); ?></a></li>
									<?php } ?>
								<?php } ?>
							<?php } else { ?>
								<li class="leagues_link"><a href="#">No leagues have been added yet for this age range</a></li>
							<?php } ?>
						<?php } else { ?>
							<?php $getAgeLimit = League_Profile::get_leagues_by_age($ages[$i]); ?>
								<li class="comp_age<?php echo $ages[$i]; ?> comp_age_levels"><span class="leagues_arrows">-</span><span class="leagues_age_header"><?php echo $ages[$i]; ?> and Under</span><span class="leagues_arrows">-</span></li>
							<?php if(!empty($getAgeLimit)) { ?>						
								<?php if(is_object($getAgeLimit)) { ?>
									<?php $leagueByAge = $getAgeLimit; ?>
									<li class="leagues_link"><a class="under<?php echo $ages[$i]; ?>_link" href="leagues.php?age=<?php echo $ages[$i]; ?>&league=<?php echo str_ireplace(" ", "_", $leagueByAge->leagues_name); ?>&leagueID=<?php echo $leagueByAge->get_league_id(); ?>"><?php echo ucwords(strtolower($leagueByAge->leagues_name)); ?></a></li>
								<?php } elseif(is_array($getAgeLimit)) { ?>
									<?php foreach($getAgeLimit as $leaguesByAge) { ?>
										<li class="leagues_link"><a class="under<?php echo $ages[$i]; ?>_link" href="leagues.php?age=<?php echo $ages[$i]; ?>&league=<?php echo str_ireplace(" ", "_", $leaguesByAge->leagues_name); ?>&leagueID=<?php echo $leaguesByAge->get_league_id(); ?>"><?php echo ucwords(strtolower($leaguesByAge->leagues_name)); ?></a></li>
									<?php } ?>
								<?php } ?>
							<?php } else { ?>
								<li class="leagues_link"><a href="#">No leagues have been added yet for this age range</a></li>
							<?php } ?>
						<?php } ?>
					</ul>
				<?php } ?>
				</div>
			<?php } elseif(isset($_GET["comp"])) { ?>
				<div id="leagues">
					<?php $comp = find_competitions(); ?>
					<h2>City Leagues <span class="switchFilterOption"><a href="leagues.php?age=false" class="">Switch To Ages</a></span></h2>
					<?php for($i=0; $i<count($comp); $i++) { ?>
						<ul class="leagues_select" id="<?php echo $comp[$i]; ?>">
							<?php $getCompLevel = League_Profile::get_leagues_by_comp($comp[$i]); ?>
							<li class="comp_<?php echo $comp[$i]; ?> comp_level"><span class="leagues_arrows">-</span><span class="leagues_age_header"><?php echo ucfirst($comp[$i]); ?></span><span class="leagues_arrows">-</span></li>
							<?php if(!empty($getCompLevel)) { ?>
								<?php if(is_object($getCompLevel)) { ?>						
									<?php $leagues = $getCompLevel; { ?>
										<li class="leagues_link"><a class="<?php echo $comp[$i]; ?>_link" href="leagues.php?comp=<?php echo $comp[$i]; ?>&league=<?php echo str_ireplace(" ", "_", $leagues->leagues_name); ?>&leagueID=<?php echo $leagues->get_league_id(); ?>"><?php echo ucwords(strtolower($leagues->leagues_name)); ?></a></li>
									<?php } ?>
								<?php } elseif(is_array($getCompLevel)) { ?>
									<?php foreach($getCompLevel as $leagues) { ?>
										<li class="leagues_link"><a class="<?php echo $comp[$i]; ?>_link" href="leagues.php?comp=<?php echo $comp[$i]; ?>&league=<?php echo str_ireplace(" ", "_", $leagues->leagues_name); ?>&leagueID=<?php echo $leagues->get_league_id(); ?>"><?php echo ucwords(strtolower($leagues->leagues_name)); ?></a></li>
									<?php } ?>
								<?php } ?>
							<?php } else { ?>
								<li class="leagues_link"><a href="#">No leagues have been added yet for this competition level</a></li>
							<?php } ?>
						</ul>
					<?php } ?>
				</div>
			<?php } elseif(isset($_GET["stats"])) { ?>
				<div id="stat_leagues">
					<?php $statLeague = League_Profile::get_online_stats_leagues() ?>
					<div class="container-fluid">
						<?php if(!empty($statLeague)) { ?>
							<?php if(is_array($statLeague)) { ?>
								<?php foreach($statLeague as $statsLeague) { ?>
									<div class="row">
										<div class="col-md-3 statLeaguePic">
											<img src="images/<?php echo $statsLeague->leagues_picture ?>" class="" />
										</div>
										<div class="col-md-9 statLeagueInfo">
											<div class="row">
												<div class="">
													<h2 class=""><?php echo $statsLeague->leagues_name ?></h2>
												</div>
												<div class="">
													<p class=""><span>Contact:&nbsp;</span><span><?php echo $statsLeague->leagues_commish . " " . $statsLeague->leagues_phone; ?></span></p>
												</div>
												<div class="">
													<p class=""><span>Address:&nbsp;</span><span><?php echo $statsLeague->leagues_address ?></span></p>
												</div>
												<div class="">
													<p class=""><span>Website:&nbsp;</span><span><a href="<?php echo $statsLeague->ttr_league_site; ?>" class="">Click here for website</a></span></p>
												</div>
											</div>
										</div>
									</div>
								<?php } ?>
							<?php } elseif(is_object($statLeague)) { ?>
								<div class="row">
									<div class="col-md-3 statLeaguePic">
										<img src="images/<?php echo $statLeague->leagues_picture ?>" class="" />
									</div>
									<div class="col-md-9 statLeagueInfo">
										<div class="row">
											<div class="">
												<h2 class=""><?php echo $statLeague->leagues_name ?></h2>
											</div>
											<div class="">
												<p class=""><span>Contact:&nbsp;</span><span><?php echo $statLeague->leagues_commish . " " . $statLeague->leagues_phone; ?></span></p>
											</div>
											<div class="">
												<p class=""><span>Address:&nbsp;</span><span><?php echo $statLeague->leagues_address ?></span></p>
											</div>
											<div class="">
												<p class=""><span>Website:&nbsp;</span><span><a href="<?php echo $statLeague->ttr_league_site ?>" class="" target="_blank">Click here for website</a></span></p>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
						<?php } else { ?>
							<div class="">
								<h2 class="">No leagues have been added yet that keep online stats. Tell the person running your league to add their league to ToTheRec.com to get more players to their league</h2>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } else { ?>
				<div id="leagues">
					<div class="container-fluid leaguesOptions">
						<div class="row">
							<h2 class="col-md-12">City Leagues</h2>
						</div>
						<div class="row">
							<div class="ageOption leaguesFilterOption col-md-4">
								<a href="leagues.php?age=false" class="">Age Level</a>
							</div>
							<div class="compOption leaguesFilterOption col-md-4">
								<a href="leagues.php?comp=false" class="">Competition Level</a>
							</div>
							<div class="statLeagueOption leaguesFilterOption col-md-4">
								<a href="leagues.php?stats=false" class="">Online Stats</a>
							</div>
						</div>
					</div>
				</div>
		<?php } ?>
		<?php if(isset($_GET["league"])) { ?>
			<?php $league = League_Profile::get_league_by_id($_GET["leagueID"]) ?>
			<div class="indLeague" style="background-image:url('images/<?php echo $league->leagues_picture; ?>');">
				<h1 class="">
					<?php echo ucwords($league->leagues_name); ?>
					<?php if($league->ttr_league == "Y") { ?>
						<span class="ttrSite">This Leagues Keeps Online Stats. Click <a href="<?php echo $league->ttr_league_site; ?>" class="" target="_blank">here</a> to see.</span>
					<?php } ?>
				</h1>
				<div class="indLeaguesInfo">
					<span>Address:</span>
					<span class=""><?php echo $league->leagues_address != "" ? $league->leagues_address : "No Address Listed"; ?></span>
				</div>
				<div class="indLeaguesInfo">
					<span>Phone #:</span>
					<span class=""><?php echo $league->leagues_phone != "" ? $league->leagues_phone : "No Phone Number Listed"; ?></span>
				</div>
				<div class="indLeaguesInfo">
					<span>Email:</span>
					<span class=""><?php echo $league->leagues_email != "" ? $league->leagues_email : "No Email Address Listed"; ?></span>
				</div>
				<div class="indLeaguesInfo">
					<span>Website:</span>
					<span class=""><?php echo $league->leagues_website != "" ? "<a href='http://".$league->leagues_website."'>".$league->leagues_website."</a>" : "No Website For This League"; ?></span>
				</div>
				<div class="indLeaguesInfo">
					<span>Entry Fee:</span>
					<span class=""><?php echo settype($league->leagues_fee, "integer") < 1 ? $league->leagues_fee : "Please Contact For League Entry"; ?></span>
				</div>
				<div class="indLeaguesInfo">
					<span>Ref Fee:</span>
					<span class=""><?php echo settype($league->ref_fee, "integer") < 1 ? $league->ref_fee : "No Ref Fee's Added Yet"; ?></span>
				</div>
				<div class="indLeaguesInfo compLevelTable">
					<span>Comp Levels:</span>
					<div class="container-fluid">
						<div class="row">
							<?php if($league->leagues_comp != "") { ?>
								<ul class="compLevelsList">
									<?php $levelsArray = explode(" ", $league->leagues_comp); ?>
									<?php for($i=0; $i < count($levelsArray); $i++) { ?>
										<li class="col-md-4"><?php echo str_ireplace(" ", "", ucwords(str_ireplace("_", " ", $levelsArray[$i]))); ?></li>
									<?php } ?>
								</ul>
							<?php } else { ?>
								<span class=""><?php echo $league->leagues_comp; ?></span>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="indLeaguesInfo ageLevelTable">
					<span>Age Levels:</span>
					<div class="container-fluid">
						<div class="row">
							<?php if($league->leagues_comp != "") { ?>
								<ul class="compLevelsList">
									<?php $agesArray = explode(" ", $league->leagues_age); ?>
									<?php for($i=0; $i < count($agesArray); $i++) { ?>
										<li class="col-md-4"><?php echo ucwords(str_ireplace("_", " ", $agesArray[$i])); ?></li>
									<?php } ?>
								</ul>
							<?php } else { ?>
								<span class=""><?php echo $league->leagues_age; ?></span>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
	<?php require_once("../include/footer.php"); ?>
</body>
</html>