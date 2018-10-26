<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUniversitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('universities', function (Blueprint $table) {
            $table->increments('uni_id');
            $table->string('uni_name', 255)->unique();
            $table->string('uni_address', 255);
            $table->float('uni_lat', '8','2');
            $table->float('uni_lng', '8','2');
            $table->tinyInteger('uni_avtive')->default(1);
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
        Schema::dropIfExists('universities');
    }
}
