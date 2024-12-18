<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogTypesTable extends Migration
{
    public function up()
    {
        Schema::create('blog_types', function (Blueprint $table) {
            $table->id();
            $table->string('name_az');
            $table->string('name_en');
            $table->string('name_ru');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('blog_types');
    }
}