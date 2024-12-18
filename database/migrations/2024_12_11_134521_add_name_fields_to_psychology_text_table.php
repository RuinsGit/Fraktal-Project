<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('psychology_text', function (Blueprint $table) {
            $table->string('name_az')->after('id');
            $table->string('name_en')->nullable()->after('name_az');
            $table->string('name_ru')->nullable()->after('name_en');
        });
    }

    public function down(): void
    {
        Schema::table('psychology_text', function (Blueprint $table) {
            $table->dropColumn(['name_az', 'name_en', 'name_ru']);
        });
    }
}; 