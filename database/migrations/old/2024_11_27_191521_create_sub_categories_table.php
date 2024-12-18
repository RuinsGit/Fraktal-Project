<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name_az');
            $table->string('name_en');
            $table->string('name_ru');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->string('image_alt_az')->nullable();
            $table->string('image_alt_en')->nullable();
            $table->string('image_alt_ru')->nullable();
            $table->string('image_title_az')->nullable();
            $table->string('image_title_en')->nullable();
            $table->string('image_title_ru')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sub_categories');
    }
};