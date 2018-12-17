<?php

// Route::get('/', 'PagesController@home');

// Route::get('/launch', 'PagesController@launch');

// Route::get('/time', 'HomeController@time');

// Route::auth();

/**
 * Home-Dashboard routes
 */

Route::get('/terms', 'HomeController@terms');

Route::get('/dashboard', 'HomeController@dashboard');

Route::get('/account', 'HomeController@account');

Route::get('/account/edit', 'HomeController@accountEdit');

Route::post('/account/update', 'HomeController@accountUpdate');

Route::get('/avatar', 'HomeController@avatar');

Route::post('/avatar/upload', 'HomeController@uploadAvatar');

Route::delete('/avatar/remove', 'HomeController@remove');

// email verification page
Route::get('/request/verification', 'HomeController@requestToken');

Route::get('/send/verification', 'HomeController@sendRequestedToken');

// contact verification page
Route::get('/contact/verification', 'HomeController@contact');

// ajax post request (User Side)
Route::post('/request/contact/code', 'HomeController@sendContactToken');

Route::post('/update/contact', 'HomeController@updateContact');

// verify contact
Route::post('/verify/contact', 'HomeController@verifyContact');

/**
 * Register routes
 */
Route::get('/register', 'RegistrationController@register');

Route::post('/register', 'RegistrationController@postRegister');

/**
 * Email Validation routes
 */
Route::get('/request/link', 'RegistrationController@getToken');

Route::post('/send/link', 'RegistrationController@sendToken');

Route::get('/sent/message', 'RegistrationController@sent');

Route::get('/register/verify/{verification_code}', 'RegistrationController@verify');

Route::get('/verify/status', 'RegistrationController@verifyStatus');

/**
 * Password Reset routes
 */
Route::get('/password/reset', 'PasswordResetController@getEmail');

Route::post('/password/send', 'PasswordResetController@sendResetLink');

Route::get('/password/reset/{reset_token}', 'PasswordResetController@getNewPassword');

Route::post('/password/reset', 'PasswordResetController@updatePassword');

/**
 * Login Session routes
 */
Route::get('/login', 'SessionsController@login');

Route::post('/login', 'SessionsController@postLogin');

Route::get('/logout', 'SessionsController@logout');

/**
 * Social routes
 */
Route::get('/redirect', 'SocialAuthController@redirect');

Route::get('/callback', 'SocialAuthController@callback');

/**
 * Assign Roles routes
 */
Route::get('/choose', 'TypeController@choose');

Route::post('/set', 'TypeController@assignType');

/**
 * Company Profile routes
 */
Route::get('/company/create', 'CreateCompanyController@create');

Route::post('/company/store', 'CreateCompanyController@store');

Route::get('/company/{id}/{business_name}', 'CompanyProfileController@profile')->name('company');

Route::get('/company/edit', 'CompanyProfileController@edit');

Route::post('/company/update', 'CompanyProfileController@update');

Route::get('/logo', 'CompanyProfileController@logo');

Route::post('/upload/logo', 'CompanyProfileController@uploadLogo');

Route::delete('/logo/{logo_id}', 'CompanyProfileController@remove');

Route::get('/company/{id}/{business_name}/review', 'CompanyProfileController@companyReview');

Route::get('/adverts', 'CompanyProfileController@myAdvert');

Route::get('/advert/{id}/job/requests/all', 'CompanyProfileController@allList');

Route::get('/advert/{id}/job/requests/pending', 'CompanyProfileController@pendingList');

Route::get('/advert/{id}/job/requests/rejected', 'CompanyProfileController@rejectedList');

Route::get('/advert/{id}/job/requests/accepted', 'CompanyProfileController@acceptedList');

Route::get('/advert/{id}/job/requests/{application_id}', 'CompanyProfileController@appliedApplicantInfo');

Route::post('/advert/job/requests/{id}/response', 'CompanyProfileController@response');

Route::post('/profile/{id}/rate', 'CompanyProfileController@rate');

// ajax post url (Employer side)
Route::post('/viewed/applicant', 'CompanyProfileController@setAsReceived');

/**
 * Job Seeker Profile routes
 */
Route::get('/profile/create', 'CreateProfileController@create');

Route::post('/profile/store', 'CreateProfileController@store');

Route::get('/profile/{id}', 'JobSeekerProfileController@profileInfo')->name('jobSeeker');

Route::get('/profile/info/edit', 'JobSeekerProfileController@edit');

Route::post('/profile/edit/update', 'JobSeekerProfileController@update');

Route::get('/profile/{id}/review', 'JobSeekerProfileController@jobSeekerReview');

Route::post('/company/{id}/{business_name}/rate', 'JobSeekerProfileController@rate');

Route::get('/my/applications', 'JobSeekerProfileController@allList');

Route::get('/my/applications/pending', 'JobSeekerProfileController@pendingList');

Route::get('/my/applications/rejected', 'JobSeekerProfileController@rejectList');

Route::get('/my/applications/accepted', 'JobSeekerProfileController@acceptList');

Route::get('/my/applications/{app_id}', 'JobSeekerProfileController@appInfo');

Route::get('/preferred-category', 'JobSeekerProfileController@preferCategory');

Route::post('/selected-category', 'JobSeekerProfileController@getCategory');

// ajax post url (Job Seeker side)
Route::post('/viewed', 'JobSeekerProfileController@requestViewed');

Route::post('/viewed/category', 'JobSeekerProfileController@setAsViewed');

/**
 * Adverts routes
 */
Route::resource('/', 'AdvertsController');

Route::get('/home', 'AdvertsController@index');

Route::get('/adverts/create', 'AdvertsController@create');

Route::post('/adverts/publish', 'AdvertsController@publish');

Route::post('/adverts/unpublish', 'AdvertsController@unpublish');

Route::get('/adverts/{id}/{job_title}', 'AdvertsController@show')->name('show');

// Route::post('adverts/preview', 'AdvertsController@preview');

Route::get('adverts/{id}/{job_title}/edit', 'AdvertsController@edit');

Route::post('adverts/{id}/{job_title}/edit/update', 'AdvertsController@update');

/**
* Job Seeker Apply Advert routes
*/
Route::get('/adverts/{id}/{job_title}/apply', 'ApplyController@apply');

Route::post('/adverts/{id}/{job_title}/apply/add', 'ApplyController@storeApply');

/**
* Subscription routes
*/
Route::get('/plans', 'SubscribeController@plans');

Route::get('/choose/plan/{id}', 'SubscribeController@choosePlan')->name('plan');

Route::post('/choose/plan/{id}', 'SubscribeController@setPlan');

Route::get('/checkout/{id}', 'SubscribeController@checkout')->name('checkout');

Route::post('/process/{id}', 'SubscribeController@charge');

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

/**
* Admin routes
*/
Route::get('/a/primary/register', 'Admin\AdminRegistrationController@register');

Route::post('/a/primary/register', 'Admin\AdminRegistrationController@postRegister');

Route::get('/a/login', 'Admin\AdminSessionsController@login');

Route::post('/a/login', 'Admin\AdminSessionsController@postLogin');

Route::get('/a/logout', 'Admin\AdminSessionsController@logout');

Route::get('/a/dashboard', 'Admin\AdminController@dashboard');

Route::get('/a/advert/create', 'Admin\AdminController@create');

Route::post('/a/advert/create', 'Admin\AdminController@store');

Route::post('/a/advert/publish', 'Admin\AdminController@publish');

Route::post('/a/advert/unpublish', 'Admin\AdminController@unpublish');

Route::get('/a/advert/{id}/{job_title}/logo/upload', 'Admin\AdminController@logo')->name('logo');

Route::post('/a/advert/{id}/{job_title}/logo/store', 'Admin\AdminController@uploadLogo');

Route::delete('/a/advert/{id}/{job_title}/logo/remove', 'Admin\AdminController@removeLogo');

Route::get('/a/advert/{id}/{job_title}/edit', 'Admin\AdminController@edit');

Route::post('/a/advert/{id}/{job_title}/update', 'Admin\AdminController@update');

Route::get('/a/advert/{id}/{job_title}/change/owner', 'Admin\AdminController@owner');

Route::post('/a/advert/{id}/{job_title}/change/owner', 'Admin\AdminController@changeOwner');

Route::get('/a/advert/change/owner', 'Admin\AdminController@owner');

Route::get('/a/activity/history', 'Admin\AdminController@history');

Route::get('/a/advert/{id}/{job_title}/requests/all', 'Admin\AdminController@allList');

Route::get('/a/advert/{id}/{job_title}/requests/pending', 'Admin\AdminController@pendingList');

Route::get('/a/advert/{id}/{job_title}/requests/rejected', 'Admin\AdminController@rejectedList');

Route::get('/a/advert/{id}/{job_title}/requests/accepted', 'Admin\AdminController@acceptedList');

Route::get('/a/advert/{id}/job/requests/{application_id}', 'Admin\AdminController@applicantInfo');

Route::post('/a/job/requests/{application_id}/response', 'Admin\AdminController@response');

/**
* Admin profile routes
*/
Route::get('/a/company/{id}/{business_name}', 'Admin\AdminProfileController@profile')->name('admin_profile');

Route::get('/a/company/edit', 'Admin\AdminProfileController@edit');

Route::post('/a/company/update', 'Admin\AdminProfileController@update');

Route::get('/a/company/logo', 'Admin\AdminProfileController@logo');

Route::post('/a/company/upload/logo', 'Admin\AdminProfileController@uploadLogo');

Route::delete('/a/company/remove/logo', 'Admin\AdminProfileController@remove');

/*
 * ------------------------------------------------------------------------------------------
 * Admin profile routes
 * ------------------------------------------------------------------------------------------
 *
 */

Route::get('/api/list/all', 'APIHomeController@index')->name('api_all');


