<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class WriterProfile extends Model
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
    public function user()
    {
        return $this->belongsTo('App\User');
    }
	
	/**
	* Get the players profile photo.
	*/
    public function image()
    {
        return $this->hasOne('App\PlayerProfileImages');
    }
	
	/**
	* Get the writers post.
	*/
    public function post()
    {
        return $this->hasMany('App\News', 'writer_id');
    }
	
	/**
	* Get the players full name.
	*/
	public function full_name() {
		return $this->firstname . " " . $this->lastname;
	}
}
