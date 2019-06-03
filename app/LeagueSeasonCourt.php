<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\LeagueSchedule;

class LeagueSeasonCourt extends Model
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
		'court_description', 'court_location',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'league_season_id',
	];

	/**
	 * Get the season for the court object.
	 */
	public function season()
	{
		return $this->belongsTo('App\LeagueSeason');
	}

	/**
	 * Get the league for the team object.
	 */
	public function playoffs()
	{
		return $this->hasOne('App\PlayoffSetting');
	}

	/**
	 * Get the teams for the selected season.
	 */
	public function league_teams()
	{
		return $this->hasMany('App\LeagueTeam');
	}

	/**
	 * Get the contact for the media object.
	 */
	public function league_players()
	{
		return $this->hasMany('App\LeaguePlayer');
	}

	/**
	 * Get the stats for the league season object.
	 */
	public function stats()
	{
		return $this->hasMany('App\LeagueStat');
	}

	/**
	 * Get the games for the league season object.
	 */
	public function games()
	{
		return $this->hasMany('App\LeagueSchedule');
	}

	/**
	 * Get the games for the league season object.
	 */
	public function standings()
	{
		return $this->hasMany('App\LeagueStanding');
	}

	/**
	 * Get the pictures for the league season object.
	 */
	public function pictures()
	{
		return $this->hasMany('App\LeaguePicture');
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
