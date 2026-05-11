<?php

namespace App\Models\Demo\Blog;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = ['demo_session_id','author_name','title','body','likes'];
 
    public function comments()
    {
        return $this->hasMany(BlogComment::class);
    }
}
