<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
       // ... mevcut kod ...
Schema::create('study_contents', function (Blueprint $table) {
    $table->id();
    $table->string('slug')->unique();  // Yeni eklenen alan
    $table->text('text_az');
    $table->text('text_en')->nullable();
    $table->text('text_ru')->nullable();
    $table->text('description_az');
    $table->text('description_en')->nullable();
    $table->text('description_ru')->nullable();
    $table->string('image');
    $table->boolean('status')->default(1);
    $table->timestamps();
});
    }

    public function down()
    {
        Schema::dropIfExists('study_contents');
    }
};