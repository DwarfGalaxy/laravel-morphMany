<?php

namespace App\Service;

use App\Models\Blog;
use App\Models\BlogImage;
use Illuminate\Support\Facades\Storage;
// with one to many relation
class BlogService
{
    private $imageService;
    public function __construct()
    {
        $this->imageService = new ImageService();
    }
    // ==========POST=============
    public function addService($data)
    {
        // adding data to db
        $blog = Blog::create($data);
        // if image exist
        if (isset($data['image'])) {
            $this->imageService->addImages($blog, $data['image'], 'blog');
        }
    }

    // =========GET(All blogs)=======================
    public function fetchBlogs()
    {
        $blogs = Blog::with('image')->get();
        return $blogs;
    }

    // ==================DELETE======================
    public function delete($blog)
    {
        if (!empty($blog['image'])) {
            $this->imageService->deleteImages($blog['image']);
        }
        $blog->delete();
    }

    // ===================view=====================
    public function view($blog)
    {
        $blog = Blog::with('image')->find($blog->id);
        // $blog = Blog::with('image')->first();
        return $blog;
    }

    // ================UPDATE=======================
    public function updateService($data, $blog)
    {
        if (!empty($data['image'])) {
            $this->imageService->updateImages($blog, $data['image'], 'blog', true);
        }
        $blog->update([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'description' => $data['description']
        ]);
    }
}
