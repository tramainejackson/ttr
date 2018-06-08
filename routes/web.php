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
    // return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@welcome')->name('welcome');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/about_us', 'HomeController@about')->name('about');

Route::resource('rec_centers', 'RecCenterController');

Route::post('rec_centers/search', 'RecCenterController@search');

Route::resource('players', 'PlayerProfileController');

Route::patch('players/{player}/playgounds', 'PlayerProfileController@update_playgrounds');

Route::patch('league_player/add_player_profile', 'LeaguePlayerController@add_player_profile');

Route::resource('leagues', 'LeagueProfileController');