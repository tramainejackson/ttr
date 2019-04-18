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

// Sub Domain
$domain = 'leagues.' . parse_url(config('app.url'), PHP_URL_HOST);

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
	// Player Videos Resources
	Route::get('videos/index', 'PlayerProfileController@index')->name('admin.videos.index');
	Route::post('videos/delete', 'PlayerProfileController@index')->name('admin.videos.delete');

	// Rec Centers Resources
	Route::get('recs/index', 'RecCenterController@index')->name('admin.recs.index');
	Route::get('recs/create', 'RecCenterController@create')->name('admin.recs.create');
	Route::get('recs/{rec}/edit', 'RecCenterController@edit')->name('admin.recs.edit');
	Route::post('recs/delete', 'RecCenterController@destroy');
	Route::post('recs/', 'RecCenterController@store');
	Route::patch('recs/{rec}', 'RecCenterController@update');

	// Players Resources
	Route::get('players/index', 'PlayerProfileController@index')->name('admin.players.index');
	Route::post('players/destroy', 'PlayerProfileController@destroy')->name('admin.players.destroy');

	// Leagues Resources
	Route::get('leagues/index', 'PlayerProfileController@index')->name('admin.leagues.index');
	Route::post('leagues/destroy', 'PlayerProfileController@destroy')->name('admin.leagues.destroy');

	// Writers Resources
	Route::get('writers/index', 'PlayerProfileController@index')->name('admin.writers.index');
	Route::post('writers/destroy', 'PlayerProfileController@destroy')->name('admin.writers.destroy');

	// News Resources
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

Route::domain($domain)->group(function () {
    Route::get('/', 'LeagueProfileController@show')->name('league.index');

    Route::get('league_profile/{league}', 'LeagueProfileController@show')->name('league.index');

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