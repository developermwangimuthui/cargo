<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTruckModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('truck_models', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('truck_brand_id');
            $table->string('truck_models');
            $table->foreign('truck_brand_id')->references('id')->on('truck_brands')->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('truck_models');
    }
}
