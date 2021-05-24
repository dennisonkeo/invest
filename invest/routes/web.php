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

Route::get('registration', function () {
    return view('user.index');
});


// Route::get('password-forgot', 'AdminHomeController@forgotPasswordPage')->name('password-forgot');
Route::post('register', 'UsersController@createUser')->name('register');
Route::post('login', 'UsersController@login')->name('login');
Route::get('logout', 'UsersController@logout')->name('logout');
Route::get('login', 'UsersController@loginPage')->name('login');
Route::get('register/{username?}', 'UsersController@register')->name('register');
Route::get('password-reset', 'UsersController@resetPass')->name('password-reset');
Route::post('sendPass', 'UsersController@sendPass')->name('sendPass');
Route::get('/', 'UsersController@homePage')->name('/');


Route::group(['middleware' => ['auth']], function () {

Route::get('dashboard', 'UsersController@index')->name('dashboard');
Route::get('add-package', 'UsersController@packages')->name('add-package');
Route::get('packages', 'UsersController@userPackages')->name('packages');
Route::get('referrals', 'UsersController@referrals')->name('referrals');
Route::get('deposit-history', 'UsersController@deposits')->name('deposit-history');
Route::get('withdrawal-history', 'UsersController@withdrawals')->name('withdrawal-history');
Route::get('investment-history', 'UsersController@investments')->name('investment-history');
Route::post('addPackages', 'UsersController@addPackages')->name('addPackages');
Route::post('mpesaDeposit', 'UsersController@mpesaDeposit')->name('mpesaDeposit');
Route::post('packageSub', 'UsersController@packageSub')->name('packageSub');
Route::post('transferFunds', 'UsersController@transferFunds')->name('transferFunds');
Route::post('withdrawFunds', 'UsersController@withdrawFunds')->name('withdrawFunds');
Route::get('profile', 'UsersController@profile')->name('profile');
Route::get('referral', 'UsersController@referral')->name('referral');



Route::get('admin-dashboard', 'AdminUserController@index')->name('admin-dashboard')->middleware(['adminOnly']);
Route::get('withdrawals', 'AdminUserController@withdrawals')->name('withdrawals')->middleware(['adminOnly']);
Route::get('deposits', 'AdminUserController@deposits')->name('deposits')->middleware(['adminOnly']);
Route::get('registered-users', 'AdminUserController@users')->name('registered-users')->middleware(['adminOnly']);
Route::get('getUser/{id}', 'AdminUserController@getUser')->name('getUser')->middleware(['adminOnly']);
Route::get('getPackage/{id}', 'AdminUserController@getPackage')->name('getPackage')->middleware(['adminOnly']);
Route::put('resetUserPass', 'AdminUserController@resetUserPass')->name('resetUserPass')->middleware(['adminOnly']);
Route::put('changeUplink', 'AdminUserController@changeUplink')->name('changeUplink')->middleware(['adminOnly']);
Route::get('deleteUser/{user}', 'AdminUserController@deleteUser')->name('deleteUser')->middleware(['adminOnly']);
Route::get('deletePackage/{package}', 'AdminUserController@deletePackage')->name('deletePackage')->middleware(['adminOnly']);
Route::put('updateUser', 'AdminUserController@updateUser')->name('updateUser')->middleware(['adminOnly']);
Route::put('updatePackage', 'AdminUserController@updatePackage')->name('updatePackage')->middleware(['adminOnly']);
Route::get('quick-search', 'AdminUserController@quickSearch')->name('quick-search')->middleware(['adminOnly']);
Route::put('depositForUser', 'AdminUserController@depositForUser')->name('depositForUser')->middleware(['adminOnly']);
Route::get('completed/{id}', 'AdminUserController@completed')->name('completed')->middleware(['adminOnly']);
Route::get('pending/{id}', 'AdminUserController@pending')->name('pending')->middleware(['adminOnly']);


});
