<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class UpdateProductDiscountedPrices extends Command
{
    protected $signature = 'products:update-discounted-prices';
    protected $description = 'Update discounted prices for all products';

    public function handle()
    {
        $products = Product::all();

        foreach ($products as $product) {
            if ($product->discount_percentage > 0) {
                $discountAmount = ($product->price * $product->discount_percentage) / 100;
                $product->discounted_price = $product->price - $discountAmount;
                $product->save();
            }
        }

        $this->info('Tüm ürünlerin indirimli fiyatları güncellendi.');
    }
}