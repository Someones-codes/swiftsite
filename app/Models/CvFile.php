<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CvFile extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = ['file_path', 'original_name', 'is_active'];
    protected $casts    = ['is_active' => 'boolean'];
}
 