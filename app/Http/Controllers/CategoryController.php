<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller {
    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return Category::all();
    }

    public function show($id) {
        return Category::findOrFail($id);
    }

    public function store(Request $request) {
        $validatedData = $request->validate(['name' => 'required|string|max:255']);
        return Category::create($validatedData);
    }

    public function update(Request $request, $id) {
        $category = Category::findOrFail($id);
        $validatedData = $request->validate(['name' => 'required|string|max:255']);
        $category->update($validatedData);
        return $category;
    }

    public function destroy($id) {
        Category::findOrFail($id)->delete();
        return response()->json(['message' => 'Category deleted successfully.']);
    }
}
