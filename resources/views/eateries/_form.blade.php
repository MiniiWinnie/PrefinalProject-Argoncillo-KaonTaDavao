@if ($errors->any())
    <div class="mb-6 rounded border border-red-300 bg-red-50 p-4 text-red-800">
        <p class="font-bold">Please correct the following errors:</p>
        <ul class="mt-2 list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid gap-5">
    <div>
        <label for="name" class="block font-semibold">Name</label>
        <input id="name" name="name" type="text" value="{{ old('name', $eatery->name ?? '') }}"
               class="mt-1 w-full rounded border border-stone-300 px-3 py-2">
        @error('name')
            <p class="mt-1 text-sm text-red-700">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="district_id" class="block font-semibold">District</label>
        <select id="district_id" name="district_id" class="mt-1 w-full rounded border border-stone-300 px-3 py-2">
            <option value="">Select district</option>
            @foreach ($districts as $district)
                <option value="{{ $district->id }}"
                    @selected((string) old('district_id', $eatery->district_id ?? '') === (string) $district->id)>
                    {{ $district->name }}
                </option>
            @endforeach
        </select>
        @error('district_id')
            <p class="mt-1 text-sm text-red-700">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="address" class="block font-semibold">Address</label>
        <input id="address" name="address" type="text" value="{{ old('address', $eatery->address ?? '') }}"
               class="mt-1 w-full rounded border border-stone-300 px-3 py-2">
        @error('address')
            <p class="mt-1 text-sm text-red-700">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="price_range" class="block font-semibold">Price range</label>
        <select id="price_range" name="price_range" class="mt-1 w-full rounded border border-stone-300 px-3 py-2">
            <option value="">Select price range</option>
            @foreach (['budget' => 'Budget', 'mid' => 'Mid', 'splurge' => 'Splurge'] as $value => $label)
                <option value="{{ $value }}"
                    @selected(old('price_range', $eatery->price_range ?? '') === $value)>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        @error('price_range')
            <p class="mt-1 text-sm text-red-700">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="specialty" class="block font-semibold">Specialty</label>
        <input id="specialty" name="specialty" type="text" value="{{ old('specialty', $eatery->specialty ?? '') }}"
               class="mt-1 w-full rounded border border-stone-300 px-3 py-2">
        @error('specialty')
            <p class="mt-1 text-sm text-red-700">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="flex items-center gap-2 font-semibold">
            <input type="hidden" name="is_open" value="0">
            <input type="checkbox" name="is_open" value="1"
                @checked(old('is_open', $eatery->is_open ?? true))>
            Open
        </label>
        @error('is_open')
            <p class="mt-1 text-sm text-red-700">{{ $message }}</p>
        @enderror
    </div>

    <fieldset>
        <legend class="font-semibold">Features</legend>
        @foreach ($features as $feature)
            <label class="mt-2 flex items-center gap-2">
                <input type="checkbox" name="features[]" value="{{ $feature->id }}"
                    @checked(in_array((string) $feature->id, array_map('strval', old('features', isset($eatery) ? $eatery->features->pluck('id')->all() : [])), true))>
                {{ $feature->name }}
            </label>
        @endforeach
        @error('features')
            <p class="mt-1 text-sm text-red-700">{{ $message }}</p>
        @enderror
        @error('features.*')
            <p class="mt-1 text-sm text-red-700">{{ $message }}</p>
        @enderror
    </fieldset>

    <div>
        <label for="permit_no" class="block font-semibold">Permit number</label>
        <input id="permit_no" name="permit_no" type="text"
               value="{{ old('permit_no', $eatery->permit->permit_no ?? '') }}"
               class="mt-1 w-full rounded border border-stone-300 px-3 py-2">
        @error('permit_no')
            <p class="mt-1 text-sm text-red-700">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="expires_on" class="block font-semibold">Permit expiry date</label>
        <input id="expires_on" name="expires_on" type="date"
               value="{{ old('expires_on', isset($eatery->permit) ? $eatery->permit->expires_on->format('Y-m-d') : '') }}"
               class="mt-1 w-full rounded border border-stone-300 px-3 py-2">
        @error('expires_on')
            <p class="mt-1 text-sm text-red-700">{{ $message }}</p>
        @enderror
    </div>
</div>
