<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('product_videos', function (Blueprint $table) {
            if (!Schema::hasColumn('product_videos', 'description')) {
                $table->text('description')->nullable()->after('title');
            }
        });
    }

    public function down()
    {
        Schema::table('product_videos', function (Blueprint $table) {
            if (Schema::hasColumn('product_videos', 'description')) {
                $table->dropColumn('description');
            }
        });
    }
};