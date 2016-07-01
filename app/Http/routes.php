<?php

// Route::get('/', 'PagesController@home');

// Route::get('/launch', 'PagesController@launch');



Route::auth();

Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@index');

Route::get('/redirect', 'SocialAuthController@redirect');

Route::get('/callback', 'SocialAuthController@callback');

/**
 * Assign Roles routes
 */
Route::get('/choose', 'TypeController@type');

Route::post('/set', 'TypeController@assignType');

/**
 * Adverts routes
 */
Route::resource('adverts', 'AdvertsController');

Route::get('/adverts/{id}/{job_title}', 'AdvertsController@show');

/**
 * Adverts edit routes
 */
Route::get('adverts/{id}/{job_title}/edit', 'AdvertsController@edit');
Route::post('adverts/{id}/{job_title}/edit/update', 'AdvertsController@update');

/**
* Advert's Job Seeker Apply routes
*/
Route::get('/adverts/{id}/{job_title}/apply', 'ApplyController@apply');

Route::post('/adverts/{id}/{job_title}/apply/add', 'ApplyController@storeApply');
