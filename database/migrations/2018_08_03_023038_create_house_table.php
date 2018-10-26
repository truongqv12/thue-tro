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
            $table->string('h_image')->nullable();
            $table->float('h_price');
            $table->string('h_time_close',5)->default(0);
            $table->float('h_area',8,4);
            $table->string('h_wc','100')->default(0);
            $table->string('h_electric','100')->default(0);
            $table->string('h_water','100')->default(0);
            $table->integer('h_floor')->default(1);
            $table->integer('h_num_people')->default(0);
            $table->string('h_address');
            $table->integer('h_use_id')->default(0);
            $table->integer('h_cty_id')->default(0);
            $table->integer('h_dis_id')->default(0);
            $table->integer('h_war_id')->default(0);
            $table->integer('h_street_id')->default(0);
            $table->string('h_description')->nullable();
            $table->string('h_utility')->nullable();
            $table->float('h_lat', 8,2)->nullable();
            $table->float('h_lng', 8,2)->nullable();
            $table->boolean('h_status')->default(1);
            $table->boolean('h_active')->default(0);
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
