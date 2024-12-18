<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('about_companies', function (Blueprint $table) {
            $table->id();
            $table->string('name_az');
            $table->string('name_en')->nullable();
            $table->string('name_ru')->nullable();
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
        Schema::dropIfExists('about_companies');
    }
};