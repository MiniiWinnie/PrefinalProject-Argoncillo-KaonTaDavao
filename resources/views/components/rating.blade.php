<div>
    <!-- Be present above all else. - Naval Ravikant -->
</div>
@props(['value' => 0])

@php
    $fullStars = (int) round((float) $value);
@endphp

<span aria-label="{{ number_format((float) $value, 1) }} stars">
    @for ($i = 1; $i <= 5; $i++)
        <span class="{{ $i <= $fullStars ? 'text-amber-500' : 'text-stone-300' }}">★</span>
    @endfor
</span>