<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable=['title','slug','description'];
    // public function blog_images(){
    //     return $this->hasMany(BlogImage::class);
    // }
    public function image(){
        return $this->morphMany(Image::class,'model');
    }
}
