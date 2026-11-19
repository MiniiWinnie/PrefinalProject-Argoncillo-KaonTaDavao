@extends('layouts.app')

@section('title', 'Eateries - Kaon Ta! Davao')

@section('content')
    <div class="mx-auto max-w-7xl px-6 py-10">
        <h1 class="text-3xl font-bold">Eateries</h1>

        <form method="GET" action="{{ route('eateries.index') }}" class="mt-6 grid gap-3 rounded-lg border border-stone-200 bg-white p-4 md:grid-cols-4">
            <input type="text" name="q" value="{{ old('q', request('q')) }}" placeholder="Search name or specialty"
                   class="rounded border border-stone-300 px-3 py-2">
            <select name="district" class="rounded border border-stone-300 px-3 py-2">
                <option value="">All districts</option>
                @foreach ($districts as $district)
                    <option value="{{ $district->id }}" @selected((string) request('district') === (string) $district->id)>
                        {{ $district->name }}
                    </option>
                @endforeach
            </select>
            <select name="feature" class="rounded border border-stone-300 px-3 py-2">
                <option value="">All features</option>
                @foreach ($features as $feature)
                    <option value="{{ $feature->name }}" @selected(request('feature') === $feature->name)>
                        {{ $feature->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="rounded bg-amber-700 px-4 py-2 font-semibold text-white">Filter</button>
        </form>

        @if ($eateries->count() === 0)
            <p class="mt-8 text-stone-600">No eateries match your filters</p>
        @else
            <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($eateries as $eatery)
                    <x-eatery-card :eatery="$eatery" />
                @endforeach
            </div>
            <div class="mt-8">
                {{ $eateries->links() }}
            </div>
        @endif
    </div>
@endsection
