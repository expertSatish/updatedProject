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
        Schema::create('call_recording_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('slot_book_id')->default(0);
            $table->string('call_meeting_code')->default(NULL);
            $table->string('call_recording_id')->default(NULL);
            $table->integer('call_end_by')->default(0);
            $table->integer('call_end_by_type')->default(0);
            $table->datetime('call_end')->default(NULL);
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
        Schema::dropIfExists('call_recording_histories');
    }
};
