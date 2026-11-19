@props(['eatery'])

@php
    $average = $eatery->reviews->avg('rating');
    $reviewCount = $eatery->reviews->count();
@endphp

<article class="flex h-full flex-col gap-4 rounded-lg border border-stone-200 bg-white p-5 shadow-sm">
    <div class="flex items-start justify-between gap-3">
        <div>
            <h2 class="text-xl font-bold">
                <a href="{{ route('eateries.show', $eatery) }}" class="hover:text-amber-700">
                    {{ $eatery->name }}
                </a>
            </h2>
            <a href="{{ route('districts.show', $eatery->district) }}" class="text-sm text-stone-600 hover:text-amber-700">
                {{ $eatery->district->name }}
            </a>
        </div>
        @if (! $eatery->is_open)
            <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-700">Closed</span>
        @endif
    </div>

    <p class="text-sm text-stone-700">
        @if ($eatery->price_range === 'budget')
            ₱
        @elseif ($eatery->price_range === 'mid')
            ₱₱
        @else
            ₱₱₱
        @endif
        @if ($eatery->specialty)
            <span class="ml-2">{{ $eatery->specialty }}</span>
        @endif
    </p>

    <div class="flex flex-wrap gap-2">
        @foreach ($eatery->features as $feature)
            <a href="{{ route('eateries.index', ['feature' => $feature->name]) }}"
               class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-800">
                {{ $feature->name }}
            </a>
        @endforeach
    </div>

    @if ($reviewCount)
        <p class="text-sm">
            <x-rating :value="$average" />
            {{ number_format($average, 1) }} ({{ $reviewCount }} {{ Str::plural('review', $reviewCount) }})
        </p>
    @else
        <p class="text-sm text-stone-500">No reviews yet</p>
    @endif
</article>