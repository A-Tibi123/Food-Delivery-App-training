<?php

namespace App\Http\Controllers;

use App\Models\Carrier;
use Illuminate\Http\Request;

class CarrierManager extends Controller
{
    // Return all active carriers
    public function getActiveCarriers()
    {
        $carriers = Carrier::where('active', true)
            ->where('deleted', false)
            ->orderBy('position', 'asc')
            ->get();

        return response()->json($carriers);
    }

    // Mark carrier status (activate/deactivate)
    public function markStatus(Request $request, $status)
    {
        $carrier = Carrier::find($request->input('carrier_id'));

        if (!$carrier) {
            return response("failed", 404);
        }

        $carrier->active = $status === 'active';
        $carrier->save();

        return response("success");
    }

    public function activate(Request $request)
    {
        return $this->markStatus($request, "active");
    }

    public function deactivate(Request $request)
    {
        return $this->markStatus($request, "inactive");
    }
}