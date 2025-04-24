<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class StateManager extends Controller
{
    // Get all active states by country
    public function getActiveStates(Request $request)
    {
        $query = State::query();

        if ($request->has('country_id')) {
            $query->where('country_id', $request->country_id);
        }

        $states = $query->where('active', true)
                        ->orderBy('name')
                        ->get();

        return response()->json($states);
    }

    // Mark a state's active status
    public function markStatus(Request $request, $status)
    {
        $state = State::find($request->input('state_id'));

        if (!$state) {
            return response("failed", 404);
        }

        $state->active = $status === 'active';
        $state->save();

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