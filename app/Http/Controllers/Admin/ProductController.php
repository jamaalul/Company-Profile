<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            // 'stock' => 'required|integer|min:0',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'specifications' => 'nullable|array',
            'link' => 'required|string|url', // Fixed: removed min:0 and added url validation
            'is_featured' => 'boolean',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->all();
        
        // Handle image uploads
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $images[] = $path;
            }
            $data['images'] = $images;
            
            // Debug: Log the uploaded images
            Log::info('Images uploaded:', $images);
        } else {
            // Debug: Log if no images were uploaded
            Log::info('No images uploaded');
        }

        // Handle specifications - convert to proper format if needed
        if ($request->has('specifications')) {
            $specs = [];
            foreach ($request->specifications as $spec) {
                if (!empty($spec['key']) && !empty($spec['value'])) {
                    $specs[$spec['key']] = $spec['value'];
                }
            }
            $data['specifications'] = $specs;
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dibuat.');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            // 'stock' => 'required|integer|min:0',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'specifications' => 'nullable|array',
            'link' => 'required|string|url', // Fixed: removed min:0 and added url validation
            'is_featured' => 'boolean',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->all();
        
        // Handle image uploads
        if ($request->hasFile('images')) {
            // Delete old images
            if ($product->images) {
                foreach ($product->images as $image) {
                    Storage::disk('public')->delete($image);
                }
            }
            
            $images = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $images[] = $path;
            }
            $data['images'] = $images;
        }

        // Handle specifications - convert to proper format if needed
        if ($request->has('specifications')) {
            $specs = [];
            foreach ($request->specifications as $spec) {
                if (!empty($spec['key']) && !empty($spec['value'])) {
                    $specs[$spec['key']] = $spec['value'];
                }
            }
            $data['specifications'] = $specs;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diupdate.');
    }

    public function destroy(Product $product)
    {
        // Delete product images
        if ($product->images) {
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}