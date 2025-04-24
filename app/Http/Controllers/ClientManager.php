<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientManager extends Controller
{
    // Get all clients with optional status filter
    public function getClients(Request $request)
    {
        $status = $request->input('status');

        $clients = Client::when($status !== null, function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->orderBy('id', 'desc')
            ->get();

        return response()->json($clients);
    }

    // Update client's status (e.g., activate, suspend)
    public function markStatus(Request $request, $status)
    {
        $client = Client::find($request->input('client_id'));

        if (!$client) {
            return response("failed", 404);
        }

        $client->status = $status;
        $client->save();

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