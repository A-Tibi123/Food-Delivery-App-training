<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryManager extends Controller
{
    // Get all active countries ordered by name
    public function getActiveCountries()
    {
        $countries = Country::where('active', true)
            ->orderBy('name', 'asc')
            ->get();

        return response()->json($countries);
    }

    // Mark a country's active status
    public function markStatus(Request $request, $status)
    {
        $country = Country::find($request->input('country_id'));

        if (!$country) {
            return response("failed", 404);
        }

        $country->active = $status === 'active';
        $country->save();

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