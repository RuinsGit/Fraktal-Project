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
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('course_type_id')->nullable()->after('category_id');
            
            $table->foreign('course_type_id')
                ->references('id')
                ->on('course_types')
                ->onDelete('set null');
        });
    }
    
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['course_type_id']);
            $table->dropColumn('course_type_id');
        });
    }
};
