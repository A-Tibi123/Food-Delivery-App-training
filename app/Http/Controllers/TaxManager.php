<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;

class TaxManager extends Controller
{
    // Get all tax records
    public function getTaxes()
    {
        $taxes = Tax::orderBy('name')->get();
        return response()->json($taxes);
    }

    // Update the tax rate or name
    public function updateTax(Request $request)
    {
        $tax = Tax::find($request->input('tax_id'));

        if (!$tax) {
            return response("failed", 404);
        }

        if ($request->has('name')) {
            $tax->name = $request->input('name');
        }

        if ($request->has('rate')) {
            $tax->rate = $request->input('rate');
        }

        $tax->save();

        return response("success");
    }
}