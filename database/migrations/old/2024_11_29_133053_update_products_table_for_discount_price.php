<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Önce sütunun var olup olmadığını kontrol et
        if (!Schema::hasColumn('products', 'discounted_price')) {
            Schema::table('products', function (Blueprint $table) {
                $table->decimal('discounted_price', 10, 2)->default(0)->after('price');
            });
        }

        // Video tablosunu güncelleme
        if (Schema::hasTable('product_videos')) {
            Schema::table('product_videos', function (Blueprint $table) {
                $columns = [
                    'download_count' => 'integer',
                    'view_count' => 'integer',
                    'rating' => 'integer',
                    'duration' => 'integer',
                    'title' => 'string',
                    'order' => 'integer'
                ];

                foreach ($columns as $column => $type) {
                    if (!Schema::hasColumn('product_videos', $column)) {
                        if ($type === 'string') {
                            $table->string($column)->nullable();
                        } else {
                            $table->$type($column)->default(0);
                        }
                    }
                }
            });
        }
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'discounted_price')) {
                $table->dropColumn('discounted_price');
            }
        });

        if (Schema::hasTable('product_videos')) {
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
    }
};