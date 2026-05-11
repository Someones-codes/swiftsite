<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = ['name', 'category', 'proficiency', 'sort_order'];
}
