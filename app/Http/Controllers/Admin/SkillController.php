<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::orderBy('category')->orderBy('sort_order')->get();
        return view('admin.skills.index', compact('skills'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:100',
            'category'    => 'required|in:frontend,backend,tools,other',
            'proficiency' => 'required|integer|min:10|max:100',
            'sort_order'  => 'nullable|integer|min:0', // ← added nullable
        ]);

        // Default sort_order to 0 if not provided
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Skill::create($validated);

        return redirect()->route('admin.skills.index')
            ->with('success', $validated['name'] . ' added successfully!');
    }

    public function destroy(Skill $skill)
    {
        $name = $skill->name;
        $skill->delete();

        return redirect()->route('admin.skills.index')
            ->with('success', $name . ' deleted.');
    }

    public function create()                          { abort(404); }
    public function show($id)                         { abort(404); }
    public function edit($id)                         { abort(404); }
    public function update(Request $request, $id)     { abort(404); }
}