<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveSubCategoryIdFromProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Önce foreign key'i kaldıralım (doğru constraint adını kullanarak)
            $table->dropForeign('products_subcategory_foreign');
            // Sonra sütunu kaldıralım
            $table->dropColumn('sub_category_id');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Geri alma durumunda sütunu tekrar ekleyelim
            $table->unsignedBigInteger('sub_category_id')->nullable()->after('category_id');
            // Foreign key'i tekrar ekleyelim
            $table->foreign('sub_category_id', 'products_subcategory_foreign')
                ->references('id')
                ->on('sub_categories')
                ->onDelete('cascade');
        });
    }
} 