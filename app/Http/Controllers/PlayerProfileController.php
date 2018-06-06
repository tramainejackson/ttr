<?php

namespace App\Http\Controllers;

use App\RecCenter;
use App\PlayerProfile;
use App\LeagueProfile;
use App\PlayerPlayground;
use Illuminate\Http\Request;

class PlayerProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {	
		$players = PlayerProfile::findRecentAddedPlayers();
		
        return view('players.index', compact('players'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PlayerProfile $player)
    {		
        return view('players.show', compact('player'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlayerProfile $player)
    {
		// dd($player);
        // Validate incoming data
		$this->validate($request, [
			'firstname' => 'required|max:50',
			'lastname' => 'nullable|max:50',
			'nickname' => 'nullable|max:50',
			'email' => 'required|max:50:unique',
			'weight' => 'numeric|min:0|max:999',
			'dob_submit' => 'nullable',
			'highschool' => 'nullable',
			'college' => 'nullable',
		]);
		
		$player->firstname = $request->firstname;
		$player->lastname = $request->lastname;
		$player->nickname = $request->nickname;
		$player->user->email = $request->email;
		$player->dob = $request->dob;
		$player->highschool = $request->highschool;
		$player->college = $request->college;
		$player->height = $request->height;
		$player->weight = $request->weight;
		
		if($player->save()) {
			return redirect()->back()->with(['status' => '<li class="">Player information updated successfully</li>']);
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        //
    }
	
	/**
     * Update the playground for the player object.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
	public function update_playgrounds(Request $request, PlayerProfile $player) {
		// dd($player);
		// Update the existing playground
		if(isset($request->playground_id)) {
			$count = count($request->playground_id);
			foreach($request->playground_id as $key => $playgroundID) {
				$time = "";
				$timeArray = explode(':', str_ireplace(array('AM', 'PM'), '', $request->time[$key]));
				
				if(substr_count($request->time[$key], 'PM') > 0) {
					if($timeArray[0] != 12) {
						$time = ($timeArray[0] + 12) . ':' . $timeArray[1];
					} else {
						$time = $timeArray[0] . ':' . $timeArray[1];
					}
				} else {
					if($timeArray[0] != 12) {
						$time = $timeArray[0] . ':' . $timeArray[1];
					} else {
						$time = '0:' . $timeArray[1];
					}
				}
				
				$playground = PlayerPlayground::find($playgroundID);
				$playground->player_profile_id = $player->id;
				$playground->playground = $request->rec_name[$key];
				$playground->day = $request->day_name[$key];
				$playground->time = $time;
				
				if($playground->save()) {}
			}
			
			// Add the leftover new playgrounds
			for($x=$count; $x < count($request->rec_name); $x++) {
				$time = "";
				$timeArray = explode(':', str_ireplace(array('AM', 'PM'), '', $request->time[$x]));
				
				if(substr_count($request->time[$x], 'PM') > 0) {
					if($timeArray[0] != 12) {
						$time = ($timeArray[0] + 12) . ':' . $timeArray[1];
					} else {
						$time = $timeArray[0] . ':' . $timeArray[1];
					}
				} else {
					if($timeArray[0] != 12) {
						$time = $timeArray[0] . ':' . $timeArray[1];
					} else {
						$time = '0:' . $timeArray[1];
					}
				}
				
				$playground = new PlayerPlayground();
				$playground->player_profile_id = $player->id;
				$playground->playground = $request->rec_name[$x];
				$playground->day = $request->day_name[$x];
				$playground->time = $time;
				
				if($playground->save()) {}
			}
		} else {
			// Add any new playgrounds
			foreach($request->rec_name as $key => $playground) {
				$time = "";
				$timeArray = explode(':', str_ireplace(array('AM', 'PM'), '', $request->time[$key]));
				
				if(substr_count($request->time[$key], 'PM') > 0) {
					if($timeArray[0] != 12) {
						$time = ($timeArray[0] + 12) . ':' . $timeArray[1];
					} else {
						$time = $timeArray[0] . ':' . $timeArray[1];
					}
				} else {
					if($timeArray[0] != 12) {
						$time = $timeArray[0] . ':' . $timeArray[1];
					} else {
						$time = '0:' . $timeArray[1];
					}
				}
				
				$playground = new PlayerPlayground();
				$playground->player_profile_id = $player->id;
				$playground->playground = $request->rec_name[$key];
				$playground->day = $request->day_name[$key];
				$playground->time = $time;
				
				if($playground->save()) {}
			}
		}
		
		return redirect()->back()->with(['status' => '<li class="">Player playground information updated successfully</li>']);
	}
}
