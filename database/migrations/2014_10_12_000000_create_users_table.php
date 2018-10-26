<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('use_id');
            $table->string('use_name');
            $table->string('use_email')->unique();
            $table->string('use_password');
            $table->string('use_avatar')->nullable();
            $table->date('use_birthdays')->nullable();
            $table->string('use_phone','20')->nullable();
            $table->string('use_address')->nullable();
            $table->tinyInteger('use_status')->default(1);
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
        Schema::dropIfExists('users');
    }
}
