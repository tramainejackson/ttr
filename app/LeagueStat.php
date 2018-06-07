<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class LeagueStat extends Model
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
	* Get the league for the team object.
	*/
    public function league()
    {
        return $this->belongsTo('App\LeagueProfile');
    }
	
	/**
	* Get the contact players the team object.
	*/
    public function player()
    {
        return $this->belongsTo('App\LeaguePlayer');
    }
	
	/**
	* Scope a query to get the players formatted stats for the league.
	*/
	public function scopePlayerSeasonStats($query) {
		return $query->select(DB::raw(self::get_formatted_stats()))
		->groupBy('league_player_id')
		->orderBy('TPTS', 'desc');
	}
	
	/** 
	* Format the retrieved stats
	**/
	public static function get_formatted_stats() {
		$format = "*, FORMAT(SUM(points)/SUM(game_played), 1) AS PPG,
			FORMAT(SUM(threes_made)/SUM(game_played), 1) AS TPG,
			FORMAT(SUM(ft_made)/SUM(game_played), 1) AS FTPG,
			FORMAT(SUM(assist)/SUM(game_played), 1) AS APG,
			FORMAT(SUM(rebounds)/SUM(game_played), 1) AS RPG,
			FORMAT(SUM(steals)/SUM(game_played), 1) AS SPG,
			FORMAT(SUM(blocks)/SUM(game_played), 1) AS BPG,
			SUM(points) AS TPTS,
			SUM(threes_made) AS TTHR,
			SUM(ft_made) AS TFTS,
			SUM(assist) AS TASS,
			SUM(rebounds) AS TRBD,
			SUM(steals) AS TSTL,
			SUM(blocks) AS TBLK
		";
			
		return $format;
	}
}
