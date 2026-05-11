<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = ['name', 'email', 'subject', 'message', 'phone', 'is_read', 'read_at'];
    protected $casts    = ['is_read' => 'boolean', 'read_at' => 'datetime'];
}
