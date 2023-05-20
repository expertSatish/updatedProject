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
        Schema::create('slot_charges', function (Blueprint $table) {
            $table->id();
            $table->integer('expert_id');
            $table->integer('slot_time_id');
            $table->float('charges');
            $table->integer('is_publish')->default(0);
            $table->integer('sequence')->default(0);
            $table->timestamps();
            $table->softdeletes();
        });
    }
  
    public function down(){
        Schema::dropIfExists('slot_charges');
    }
};
