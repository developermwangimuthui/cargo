<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarrierWalletHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrier_wallet_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('carrier_id');
            $table->foreign('carrier_id')->references('id')->on('carriers')->onDelete('cascade');
            $table->string('type');//topup,withdraw
            $table->double('amount');
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
        Schema::dropIfExists('carrier_wallet_histories');
    }
}
