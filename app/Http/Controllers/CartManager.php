<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartManager extends Controller
{
    // Get all carts for a specific client (similar to getDelivery)
    public function getCart(Request $request)
    {
        $clientId = $request->input('client_id');

        $carts = Cart::where('client_id', $clientId)
            ->orderBy('id', 'desc')
            ->get();

        return response()->json($carts);
    }

    // Mark a cart's status field (e.g., active/inactive) — similar to markStatus
    public function markStatus(Request $request, $status)
    {
        $cart = Cart::find($request->input('cart_id'));

        if (!$cart) {
            return response("failed", 404);
        }

        $cart->active = $status === 'active';
        $cart->save();

        return response("success");
    }

    public function markActive(Request $request)
    {
        return $this->markStatus($request, "active");
    }

    public function markInactive(Request $request)
    {
        return $this->markStatus($request, "inactive");
    }
}