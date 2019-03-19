<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouseAttributesValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_attributes_value', function (Blueprint $table) {
            $table->increments('ha_id');
            $table->integer('ha_attributes_id');
            $table->integer('ha_house_id');
            $table->integer('ha_attribute_value_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('house_attributes_value');
    }
}
