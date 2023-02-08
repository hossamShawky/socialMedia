<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->increments("id");
            
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->
                    on('users')-> onDelete('cascade');

            $table->integer('followed_id')->unsigned();
            $table->foreign('followed_id')->references('id')->
                    on('users')-> onDelete('cascade');

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
        Schema::dropIfExists('follows');
    }
}
