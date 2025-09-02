<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::with('variants')->where('slug', $slug)->firstOrFail();

        $colors = $product->variants->pluck('color')->unique();
        $sizes  = $product->variants->pluck('size')->unique();

        return view('details', compact('product', 'colors', 'sizes'));
    }
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'slug' => 'required|string|unique:products,slug',
        'description' => 'required',
        'variants' => 'required|array',
        'variants.*.color' => 'required|string',
        'variants.*.size' => 'required|string',
        'variants.*.price' => 'nullable|numeric',
        'variants.*.quantity' => 'nullable|integer|min:0',
    ]);

    $product = new Product();
    $product->name = $request->name;
    $product->slug = $request->slug;
    $product->description = $request->description;

    // xử lý ảnh
    if ($request->hasFile('image')) {
        $product->image = $request->file('image')->store('products', 'public');
    }

    $product->save();

    // Lưu biến thể
    foreach ($request->variants as $variant) {
        $product->variants()->create($variant);
    }

    return redirect()->route('admin.products')->with('success', 'Thêm sản phẩm thành công!');
    }
    
}
