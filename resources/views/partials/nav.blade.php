<header class="border-b border-stone-200 bg-white">
    <nav class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-4 px-6 py-4" aria-label="Main navigation">
        <a href="{{ route('home') }}" class="text-lg font-bold text-amber-700">
            Kaon Ta! Davao - Argoncillo's Food Guide
        </a>
        <div class="flex flex-wrap gap-5 text-sm font-medium">
            <a href="{{ route('home') }}" class="hover:text-amber-700">Home</a>
            <a href="{{ route('eateries.index') }}" class="hover:text-amber-700">Eateries</a>
            <a href="{{ route('districts.index') }}" class="hover:text-amber-700">Districts</a>
            <a href="{{ route('eateries.create') }}" class="hover:text-amber-700">Add Eatery</a>
        </div>
    </nav>
</header>
