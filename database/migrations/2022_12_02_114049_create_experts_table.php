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
        Schema::create('experts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('user_id');
            $table->string('email')->unique();
            $table->string('ccode')->unique();
            $table->string('mobile')->unique();
            $table->string('password');
            $table->string('password_text');
            $table->string('linkedin');
            $table->integer('highest_qualification');
            $table->integer('your_expertise');
            $table->json('fluent_language');
            $table->json('suitable_industry');
            $table->longtext('your_strength');
            $table->longtext('bio');
            $table->integer('currently_working_as');
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
        Schema::dropIfExists('experts');
    }
};
