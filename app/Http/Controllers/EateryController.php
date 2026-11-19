<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEateryRequest;
use App\Http\Requests\UpdateEateryRequest;
use App\Models\District;
use App\Models\Eatery;
use App\Models\Feature;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        return view('eateries.create', [
            'districts' => District::orderBy('name')->get(),
            'features' => Feature::orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEateryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $featureIds = $data['features'];
        unset($data['features'], $data['permit_no'], $data['expires_on']);

        $eatery = Eatery::create([
            ...$data,
            'slug' => Str::slug($data['name']),
            'is_open' => (bool) ($data['is_open'] ?? false),
        ]);
        $eatery->permit()->create([
            'permit_no' => $request->validated('permit_no'),
            'expires_on' => $request->validated('expires_on'),
        ]);
        $eatery->features()->sync($featureIds);

        return redirect()->route('eateries.show', $eatery)
            ->with('success', 'Eatery added.');
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

        $users = User::orderBy('name')->get();

        return view('eateries.show', compact('eatery', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Eatery $eatery): View
    {
        $eatery->load(['permit', 'features']);

        return view('eateries.edit', [
            'eatery' => $eatery,
            'districts' => District::orderBy('name')->get(),
            'features' => Feature::orderBy('name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEateryRequest $request, Eatery $eatery): RedirectResponse
    {
        $data = $request->validated();
        $featureIds = $data['features'];
        unset($data['features'], $data['permit_no'], $data['expires_on']);

        $eatery->update([
            ...$data,
            'slug' => Str::slug($data['name']),
            'is_open' => (bool) ($data['is_open'] ?? false),
        ]);
        $eatery->permit()->updateOrCreate(
            ['eatery_id' => $eatery->id],
            [
                'permit_no' => $request->validated('permit_no'),
                'expires_on' => $request->validated('expires_on'),
            ],
        );
        $eatery->features()->sync($featureIds);

        return redirect()->route('eateries.show', $eatery)
            ->with('success', 'Eatery updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Eatery $eatery): RedirectResponse
    {
        $eatery->delete();

        return redirect()->route('eateries.index')
            ->with('success', 'Eatery deleted.');
    }
}
