<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductService
{
    /**
     * Ürünleri filtrele ve getir
     */
    public function getFilteredProducts(Request $request)
    {
        $query = Product::with(['category', 'courseType', 'videos'])
            ->where('status', true);

        $this->applyPriceFilter($query, $request);
        $this->applyCategoryFilter($query, $request);
        $this->applyCourseTypeFilter($query, $request);
        $this->applyVideoCountFilter($query, $request);
        $this->applySearchFilter($query, $request);

        return $query->orderBy('order', 'asc')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
    }

    /**
     * Fiyat filtresini uygula
     */
    private function applyPriceFilter(Builder $query, Request $request): void
    {
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
    }

    /**
     * Kategori filtresini uygula
     */
    private function applyCategoryFilter(Builder $query, Request $request): void
    {
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
    }

    /**
     * Kurs tipi filtresini uygula
     */
    private function applyCourseTypeFilter(Builder $query, Request $request): void
    {
        if ($request->filled('course_type_id')) {
            $query->where('course_type_id', $request->course_type_id);
        }
    }

    /**
     * Video sayısı filtresini uygula
     */
    private function applyVideoCountFilter(Builder $query, Request $request): void
    {
        if ($request->filled('video_lesson_count')) {
            $query->withCount('videos')
                  ->having('videos_count', '=', $request->video_lesson_count);
        }
    }

    /**
     * Arama filtresini uygula
     */
    private function applySearchFilter(Builder $query, Request $request): void
    {
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name_az', 'like', "%{$search}%")
                  ->orWhere('name_en', 'like', "%{$search}%")
                  ->orWhere('name_ru', 'like', "%{$search}%");
            });
        }
    }

    /**
     * Tekil ürün detayını getir
     */
    public function getProductDetail($id)
    {
        return Product::with(['category', 'courseType', 'videos'])
            ->where('id', $id)
            ->first();
    }
} 