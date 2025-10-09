<?php
namespace App\Http\Controllers;

use App\Models\DefaultContent;
use Illuminate\Http\Request;

class DefaultContentController extends Controller
{
    public function index()
    {
        $templates = DefaultContent::all();
        return view('default_contents.index', compact('templates'));
    }

    public function create()
    {
        return view('default_contents.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'document_type' => 'required',
            'content_type' => 'required',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        DefaultContent::create($validated);
        return redirect()->route('default-content.index')->with('success', 'Template created successfully.');
    }

    public function edit(DefaultContent $default_content)
    {
        return view('default_contents.create', compact('default_content'));
    }

    public function update(Request $request, DefaultContent $default_content)
    {
        $validated = $request->validate([
            'document_type' => 'required',
            'content_type' => 'required',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $default_content->update($validated);
        return redirect()->route('default-content.index')->with('success', 'Template updated successfully.');
    }

    public function destroy(DefaultContent $default_content)
    {
        $default_content->delete();
        return redirect()->route('default-content.index')->with('success', 'Template deleted successfully.');
    }
}
