<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::paginate(10);
        return view('Categories.Index', compact('categories'));
    }

    public function create()
    {
        return view('Categories.Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        Categorie::create($request->all());
        return redirect()->route('categories.index')
                         ->with('success', 'Category created successfully');
    }

    public function show(Categorie $category)
    {
        return view('Categories.Show', compact('category'));
    }

    public function edit(Categorie $category)
    {
        return view('Categories.Edit', compact('category'));
    }

    public function update(Request $request, Categorie $category)
    {
        $category->update($request->all());
        return redirect()->route('categories.show', $category->id)
                         ->with('success', 'Category updated successfully');
    }

    public function destroy(Categorie $category)
    {
        $category->delete();
        return redirect()->route('categories.index')
                         ->with('success', 'Category deleted successfully');
    }
}
