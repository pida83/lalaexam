<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('board');

        Schema::create('board', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->bigIncrements('seq')->unique()->comment('seq');
            $table->enum('delete_YN', ['Y', 'N'])->default("N")->comment('delete or not')->index();
            $table->text('contents');
            $table->String('subject',"50");
            $table->string('email',"20")->comment('email');
            $table->bigInteger('user_seq')->comment('use_seq')->index();
            $table->string('user_name',"20")->comment('user real name')->index();
            $table->string('nick_name',"20")->comment('user real name')->index();
            $table->string('user_id',"20")->comment('user id')->index();
            $table->bigInteger('read_count')->default("0")->comment('seq');
            $table->bigInteger('like_count')->default("0")->comment('seq');
            $table->bigInteger('hate_count')->default("0")->comment('seq');
            $table->ipAddress('visitor')->comment('ip address');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('board');
    }
}
