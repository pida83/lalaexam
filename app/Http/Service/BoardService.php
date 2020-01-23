<?php


namespace App\Http\Service;

use App\Http\Data\BoardInterface;
use Illuminate\Database\Eloquent\Model;

class BoardService implements BoardInterface
{
    /**
     * @var $board Model | \Illuminate\Database\Query\Builder :: 모델
     */
    protected $board;

    public function __construct(\App\DAO\Board $bd)
    {
        // \App\DAO\Board 주입
        $this->board = $bd;

    }

    public function getRow($id, $boardType = "F")
    {

        $result = $this->board->where("seq",$id)->get();

        return ($result->isNotEmpty())? $result : false;
    }

    public function getAll($boardType = "F")
    {
        $result = $this->board->limit("10")->get();
        return ($result->isNotEmpty())? $result : false;
    }

    public function getData($id = false, $boardType = "F")
    {
        return (!$id)? $this->getAll($boardType) : $this->getRow($id, $boardType);
    }
}
