<?php
Route::prefix('/photomeet')->group(function () {
    Route::get('/','Photomeet\PhotoMeetController@index');
    Route::get('/show','Photomeet\PhotoMeetController@show');
    Route::get('/list','Photomeet\PhotoMeetController@list');
    #Route::get('/list/{page?}/{limit?}', 'Photomeet\PhotoMeetController@list');
    #Route::get('/user/{id?}', 'Photomeet\PhotoMeetController@show');
});
