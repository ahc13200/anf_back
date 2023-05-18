<?php

use Illuminate\Http\Request;

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

Route::group(['prefix' => 'services', 'middleware' => []], function () {
    Route::get('/', function () {
        return ["message" => "services"];
    });


    /*Person*/
    Route::get('person/calculos', 'PersonController@calculos');
    Route::post('person/validate', 'PersonController@validate_model');
    Route::post('person/update_multiple', 'PersonController@update_multiple');
    Route::delete('person/delete_by_id', 'PersonController@deletebyid');
    Route::resource('person', 'PersonController');


});
