<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->text('address');
            $table->decimal('total_price', 10, 2);
            $table->enum('delivery_type', ['delivery_address', 'pickup_store'])->default('delivery_address');
            $table->enum('payment_type', ['debet', 'bank'])->default('debet');
            $table->tinyInteger('status')->default(0);
            $table->text('info')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};