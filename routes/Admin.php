<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
use Illuminate\Http\Request;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json; charset=UTF-8', true);


/** Start Auth Route **/

Route::middleware('auth:api-Admin')->group(function () {
    //Auth_private
    Route::prefix('Auth_private')->group(function()
    {
        Route::post('/change_password', 'AuthController@change_password')->name('Auth.change_password');
        Route::post('/edit_profile', 'AuthController@edit_profile')->name('Auth.edit_profile');
        Route::get('/my_info', 'AuthController@my_info')->name('Auth.my_info');
        Route::post('/logout', 'AuthController@logout')->name('user.logout');
    });


});
/** End Auth Route **/

/** Auth_general */

Route::prefix('Auth_general')->group(function()
{
    Route::post('/login', 'AuthController@login')->name('Auth.login');
    Route::post('/forget_password', 'AuthController@forget_password')->name('Auth.forget_password');
    Route::post('/reset_password', 'AuthController@reset_password')->name('Auth.reset_password');
});
