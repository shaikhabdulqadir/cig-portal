<?php

namespace App\Http\Controllers;

use App\Models\Addon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class AddonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addons = Addon::whereNotNull('api_name')->latest()->get();

        return Inertia::render('Admin/Addons/Index', [
            'addons' => $addons,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Addons/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:addons',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'max_quantity' => 'nullable|integer|min:1',
            'is_recurring' => 'required|boolean',
        ]);

        Addon::create($validated);

        return redirect()->route('admin.addons.index')
            ->with('success', 'Addon created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $addon = Addon::findOrFail($id);

        return Inertia::render('Admin/Addons/Show', [
            'addon' => $addon,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $addon = Addon::findOrFail($id);

        return Inertia::render('Admin/Addons/Create', [
            'addon' => $addon,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $addon = Addon::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('addons')->ignore($addon->id)],
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'max_quantity' => 'nullable|integer|min:1',
            'is_recurring' => 'required|boolean',
        ]);

        $addon->update($validated);

        return redirect()->route('admin.addons.index')
            ->with('success', 'Addon updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $addon = Addon::findOrFail($id);
        $addon->delete();

        return redirect()->route('admin.addons.index')
            ->with('success', 'Addon deleted successfully.');
    }
}
