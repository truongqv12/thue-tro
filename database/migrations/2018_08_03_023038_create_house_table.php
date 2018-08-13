<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house', function (Blueprint $table) {
            $table->increments('h_id');
            $table->string('h_title')->unique();
            $table->string('h_slug')->unique();
            $table->string('h_image');
            $table->float('h_price');
            $table->float('h_price_electric');
            $table->string('h_price_water');
            $table->string('h_time_close',5);
            $table->float('h_area',8,4);
            $table->string('h_wc','100');
            $table->integer('h_floor')->default(1);
            $table->integer('h_num_people')->default(1);
            $table->string('h_address');
            $table->integer('h_use_id');
            $table->integer('h_cty_id');
            $table->integer('h_dis_id');
            $table->integer('h_war_id');
            $table->string('h_description');
            $table->float('h_lat', 8,2);
            $table->float('h_lng', 8,2);
            $table->boolean('h_status')->default(1);
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
        Schema::dropIfExists('house');
    }
}
