<?php

namespace App\Http\Controllers;

use App\Models\Eatery;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class EateryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        return view('eateries.index');
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
