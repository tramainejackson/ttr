<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
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
        'username', 'email', 'password',
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
	* Get the player profile for the user object.
	*/
    public function player()
    {
        return $this->hasOne('App\PlayerProfile');
    }
	
	/**
	* Get the league profile for the user object.
	*/
    public function league()
    {
        return $this->hasOne('App\LeagueProfile');
    }
	
	/**
	* Get the league writer for the user object.
	*/
    public function writer()
    {
        return $this->hasOne('App\WriterProfile');
    }
}
