<?php

namespace App\Http\Controllers;

use App\Models\Client_Address;
use Illuminate\Http\Request;

class ClientAddressManager extends Controller
{
    // Get all addresses for a client
    public function getAddresses(Request $request)
    {
        $clientId = $request->input('client_id');

        $addresses = Client_Address::where('client_id', $clientId)
            ->orderBy('id', 'desc')
            ->get();

        return response()->json($addresses);
    }

    // Mark address active/inactive
    public function markStatus(Request $request, $status)
    {
        $address = Client_Address::find($request->input('address_id'));

        if (!$address) {
            return response("failed", 404);
        }

        $address->active = $status === 'active';
        $address->save();

        return response("success");
    }

    public function markStatusActive(Request $request)
    {
        return $this->markStatus($request, 'active');
    }

    public function markStatusInactive(Request $request)
    {
        return $this->markStatus($request, 'inactive');
    }
}