@extends('layouts.app')

@section('title', 'Kaon Ta! Davao - Argoncillo\'s Food Guide')

@section('content')
    <div class="mx-auto max-w-7xl px-6 py-10">
        <h1 class="text-3xl font-bold">Kaon Ta! Davao</h1>

        <div class="mt-6 grid gap-4 sm:grid-cols-3">
            <div class="rounded-lg border border-stone-200 bg-white p-5">
                <p class="text-sm text-stone-500">Eateries</p>
                <p class="text-2xl font-bold">{{ $eateryCount }}</p>
            </div>
            <div class="rounded-lg border border-stone-200 bg-white p-5">
                <p class="text-sm text-stone-500">Districts</p>
                <p class="text-2xl font-bold">{{ $districtCount }}</p>
            </div>
            <div class="rounded-lg border border-stone-200 bg-white p-5">
                <p class="text-sm text-stone-500">Reviews</p>
                <p class="text-2xl font-bold">{{ $reviewCount }}</p>
            </div>
        </div>

        <h2 class="mt-10 text-2xl font-bold">Top Rated</h2>
        <div class="mt-5 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($topRated as $eatery)
                <x-eatery-card :eatery="$eatery" />
            @endforeach
        </div>
    </div>
@endsection
