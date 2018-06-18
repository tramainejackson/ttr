<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class PlayerProfileVideos extends Model
{
    use SoftDeletes;
	
	/**
	* Get the player profle for the player video object.
	*/
    public function player()
    {
        return $this->belongsTo('App\PlayerProfile', 'player_profile_id');
    }
	
	/**
	* Get the player profle for the player video object.
	*/
    public function uploaded()
    {
		$date = new Carbon($this->created_at);
        return $date->format('m/d/Y');;
    }
}
