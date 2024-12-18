<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            // Temel Bilgiler
            $table->id();
            
            // İsim (3 dilde)
            $table->string('name_az')->index();
            $table->string('name_en')->index();
            $table->string('name_ru')->index();
            
            // Başlık (3 dilde)
            $table->string('title_az');
            $table->string('title_en');
            $table->string('title_ru');
            
            // Açıklama (3 dilde)
            $table->text('description_az');
            $table->text('description_en');
            $table->text('description_ru');
            
            // İlişkiler (Foreign Keys)
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('sub_category_id');
            
            // Fiyatlandırma
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('discounted_price', 10, 2)->default(0);
            $table->integer('discount_percentage')->nullable();
            
            // Puanlama Sistemi
            $table->decimal('rating', 3, 2)->default(0)->index();
            $table->integer('rating_count')->default(0);
            
            // Video Bilgileri
            $table->integer('total_videos')->default(0);
            $table->string('total_duration')->nullable();
            $table->integer('download_count')->default(0)->index();
            
            // Ana Medya
            $table->string('thumbnail')->nullable();
            $table->string('preview_video')->nullable();
            
            // Durum Bilgileri
            $table->boolean('status')->default(true)->index();
            $table->integer('order')->default(0)->index();
            
            // Slug
            $table->string('slug')->unique();
            
            // Timestamps
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('category_id', 'products_category_foreign')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');

            $table->foreign('sub_category_id', 'products_subcategory_foreign')
                ->references('id')
                ->on('sub_categories')
                ->onDelete('cascade');
        });

        // Video tablosu
        Schema::create('product_videos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('title');
            $table->string('video_path');
            $table->string('duration')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->foreign('product_id', 'product_videos_product_foreign')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');

            $table->index(['product_id', 'order']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_videos');
        Schema::dropIfExists('products');
    }
}