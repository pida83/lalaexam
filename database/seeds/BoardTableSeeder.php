<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
;

class BoardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\DAO\Board::class, 50)->create();
        /*
        DB::table("board")->insert([
           "contents"   => Str::random(10),
           "subject"    => Str::random(10),
           "email"      => Str::random(10) . '@gmail.com',
           "user_seq"   => rand("1"),
           "user_name"  => Str::random(10),
           "nick_name"  => Str::random(10),
           "user_id"    => Str::random(10),
           "visitor"    => Str::random(10),
           "created_at" => date("Y-m-d H:i:s"),
       ]);
        */

    }
}
