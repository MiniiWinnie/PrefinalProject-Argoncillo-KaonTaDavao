@extends('layouts.app')

@section('title', 'Edit ' . $eatery->name)

@section('content')
    <div class="mx-auto max-w-3xl px-6 py-10">
        <h1 class="text-3xl font-bold">Edit {{ $eatery->name }}</h1>

        <form method="POST" action="{{ route('eateries.update', $eatery) }}" class="mt-6 rounded-lg border border-stone-200 bg-white p-6">
            @csrf
            @method('PUT')
            @include('eateries._form', ['eatery' => $eatery])
            <button type="submit" class="mt-6 rounded bg-amber-700 px-4 py-2 font-semibold text-white">
                Update Eatery
            </button>
        </form>
    </div>
@endsection
