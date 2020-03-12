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


#require_once "web_route/route_admin.php";


use Illuminate\Support\Facades\Route;

require_once "web_route/route_board.php";
require_once "web_route/route_chat.php";
#require_once "web_route/photomeet.php";

Route::get('/', function(){
    return redirect("/board");
});


