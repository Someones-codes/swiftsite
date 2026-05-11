<?php

namespace App\Models\Demo\Blog;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = ['demo_session_id','blog_post_id','author_name','content'];
 
    public function post()
    {
        return $this->belongsTo(BlogPost::class, 'blog_post_id');
    }
}
