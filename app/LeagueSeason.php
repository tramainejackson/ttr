<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeagueSeason extends Model
{
    use SoftDeletes;
	
	/**
	* Get the league for the season object.
	*/
    public function league()
    {
        return $this->belongsTo('App\LeagueProfile', 'league_profile_id');
    }
	
	/**
	* Get the standings for the season object.
	*/
    public function standings()
    {
        return $this->hasMany('App\LeagueStanding');
    }
	
	/**
	* Get the contact for the media object.
	*/
    public function teams()
    {
        return $this->hasMany('App\LeagueTeam');
    }
	
	/**
	* Get the players for the season object.
	*/
    public function players()
    {
        return $this->hasMany('App\LeaguePlayer');
    }

	/**
	* Get the league for the team object.
	*/
    public function stats()
    {
        return $this->hasMany('App\LeagueStat');
    }
	
		/**
     * Scope a query to only include active seasons.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeActive($query)
    {
        return $query->where('active', 'Y');
    }
	
	/**
     * Scope a query to only include active seasons.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeCompleted($query)
    {
        return $query->where([
			['completed', 'Y'],
			['active', 'N'],
		]);
    }
	
}
