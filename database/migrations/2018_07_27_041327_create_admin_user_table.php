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
            $table->string('adm_login_name','255')->unique();
            $table->string('adm_password');
            $table->string('adm_name');
            $table->string('adm_email')->unique();
            $table->string('adm_avatar')->nullable();
            $table->string('adm_phone','20')->nullable();
            $table->boolean('adm_create')->default('1');
            $table->boolean('adm_edit')->default('1');
            $table->boolean('adm_delete')->default('1');
            $table->boolean('adm_setting')->default('0');
            $table->boolean('adm_active')->default('1');
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
