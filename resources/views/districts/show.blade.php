@extends('layouts.app')

@section('title', $district->name)

@section('content')
    <div class="mx-auto max-w-7xl px-6 py-10">
        <h1 class="text-3xl font-bold">{{ $district->name }}</h1>
        <p class="mt-2 text-stone-600">
            {{ $district->reviews_count }} {{ Str::plural('review', $district->reviews_count) }} in {{ $district->name }}
        </p>

        <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($district->eateries as $eatery)
                <x-eatery-card :eatery="$eatery" />
            @endforeach
        </div>
    </div>
@endsection
