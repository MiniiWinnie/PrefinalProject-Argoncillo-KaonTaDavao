@extends('layouts.app')

@section('title', $user->name)

@section('content')
    <div class="mx-auto max-w-5xl px-6 py-10">
        <h1 class="text-3xl font-bold">{{ $user->name }}</h1>
        <p class="mt-2 text-stone-600">
            {{ $user->reviews_count }} {{ Str::plural('review', $user->reviews_count) }} written
        </p>

        <div class="mt-6 space-y-4">
            @forelse ($user->reviews as $review)
                <article class="rounded-lg border border-stone-200 bg-white p-5">
                    <a href="{{ route('eateries.show', $review->eatery) }}" class="font-semibold text-amber-700">
                        {{ $review->eatery->name }}
                    </a>
                    <p class="mt-2"><x-rating :value="$review->rating" /></p>
                    <p class="mt-2 text-stone-700">{{ $review->body }}</p>
                </article>
            @empty
                <p class="text-stone-500">No reviews written</p>
            @endforelse
        </div>
    </div>
@endsection
