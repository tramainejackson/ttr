<?php

namespace App\Http\Controllers;

use App\RecCenter;
use App\PlayerProfile;
use App\LeagueProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		if(PlayerProfile::where('user_id', Auth::id())->first()) {
			// Get player instance
			$player = PlayerProfile::where('user_id', Auth::id())->first();
			$playgrounds = $player->playgrounds;
			$videos = $player->videos;
			$leagues = $player->leagues;
			// $checkLinks = League_Player::link_player_accounts($player->email);
			
			$recs = RecCenter::all();
			$times = DB::table('game_times')->get();
			$days = DB::table('calendar_day')->get();

			return view('players.edit', compact('player', 'recs', 'times', 'days', 'playgrounds', 'videos', 'leagues'));
		} else {
			$league = LeagueProfile::where('user_id', Auth::id())->first();
			
			return view('leagues.edit', compact('league'));			
		}
    }
	
	/**
     * Show the application welcome page for public.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
		$getRecs = RecCenter::all();
		$getLeagues = LeagueProfile::all();
		$fireRecs = PlayerProfile::get_fire_recs();
		
        return view('welcome', compact('getRecs', 'getLeagues', 'fireRecs'));
    }
	
	/**
     * Show the application about us page for public.
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        return view('about', compact(''));
    }
}
