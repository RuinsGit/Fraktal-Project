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
    Schema::create('headers', function (Blueprint $table) {
        $table->id();
        // Ana menü elementləri
        $table->string('home_az')->nullable();
        $table->string('home_en')->nullable();
        $table->string('home_ru')->nullable();

        $table->string('about_az')->nullable();
        $table->string('about_en')->nullable();
        $table->string('about_ru')->nullable();

        $table->string('vision_az')->nullable();
        $table->string('vision_en')->nullable();
        $table->string('vision_ru')->nullable();

        $table->string('history_az')->nullable();
        $table->string('history_en')->nullable();
        $table->string('history_ru')->nullable();

        $table->string('leadership_az')->nullable();
        $table->string('leadership_en')->nullable();
        $table->string('leadership_ru')->nullable();

        $table->string('services_az')->nullable();
        $table->string('services_en')->nullable();
        $table->string('services_ru')->nullable();

        $table->string('our_services_az')->nullable();
        $table->string('our_services_en')->nullable();
        $table->string('our_services_ru')->nullable();

        $table->string('courses_az')->nullable();
        $table->string('courses_en')->nullable();
        $table->string('courses_ru')->nullable();

        $table->string('study_program_az')->nullable();
        $table->string('study_program_en')->nullable();
        $table->string('study_program_ru')->nullable();

        $table->string('digital_psychology_az')->nullable();
        $table->string('digital_psychology_en')->nullable();
        $table->string('digital_psychology_ru')->nullable();

        $table->string('human_design_az')->nullable();
        $table->string('human_design_en')->nullable();
        $table->string('human_design_ru')->nullable();

        $table->string('media_az')->nullable();
        $table->string('media_en')->nullable();
        $table->string('media_ru')->nullable();

        $table->string('gallery_az')->nullable();
        $table->string('gallery_en')->nullable();
        $table->string('gallery_ru')->nullable();

        $table->string('blogs_az')->nullable();
        $table->string('blogs_en')->nullable();
        $table->string('blogs_ru')->nullable();

        $table->string('contact_az')->nullable();
        $table->string('contact_en')->nullable();
        $table->string('contact_ru')->nullable();

        $table->string('image')->nullable();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('headers');
}
};
