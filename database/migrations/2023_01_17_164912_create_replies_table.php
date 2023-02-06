<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->increments("id");
            $table->string('content');

            $table->string('media')->nullable();
         $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
         $table->integer('post_id')->unsigned();
         $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
         $table->integer('reply_id')->nullable();

         
         $table->integer('comment_id')->unsigned();
         $table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replies');
    }
}
