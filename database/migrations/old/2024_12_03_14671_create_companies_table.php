<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name_1_az')->nullable();
            $table->string('name_1_en')->nullable();
            $table->string('name_1_ru')->nullable();
            $table->string('name_2_az')->nullable();
            $table->string('name_2_en')->nullable();
            $table->string('name_2_ru')->nullable();
            $table->string('image')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('companies');
    }
};