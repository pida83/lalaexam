<?php


namespace App\Http\Service;

use App\Board;
use App\Http\Data\BoardInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BoardService implements BoardInterface
{
    /**
     * @var $board Model | Board | \Illuminate\Database\Query\Builder
     */
    protected $board;

    public function __construct(Board $bd)
    {
        $this->board = $bd;
    }

    public function getRow($id)
    {
        $result = $this->board->where("id",$id)->delete();
        echo "LINE :: " . __LINE__ . "<br/>";
        echo "FILE :: " . __FILE__ . "<br/>";
        echo "METHOD :: " . __METHOD__ . "<br/>";
        echo "<pre>";
        var_dump($result);
       echo "</pre>";
       exit;

    }

    public function getAll($board)
    {
    //    echo $board;
    }
}
