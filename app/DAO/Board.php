<?php

namespace App\DAO;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'board';

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
}
