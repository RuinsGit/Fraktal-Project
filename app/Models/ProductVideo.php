<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVideo extends Model
{
    protected $fillable = [
        'product_id',
        'video_path',
        'title',
        'description',
        'download_count',
        'view_count',
        'rating',
        'duration',
        'order'
    ];

    protected $attributes = [
        'download_count' => 0,
        'rating' => 5,
        'view_count' => 0,
        'duration' => 0
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getFormattedDurationAttribute()
    {
        $duration = $this->duration ?? 0;
        
        if ($duration < 60) {
            return $duration . ' saniyə';
        } elseif ($duration < 3600) {
            $minutes = floor($duration / 60);
            $seconds = $duration % 60;
            return sprintf('%02d:%02d', $minutes, $seconds);
        } else {
            $hours = floor($duration / 3600);
            $minutes = floor(($duration % 3600) / 60);
            $seconds = $duration % 60;
            return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
        }
    }

    public function getRatingStarsAttribute()
    {
        $rating = $this->rating ?? 5;
        $html = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $rating) {
                $html .= '<i class="fas fa-star text-warning"></i>';
            } else {
                $html .= '<i class="far fa-star text-warning"></i>';
            }
        }
        return $html;
    }

    public function incrementDownloadCount()
    {
        $this->increment('download_count');
    }

    public function incrementViewCount()
    {
        $this->increment('view_count');
    }

    public static function uploadVideo($file, $productId, $order = 0)
    {
        try {
            $videoName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $uploadPath = 'uploads/products/videos';
            $fullPath = public_path($uploadPath);
            
            // Klasör yoksa oluştur
            if (!file_exists($fullPath)) {
                mkdir($fullPath, 0777, true);
            }
            
            // Videoyu yükle
            $file->move($fullPath, $videoName);
            
            // Video kaydını oluştur
            return self::create([
                'product_id' => $productId,
                'title' => 'Video ' . ($order + 1),
                'video_path' => $uploadPath . '/' . $videoName,
                'order' => $order,
                'duration' => 0, // FFmpeg ile otomatik hesaplanacak
                'download_count' => 0,
                'view_count' => 0,
                'rating' => 5
            ]);
        } catch (\Exception $e) {
            \Log::error('Video yükleme hatası: ' . $e->getMessage());
            throw $e;
        }
    }

    public function deleteWithFile()
    {
        try {
            // Dosyayı sil
            if ($this->video_path && file_exists(public_path($this->video_path))) {
                unlink(public_path($this->video_path));
            }
            
            // Kaydı sil
            return $this->delete();
        } catch (\Exception $e) {
            \Log::error('Video silme hatası: ' . $e->getMessage());
            throw $e;
        }
    }

    public function updateDurationFromFile()
    {
        try {
            $path = public_path($this->video_path);
            if (file_exists($path)) {
                $getID3 = new \getID3;
                $fileInfo = $getID3->analyze($path);
                
                if (isset($fileInfo['playtime_seconds'])) {
                    $this->duration = round($fileInfo['playtime_seconds']);
                    $this->save();
                }
            }
        } catch (\Exception $e) {
            \Log::error('Video süresi hesaplama hatası: ' . $e->getMessage());
        }
    }
}