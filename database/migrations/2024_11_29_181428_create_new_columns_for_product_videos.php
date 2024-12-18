<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // discounted_price sütunu yoksa ekle
            if (!Schema::hasColumn('products', 'discounted_price')) {
                $table->decimal('discounted_price', 10, 2)->default(0)->after('price');
            }
        });

        // Video tablosunu güncelleme
        Schema::table('product_videos', function (Blueprint $table) {
            // Eğer sütunlar yoksa ekle
            if (!Schema::hasColumn('product_videos', 'download_count')) {
                $table->integer('download_count')->default(0);
            }
            if (!Schema::hasColumn('product_videos', 'view_count')) {
                $table->integer('view_count')->default(0);
            }
            if (!Schema::hasColumn('product_videos', 'rating')) {
                $table->integer('rating')->default(5);
            }
            if (!Schema::hasColumn('product_videos', 'duration')) {
                $table->integer('duration')->default(0);
            }
            if (!Schema::hasColumn('product_videos', 'title')) {
                $table->string('title')->nullable();
            }
            if (!Schema::hasColumn('product_videos', 'order')) {
                $table->integer('order')->default(0);
            }
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'discounted_price')) {
                $table->dropColumn('discounted_price');
            }
        });

        Schema::table('product_videos', function (Blueprint $table) {
            $columns = [
                'download_count',
                'view_count',
                'rating',
                'duration',
                'title',
                'order'
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('product_videos', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};