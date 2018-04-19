<?php

namespace App\Http\Controllers;

use App\RecCenter;
use App\PlayerProfile;
use App\LeagueProfile;
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
        return view('players.index', compact(''));
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
}
