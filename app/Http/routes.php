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
 * Profile routes
 */

Route::get('/create-profile', 'ProfileController@create');

Route::post('/preview-profile', 'ProfileController@preview');

Route::get('/photo', 'ProfileController@photo');

Route::post('/upload', 'ProfileController@upload');



/**
 * Adverts routes
 */
Route::resource('adverts', 'AdvertsController');

Route::get('/adverts/{id}/{job_title}', 'AdvertsController@show');

Route::post('adverts/preview', 'AdvertsController@preview');

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

/**
* Subcription routes
*/
Route::get('/plans', 'SubscribeController@plans');
Route::get('/subscribe', 'SubscribeController@subscribe');
Route::post('/checkout', 'SubscribeController@checkout');
Route::get('/invoices', 'SubscribeController@invoices');
Route::get('/invoices/download/{invoiceId}', 'SubscribeController@download');

/**
* Webhook routes
*/
Route::post('braintree/webhook', '\Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook');

/**
* Payment routes
*/
Route::get('/status', 'StatusController@status');
Route::get('/cancel', 'StatusController@cancel');
Route::get('/resume', 'StatusController@resume');


