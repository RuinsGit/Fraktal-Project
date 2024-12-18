<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        try {
            $products = $this->productService->getFilteredProducts($request);

            return response()->json([
                'status' => 'success',
                'data' => ProductResource::collection($products),
                'message' => 'Məhsullar uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            \Log::error('Product API Error:', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $product = $this->productService->getProductDetail($id);

            if (!$product) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Məhsul tapılmadı'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => new ProductResource($product),
                'message' => 'Məhsul uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            \Log::error('Product Show API Error:', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 500);
        }
    }
} 