<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_user', function (Blueprint $table) {
            $table->increments('adm_id');
            $table->string('adm_login_name')->unique();
            $table->string('adm_password');
            $table->string('adm_name');
            $table->string('adm_email')->unique();
            $table->string('adm_avatar')->nullable();
            $table->string('adm_phone','20')->nullable();
            $table->tinyInteger('adm_active')->default('1');
            $table->tinyInteger('adm_add')->default('1');
            $table->tinyInteger('adm_edit')->default('1');
            $table->tinyInteger('adm_delete')->default('1');
            $table->boolean('adm_status')->default('1');
            $table->integer('admin_id')->default('0');
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
        Schema::dropIfExists('admin_user');
    }
}
