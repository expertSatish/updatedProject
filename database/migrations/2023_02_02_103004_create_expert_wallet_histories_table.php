<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expert_wallet_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('expert_id')->default(NULL);
            $table->float('amount')->default(NULL);
            $table->string('type')->default(NULL);
            $table->integer('purchase_booking_id')->default(0);
            $table->string('amounttype')->default(NULL);
            $table->integer('transation_id')->default(0);
            $table->integer('is_publish')->default(0);
            $table->integer('sequence')->default(0);
            $table->timestamps();
            $table->softdeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expert_wallet_histories');
    }
};
