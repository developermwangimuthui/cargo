<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarrierWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrier_wallets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('carrier_id');
            $table->foreign('carrier_id')->references('id')->on('carriers')->onDelete('cascade');
            $table->double('balance');
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
        Schema::dropIfExists('carrier_wallets');
    }
}
