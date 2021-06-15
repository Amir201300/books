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



        /**Author*/
            Route::post('/add_Author','AuthorController@add_Author')->name('Author.add_Author');
            Route::post('/edit_Author/{Author_id}','AuthorController@edit_Author')->name('Author.edit_Author');
            Route::post('/delete_Author/{Author_id}','AuthorController@delete_Author')->name('Author.delete_Author');
            Route::post('/All_Authors','AuthorController@All_Authors')->name('Author.All_Authors');
            Route::post('/single_Author/{Author_id}','AuthorController@single_Author')->name('Author.single_Author');


        /**Slider*/
        Route::post('/add_Slider','SliderController@add_Slider')->name('Slider.add_Slider');
        Route::post('/edit_Slider/{Slider_id}','SliderController@edit_Slider')->name('Slider.edit_Slider');
        Route::post('/delete_Slider/{Slider_id}','SliderController@delete_Slider')->name('Slider.delete_Slider');
        Route::post('/All_Slider','SliderController@All_Slider')->name('Slider.All_Slider');
        Route::post('/single_Slider/{Slider_id}','SliderController@single_Slider')->name('Slider.single_Slider');


        /**Category*/
        Route::post('/add_Category','CategoryController@add_Category')->name('Category.add_Category');
        Route::post('/edit_Category/{Category_id}','CategoryController@edit_Category')->name('Category.edit_Category');
        Route::post('/delete_Category/{Category_id}','CategoryController@delete_Category')->name('Category.delete_Category');
        Route::post('/All_Category','CategoryController@All_Category')->name('Category.All_Category');
        Route::post('/single_Category/{Category_id}','CategoryController@single_Category')->name('Category.single_Category');


        /**User*/
        Route::post('/delete_User/{User_id}','UserController@delete_User')->name('User.delete_User');
        Route::post('/All_User','UserController@All_User')->name('User.All_User');
        Route::post('/single_User/{User_id}','UserController@single_User')->name('User.single_User');
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
