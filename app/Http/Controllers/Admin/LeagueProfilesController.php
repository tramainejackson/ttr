<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\RecCenter;
use App\PlayerProfile;
use App\LeagueProfile;
use Intervention\Image\ImageManagerStatic as Image;

class LeagueProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leagues = LeagueProfile::all();
		
		// Resize the default image
		Image::make(public_path('/images/basketball_background1.jpg'))->save(storage_path('app/public/images/lg/default_img.jpg'));
		$defaultImg = asset('/storage/images/lg/default_img.jpg');

		return view('admin.leagues.index', compact('leagues', 'defaultImg'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    return view('admin.leagues.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    $user = new User();
	    $player = new LeagueProfile();

	    $user->username = $request->username;
	    $user->email    = $request->email;
	    $user->password = bcrypt($request->password);
	    $user->type     = 'commish';

	    if($user->save()) {
		    $player->user_id = $user->id;

		    if($player->save()) {}
	    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(LeagueProfile $league)
    {
		return view('leagues.show', compact('league'));
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
    public function update(Request $request, LeagueProfile $league)
    {
		// Validate incoming data
		$this->validate($request, [
			'leagues_name' => 'required|max:50:unique:league_profile',
			'leagues_commish' => 'required|max:100',
			'leagues_fee' => 'required|nullable|',
			'ref_fee' => 'numeric|nullable',
		]);
		
		$league->name = $request->leagues_name;
		$league->commish = $request->leagues_commish;
		$league->address = $request->leagues_address;
		$league->phone = $request->leagues_phone;
		$league->leagues_email = $request->leagues_email;
		$league->leagues_website = $request->leagues_website;
		$league->leagues_fee = $request->leagues_fee;
		$league->ref_fee = $request->ref_fee;
		$league->age = implode(' ', $request->age);
		$league->comp = implode(' ', $request->leagues_comp);
		
		if($league->save()) {
			return redirect()->back()->with(['status' => '<li class="">Leagues Information Updated Successfully</li>']);
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
     * Search the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
		$leagues = LeagueProfile::search(str_ireplace(' ', '', str_ireplace('_', '', $request->search)));
		$searchCriteria = $request->search;
		
		// Create and Resize the default image
		Image::make(public_path('images/commissioner.jpg'))->resize(350, null, 	function ($constraint) {
				$constraint->aspectRatio();
			}
		)->save(storage_path('app/public/images/lg/default_img.jpg'));
		$defaultImg = asset('/storage/images/lg/default_img.jpg');
		
		return view('leagues.index', compact('searchCriteria', 'defaultImg', 'leagues'));
    }
}
