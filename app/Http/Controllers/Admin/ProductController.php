<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVideo;
use App\Models\CourseType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'videos']);

        
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name_az', 'like', "%{$search}%")
                  ->orWhere('name_en', 'like', "%{$search}%")
                  ->orWhere('name_ru', 'like', "%{$search}%");
            });
        }

        $products = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('back.pages.product.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        $courseTypes = CourseType::where('status', 1)->get();
        
        return view('back.pages.product.create', compact('categories', 'courseTypes'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            \Log::info('Product store başladı', $request->all());

            
            $thumbnailPath = null;
            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $this->uploadImage($request->file('thumbnail'), 'products');
                \Log::info('Thumbnail yüklendi', ['path' => $thumbnailPath]);
            }

            
            $previewVideoPath = null;
            if ($request->hasFile('preview_video')) {
                $previewVideoPath = $this->uploadVideo($request->file('preview_video'), 'products/videos/previews');
                \Log::info('Preview video yüklendi', ['path' => $previewVideoPath]);
            }

            
            $price = floatval($request->price);
            $discountPercentage = floatval($request->discount_percentage ?? 0);
            $discountedPrice = $this->calculateDiscountedPrice($price, $discountPercentage);

            \Log::info('Fiyat hesaplandı', [
                'price' => $price,
                'discount' => $discountPercentage,
                'discounted_price' => $discountedPrice
            ]);

            
            $product = Product::create([
                'name_az' => $request->name_az,
                'name_en' => $request->name_en,
                'name_ru' => $request->name_ru,
                'title_az' => $request->title_az,
                'title_en' => $request->title_en,
                'title_ru' => $request->title_ru,
                'description_az' => $request->description_az,
                'description_en' => $request->description_en,
                'description_ru' => $request->description_ru,
                'category_id' => $request->category_id,
                'course_type_id' => $request->course_type_id,
                'price' => $price,
                'discount_percentage' => $discountPercentage,
                'discounted_price' => $discountedPrice,
                'thumbnail' => $thumbnailPath,
                'preview_video' => $previewVideoPath,
                'status' => $request->status ?? 1,
                'order' => $request->order ?? 0,
                'slug' => $this->createUniqueSlug($request->name_az)
            ]);

            \Log::info('Ürün oluşturuldu', ['product_id' => $product->id]);

            
            if ($request->hasFile('videos')) {
                foreach ($request->file('videos') as $key => $video) {
                    $videoName = time() . '_' . $video->getClientOriginalName();
                    $uploadPath = 'uploads/product-videos';
                    $video->move(public_path($uploadPath), $videoName);

                    ProductVideo::create([
                        'product_id' => $product->id,
                        'video_path' => $uploadPath . '/' . $videoName,
                        'title' => $request->video_titles[$key] ?? null,
                        'description' => $request->video_descriptions[$key] ?? null,
                        'order' => $key + 1,
                        'download_count' => 0,
                        'view_count' => 0,
                        'rating' => 5,
                        'duration' => 0
                    ]);
                }
            }

            DB::commit();
            \Log::info('İşlem başarıyla tamamlandı');

            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Məhsul uğurla əlavə edildi',
                    'redirect' => route('admin.product.index')
                ]);
            }

            return redirect()
                ->route('admin.product.index')
                ->with('success', 'Məhsul uğurla əlavə edildi');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Ürün ekleme hatası', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            $this->cleanupFiles([$thumbnailPath, $previewVideoPath]);

            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Xəta baş verdi: ' . $e->getMessage()
                ], 422);
            }

            return back()
                ->withInput()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }

    
    private function uploadImage($file, $path)
    {
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $uploadPath = 'uploads/' . $path;
        
        if (!file_exists(public_path($uploadPath))) {
            mkdir(public_path($uploadPath), 0777, true);
        }
        
        $file->move(public_path($uploadPath), $fileName);
        return $uploadPath . '/' . $fileName;
    }

    private function uploadVideo($file, $path)
    {
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $uploadPath = 'uploads/' . $path;
        
        if (!file_exists(public_path($uploadPath))) {
            mkdir(public_path($uploadPath), 0777, true);
        }
        
        $file->move(public_path($uploadPath), $fileName);
        return $uploadPath . '/' . $fileName;
    }

    private function calculateDiscountedPrice($price, $discountPercentage)
    {
        if ($discountPercentage > 0) {
            return $price - ($price * $discountPercentage / 100);
        }
        return $price;
    }

    private function cleanupFiles($paths)
    {
        foreach ($paths as $path) {
            if ($path && file_exists(public_path($path))) {
                unlink(public_path($path));
            }
        }
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $courseTypes = CourseType::all();
        
        return view('back.pages.product.edit', compact('product', 'categories', 'courseTypes'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $product = Product::findOrFail($id);
            
            // Validate the request
            $data = $request->validate([
                'name_az' => 'required|string|max:255',
                'name_en' => 'required|string|max:255',
                'name_ru' => 'required|string|max:255',
                'title_az' => 'required|string|max:255',
                'title_en' => 'required|string|max:255',
                'title_ru' => 'required|string|max:255',
                'description_az' => 'required|string',
                'description_en' => 'required|string',
                'description_ru' => 'required|string',
                'category_id' => 'required|exists:categories,id',
                'price' => 'required|numeric',
                'discount_percentage' => 'nullable|numeric|min:0|max:100',
                'status' => 'required|boolean',
                'order' => 'nullable|integer',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            // Trim the description to remove unnecessary spaces
            $data['description_az'] = trim($data['description_az']);
            
            if ($request->hasFile('thumbnail')) {
                if ($product->thumbnail && file_exists(public_path($product->thumbnail))) {
                    unlink(public_path($product->thumbnail));
                }
                $data['thumbnail'] = $this->uploadImage($request->file('thumbnail'), 'products');
            }

            $price = floatval($request->price);
            $discountPercentage = floatval($request->discount_percentage ?? 0);
            $discountedPrice = $this->calculateDiscountedPrice($price, $discountPercentage);

            $product->update([
                'name_az' => $data['name_az'],
                'name_en' => $data['name_en'],
                'name_ru' => $data['name_ru'],
                'title_az' => $data['title_az'],
                'title_en' => $data['title_en'],
                'title_ru' => $data['title_ru'],
                'description_az' => $data['description_az'],
                'description_en' => $data['description_en'],
                'description_ru' => $data['description_ru'],
                'category_id' => $data['category_id'],
                'price' => $price,
                'discount_percentage' => $discountPercentage,
                'discounted_price' => $discountedPrice,
                'status' => $data['status'],
                'order' => $data['order'],
                'thumbnail' => $data['thumbnail'] ?? $product->thumbnail
            ]);

            // Yeni videoları kaydet
            if ($request->hasFile('videos')) {
                foreach ($request->file('videos') as $key => $video) {
                    $videoName = time() . '_' . $video->getClientOriginalName();
                    $uploadPath = 'uploads/product-videos';
                    $video->move(public_path($uploadPath), $videoName);

                    ProductVideo::create([
                        'product_id' => $product->id,
                        'video_path' => $uploadPath . '/' . $videoName,
                        'title' => $request->video_titles[$key] ?? null,
                        'description' => $request->video_descriptions[$key] ?? null,
                        'order' => $key + 1,
                        'download_count' => 0,
                        'view_count' => 0,
                        'rating' => 5,
                        'duration' => 0
                    ]);
                }
            }

            DB::commit();
            toastr()->success('Məhsul uğurla yeniləndi!');
            return redirect()->route('admin.product.index');

        } catch (\Exception $e) {
            DB::rollback();
            if (isset($data['thumbnail']) && file_exists(public_path($data['thumbnail']))) {
                unlink(public_path($data['thumbnail']));
            }

            toastr()->error('Xəta: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            
            
            foreach($product->videos as $video) {
                if(file_exists(public_path($video->video_path))) {
                    unlink(public_path($video->video_path));
                }
                $video->delete();
            }
            
            
            if($product->thumbnail && file_exists(public_path($product->thumbnail))) {
                unlink(public_path($product->thumbnail));
            }
            
            
            $product->delete();
            
            
            return redirect()->route('admin.product.index');
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Məhsul silinərkən xəta baş verdi'
            ], 500);
        }
    }

    public function getSubCategory($category_id)
    {
        try {
            
            $category = Category::findOrFail($category_id);
            
            
            $sub_categories = SubCategory::where('category_id', $category_id)
                ->where('status', 1)
                ->orderBy('name_az')
                ->get();

            if ($sub_categories->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Bu kateqoriya aid alt kateqoriya tapılmadı'
                ]);
            }

            
            $view = '<option value="">Seçim edin</option>';
            foreach ($sub_categories as $sub) {
                $view .= '<option value="'.$sub->id.'">'.$sub->name_az.'</option>';
            }

            return response()->json([
                'status' => 'success',
                'view' => $view
            ]);

        } catch (\Exception $e) {
            \Log::error('Alt kategori getirme hatası: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 422);
        }
    }

    public function show($id)
    {
        $product = Product::with('videos')
            ->withCount('videos')
            ->findOrFail($id);

        
        $totalSeconds = $product->videos->sum('duration');
        
        
        if ($totalSeconds < 60) {
            $product->total_duration = $totalSeconds . ' saniyə';
        } elseif ($totalSeconds < 3600) {
            $minutes = floor($totalSeconds / 60);
            $product->total_duration = $minutes . ' dəqiqə';
        } else {
            $hours = floor($totalSeconds / 3600);
            $minutes = floor(($totalSeconds % 3600) / 60);
            $product->total_duration = $hours . ' saat ' . ($minutes > 0 ? $minutes . ' dəqiqə' : '');
        }

        
        foreach ($product->videos as $video) {
            $duration = $video->duration;
            if ($duration < 60) {
                $video->formatted_duration = $duration . ' saniyə';
            } elseif ($duration < 3600) {
                $minutes = floor($duration / 60);
                $seconds = $duration % 60;
                $video->formatted_duration = $minutes . ':' . sprintf('%02d', $seconds) . ' dəqiqə';
            } else {
                $hours = floor($duration / 3600);
                $minutes = floor(($duration % 3600) / 60);
                $seconds = $duration % 60;
                $video->formatted_duration = sprintf('%d:%02d:%02d', $hours, $minutes, $seconds);
            }
        }

        
        $product->total_downloads = $product->videos->sum('download_count');

        return view('back.pages.product.show', compact('product'));
    }

    /**
     * Başarılı yanıt döndürür
     */
    private function successResponse($route, $message)
    {
        if (request()->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => $message,
                'redirect' => route($route)
            ]);
        }

        toastr()->success($message);
        return redirect()->route($route);
    }

    /**
     * Hata yanıtı döndürür
     */
    private function errorResponse($message)
    {
        if (request()->ajax()) {
            return response()->json([
                'status' => 'error',
                'message' => $message
            ], 422);
        }

        toastr()->error($message);
        return back()->withInput();
    }

    private function createUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $count = 1;

        
        while (Product::where('slug', $slug)->exists()) {
            $slug = Str::slug($title) . '-' . $count;
            $count++;
        }

        return $slug;
    }

    public function deleteVideo($id)
    {
        try {
            $video = ProductVideo::findOrFail($id);
            
            // Video dosyasını sil
            if (file_exists(public_path($video->video_path))) {
                unlink(public_path($video->video_path));
            }
            
            $video->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Video uğurla silindi'
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Video silme hatası: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Video silinərkən xəta baş verdi'
            ], 500);
        }
    }
}
