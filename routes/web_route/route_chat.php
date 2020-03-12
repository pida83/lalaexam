<?php

use Illuminate\Support\Facades\Route;

// /chat/{} 로 들어오는 모든 url 을 처리
Route::prefix('chat')->group(function () {

    //Log::info('is admin check show :: ', ["route" => session("isAdmin")]);

    Route::get('/','ChatController@entrance'); //read
    Route::get('/chatRoom','ChatController@chatRoom'); //read
    Route::post('/setNickName',"ChatController@setNickName"); // getList
    //Route::get('/create',"ChatController@create"); // write

    //Route::post('/store',"ChatController@store"); // getList
    //Route::post('/setfile',"ChatController@setFile"); // setFile
    //Route::post('/getfile',"ChatController@getTempFile"); // setFile


    /*
     * Route::put('/edit/{id?}',"BoardController@edit"); // edit // request가 있을 것이고 내용을 수정 후 저장
        Route::get('/{id?}',"BoardController@show"); // read


    Route::delete('/{id?}',"BoardController@destroy"); // put del
*/

});
