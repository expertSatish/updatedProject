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
        Schema::create('slot_books', function (Blueprint $table) {
            $table->id();
            $table->integer('expert_id')->default(0);
            $table->date('booking_date');
            $table->time('booking_time');
            $table->integer('user_id')->default(0);
            $table->string('user_number')->default(NULL);
            $table->string('user_email')->default(NULL);
            $table->string('user_name')->default(NULL);
            $table->integer('payment')->default(0);
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('slot_books');
    }
};
