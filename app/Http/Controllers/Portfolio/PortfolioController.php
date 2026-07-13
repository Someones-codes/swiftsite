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
 
   public function downloadCv(): StreamedResponse|\Illuminate\Http\RedirectResponse
{
    $cv = CvFile::where('is_active', true)->latest()->first();

    // If no DB record, serve the file directly by path
    if (!$cv) {
        $path = storage_path('app/public/cv/prince_chishanga_cv.pdf');

        if (!file_exists($path)) {
            abort(404, 'CV not found. Please check back soon.');
        }

        return response()->streamDownload(function () use ($path) {
            echo file_get_contents($path);
        }, 'Prince_Chishanga_CV.pdf', [
            'Content-Type' => 'application/pdf',
        ]);
    }

    return response()->streamDownload(function () use ($cv) {
        echo \Illuminate\Support\Facades\Storage::disk('public')->get($cv->file_path);
    }, 'Prince_Chishanga_CV.pdf', [
        'Content-Type' => 'application/pdf',
    ]);
}
}
