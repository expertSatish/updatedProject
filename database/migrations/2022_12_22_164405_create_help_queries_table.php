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
        Schema::create('help_queries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type')->default(0);
            $table->string('type_id')->default(NULL);
            $table->longtext('description')->default(NULL);
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
        Schema::dropIfExists('help_queries');
    }
};
