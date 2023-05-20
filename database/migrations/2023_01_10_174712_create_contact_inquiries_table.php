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
        Schema::create('contact_inquiries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default(0);
            $table->string('ip')->default(NULL);
            $table->string('email')->default(NULL);
            $table->string('mobile')->default(NULL);
            $table->string('reason')->default(NULL);
            $table->longtext('message')->default(NULL);
            $table->integer('business_sector')->default(NULL);
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
        Schema::dropIfExists('contact_inquiries');
    }
};
