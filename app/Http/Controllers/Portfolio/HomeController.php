<?php

namespace App\Http\Controllers\Portfolio;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Skill;

class HomeController extends Controller
{
    public function index()
    {
        // Get 3 featured projects for homepage
        $featuredProjects = Project::where('is_featured', true)
            ->orderBy('sort_order')
            ->take(3)
            ->get();

        // Group skills by category
        $skills = Skill::orderBy('sort_order')
            ->get()
            ->groupBy('category');

        return view('home', compact('featuredProjects', 'skills'));
    }

    public function demos()
    {
        return view('demos');
    }
}