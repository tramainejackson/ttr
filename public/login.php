<?php require_once("../include/initialize.php"); ?>
<?php if($session->is_logged_in()) { redirect_to("index.php"); } ?>
<?php 
	if(isset($_POST["submit"])) {
		$username = trim($_POST["username"]);
		$password = trim($_POST["password2"]);
		
		$foundUser = User_Account::authenticate($username, $password);
		if(!empty($foundUser)) {
			if($foundUser) {
				$foundUser->id = $foundUser->get_user_account_id();
				
				// Check to see if account is a player account or league account
				$player = Player_Profile::find_by_sql("SELECT * FROM player_profile WHERE user_account_id = '".$foundUser->id."';");
				$league = League_Profile::find_by_sql("SELECT * FROM leagues_profile WHERE user_account_id = '".$foundUser->id."';");
		
				if(!empty($league)) {
					$session->login($foundUser, $league->get_league_id(), "league");
					$foundUser->set_last_login();
					$foundUser->id = $foundUser->get_user_account_id();
					if($foundUser->save()) {
						if($league->ttr_league == "Y") {
							$leagueUser = League_Login::get_user_by_username($league->get_league_id(), $session->user_name);
							$leagueUser->set_last_login();
							$leagueUser->id = $leagueUser->get_login_id();
							$leagueUser->save();
							redirect_to("http://localhost/leagues.totherec/admin/admin_home.php");
						} else {
							redirect_to("league_page.php");
						}
					}
				} elseif(!empty($player)) {
					$session->login($foundUser, $player->get_player_id(), "player");
					$foundUser->set_last_login();
					if($foundUser->save()) {
						redirect_to("player_page.php");
					}
				}
			} else {
				//Username and Password combination was not found in database
				$message = ["Error" => "Username and Password combination was not found"];
				echo form_errors($message);
			}
		} else {
			// User profile has been deleted
			echo "Incorrect username / password combination.";
		}
	} else {
		// $message = ["Error" => "Form has not been submitted correctly. Please try again"];
		// $username = "";
		// $password = "";
		// echo form_errors($message);
	}
?>
<?php require_once("../include/header.php"); ?>
<body id="login">
	<?php require_once("../public/modal.php"); ?>
	<?php require_once("../public/about.html"); ?>
	<?php require_once("../public/menu.php"); ?>
	<div class="container"  id="loginPageContainer">
		<div id="login_page">
			<h2 class="login_header">Log In</h2>
			<form name="form1" id="form1" class="loginForm" method="POST" action="login.php">
				<table id="login_page_table">
					<tr> 
						<th><input type="text" name="username" id="username" placeholder="Enter Username" /></th>
						<th><input type="password" id="pass2" name="password2" placeholder="Enter Password" /></th>
					</tr>
					<tr>
						<th colspan="2"><input type="submit" name="submit" id="login_page_btn" value="Sign me in" /></th>
					</tr>								
				</table>
			</form>
		</div>
	</div>	
	<?php require_once("../include/footer.php"); ?>
</body>
</html>