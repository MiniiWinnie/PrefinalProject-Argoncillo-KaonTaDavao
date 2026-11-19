@if (session('success'))
    <div class="mx-auto max-w-7xl px-6 pt-4">
        <p class="rounded border border-green-200 bg-green-50 px-4 py-3 text-green-800">
            {{ session('success') }}
        </p>
    </div>
@endif
