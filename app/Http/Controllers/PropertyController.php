<?php

namespace App\Http\Controllers;

use App\Http\Resources\PropertyResource;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return PropertyResource::collection(Property::paginate());
    }

    public function search(Request $request)
    {
        $data = $request->validate([
            'name' => 'nullable|string',
            'price.min' => 'nullable|numeric|min:0|lte:price.max',
            'price.max' => 'nullable|numeric|min:0|gte:price.min',
            'bedrooms' => 'nullable|numeric',
            'bathrooms' => 'nullable|numeric',
            'garages' => 'nullable|numeric|min:0',
            'storeys' => 'nullable|numeric|min:0',
        ]);
        $query = Property::query();
        if (!empty($data['name'])) {
            $name = mb_strtolower($data['name']);
            $query->where('name', 'like', "%$name%");
        }
        if (isset($data['bedrooms'])) {
            $query->where('bedrooms', $data['bedrooms']);
        }
        if (isset($data['bathrooms'])) {
            $query->where('bathrooms', $data['bathrooms']);
        }
        if (isset($data['garages'])) {
            $query->where('garages', $data['garages']);
        }
        if (isset($data['storeys'])) {
            $query->where('storeys', $data['storeys']);
        }
        if (isset($data['price']['min'])) {
            $query->where('price', '>=', $data['price']['min']);
        }
        if (isset($data['price']['max'])) {
            $query->where('price', '<=', $data['price']['max']);
        }

        return PropertyResource::collection($query->get())
            ->additional([
                'formData' => $data,
                'sql' => Property::getSqlWithBindings($query),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        //
    }
}
