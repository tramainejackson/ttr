<?php

namespace App\Http\Controllers;

use App\RecCenter;
use App\PlayerProfile;
use App\LeagueProfile;
use App\LeaguePlayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;

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
		if(session()->has('user')) {
			if(session()->has('player')) {
				$player = PlayerProfile::where('user_id', session()->get('player'))->first();
				$recs = RecCenter::all();
				$playgrounds = $player->playgrounds;
				$videos = $player->videos;
				$leagues = $player->leagues;
				$linkLeague = LeaguePlayer::where([
					['email', $player->email],
					['player_profile_id', null]
				])->get();

				$days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

				// Resize the default image
				Image::make(public_path('images/emptyface.jpg'))->resize(350, null, 	function ($constraint) {
						$constraint->aspectRatio();
					}
				)->save(storage_path('app/public/images/lg/default_img.jpg'));
				$defaultImg = asset('/storage/images/lg/default_img.jpg');
			
				return view('players.edit', compact('player', 'recs', 'playgrounds', 'videos', 'leagues', 'days', 'linkLeague', 'defaultImg'));
			} elseif(session()->has('commish')) {
				$league = LeagueProfile::where('user_id', session()->get('commish'))->first();

				return view('leagues.edit', compact('league'));			
			}
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
		// dd($getLeagues);
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
