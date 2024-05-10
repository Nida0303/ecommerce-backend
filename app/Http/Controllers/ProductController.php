<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductController extends Controller {
    // Get all products
    public function index() {
        return Product::all();
    }

    // Get a single product
    public function show($id) {
        return Product::findOrFail($id);
    }

    // Create a new product
    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|string'
        ]);

        return Product::create($validatedData);
    }

    // Update an existing product
    public function update(Request $request, $id) {
        $product = Product::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|string'
        ]);

        $product->update($validatedData);
        return $product;
    }

    // Delete a product
    public function destroy($id) {
        Product::findOrFail($id)->delete();
        return response()->json(['message' => 'Product deleted successfully.']);
    }
}

