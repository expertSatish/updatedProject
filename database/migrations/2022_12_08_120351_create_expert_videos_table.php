<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(){
        Schema::create('expert_videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('video_type');
            $table->string('video_url');
            $table->string('video');
            $table->string('video_image');
            $table->json('industries');
            $table->integer('expert_id');
            $table->longtext('description');
            $table->integer('is_publish')->default(0);
            $table->integer('sequence')->default(0);
            $table->timestamps();
            $table->softdeletes();
        });
    }

    public function down(){
        Schema::dropIfExists('expert_videos');
    }
};
