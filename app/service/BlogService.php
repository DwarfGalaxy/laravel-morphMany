<?php

namespace App\Service;

use App\Models\Blog;
class BlogService
{
    private $imageService;
    public function __construct()
    {
        $this->imageService = new ImageService();
    }
    // ==========POST=============
    public function addService($request)
    {
        // adding data to db
        $blog = Blog::create($request);
        // if image exist
        if (isset($request['image'])) {
            $this->imageService->addImages($blog, $request['image'], 'blog');
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
    public function updateService($request, $blog)
    {
        if (!empty($request['image'])) {
            $this->imageService->updateImages($blog, $request['image'], 'blog', true);
        }
        $blog->update([
            'title' => $request['title'],
            'slug' => $request['slug'],
            'description' => $request['description']
        ]);
    }
}
