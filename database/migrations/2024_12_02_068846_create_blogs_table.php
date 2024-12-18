<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            
            // Blog Type ilişkisi
            $table->foreignId('blog_type_id')
                  ->constrained('blog_types')
                  ->onDelete('cascade');
            
            // Çok dilli içerik alanları
            $table->string('title_az');
            $table->string('title_en');
            $table->string('title_ru');
            
            $table->text('description_az');
            $table->text('description_en');
            $table->text('description_ru');
            
            // Resim alanı
            $table->string('image');
            
            // İstatistik alanları
            $table->integer('view_count')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->string('slug');
            
            // Tarih alanları
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('blogs');
    }
};