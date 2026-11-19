@extends('layouts.app')

@section('title', $eatery->name)

@section('content')
    <div class="mx-auto max-w-5xl px-6 py-10">
        <a href="{{ route('eateries.index') }}" class="text-sm text-amber-700">&larr; Back to eateries</a>

        <div class="mt-4 flex gap-3">
            <a href="{{ route('eateries.edit', $eatery) }}"
               class="rounded border border-amber-700 px-3 py-2 text-sm font-semibold text-amber-700">
                Edit
            </a>
            <form method="POST" action="{{ route('eateries.destroy', $eatery) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="rounded border border-red-700 px-3 py-2 text-sm font-semibold text-red-700">
                    Delete
                </button>
            </form>
        </div>

        <div class="mt-5 rounded-lg border border-stone-200 bg-white p-6">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold">{{ $eatery->name }}</h1>
                    <a href="{{ route('districts.show', $eatery->district) }}" class="text-amber-700">
                        {{ $eatery->district->name }}
                    </a>
                    <p class="mt-2 text-stone-600">{{ $eatery->address }}</p>
                </div>
                @if (! $eatery->is_open)
                    <span class="rounded-full bg-red-100 px-3 py-1 text-sm font-bold text-red-700">Closed</span>
                @endif
            </div>

            <p class="mt-4">
                @if ($eatery->price_range === 'budget') ₱
                @elseif ($eatery->price_range === 'mid') ₱₱
                @else ₱₱₱
                @endif
                @if ($eatery->specialty) · {{ $eatery->specialty }} @endif
            </p>

            <div class="mt-4 flex flex-wrap gap-2">
                @foreach ($eatery->features as $feature)
                    <a href="{{ route('eateries.index', ['feature' => $feature->name]) }}"
                       class="rounded-full bg-amber-100 px-3 py-1 text-sm text-amber-800">
                        {{ $feature->name }}
                    </a>
                @endforeach
            </div>
        </div>

        @if ($eatery->permit)
            <section class="mt-6 rounded-lg border border-stone-200 bg-white p-6">
                <h2 class="text-xl font-bold">Permit</h2>
                <p>Permit number: {{ $eatery->permit->permit_no }}</p>
                <p>Expires: {{ $eatery->permit->expires_on->format('F j, Y') }}</p>
                @if ($eatery->permit->expires_on->isBefore(today()))
                    <p class="mt-2 font-bold text-red-700">Permit expired</p>
                @endif
            </section>
        @endif

        <section class="mt-6 rounded-lg border border-stone-200 bg-white p-6">
            <h2 class="text-xl font-bold">Dishes</h2>
            <div class="mt-4 space-y-3">
                @forelse ($eatery->dishes as $dish)
                    <div class="flex justify-between gap-4 border-b border-stone-100 pb-3">
                        <p>
                            {{ $dish->name }}
                            @if ($dish->is_bestseller)
                                <span class="ml-2 rounded bg-amber-100 px-2 py-1 text-xs font-bold text-amber-800">Bestseller</span>
                            @endif
                        </p>
                        <p class="font-semibold">{{ number_format((float) $dish->price, 2) }}</p>
                    </div>
                @empty
                    <p class="text-stone-500">No dishes listed.</p>
                @endforelse
            </div>
        </section>

        @if (! $eatery->is_open)
            <p class="mt-6 rounded border border-red-200 bg-red-50 p-4 font-semibold text-red-700">
                This eatery is closed. Reviews are paused.
            </p>
        @endif

        <section class="mt-6 rounded-lg border border-stone-200 bg-white p-6">
            <h2 class="text-xl font-bold">Reviews</h2>
            @forelse ($eatery->reviews as $review)
                <article class="mt-4 border-b border-stone-100 pb-4">
                    <div class="flex flex-wrap justify-between gap-2">
                        <a href="{{ route('reviewers.show', $review->user) }}" class="font-semibold text-amber-700">
                            {{ $review->user->name }}
                        </a>
                        <time class="text-sm text-stone-500">{{ $review->created_at->format('F j, Y') }}</time>
                    </div>
                    <p class="mt-1"><x-rating :value="$review->rating" /></p>
                    <p class="mt-2 text-stone-700">{{ $review->body }}</p>
                </article>
            @empty
                <p class="mt-4 text-stone-500">No reviews yet</p>
            @endforelse
        </section>
    </div>
@endsection
