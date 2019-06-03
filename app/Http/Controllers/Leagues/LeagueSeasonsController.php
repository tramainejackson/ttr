<?php

namespace App\Http\Controllers\Leagues;

use App\PlayerProfile;
use App\LeagueProfile;
use App\LeagueSchedule;
use App\LeagueStanding;
use App\LeaguePlayer;
use App\LeagueTeam;
use App\LeagueStat;
use App\LeagueSeason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class LeagueSeasonsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    // Get the season to show
	    $showSeason = $this->find_season(request());

	    if($showSeason instanceof \App\LeagueProfile) {

		    $completedSeasons = $showSeason->seasons()->completed()->get();
		    $activeSeasons = $showSeason->seasons()->active()->get();
		    $ageGroups = explode(' ', $showSeason->age);
		    $compGroups = explode(' ', $showSeason->comp);
		    $showSeasonUnpaidTeams = $showSeasonTeams = $showSeasonStat = $showSeasonPlayers = $showSeasonSchedule = collect();

		    if($showSeason->is_playoffs == 'Y') {

			    $allGames = $showSeason->games;
			    $allTeams = $showSeason->league_teams;
			    $playoffSettings = $showSeason->playoffs;
			    $nonPlayInGames = $showSeason->games()->playoffNonPlayinGames()->get();
			    $playInGames = $showSeason->games()->playoffPlayinGames()->get();

			    return view('leagues_sub.playoffs.index', compact('ageGroups', 'compGroups', 'completedSeasons', 'activeSeasons', 'showSeason', 'nonPlayInGames', 'playInGames', 'playoffSettings', 'allGames', 'allTeams'));

		    } else {

			    return view('leagues_sub.season.index', compact('completedSeasons', 'activeSeasons', 'showSeason', 'showSeasonSchedule', 'showSeasonStat', 'showSeasonPlayers', 'showSeasonTeams', 'ageGroups', 'compGroups', 'showSeasonUnpaidTeams'));

		    }

	    } else {

		    $completedSeasons = $showSeason->league_profile->seasons()->completed()->get();
		    $activeSeasons = $showSeason->league_profile->seasons()->active()->get();
		    $ageGroups = explode(' ', $showSeason->league_profile->age);
		    $compGroups = explode(' ', $showSeason->league_profile->comp);
		    $showSeasonSchedule = $showSeason->games()->upcomingGames()->get();
		    $showSeasonStat = $showSeason->stats()->get();
		    $showSeasonTeams = $showSeason->league_teams;
		    $showSeasonUnpaidTeams = $showSeason->league_teams()->unpaid();
		    $showSeasonPlayers = $showSeason->league_players;

		    if($showSeason->is_playoffs == 'Y') {

			    $allGames = $showSeason->games;
			    $allTeams = $showSeason->league_teams;
			    $playoffSettings = $showSeason->playoffs;
			    $nonPlayInGames = $showSeason->games()->playoffNonPlayinGames()->get();
			    $playInGames = $showSeason->games()->playoffPlayinGames()->get();

			    return view('leagues_sub.playoffs.index', compact('ageGroups', 'compGroups', 'completedSeasons', 'activeSeasons', 'showSeason', 'nonPlayInGames', 'playInGames', 'playoffSettings', 'allGames', 'allTeams'));

		    } else {

			    return view('leagues_sub.season.index', compact('completedSeasons', 'activeSeasons', 'showSeason', 'showSeasonSchedule', 'showSeasonStat', 'showSeasonPlayers', 'showSeasonTeams', 'ageGroups', 'compGroups', 'showSeasonUnpaidTeams'));

		    }

	    }
    }
	
	/**
     * Store a new season for the logged in league.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$season = new LeagueSeason();
		$season->league_profile_id = $request->league_id;
		$season->season = $request->season;
		$season->name = $request->name;
		$season->year = $request->year;
		$season->age_group = $request->age_group;
		$season->comp_group = $request->comp_group;
		$season->league_fee = $request->league_fee;
		$season->ref_fee = $request->ref_fee;
		$season->location = $request->location;
		$season->active = 'Y';
		$season->paid = 'Y';
		
		if($season->save()) {
			if($season->playoffs()->create([])) {
				$newSeason = $season->id;

				return [$newSeason, "New Season Added Successfully"];
			}
		}
    }
	
	/**
     * Store a new season for the logged in league.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_playoffs(Request $request, LeagueSeason $league_season)
    {
		// Get the season to show
		$showSeason = $this->find_season(request());
		
		$createPlayoffs = $showSeason->create_playoff_settings();
		
		return redirect()->back()->with(['status' => $createPlayoffs]);
    }
	
	/**
     * Store a new season for the logged in league.
     *
     * @return \Illuminate\Http\Response
     */
    public function complete_season(LeagueSeason $league_season)
    {
		// Get the season to show
		$showSeason = $this->find_season(request());
		
		$showSeason->completed = 'Y';
		$showSeason->active = 'N';
		
		if($showSeason->save()) {
			return redirect()->action('HomeController@index')->with(['status' => 'Season Completed']);
		}
    }
	
	/**
     * Store a new season for the logged in league.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
		// Get the season to show
		$showSeason = $this->find_season(request());

		$showSeason->name = $request->name;
		$showSeason->comp_group = $request->comp_group;
		$showSeason->age_group = $request->age_group;
		$showSeason->league_fee = $request->leagues_fee;
		$showSeason->ref_fee = $request->ref_fee;
		$showSeason->location = $request->leagues_address;

		if($request->new_court_description != null && $request->new_court_location != null) {
			foreach($request->new_court_location as $key => $value) {
				$showSeason->courts()->create([
					'court_description' => $request->new_court_description[$key],
					'court_location' => $request->new_court_location[$key],
				]);
			}
		}

		if($request->court_id != null) {
			foreach($request->court_id as $key => $value) {
				$court = $showSeason->courts()->find($request->court_id[$key]);

				$court->court_description = $request->court_description[$key];
				$court->court_location = $request->court_location[$key];

				if($court->save()) {}
			}
		}

		if($showSeason->save()) {
			return redirect()->back()->with(['status' => 'Season Updated Successfully']);
		}
    }
	
	/**
     * Show the application about us page for public.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(LeagueProfile $league)
	{
		// Resize the default image
		Image::make(public_path('images/commissioner.jpg'))->resize(600, null, 	function ($constraint) {
			$constraint->aspectRatio();
		}
		)->save(storage_path('app/public/images/lg/default_img.jpg'));
		$defaultImg = asset('/storage/images/lg/default_img.jpg');

		if (Storage::disk('public')->exists(str_ireplace('storage', '', $league->picture))) {
			$leagueImage = $league->picture;
		} else {
			$leagueImage = $defaultImg;
		}

		return view('leagues_sub.leagues.show', compact('league', 'leagueImage'));
	}
	
	/**
     * Check for a query string and get the current season.
     *
     * @return seaon
    */
	public function find_season(Request $request) {

		if(Auth::check()) {

			$league = Auth::user()->league;
			$showSeason = '';

			if($request->query('season') != null && $request->query('year') != null) {

				$showSeason = $league->seasons()->active()->find($request->query('season'));

			} else {

				if($league) {

					if($league->seasons()->active()->count() < 1 && $league->seasons()->completed()->count() > 0) {

						$showSeason = $league;

					} else {

						if($league->seasons()->active()->first()) {

							$showSeason = $league->seasons()->active()->first();

						} else {

							if($league->seasons()->first()) {

								$showSeason = $league->seasons()->first();

							} else {

								$showSeason = $league;

							}

						}

					}

				} else {



				}

			}

			return $showSeason;
		} else {
			if(session()->has('commish')) {
				Auth::loginUsingId(session()->get('commish'));
			}
		}
	}
}
