<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecCenter extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
	
	public function scopeSearch($query, $search) {
		return $query->where('name', 'like', '%' . $search . '%');
	}
	
	public static function get_rec_centers() {
		$recs = self::all();

		return $recs;
	}
}
