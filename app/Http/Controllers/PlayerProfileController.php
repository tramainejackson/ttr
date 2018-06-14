<?php

namespace App\Http\Controllers;

use App\RecCenter;
use App\PlayerProfile;
use App\LeagueProfile;
use App\PlayerPlayground;
use App\PlayerProfileImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\File;
use Carbon\Carbon;

class PlayerProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {	
		$allPlayers = PlayerProfile::orderBy('lastname')->get();
		$recentPlayers = PlayerProfile::findRecentAddedPlayers();

		// Create and Resize the default image
		Image::make(public_path('images/emptyface.jpg'))->resize(350, null, 	function ($constraint) {
				$constraint->aspectRatio();
			}
		)->save(storage_path('app/public/images/lg/default_img.jpg'));
		$defaultImg = asset('/storage/images/lg/default_img.jpg');
		
		if(request()->query('filter')) {
			$allPlayers = PlayerProfile::filter(request()->query('filter'));
			
			return view('players.index', compact('defaultImg', 'allPlayers'));
		} else {
			return view('players.index', compact('defaultImg', 'recentPlayers', 'allPlayers'));
		}
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
		// Create and Resize the default image
		Image::make(public_path('images/emptyface.jpg'))->resize(350, null, 	function ($constraint) {
				$constraint->aspectRatio();
			}
		)->save(storage_path('app/public/images/lg/default_img.jpg'));
		$defaultImg = asset('/storage/images/lg/default_img.jpg');
		
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
	
	/**
     * Update the image for the player object.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
	public function update_player_image(Request $request, PlayerProfile $player) {
		if($player->image) {
			if($request->hasFile('file')) {
				$newImage = $request->file('file');
				// Check to see if upload is an image
				if($newImage->guessExtension() == 'jpeg' || $newImage->guessExtension() == 'png' || $newImage->guessExtension() == 'gif' || $newImage->guessExtension() == 'webp' || $newImage->guessExtension() == 'jpg') {
					$addImage = $player->image;
					
					// Check to see if images is too large
					if($newImage->getError() == 1) {
						$fileName = $request->file('file')[0]->getClientOriginalName();
						$error .= "<li class='errorItem'>The file " . $fileName . " is too large and could not be uploaded</li>";
					} elseif($newImage->getError() == 0) {
						// Check to see if images is about 25MB
						// If it is then resize it
						if($newImage->getClientSize() < 25000000) {
							$image = Image::make($newImage->getRealPath())->orientate();
							$path = $newImage->store('public/images');
							
							if($image->save(storage_path('app/'. $path))) {
								// prevent possible upsizing
								// Create a larger version of the image
								// and save to large image folder
								$image->resize(1700, null, function ($constraint) {
									$constraint->aspectRatio();
									// $constraint->upsize();
								});
								
								
								if($image->save(storage_path('app/'. str_ireplace('images', 'images/lg', $path)))) {
									// Get the height of the current large image
									$addImage->lg_height = $image->height();
									
									// Create a smaller version of the image
									// and save to large image folder
									$image->resize(544, null, function ($constraint) {
										$constraint->aspectRatio();
									});
									
									if($image->save(storage_path('app/'. str_ireplace('images', 'images/sm', $path)))) {
										// Get the height of the current small image
										$addImage->sm_height = $image->height();
									}
								}
							}
							
							$addImage->width = $image->width();
							$addImage->path = str_ireplace('public', 'storage', $path);
							$addImage->player_profile_id = $player->id;
							
							if($addImage->save()) {
								return $player->image;
							}
						} else {
							// Resize the image before storing. Will need to hash the filename first
							$path = $newImage->store('public/images');
							$image = Image::make($newImage)->orientate()->resize(1500, null, function ($constraint) {
								$constraint->aspectRatio();
								$constraint->upsize();
							});
							
							$addImage->width = $image->width();
							$addImage->path = str_ireplace('public', 'storage', $path);
							$addImage->player_profile_id = $player->id;
							
							if($addImage->save()) {
								return $player->image;
							}
						}
					} else {
						$error .= "<li class='errorItem'>The file " . $fileName . " may be corrupt and could not be uploaded</li>";
					}
				} else {
					$error .= "<li class='errorItem'>The file " . $fileName . " may be corrupt and could not be uploaded</li>";
				}
			}
		} else {
			if($request->hasFile('file')) {
				$newImage = $request->file('file');
				// Check to see if upload is an image
				if($newImage->guessExtension() == 'jpeg' || $newImage->guessExtension() == 'png' || $newImage->guessExtension() == 'gif' || $newImage->guessExtension() == 'webp' || $newImage->guessExtension() == 'jpg') {
					$addImage = new PlayerProfileImages();
					
					// Check to see if images is too large
					if($newImage->getError() == 1) {
						$fileName = $request->file('file')[0]->getClientOriginalName();
						$error .= "<li class='errorItem'>The file " . $fileName . " is too large and could not be uploaded</li>";
					} elseif($newImage->getError() == 0) {
						// Check to see if images is about 25MB
						// If it is then resize it
						if($newImage->getClientSize() < 25000000) {
							$image = Image::make($newImage->getRealPath())->orientate();
							$path = $newImage->store('public/images');
							
							if($image->save(storage_path('app/'. $path))) {
								// prevent possible upsizing
								// Create a larger version of the image
								// and save to large image folder
								$image->resize(1700, null, function ($constraint) {
									$constraint->aspectRatio();
									// $constraint->upsize();
								});
								
								
								if($image->save(storage_path('app/'. str_ireplace('images', 'images/lg', $path)))) {
									// Get the height of the current large image
									$addImage->lg_height = $image->height();
									
									// Create a smaller version of the image
									// and save to large image folder
									$image->resize(544, null, function ($constraint) {
										$constraint->aspectRatio();
									});
									
									if($image->save(storage_path('app/'. str_ireplace('images', 'images/sm', $path)))) {
										// Get the height of the current small image
										$addImage->sm_height = $image->height();
									}
								}
							}
							
							$addImage->width = $image->width();
							$addImage->path = str_ireplace('public', 'storage', $path);
							$addImage->player_profile_id = $player->id;
							
							if($addImage->save()) {
								return $player->image;
							}
						} else {
							// Resize the image before storing. Will need to hash the filename first
							$path = $newImage->store('public/images');
							$image = Image::make($newImage)->orientate()->resize(1500, null, function ($constraint) {
								$constraint->aspectRatio();
								$constraint->upsize();
							});
							
							$addImage->width = $image->width();
							$addImage->path = str_ireplace('public', 'storage', $path);
							$addImage->player_profile_id = $player->id;
							
							if($addImage->save()) {
								return $player->image;
							}
						}
					} else {
						$error .= "<li class='errorItem'>The file " . $fileName . " may be corrupt and could not be uploaded</li>";
					}
				} else {
					$error .= "<li class='errorItem'>The file " . $fileName . " may be corrupt and could not be uploaded</li>";
				}
			}
			
		}
	}

	/**
     * Search the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
		$allPlayers = PlayerProfile::search($request->search);
		$searchCriteria = $request->search;
		
		// Create and Resize the default image
		Image::make(public_path('images/emptyface.jpg'))->resize(350, null, 	function ($constraint) {
				$constraint->aspectRatio();
			}
		)->save(storage_path('app/public/images/lg/default_img.jpg'));
		$defaultImg = asset('/storage/images/lg/default_img.jpg');
		
		return view('players.index', compact('searchCriteria', 'defaultImg', 'allPlayers'));
    }
}