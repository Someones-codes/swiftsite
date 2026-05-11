<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CvFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CvController extends Controller
{
    public function index()
    {
        $activeCv = CvFile::where('is_active', true)->latest()->first();
        return view('admin.cv.index', compact('activeCv'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'cv' => 'required|file|mimes:pdf|max:5120',
        ]);

        // Make sure the storage disk is writable
        if (!Storage::disk('public')->exists('cv')) {
            Storage::disk('public')->makeDirectory('cv');
        }

        // Deactivate old CVs
        CvFile::where('is_active', true)->update(['is_active' => false]);

        $file = $request->file('cv');
        $path = $file->store('cv', 'public');

        CvFile::create([
            'file_path'     => $path,
            'original_name' => $file->getClientOriginalName(),
            'is_active'     => true,
        ]);

        return redirect()->route('admin.cv.index')
            ->with('success', 'CV uploaded successfully!');
    }

    public function destroy(CvFile $cv)
    {
        Storage::disk('public')->delete($cv->file_path);
        $cv->delete();

        return redirect()->route('admin.cv.index')
            ->with('success', 'CV removed.');
    }
}