<?php

namespace App\Http\Controllers;

//use App\Http\Data\BoardInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use \App\DAO\Board;

class BoardController extends Controller
{
    /**
     * @var \App\DAO\Board |  \Illuminate\Database\Query\Builder  $board
     */
    protected $board;

    public function __construct(Board $bd)
    {
        // 모델 주입
        $this->board = $bd;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function index(Request $req)
    {
        return redirect("/board/show");
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function show(Request $request, $id = null)
    {
        $board = $this->board;
        $isAdmin = $request->session()->get("isAdmin");

        //Log::info('is admin check show :: ', ["show" => session("isAdmin")]);
        //Log::info('is admin check show :: ', ["admin" => $isAdmin]);
        //Log::info('is admin check show :: ', ["var"=>var_export($board,true)]);
        //log::info(__METHOD__,["list" => $boardList]);
        $boardList =$board->getData($id);

        $return = array(
            "list" => $boardList,
            "token" => csrf_token()
        );




        $twig = resolve('Twig');

        try {
            $template = $twig->load('/board/board.html');
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }
        return $template->render($return);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getBoardList(){
        $list = $this->board->getAll();
        return json_encode($list);

    }
}
