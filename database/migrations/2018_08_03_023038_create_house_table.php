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
            $table->string('h_picture');
            $table->float('h_price');
            $table->string('h_time_close',5)->default(0);
            $table->float('h_area',8,4);
            $table->integer('h_cty_id');
            $table->integer('h_dis_id');
            $table->integer('h_war_id');
            $table->string('h_address');
            $table->text('h_description');
            $table->string('h_amenities')->nullable()->comment('tien nghi');
            $table->integer('h_use_id')->default(0)->comment('nguoi dang tin');
            $table->float('h_lat', 8,2)->nullable();
            $table->float('h_lng', 8,2)->nullable();
            $table->boolean('h_status')->default(2)->comment('trang thai');
            $table->boolean('h_type')->default(1)->comment('type 1 = cho thue, type 2 = o ghep');
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
