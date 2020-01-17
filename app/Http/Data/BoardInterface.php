<?php


namespace App\Http\Data;


interface BoardInterface
{

    public function getRow($id);
    public function getAll($board);

}
