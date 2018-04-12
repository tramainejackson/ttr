<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PlayerProfile extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
    */
    protected $hidden = [
        'password', 'remember_token',
    ];
	
	/**
     *
     * Get all the rec centers from the player profiles and 
     * count the most popular ones
     *
     * @var array
    */
	public static function get_fire_recs() {
		$playerPlaygrounds = self::where('player_playground', '<>', 'null')->get();

		if(!empty($playerPlaygrounds)) {
			$fireRecs = [];
			$returnArray = [];
			foreach($playerPlaygrounds as $playground) {
				$getPlaygrounds = explode("; ", $playground->player_playground);
				for($i=0; $i < count($getPlaygrounds); $i++) { 
					$playgrounds = explode(" ", $getPlaygrounds[$i]);
					array_push($fireRecs, $playgrounds[0]);
				}
			}
		
			//Sort the array by rec name and how many times it was selected
			$orderArray = array_count_values($fireRecs);
			
			//Sort the array again to put the recs selected the most at the beginning
			uasort($orderArray, function ($a, $b) {
				if ($a==$b) return 0;
				return ($b<$a)?-1:1;
			});
			
			//Get the top 3 keys of the array and return them as the fire recs
			$fireRecs = array_keys($orderArray);
			
			//Add top 3 recs to an array
			//Return the top 3 array
			isset($fireRecs[0]) ? array_push($returnArray, $fireRecs[0]) : "";
			isset($fireRecs[1]) ? array_push($returnArray, $fireRecs[1]) : "";
			isset($fireRecs[2]) ? array_push($returnArray, $fireRecs[2]) : "";
			
			return $returnArray;
		
		} else {
			return false;
		}
	}
}
