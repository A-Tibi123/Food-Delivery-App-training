<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguageManager extends Controller
{
    // Get all active languages
    public function getActiveLanguages()
    {
        $languages = Language::where('active', true)
            ->orderBy('display_order', 'asc')
            ->get();

        return response()->json($languages);
    }

    // Update the active status of a language
    public function markStatus(Request $request, $status)
    {
        $language = Language::find($request->input('language_id'));

        if (!$language) {
            return response("failed", 404);
        }

        $language->active = $status === 'active';
        $language->save();

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
