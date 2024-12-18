<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('home_titles', function (Blueprint $table) {
            $table->id();
            
            // Name 1
            $table->string('name_1_az')->nullable();
            $table->string('name_1_en')->nullable();
            $table->string('name_1_ru')->nullable();
            
            // Name 2
            $table->string('name_2_az')->nullable();
            $table->string('name_2_en')->nullable();
            $table->string('name_2_ru')->nullable();
            
            // Name 3
            $table->string('name_3_az')->nullable();
            $table->string('name_3_en')->nullable();
            $table->string('name_3_ru')->nullable();
            
            // Name 4
            $table->string('name_4_az')->nullable();
            $table->string('name_4_en')->nullable();
            $table->string('name_4_ru')->nullable();
            
            // Name 5
            $table->string('name_5_az')->nullable();
            $table->string('name_5_en')->nullable();
            $table->string('name_5_ru')->nullable();
            
            // Name 6
            $table->string('name_6_az')->nullable();
            $table->string('name_6_en')->nullable();
            $table->string('name_6_ru')->nullable();
            
            $table->string('image')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('home_titles');
    }
};