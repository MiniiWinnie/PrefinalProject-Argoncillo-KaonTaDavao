<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Contracts\View\View;

class DistrictController extends Controller
{
    public function index(): View
    {
        $districts = District::query()
            ->withCount('eateries')
            ->orderBy('name')
            ->get();

        return view('districts.index', compact('districts'));
    }

    public function show(District $district): View
    {
        $district->load([
            'eateries' => function ($query): void {
                $query->with(['district', 'features', 'reviews'])
                    ->orderBy('name');
            },
        ]);
        $district->loadCount('reviews');

        return view('districts.show', compact('district'));
    }
}
