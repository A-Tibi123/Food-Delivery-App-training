<?php

namespace App\Http\Controllers;

use App\Models\Cart_Product;
use Illuminate\Http\Request;

class CartProductManager extends Controller
{
    // Fetch all products for a specific cart by cart_id
    public function getCartItems(Request $request)
    {
        $cartId = $request->input('cart_id');

        $items = CartProductManager::where('cart_id', $cartId)
            ->orderBy('id', 'desc')
            ->get();

        return response()->json($items);
    }

    // Mark product item with a custom status (e.g., update quantity, flag as removed)
    public function updateQuantity(Request $request)
    {
        $item = CartProductManager::find($request->input('id'));

        if (!$item) {
            return response()->json(['status' => 'failed', 'message' => 'Item not found'], 404);
        }

        $item->quantity = $request->input('quantity', $item->quantity);
        $item->save();

        return response()->json(['status' => 'success', 'data' => $item]);
    }

    // Remove product item from cart
    public function removeItem(Request $request)
    {
        $item = CartProductManager::find($request->input('id'));

        if (!$item) {
            return response()->json(['status' => 'failed', 'message' => 'Item not found'], 404);
        }

        $item->delete();

        return response()->json(['status' => 'success']);
    }
}