<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ComplaintCategory;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = ComplaintCategory::get();
        
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $category = ComplaintCategory::create($validatedData);
        return redirect()->route('categories.all')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = ComplaintCategory::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $category = ComplaintCategory::findOrFail($id);
        $category->update($validatedData);
        return redirect()->route('categories.all')->with('success', 'Category updated successfully.');
    }

    public function show($id)
    {
        $category = ComplaintCategory::findOrFail($id);
        return view('categories.show', compact('category'));
    }
}
