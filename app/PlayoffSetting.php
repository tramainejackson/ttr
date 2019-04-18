<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlayoffSetting extends Model
{
    use SoftDeletes;
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
    ];
	
	/**
	* Get the seaon for the playoff settings object.
	*/
    public function season()
    {
        return $this->belongsTo('App\LeagueSeason', 'league_season_id');
    }
	
	/**
	* Get the games for the seasons playoffs.
	*/
    public function games()
    {
        return $this->belongsTo('App\LeagueSeason');
    }
}
