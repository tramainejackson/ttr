<?php

namespace App\Http\Controllers;

use App\PlayerProfile;
use App\LeagueProfile;
use App\LeagueSchedule;
use App\LeagueStanding;
use App\LeaguePlayer;
use App\LeagueTeam;
use App\LeagueStat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class LeaguePlayersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('index', 'team_edit');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$league = Auth::user()->leagues_profiles->where('user_id', Auth::id())->first();
		$showcaseGame = LeagueSchedule::get_random_game();
		
		if($showcaseGame != null) {
			$awayTeamLeader = LeagueStat::get_scoring_leader($showcaseGame->get_away_team_id());
			$homeTeamLeader = LeagueStat::get_scoring_leader($showcaseGame->get_home_team_id());
		}
		
		return view('index', compact('league', 'showcaseGame'));
    }
	
	/**
     * Show the application welcome page for public.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_player_profile(Request $request)
    {
		$player = LeaguePlayer::find($request->player);
		$link = LeaguePlayer::find($request->link);

		if($player != null) {
			$player->player_profile_id = Auth::id();
			$player->player_profile_accepted = $request->link;
			
			if($player->save()) {
				return 'Linked!';
			} else {
				return 'Unable to link account. Please try again';
			}
		} else {
			return 'Player has been removed from team. Not Linked';
		}
    }
	
	/**
     * Show the application about us page for public.
     *
     * @return \Illuminate\Http\Response
     */
    public function team_edit(LeagueTeam $league_team)
    {
	    // Get the season to show
	    $showSeason = $this->find_season($league_team->id);

	    if($showSeason->teams->contains('id', $league_team->id)) {

		    // Resize the default image
		    Image::make(public_path('images/commissioner.jpg'))->resize(600, null, 	function ($constraint) {
			    $constraint->aspectRatio();
		    }
		    )->save(storage_path('app/public/images/lg/default_img.jpg'));
		    $defaultImg = asset('/storage/images/lg/default_img.jpg');

		    if (Storage::disk('public')->exists(str_ireplace('storage', '', $league_team->team_picture))) {
			    $teamImage = $league_team->lg_photo();
		    } else {
			    $teamImage = $defaultImg;
		    }

		    return view('leagues_sub.teams.edit', compact('league_team', 'showSeason', 'teamImage'));

	    } else {

		    abort(404);

	    }
    }
	
	/**
     * Remove a individual player from the team.
     *
     * @return \Illuminate\Http\Response
    */
    public function destroy(Request $request, LeaguePlayer $league_player)
    {
		// Delete Player
		if($league_player->delete()) {
			if($league_player->stats) {
				foreach($league_player->stats as $playerStat) {
					$playerStat->delete();
				}
				
				return redirect()->back()->with('status', 'Player Deleted Successfully');
			}
		}
    }
	
	/**
     * Check for a query string and get the current season.
     *
     * @return season
    */
	public function find_season($team_id) {
		if(Auth::check()) {

			$league_season = Auth::user()->player->leagues->where('league_team_id', $team_id)->first()->season;
			$showSeason = '';

			if($league_season->active == 'N' && $league_season->completed->completed == 'Y') {
				$showSeason = $league_season;
			} else {
				if($league_season->active == 'Y') {
					$showSeason = $league_season;
				} else {
					if($league_season->first()) {
						$showSeason = $league_season->first();
					} else {
						$showSeason = $league_season;
					}
				}
			}

			return $showSeason;
		}
	}
}
