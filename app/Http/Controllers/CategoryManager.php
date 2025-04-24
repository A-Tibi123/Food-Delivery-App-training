<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryManager extends Controller
{
    // Return all active categories, ordered by position
    public function getActiveCategories()
    {
        $categories = Category::where('active', true)
            ->orderBy('position', 'asc')
            ->get();

        return response()->json($categories);
    }

    // Mark a category as active or inactive
    public function markStatus(Request $request, $status)
    {
        $category = Category::find($request->input('category_id'));

        if (!$category) {
            return response("failed", 404);
        }

        $category->active = $status === 'active';
        $category->save();

        return response("success");
    }

    public function markStatusActive(Request $request)
    {
        return $this->markStatus($request, "active");
    }

    public function markStatusInactive(Request $request)
    {
        return $this->markStatus($request, "inactive");
    }
}
