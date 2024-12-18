<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->string('image');
            
            // AZ dili için
            $table->string('title_az');
            $table->text('comment_az');
            
            // EN dili için
            $table->string('title_en')->nullable();
            $table->text('comment_en')->nullable();
            
            // RU dili için
            $table->string('title_ru')->nullable();
            $table->text('comment_ru')->nullable();
            
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
};