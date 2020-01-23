<?php

use Illuminate\Http\Request;
use \App\DAO\Board;
use Illuminate\Support\Facades\Log;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

// /board/{} 로 들어오는 모든 url 을 처리
Route::prefix('board')->group(function () {

    //Log::info('is admin check show :: ', ["route" => session("isAdmin")]);

    Route::get('/','BoardController@show');

    Route::get('/index',"BoardController@index");

    Route::get('/show/{id?}',"BoardController@show");
    Route::post('/ajax', "BoardController@getBoardList");

/*
    Route::get('/list/{page?}/{limit?}', function ($page = 0,$limit = 30) {
        $board = App\Board::paginate(15);

        foreach ($board as $val) {
            echo "{$val->id} :: {$val->user_name} </br>";
        }
    });

    Route::get('/get/{id?}', function ($id = null) {
        if ($id == null) {
            return redirect("/board/list");
        }
        $proc = DB::connection("proc")->select("call count_board()");
        $board = App\Board::find($id);

        return (empty($board))? "게시글이 없습니다. ::" : " {$board->id} :: {$board->user_name}  :: </br>";
    });

    Route::get('/write', function () {
        return view("board.write");
    });

    Route::get('/set/{id?}', function (Request $request, $id = null) {

    });

    Route::post('/put', function (Request $request) {
        $board = new App\Board();

        $board->user_name = $request->input("user_name");
        $board->contents = $request->input("contents");
        $board->user_id = 'myid';
        $board->user_seq = '1';
        #$board->user_seq = $request->input("user_seq");

        if ($board->save()) {
            return redirect("/board/get/{$board->id}");
        }
    });

    Route::get('/cnt', function ()   {
        /*
        if ($id == null) {
            return redirect("/board/list");
        }
        #$board = App\Conetents::find($id);
        $proc = DB::select("call count_board()");

        //$board = App\Conetents::find($id);
        //echo (empty($board))? "게시글이 없습니다." : " {$board->id} :: {$board->user_name} </br>";
    });
*/
});
