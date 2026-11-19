@extends('layouts.app')

@section('title', 'Districts - Kaon Ta! Davao')

@section('content')
    <div class="mx-auto max-w-5xl px-6 py-10">
        <h1 class="text-3xl font-bold">Districts</h1>
        <div class="mt-6 grid gap-4 sm:grid-cols-2">
            @foreach ($districts as $district)
                <a href="{{ route('districts.show', $district) }}"
                   class="rounded-lg border border-stone-200 bg-white p-5 font-semibold hover:border-amber-500">
                    {{ $district->name }} · {{ $district->eateries_count }} {{ Str::plural('eatery', $district->eateries_count) }}
                </a>
            @endforeach
        </div>
    </div>
@endsection
