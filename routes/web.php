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

/* Overwrite the default login controller */
Route::post('/login', 'Auth\LoginController@authenticate');
Route::get('/login', 'Auth\LoginController@index')->name('login');
Route::get('/login/{user}', 'Auth\LoginController@ttr_user');
Route::get('/register', 'Auth\RegisterController@index')->name('register');
/* Overwrite the default login controller */

Route::domain($domain)->namespace('Leagues')->group(function () {
	/* Overwrite the default login controller */
	Route::post('/login', 'Auth\LoginController@authenticate');
	Route::get('/login/{user}', 'Auth\LoginController@ttr_user');
	/* Overwrite the default login controller */

	Route::get('/', 'HomeController@about')->name('leagues_home');

	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('/test_drive', 'HomeController@test_drive')->name('test_drive');

	Route::post('/remove_test_drive', 'HomeController@remove_test_drive')->name('remove_test_drive');

	Route::post('/home', 'HomeController@store');

	Route::get('/archives/{season}', 'HomeController@archive')->name('archives');

	Route::get('/league_standings', 'HomeController@standings')->name('league_standings');

	Route::get('/league_info', 'HomeController@info')->name('league_info');

	Route::post('/league_schedule/add_game/', 'LeagueScheduleController@add_game');

	Route::post('/league_schedule/add_week/', 'LeagueScheduleController@add_week');

	Route::patch('/league_schedule/{week}/', 'LeagueScheduleController@update_week');

	Route::delete('/league_schedule/{week}/', 'LeagueScheduleController@delete_week');

	Route::get('/edit_playoffs/playins/', 'LeagueScheduleController@edit_playins')->name('edit_playins');

	Route::get('/edit_playoffs/round/{round}', 'LeagueScheduleController@edit_round')->name('edit_round');

	Route::post('/edit_playoffs/', 'LeagueScheduleController@update_playoff_week')->name('update_playoff_week');

	Route::delete('/delete_game/{league_schedule}/', 'LeagueScheduleController@delete_game');

	Route::patch('/update_game/', 'LeagueScheduleController@update_game');

	Route::get('/league_stat', 'LeagueStatController@index')->name('league_stat.index');

	Route::get('league_stat/edit_week/{week}', 'LeagueStatController@edit_week')->name('league_stat.edit_week');

	Route::get('league_stat/edit_round/{round}', 'LeagueStatController@edit_round')->name('league_stat.edit_round');

	Route::patch('league_stat/edit_week/{week}', 'LeagueStatController@update');

	Route::resource('league_schedule', 'LeagueScheduleController');

	Route::resource('league_players', 'LeaguePlayerController');

	Route::resource('league_teams', 'LeagueTeamController');

	Route::resource('league_pictures', 'LeaguePictureController');

	Route::resource('league_profile', 'LeagueProfileController');

	Route::resource('league_season', 'LeagueSeasonController');

	Route::post('create_playoffs', 'LeagueSeasonController@create_playoffs');

	Route::post('complete_season', 'LeagueSeasonController@complete_season');

	Route::get('league_profile/{league}/{season}', 'LeagueProfileController@show_season')->name('league_profile.season');
});

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

Route::patch('/players/{player}/playgounds', 'PlayerProfileController@update_playgrounds');

Route::post('/player_images/{player}', 'PlayerProfileController@update_player_image');

Route::post('/player_highlights/{player}', 'PlayerProfileController@add_player_highlight');

Route::delete('/highlight_remove/{video}', 'PlayerProfileController@remove_video');

Route::post('/players/search', 'PlayerProfileController@search')->name('players.search');

Route::patch('/league_player/add_player_profile', 'LeaguePlayerController@add_player_profile');

Route::post('/leagues/search', 'LeagueProfileController@search')->name('leagues.search');

Route::post('/news/search', 'NewsController@search')->name('news.search');

Route::post('/rec_centers/search', 'RecCenterController@search');