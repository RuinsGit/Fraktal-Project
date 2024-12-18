<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('services_title', function (Blueprint $table) {
            $table->id();
            $table->string('name_az');
            $table->string('name_en')->nullable();
            $table->string('name_ru')->nullable();
            $table->text('text_az');
            $table->text('text_en')->nullable();
            $table->text('text_ru')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('services_title');
    }
};