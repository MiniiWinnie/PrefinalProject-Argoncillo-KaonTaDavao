<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Contracts\View\View;

class DistrictController extends Controller
{
    public function index(): View
    {
        return view('districts.index');
    }

    public function show(District $district): View
    {
        return view('districts.show', compact('district'));
    }
}
