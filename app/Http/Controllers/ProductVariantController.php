<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductVariant;

class ProductVariantController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('search');

        $products_variant = ProductVariant::with(['product:id,name,image,slug'])
            ->when($q, function ($query) use ($q) {
                $query->where('color', 'like', "%$q%")
                    ->orWhere('size', 'like', "%$q%")
                    ->orWhere('SKU', 'like', "%$q%")
                    ->orWhereHas('product', function ($p) use ($q) {
                        $p->where('name', 'like', "%$q%");
                    });
            })
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        // Đúng tên biến
        return view('admin.products-variant', compact('products_variant'));
    }

}
