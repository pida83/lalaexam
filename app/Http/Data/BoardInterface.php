<?php


namespace App\Http\Data;


interface BoardInterface
{

    public function getRow($id, $boardType = "F");
    public function getAll($boardType = "F");
    public function getData($id = false, $boardType ="F");

}
