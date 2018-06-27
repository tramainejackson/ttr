<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class News extends Model
{
	use SoftDeletes;
	
	/**
	* Get the writer profile for the news article.
	*/
    public function writer()
    {
        return $this->belongsTo('App\WriterProfile');
    }
	
	public function scopeRecentPost($query, $exclude=null) {
		$date = Carbon::now()->subMonth();
		
		$post = $query->where([
			['created_at', '>', $date],
			['publish', '=', 'Y'],
			['show_post', '=', 'Y'],
			['id', '<>', $exclude]
		])
		->orderBy('created_at', 'desc')
		->get();

		return $post;
	}
}
