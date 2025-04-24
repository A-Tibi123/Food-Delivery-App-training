<?php

namespace App\Http\Controllers;

use App\Models\Currency_Rate;
use Illuminate\Http\Request;

class CurrencyRateManager extends Controller
{
    // Get all rates for a specific reference currency
    public function getRates(Request $request)
    {
        $refId = $request->input('reference_currency_id');

        $rates = Currency_Rate::where('reference_currency_id', $refId)
            ->orderBy('valability_date', 'desc')
            ->get();

        return response()->json($rates);
    }

    // Update conversion rate for a currency pair
    public function updateRate(Request $request)
    {
        $rate = Currency_Rate::find($request->input('rate_id'));

        if (!$rate) {
            return response("failed", 404);
        }

        $rate->conversion_rate = $request->input('conversion_rate', $rate->conversion_rate);
        $rate->save();

        return response("success");
    }
}
