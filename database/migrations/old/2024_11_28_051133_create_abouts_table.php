<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('abouts', function (Blueprint $table) {
        $table->id();
        $table->string('title_az')->nullable();
        $table->string('title_en')->nullable();
        $table->string('title_ru')->nullable();
        $table->text('description_az')->nullable();
        $table->text('description_en')->nullable();
        $table->text('description_ru')->nullable();
        $table->string('image')->nullable();
        $table->timestamps();
    });
}
    public function down()
    {
        Schema::dropIfExists('abouts');
    }
};