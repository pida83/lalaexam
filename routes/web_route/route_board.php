<?php

use Illuminate\Support\Facades\Route;

// /board/{} 로 들어오는 모든 url 을 처리
Route::prefix('board')->group(function () {

    //Log::info('is admin check show :: ', ["route" => session("isAdmin")]);

    Route::get('/','BoardController@index'); //read
    Route::get('/file','BoardController@fileUp'); //read
    Route::get('/create',"BoardController@create"); // write
    Route::post('/list',"BoardController@list"); // getList
    Route::post('/store',"BoardController@store"); // getList
    Route::post('/setfile',"BoardController@setFile"); // setFile
    Route::post('/getfile',"BoardController@getTempFile"); // setFile


    /*
     * Route::put('/edit/{id?}',"BoardController@edit"); // edit // request가 있을 것이고 내용을 수정 후 저장
        Route::get('/{id?}',"BoardController@show"); // read


    Route::delete('/{id?}',"BoardController@destroy"); // put del
*/

});
