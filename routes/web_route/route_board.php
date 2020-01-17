<?php

use Illuminate\Http\Request;
use bootstrap\Helpers\Helper;
use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;

Route::prefix('board')->group(function () {

    Route::get('/', function () {
        $loader = new FilesystemLoader(resource_path("templates"));
        $twig = new Environment($loader, [
            'debug' => true,
            #'cache' => resource_path("templates")."/cache",
            'cache' => false
        ]);

        $template = $twig->load('/board/board.html');
        $aList = array(
            "b" => "b test",
        );

        return $template->render($aList);
        /*
        //$loader = new \Twig\Loader\FilesystemLoader(resource_path("templates"));
        return view("index");
        */
    });
    Route::get('/index',"BoardController@index");

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
        */
    });

});
