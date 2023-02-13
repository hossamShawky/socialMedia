<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments("id");
            $table->string('name');
            $table->string('bio')->nullable();
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('address');
            $table->timestamp('email_verified_at')->nullable();
            $table->string("avatar")->default("admin/avatars/def.jpg")->nullable();
 $table->enum('status',array(0,1))->default(1);
 $table->enum('role',array("admin","superadmin"))->default("admin");
            $table->string("provider")->nullable();
            $table->string("provider_id")->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('admins');

    }
}
