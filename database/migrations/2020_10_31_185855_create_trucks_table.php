<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrucksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trucks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('carrier_id');
            $table->uuid('plate_color_id')->nullable();
            $table->uuid('driving_yrs_id')->nullable();
            $table->uuid('brand_id')->nullable();
            $table->uuid('model_id')->nullable();
            $table->string('reg_no')->nullable();
            $table->string('manufacturer_date')->nullable();
            $table->string('body_type')->nullable();
            $table->string('permit_main_page')->nullable();
            $table->string('loading_capacity')->nullable();
            $table->string('truck_requirement')->nullable();
            $table->string('truck_type')->nullable();
            $table->string('carrier_lengths')->nullable();
            $table->string('lati')->nullable();
            $table->string('longi')->nullable();
            $table->foreign('carrier_id')->references('id')->on('carriers')->onDelete('cascade');
            $table->foreign('plate_color_id')->references('id')->on('license_plate_colors')->onDelete('cascade');
            $table->foreign('driving_yrs_id')->references('id')->on('driving_years')->onDelete('cascade');
            // $table->foreign('carrier_lengths_id')->references('id')->on('carrier_lengths')->onDelete('cascade');
            // $table->foreign('truck_requirement_id')->references('id')->on('truck_requirements')->onDelete('cascade');
            // $table->foreign('truck_type_id')->references('id')->on('truck_types')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('truck_brands')->onDelete('cascade');
            $table->foreign('model_id')->references('id')->on('truck_models')->onDelete('cascade');
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
        Schema::dropIfExists('trucks');
    }
}
