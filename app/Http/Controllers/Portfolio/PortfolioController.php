<?php

namespace App\Http\Controllers\Portfolio;
 
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\CvFile;
use Symfony\Component\HttpFoundation\StreamedResponse;
 
class PortfolioController extends Controller
{
    public function index()
    {
        $projects  = Project::orderBy('sort_order')->orderBy('is_featured', 'desc')->get();
        $activeCv  = CvFile::where('is_active', true)->latest()->first();
        return view('portfolio', compact('projects', 'activeCv'));
    }
 
    public function downloadCv(): StreamedResponse
    {
        $cv = CvFile::where('is_active', true)->latest()->firstOrFail();
 
        return response()->streamDownload(function () use ($cv) {
            echo \Illuminate\Support\Facades\Storage::disk('public')->get($cv->file_path);
        }, $cv->original_name, ['Content-Type' => 'application/pdf']);
    }
}
