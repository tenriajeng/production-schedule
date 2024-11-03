<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductionPlanRequest;
use App\Http\Requests\UpdateProductionPlanRequest;
use App\Models\ProductionPlan;
use Illuminate\Http\Request;

class ProductionPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');

        $plans = ProductionPlan::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })->paginate(10);

        return view('production_plans.index', compact('plans', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('production_plans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductionPlanRequest $request)
    {
        $validatedData = $request->validated();

        $productionPlan = ProductionPlan::create([
            'name' => $validatedData['name'],
        ]);

        foreach ($validatedData['planned_production'] as $day => $plannedProduction) {
            $adjustedProduction = $validatedData['adjusted_production'][$day] ?? 0;

            $productionPlan->productionSchedules()->create([
                'day' => $day,
                'planned_production' => $plannedProduction,
                'adjusted_production' => $adjustedProduction,
            ]);
        }

        return redirect()->route('production.plans.index')->with('success', 'Production plan created successfully!');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductionPlan $productionPlan)
    {
        return view('production_plans.edit', compact('productionPlan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductionPlanRequest $request, ProductionPlan $productionPlan)
    {
        $validatedData = $request->validated();

        $productionPlan->update(['name' => $validatedData['name']]);

        foreach ($validatedData['planned_production'] as $day => $plannedProduction) {
            $adjustedProduction = $validatedData['adjusted_production'][$day] ?? 0;

            $productionPlan->productionSchedules()->updateOrCreate(
                ['day' => $day],
                ['planned_production' => $plannedProduction, 'adjusted_production' => $adjustedProduction]
            );
        }

        return redirect()->route('production.plans.index')->with('success', 'Production Plan updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductionPlan $productionPlan)
    {
        $productionPlan->delete();
        return redirect()->route('production.plans.index')->with('success', 'Production Plan deleted successfully.');
    }
}
