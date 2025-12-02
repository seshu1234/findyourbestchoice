<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tool;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Validator;

class ToolController extends Controller
{
    /**
     * Show the frontend form to create a tool submission.
     */
    public function create()
    {
        return view('tools.create');
    }

    /**
     * Store a newly created Tool from the frontend form.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'slug' => 'nullable|string|max:191|unique:tools,slug',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'category_id' => 'nullable|integer|exists:categories,id',
            'logo_url' => 'nullable|url',
            'images' => 'nullable|string',
            'price_from' => 'nullable|numeric',
            'affiliate_url' => 'nullable|url',
            'official_url' => 'nullable|url',
            'pros' => 'nullable|string',
            'cons' => 'nullable|string',
            'meta' => 'nullable|string',
        ]);

        // Generate slug if not provided
        if (empty($data['slug']) && !empty($data['name'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        // Convert comma-separated strings to arrays where appropriate
        if (!empty($data['images']) && is_string($data['images'])) {
            // allow either comma-separated or JSON array
            $decoded = json_decode($data['images'], true);
            if (is_array($decoded)) {
                $data['images'] = $decoded;
            } else {
                $data['images'] = array_filter(array_map('trim', explode(',', $data['images'])));
            }
        }

        if (!empty($data['pros']) && is_string($data['pros'])) {
            $data['pros'] = array_filter(array_map('trim', explode(',', $data['pros'])));
        }

        if (!empty($data['cons']) && is_string($data['cons'])) {
            $data['cons'] = array_filter(array_map('trim', explode(',', $data['cons'])));
        }

        if (!empty($data['meta']) && is_string($data['meta'])) {
            $decoded = json_decode($data['meta'], true);
            $data['meta'] = is_array($decoded) ? $decoded : null;
        }

        $tool = Tool::create($data);

        return Redirect::route('tools.create')->with('success', 'Tool submitted successfully.');
    }
}
