<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyManager extends Controller
{
    // Return all active currencies
    public function getActiveCurrencies()
    {
        $currencies = Currency::where('active', true)
            ->orderBy('name')
            ->get();

        return response()->json($currencies);
    }

    // Mark a currency as active/inactive
    public function markStatus(Request $request, $status)
    {
        $currency = Currency::find($request->input('currency_id'));

        if (!$currency) {
            return response("failed", 404);
        }

        $currency->active = $status === 'active';
        $currency->save();

        return response("success");
    }

    public function activate(Request $request)
    {
        return $this->markStatus($request, 'active');
    }

    public function deactivate(Request $request)
    {
        return $this->markStatus($request, 'inactive');
    }
}