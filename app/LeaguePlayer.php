<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaguePlayer extends Model
{
    use SoftDeletes;

	/**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
    ];
	
	/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id',
    ];
	
	/**
	* Get the contact for the media object.
	*/
    public function player_profile()
    {
        return $this->belongsTo('App\PlayerProfile', 'player_profile_id');
    }
	
	/**
	* Get the contact for the media object.
	*/
    public function team()
    {
        return $this->belongsTo('App\LeagueTeam', 'league_team_id');
    }
	
	/**
	* Get the league for the team object.
	*/
    public function league_profile()
    {
        return $this->belongsTo('App\LeagueProfile');
    }
	
	/**
	* Get the league for the team object.
	*/
    public function season()
    {
        return $this->belongsTo('App\LeagueSeason', 'league_season_id');
    }
	
	/**
	* Get the players stats for the season object.
	*/
    public function stats()
    {
        return $this->hasMany('App\LeagueStat');
    }
	
	/**
	* Get the players stats for the season object.
	*/
    public function scopeLeagueLink($query, $email, $player_id)
    {
        return $query->where([
	        ['email', $email],
	        ['player_profile_id', $player_id],
	        ['player_profile_accepted', null]
        ])->get();
    }

	/**
	* Get the players stats for the season object.
	*/
    public function scopeDuplicate($query, $email)
    {
        return $query->where([
			['email', $email],
		])->get();
    }
	
	/**
	* Get the players stats for the season object.
	*/
    public function scopeAcceptedLeague($query)
    {
        return $query->where([
			['player_profile_accepted', 'Y'],
		])->get();
    }
}
