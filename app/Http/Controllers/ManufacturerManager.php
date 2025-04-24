<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerManager extends Controller
{
    // Fetch all active manufacturers
    public function getActiveManufacturers()
    {
        $manufacturers = Manufacturer::where('active', true)
            ->orderBy('name', 'asc')
            ->get();

        return response()->json($manufacturers);
    }

    // Mark a manufacturer as active or inactive
    public function markStatus(Request $request, $status)
    {
        $manufacturer = Manufacturer::find($request->input('manufacturer_id'));

        if (!$manufacturer) {
            return response("failed", 404);
        }

        $manufacturer->active = $status === 'active';
        $manufacturer->save();

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
