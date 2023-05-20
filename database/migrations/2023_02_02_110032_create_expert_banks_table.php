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
        Schema::create('expert_banks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('expert_id')->default(0);
            $table->string('account_holder_name')->default(NULL);
            $table->string('bank_name')->default(NULL);
            $table->string('ifsc_code')->default(NULL);
            $table->string('account_number')->default(NULL);
            $table->integer('is_publish')->default(1);
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
        Schema::dropIfExists('expert_banks');
    }
};
