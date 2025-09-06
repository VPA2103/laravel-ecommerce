<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use Auth;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, $order_id, $product_id)
    {
        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // chỉ cho phép đánh giá khi user đã mua sản phẩm
        $order = Order::where('id', $order_id)
            ->where('user_id', Auth::id())
            ->whereHas('orderItems', function ($q) use ($product_id) {
                $q->where('product_id', $product_id);
            })
            ->first();

        if (!$order) {
            return back()->with('error', 'Bạn chưa mua sản phẩm này, không thể đánh giá!');
        }

        Review::updateOrCreate(
            [
                'user_id'    => Auth::id(),
                'product_id' => $product_id,
                'order_id'   => $order_id,
            ],
            [
                'rating'  => $request->rating,
                'comment' => $request->comment,
            ]
        );

        return back()->with('success', 'Cảm ơn bạn đã đánh giá!');
    }
}
