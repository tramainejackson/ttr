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

// Domain
$domain = parse_url(config('app.url'), PHP_URL_HOST);

// Sub Domain
$sub_domain = 'leagues.' . parse_url(config('app.url'), PHP_URL_HOST);

// Route::get('/test', function () {
// 	return view('auth.passwords.reset', compact('token'));
// });

Auth::routes();

/* Overwrite the default login controller */
Route::post('/login', 'Auth\LoginController@authenticate');
Route::get('/login', 'Auth\LoginController@index')->name('login');
Route::get('/login/{user}', 'Auth\LoginController@ttr_user');
Route::get('/register', 'Auth\RegisterController@index')->name('register');
/* Overwrite the default login controller */

// Home site Web Directs
Route::domain($domain)->group(function () {

	Route::get('/', 'HomeController@welcome')->name('welcome');

	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('/about_us', 'HomeController@about')->name('about');

	Route::resource('/rec_centers', 'RecCenterController');

	Route::resource('/players', 'PlayerProfilesController');

	Route::resource('/leagues', 'LeagueProfilesController');

	Route::resource('/leagues_team', 'LeagueTeamsController');

	Route::resource('/leagues_player', 'LeaguePlayersController');

	Route::resource('/writers', 'WritersProfileController');

	Route::resource('/clips', 'VideosController');

	Route::resource('/news', 'NewsArticleController');

	Route::resource('/messages', 'MessagesController');

	Route::patch('/players/{player}/playgounds', 'PlayerProfilesController@update_playgrounds');

	Route::post('/player_images/{player}', 'PlayerProfilesController@update_player_image');

	Route::post('/player_highlights/{player}', 'PlayerProfilesController@add_player_highlight');

	Route::delete('/highlight_remove/{video}', 'PlayerProfilesController@remove_video');

	Route::post('/players/search', 'PlayerProfilesController@search')->name('players.search');

	Route::patch('/league_player/add_player_profile', 'LeaguePlayersController@add_player_profile');

	Route::get('/league_player/team/{league_team}/edit', 'LeaguePlayersController@team_edit')->name('captain_profile');

	Route::post('/leagues/search', 'LeagueProfilesController@search')->name('leagues.search');

	Route::post('/news/search', 'NewsArticleController@search')->name('news.search');

	Route::post('/rec_centers/search', 'RecCenterController@search');
});

// Sub Domain Web Directs
Route::domain($sub_domain)->namespace('Leagues')->group(function () {
	Route::get('/', 'HomeController@about')->name('leagues_home');

	Route::get('/home', 'HomeController@index')->name('leagues_home');

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

	Route::resource('league_profile', 'LeagueProfilesController');

	Route::resource('league_season', 'LeagueSeasonController');

	Route::post('create_playoffs', 'LeagueSeasonController@create_playoffs');

	Route::post('complete_season', 'LeagueSeasonController@complete_season');

	Route::get('league_profile/{league}/{season}', 'LeagueProfilesController@show_season')->name('league_profile.season');
});

// Administrator Web Directs
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
	Route::resource('messages', 'MessagesController');
	Route::resource('videos', 'VideosController');
	Route::resource('recs', 'RecCenterController');
	Route::resource('leagues', 'LeagueProfilesController');
	Route::resource('writers', 'WritersProfileController');
	Route::resource('news', 'NewsArticleController');
	Route::resource('players', 'PlayerProfilesController');
});