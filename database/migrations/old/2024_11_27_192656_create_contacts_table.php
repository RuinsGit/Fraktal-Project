<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address_az')->nullable();
            $table->string('address_en')->nullable();
            $table->string('address_ru')->nullable();
            $table->text('work_hours_az')->nullable();
            $table->text('work_hours_en')->nullable();
            $table->text('work_hours_ru')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('logo')->nullable();
            $table->string('logo_2')->nullable();
            $table->string('favicon')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
};