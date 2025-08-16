<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\PlanFeature;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\Rule;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = Plan::with('features')->get();

        return Inertia::render('Admin/Plans/Index', [
            'plans' => $plans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Plans/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:plans',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
            'features' => 'array',
            'features.*.feature_name' => 'required|string|max:255',
            'features.*.description' => 'nullable|string'
        ]);

        $plan = Plan::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'is_active' => $validated['is_active'] ?? true,
        ]);

        if (isset($validated['features'])) {
            foreach ($validated['features'] as $feature) {
                $plan->features()->create([
                    'feature_name' => $feature['feature_name'],
                    'description' => $feature['description'] ?? null,
                ]);
            }
        }

        return redirect()->route('admin.plans.index')
            ->with('success', 'Plan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $plan = Plan::with('features')->findOrFail($id);

        return Inertia::render('Admin/Plans/Show', [
            'plan' => $plan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $plan = Plan::with('features')->findOrFail($id);

        return Inertia::render('Admin/Plans/Edit', [
            'plan' => $plan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $plan = Plan::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('plans')->ignore($plan->id)],
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
            'features' => 'array',
            'features.*.feature_name' => 'required|string|max:255',
            'features.*.description' => 'nullable|string'
        ]);

        $plan->update([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'is_active' => $validated['is_active'] ?? true,
        ]);

        // Delete existing features and create new ones
        $plan->features()->delete();

        if (isset($validated['features'])) {
            foreach ($validated['features'] as $feature) {
                $plan->features()->create([
                    'feature_name' => $feature['feature_name'],
                    'description' => $feature['description'] ?? null,
                ]);
            }
        }

        return redirect()->route('admin.plans.index')
            ->with('success', 'Plan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $plan = Plan::findOrFail($id);
        $plan->delete();

        return redirect()->route('admin.plans.index')
            ->with('success', 'Plan deleted successfully.');
    }
}
