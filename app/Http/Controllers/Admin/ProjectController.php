<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('sort_order')->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'description'       => 'required|string',
            'short_description' => 'required|string|max:255',
            'tech_stack'        => 'required|string|max:255',
            'live_url'          => 'nullable|url',
            'github_url'        => 'nullable|url',
            'is_featured'       => 'boolean',
            'sort_order'        => 'integer',
            'image'             => 'nullable|image|mimes:jpg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('projects', 'public');
            $validated['image_path'] = $path;
        }

        unset($validated['image']);
        Project::create($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully!');
    }

    public function show(string $id)
    {
        abort(404);
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'description'       => 'required|string',
            'short_description' => 'required|string|max:255',
            'tech_stack'        => 'required|string|max:255',
            'live_url'          => 'nullable|url',
            'github_url'        => 'nullable|url',
            'is_featured'       => 'boolean',
            'sort_order'        => 'integer',
            'image'             => 'nullable|image|mimes:jpg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($project->image_path) {
                Storage::disk('public')->delete($project->image_path);
            }
            $path = $request->file('image')->store('projects', 'public');
            $validated['image_path'] = $path;
        }

        unset($validated['image']);
        $project->update($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully!');
    }

    public function destroy(Project $project)
    {
        if ($project->image_path) {
            Storage::disk('public')->delete($project->image_path);
        }
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted.');
    }
}