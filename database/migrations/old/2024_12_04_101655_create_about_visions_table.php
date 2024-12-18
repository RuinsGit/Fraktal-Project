<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('about_visions', function (Blueprint $table) {
            $table->id();
            $table->string('icon_1');
            $table->string('name_1_az');
            $table->string('name_1_en')->nullable();
            $table->string('name_1_ru')->nullable();
            $table->text('text_1_az');
            $table->text('text_1_en')->nullable();
            $table->text('text_1_ru')->nullable();
            $table->string('icon_2');
            $table->string('name_2_az');
            $table->string('name_2_en')->nullable();
            $table->string('name_2_ru')->nullable();
            $table->text('text_2_az');
            $table->text('text_2_en')->nullable();
            $table->text('text_2_ru')->nullable();
            $table->string('image');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('about_visions');
    }
};