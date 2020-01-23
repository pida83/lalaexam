<?php

namespace App\DAO;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Board
 * @package App\DAO
 */
class Board extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'board';

    /**
     * @var \Illuminate\Database\Eloquent\Builder $this
     */

    protected $fillable = [
        "contents",
        "subject",
        "email",
        "user_seq",
        "user_name",
        "nick_name",
        "user_id",
        "visitor",
        "created_at",
    ];

    /**
     *
     * @param        $id
     * @param string $boardType
     * @return array | bool
     */
    public function getRow($id, $boardType = "F")
    {
        $result = $this::where("seq",$id)->get();

        return ($result->isNotEmpty())? $result : false;
    }

    public function getAll($boardType = "F")
    {
        $result = $this::limit("10")->get();

        return $result;
        //return ($result->isNotEmpty())? $result : false;
    }

    public function getData($id = false, $boardType = "F")
    {
        return (!$id)? $this->getAll($boardType) : $this->getRow($id, $boardType);
    }
}
