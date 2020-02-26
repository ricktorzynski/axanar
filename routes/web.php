<?php
/**
 * Web Routes
 */
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/**
 * Auth
 */
Auth::routes();

Route::get('password/change', 'Auth\ChangePasswordController@showChangeRequestForm')->name('password.change.request');
Route::post('password/change', 'Auth\ChangePasswordController@changePassword')->name('password.change.update');
Route::post('password/set', 'Auth\ChangePasswordController@setPassword')->name('password.change.set');
Route::post('password/select', 'Auth\RegisterController@updatePassword')->name('password.select.update');
Route::post('password/update', 'Auth\RegisterController@updatePassword')->name('password.update');
Route::get('password/email', 'AccountController@emailChange')->middleware('verified');
// Try new route
Route::post('password/newreset', 'Auth\ResetPasswordController@reset')->name('password.newreset');
Route::get('password/select', 'Auth\RegisterController@completePassword');
Route::get('password/complete', 'Auth\RegisterController@completePassword');
Route::post('password/complete', 'Auth\RegisterController@completePassword')->name('complete.password');

Route::get('password/activate', 'Auth\RegisterController@showActivateForm');
Route::post('password/activate', 'Auth\RegisterController@checkActivateEmail')->name('register.activate');
Route::match(['get', 'post'], 'auth/activate/{token?}/{tokenType?}', 'Auth\RegisterController@activateLinkClicked')
    ->name('auth.activate');

Route::get('register/new-donor', 'Auth\RegisterController@showNewDonorForm')->name('register.request');
Route::post('register/new-donor', 'Auth\RegisterController@checkEmail')->name('register.check');
Route::post('register/match', 'Auth\RegisterController@matchEmail')->name('register.match');

Route::get('register/thanks', 'Auth\RegisterController@showThanksLinkSent');


/**
 * Groups of routes that needs authentication to access.
 */
Route::group(array('before' => 'auth'), function() 
{

    Route::get('campaign',  array(
        'uses' => 'SiteController@campaign',
    ));

    // More Routes

});

/**
 * Root
 */
Route::get('/', 'SiteController@index');
Route::get('/faq', 'SiteController@faq');
Route::get('/dashboard', 'SiteController@dashboard')->name('dashboard');
Route::get('/logout', 'Auth\LoginController@logout');

    
// Route::get('/campaign', 'SiteController@campaign')->name('campaign');

Route::redirect('/home', '/');

/**
 * Groups
 */
Route::prefix('admin')->group(function () {
    Route::get('members', 'AdminController@members');
    Route::get('campaigns', 'AdminController@campaigns');
    Route::post('serverMembers', 'AdminController@apiMembers');
    Route::post('memberDetails', 'AdminController@apiMemberDetails');
    Route::get('formResetLink', 'AdminController@formResetLink')->name('formResetLink');
    Route::post('createResetLink', 'AdminController@createResetLink')->name('admin.createResetLink');
    Route::post('generateResetLink/{user_id}', 'AdminController@getNewPassResetUrl');
    Route::get('impersonate/{user_id}', 'AdminController@impersonateUser')->name('impersonate');
    Route::get('impersonate_leave', 'AdminController@impersonateUserLeave')->name('impersonate.leave');

    Route::prefix('fulfillment')->group(function () {
        Route::get('/', 'AdminController@fulfillmentDashboard');
        Route::get('item/{skuID}', 'AdminController@items');
        Route::get('item/{skuID}/shippingList', 'AdminController@getShippingList');
        Route::get('items/{skuID?}', 'AdminController@items');
        Route::post('item/{skuID}/setShipping', 'AdminController@apiSetShipping');

        Route::get('tiers', 'AdminController@tiers');
        Route::get('tier/{packageID}', 'AdminController@tier');
        Route::post('tier/{packageID}/setShipping', 'AdminController@apiSetShippingForPackage');
        Route::get('tier/{packageID}/shippingList', 'AdminController@getShippingListForPackage');
    });
});

Route::prefix('account')->group(function () {
    Route::get('shipping', 'AccountController@shipping')->middleware('verified');
    Route::post('shipping', 'AccountController@shipping')->middleware('verified');
    Route::get('email/change', 'AccountController@emailChange')->middleware('verified');
    Route::post('email/change', 'AccountController@emailChange')->middleware('verified')->name('account.email.change');
});

Route::prefix('vault')->group(function () {
    Route::get('asset/{hash}', 'VaultController@asset')->middleware('verified');
    Route::get('assets/{campaignId}', 'VaultController@index')->middleware('verified');
});


