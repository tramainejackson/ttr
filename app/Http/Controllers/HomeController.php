<?php

namespace App\Http\Controllers;

use App\Message;
use App\News;
use App\PlayerProfileVideos;
use App\RecCenter;
use App\PlayerProfile;
use App\LeagueProfile;
use App\Video;
use App\WriterProfile;
use App\LeaguePlayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

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
    	session(['user' => Auth::user()]);
    	$league  = isset(Auth::user()->league) ? Auth::user()->league : false;
    	$player  = isset(Auth::user()->player) ? Auth::user()->player : false;
    	$writer  = isset(Auth::user()->writer) ? Auth::user()->writer : false;

		if ($player) {
			$recs = RecCenter::all();
			$playgrounds = $player->playgrounds;
			$videos = $player->videos;
			$leagues = $player->leagues;
			$linkLeague = LeaguePlayer::where([
				['email', $player->user->email],
				['player_profile_id', null]
			])->get();

			$days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

			// Resize the default image
			Image::make(public_path('images/emptyface.jpg'))->resize(350, null, 	function ($constraint) {
					$constraint->aspectRatio();
				}
			)->save(storage_path('app/public/images/lg/default_img.jpg'));
			$defaultImg = asset('/storage/images/lg/default_img.jpg');

			if ($player->image != null) {

				if (Storage::disk('public')->exists(str_ireplace('storage', '', $player->image->path))) {
					$playerImage = asset($player->image->path);
				} else {
					$playerImage = $defaultImg;
				}

			} else {
				$playerImage = $defaultImg;
			}

			return view('players.edit', compact('player', 'recs', 'playgrounds', 'videos', 'leagues', 'days', 'linkLeague', 'playerImage', 'defaultImg'));
		} elseif($league) {
			return view('leagues.edit', compact('league'));
		} elseif($writer) {
			return view('writer.edit', compact('writer'));
		} elseif(Auth::user()->type == 'admin') {
			$admin      = Auth::user();
			$recs       = RecCenter::all();
			$players    = PlayerProfile::all();
			$videos     = PlayerProfileVideos::all();
			$leagues    = LeagueProfile::all();
			$articles   = News::all();
			$writers    = WriterProfile::all();
			$messages   = Message::all();

			return view('admin.index', compact('admin', 'messages', 'recs', 'players', 'videos', 'leagues', 'articles', 'writers'));
		}
    }
	
	/**
     * Show the application welcome page for public.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
		$getRecs = RecCenter::orderBy('name')->get();
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
