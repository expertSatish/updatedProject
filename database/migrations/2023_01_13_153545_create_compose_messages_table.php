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
        Schema::create('compose_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('expert_id')->default(0);
            $table->string('to')->default(NULL);
            $table->string('cc')->default(NULL);
            $table->string('bcc')->default(NULL);
            $table->string('subject')->default(NULL);
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
        Schema::dropIfExists('compose_messages');
    }
};
