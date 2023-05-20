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
        Schema::create('job_applies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job')->default(0);
            $table->string('name')->default(0);
            $table->string('experience')->default(NULL);
            $table->string('email')->default(NULL);
            $table->string('phone')->default(NULL);
            $table->string('resume')->default(NULL);
            $table->longtext('message')->default(NULL);
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
        Schema::dropIfExists('job_applies');
    }
};
