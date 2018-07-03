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

Route::resource('rec_centers', 'RecCenterController');

Route::resource('players', 'PlayerProfileController');

Route::resource('leagues', 'LeagueProfileController');

Route::resource('writers', 'WriterProfileController');

Route::resource('clips', 'VideoController');

Route::resource('news', 'NewsController');

Route::patch('players/{player}/playgounds', 'PlayerProfileController@update_playgrounds');

Route::post('player_images/{player}', 'PlayerProfileController@update_player_image');

Route::post('player_highlights/{player}', 'PlayerProfileController@add_player_highlight');

Route::delete('highlight_remove/{video}', 'PlayerProfileController@remove_video');

Route::post('players/search', 'PlayerProfileController@search')->name('players.search');

Route::patch('league_player/add_player_profile', 'LeaguePlayerController@add_player_profile');

Route::post('leagues/search', 'LeagueProfileController@search')->name('leagues.search');

Route::post('news/search', 'NewsController@search')->name('news.search');

Route::post('rec_centers/search', 'RecCenterController@search');

Route::domain('leagues.totherec.com')->group(function () {
    Route::get('/{league}', function ($league) {
        //
    })->name('league.index');
	
	Route::get('/{league}/{season}', function ($league, $season) {
        //
    })->name('season.show');
});
