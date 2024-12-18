<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogRequest;
use App\Models\Blog;
use App\Models\BlogType;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('blogType')->latest()->get();
        return view('back.pages.blog.index', compact('blogs'));
    }

    public function create()
    {
        $blogTypes = BlogType::where('status', true)->get();
        return view('back.pages.blog.create', compact('blogTypes'));
    }

    public function store(BlogRequest $request)
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $destinationPath = public_path('uploads/blogs');
                $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $webpFileName = time() . '_' . $originalFileName . '.webp';

                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0777, true);
                }

                $imageResource = imagecreatefromstring(file_get_contents($file));
                $webpPath = $destinationPath . '/' . $webpFileName;

                if ($imageResource) {
                    imagewebp($imageResource, $webpPath, 80);
                    imagedestroy($imageResource);

                    $data['image'] = 'uploads/blogs/' . $webpFileName;
                }
            }

            $data['slug'] = Str::slug($request->title_en);
            $data['view_count'] = 0;
            $data['published_at'] = now();

            Blog::create($data);

            return redirect()
                ->route('admin.blog.index')
                ->with('success', 'Blog uğurla əlavə edildi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $blog = Blog::findOrFail($id);
            $blogTypes = BlogType::where('status', true)->get();
            return view('back.pages.blog.edit', compact('blog', 'blogTypes'));
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.blog.index')
                ->with('error', 'Blog tapılmadı');
        }
    }

    public function update(BlogRequest $request, $id)
    {
        try {
            $blog = Blog::findOrFail($id);
            $data = $request->validated();

            if ($request->hasFile('image')) {
                if ($blog->image && File::exists(public_path($blog->image))) {
                    File::delete(public_path($blog->image));
                }

                $file = $request->file('image');
                $destinationPath = public_path('uploads/blogs');
                $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $webpFileName = time() . '_' . $originalFileName . '.webp';

                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0777, true);
                }

                $imageResource = imagecreatefromstring(file_get_contents($file));
                $webpPath = $destinationPath . '/' . $webpFileName;

                if ($imageResource) {
                    imagewebp($imageResource, $webpPath, 80);
                    imagedestroy($imageResource);

                    $data['image'] = 'uploads/blogs/' . $webpFileName;
                }
            }

            $data['slug'] = Str::slug($request->title_en);
            $blog->update($data);

            return redirect()
                ->route('admin.blog.index')
                ->with('success', 'Blog uğurla yeniləndi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $blog = Blog::findOrFail($id);

            if ($blog->image && File::exists(public_path($blog->image))) {
                File::delete(public_path($blog->image));
            }

            $blog->delete();

            return redirect()
                ->route('admin.blog.index')
                ->with('success', 'Blog uğurla silindi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }

    public function status($id)
    {
        try {
            $blog = Blog::findOrFail($id);
            $blog->status = !$blog->status;
            $blog->save();

            return redirect()
                ->route('admin.blog.index')
                ->with('success', 'Status uğurla yeniləndi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }
}
