<?php

namespace App\Http\Controllers;

use App\Models\Eatery;
use App\Models\District;
use App\Models\Feature;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class EateryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $eateries = Eatery::query()
            ->with(['district', 'features', 'reviews'])
            ->when($request->filled('q'), function (Builder $query) use ($request): void {
                $search = (string) $request->string('q');
                $query->where(function (Builder $query) use ($search): void {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('specialty', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('district'), function (Builder $query) use ($request): void {
                $query->where('district_id', (int) $request->input('district'));
            })
            ->when($request->filled('feature'), function (Builder $query) use ($request): void {
                $featureName = (string) $request->string('feature');
                $query->whereHas('features', function (Builder $query) use ($featureName): void {
                    $query->where('name', $featureName);
                });
            })
            ->orderBy('name')
            ->paginate(6)
            ->withQueryString();

        $districts = District::orderBy('name')->get();
        $features = Feature::orderBy('name')->get();

        return view('eateries.index', compact('eateries', 'districts', 'features'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('eateries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort(501);
    }

    /**
     * Display the specified resource.
     */
    public function show(Eatery $eatery): View
    {
        $eatery->load([
            'district',
            'features',
            'permit',
            'dishes',
            'reviews.user',
        ]);
        $eatery->setRelation(
            'reviews',
            $eatery->reviews->sortByDesc('created_at')->values(),
        );
        return view('eateries.show', compact('eatery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Eatery $eatery): View
    {
        return view('eateries.edit', compact('eatery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Eatery $eatery)
    {
        abort(501);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Eatery $eatery)
    {
        abort(501);
    }
}
