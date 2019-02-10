<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/test', function () {
    // return view('home');
// });

Auth::routes();

Route::get('/', 'HomeController@welcome')->name('welcome');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/about_us', 'HomeController@about')->name('about');

Route::resource('/rec_centers', 'RecCenterController');

Route::resource('/players', 'PlayerProfileController');

Route::resource('/leagues', 'LeagueProfileController');

Route::resource('/writers', 'WriterProfileController');

Route::resource('/clips', 'VideoController');

Route::resource('/news', 'NewsController');

Route::resource('/messages', 'MessageController');

Route::namespace('Admin')->prefix('admin')->group(function () {
	Route::get('videos/index', 'PlayerProfileController@index')->name('admin.videos.index');
	Route::post('videos/delete', 'PlayerProfileController@index')->name('admin.videos.delete');
	Route::get('recs/index', 'RecCenterController@index')->name('admin.recs.edit');
	Route::get('recs/create', 'RecCenterController@create')->name('admin.recs.create');
	Route::post('recs/delete', 'RecCenterController@destroy');
	Route::get('players/index', 'PlayerProfileController@index')->name('admin.players.index');
	Route::post('players/destroy', 'PlayerProfileController@destroy')->name('admin.players.destroy');
	Route::get('leagues/index', 'PlayerProfileController@index')->name('admin.leagues.index');
	Route::post('leagues/destroy', 'PlayerProfileController@destroy')->name('admin.leagues.destroy');
	Route::get('writers/index', 'PlayerProfileController@index')->name('admin.writers.index');
	Route::post('writers/destroy', 'PlayerProfileController@destroy')->name('admin.writers.destroy');
	Route::get('news/index', 'PlayerProfileController@index')->name('admin.news.index');
	Route::post('news/destroy', 'PlayerProfileController@destroy')->name('admin.news.destroy');
});

Route::patch('/players/{player}/playgounds', 'PlayerProfileController@update_playgrounds');

Route::post('/player_images/{player}', 'PlayerProfileController@update_player_image');

Route::post('/player_highlights/{player}', 'PlayerProfileController@add_player_highlight');

Route::delete('/highlight_remove/{video}', 'PlayerProfileController@remove_video');

Route::post('/players/search', 'PlayerProfileController@search')->name('players.search');

Route::patch('/league_player/add_player_profile', 'LeaguePlayerController@add_player_profile');

Route::post('/leagues/search', 'LeagueProfileController@search')->name('leagues.search');

Route::post('/news/search', 'NewsController@search')->name('news.search');

Route::post('/rec_centers/search', 'RecCenterController@search');

Route::domain('leagues.totherec.com')->group(function () {
    Route::get('league_profile/{league}', function ($league) {
		
    })->name('league.index');
	
	Route::get('league_profile/{league}/{season}', function ($league, $season) {
        //
    })->name('season.show');
	
	Route::get('/{picture}', function ($picture) {
        //
    })->name('sub_photo');
	
	Route::get('login/{user}', function ($user) {
        return Auth::user();
    })->name('sub_profile');
});
