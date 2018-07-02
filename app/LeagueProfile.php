<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class LeagueProfile extends Model
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
	* Get the seasons for the league object.
	*/
    public function seasons()
    {
        return $this->hasMany('App\LeagueSeason');
    }
	
	/**
	* Get the players for the league object.
	*/
    public function players()
    {
        return $this->hasMany('App\LeaguePlayer');
    }
	
	/**
	* Get the team for the league object.
	*/
    public function teams()
    {
        return $this->hasMany('App\LeagueTeam');
    }
	
	/**
	* Get the standings for the league object.
	*/
    public function standings()
    {
        return $this->hasMany('App\LeagueStanding');
    }
	
	/**
	* Get the standings for the league object.
	*/
    public function stats()
    {
        return $this->hasMany('App\LeagueStat');
    }
	
	/**
	* Get the standings for the league object.
	*/
    public function comps()
    {
		if($this->comp != null) {
			return explode(' ', $this->comp);
		} else {
			return collect();
		}
    }
	
	/**
	* Get the standings for the league object.
	*/
    public function ages()
    {
		if($this->age != null) {
			return explode(' ', $this->age);
		} else {
			return collect();
		}
    }

	public function scopeSearch($query, $search) {
		$players = $query->where('name', 'like', '%' . $search . '%')
			->orWhere('commish', 'like', '%' . $search . '%')
			->orWhere('address', 'like', '%' . $search . '%')
			->orWhere('phone', 'like', '%' . $search . '%')
			->get();

		return $players;
	}

	public function scopeFilter($query, $filter) {
		$leagues = $query->where('age', 'like', '%'. $filter . '%')
			->get();

		return $leagues;
	}
}
