<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('study_programs', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('name_az');
            $table->text('text_az');
            $table->text('description_az');
            $table->string('name_en');
            $table->text('text_en');
            $table->text('description_en');
            $table->string('name_ru');
            $table->text('text_ru');
            $table->text('description_ru');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('study_programs');
    }
};
