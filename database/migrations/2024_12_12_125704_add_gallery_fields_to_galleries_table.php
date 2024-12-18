<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->string('main_image')->nullable()->after('image');
            $table->json('sub_images')->nullable()->after('main_image');
        });
    }

    public function down()
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn('main_image');
            $table->dropColumn('sub_images');
        });
    }
};