<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="lg:col-span-2">
        <label for="name" class="block text-sm font-semibold mb-2">
            Name
        </label>

        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $countrySide->name ?? '') }}"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
            placeholder="Phnom Penh"
            required
        >

        @error('name')
            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
        @enderror
    </div>

    <div class="lg:col-span-2">
        <label for="slug" class="block text-sm font-semibold mb-2">
            Slug
        </label>

        <input
            type="text"
            id="slug"
            name="slug"
            value="{{ old('slug', $countrySide->slug ?? '') }}"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
            placeholder="phnom-penh"
            required
        >

        <p class="text-xs text-gray-500 mt-2">
            Use lowercase letters and hyphens.
        </p>

        @error('slug')
            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="center_lat" class="block text-sm font-semibold mb-2">
            Center Latitude
        </label>

        <input
            type="number"
            step="0.0000001"
            id="center_lat"
            name="center_lat"
            value="{{ old('center_lat', $countrySide->center_lat ?? '') }}"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
            placeholder="11.5564000"
        >

        @error('center_lat')
            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="center_lng" class="block text-sm font-semibold mb-2">
            Center Longitude
        </label>

        <input
            type="number"
            step="0.0000001"
            id="center_lng"
            name="center_lng"
            value="{{ old('center_lng', $countrySide->center_lng ?? '') }}"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
            placeholder="104.9282000"
        >

        @error('center_lng')
            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="zoom" class="block text-sm font-semibold mb-2">
            Zoom Level
        </label>

        <input
            type="number"
            id="zoom"
            name="zoom"
            min="1"
            max="20"
            value="{{ old('zoom', $countrySide->zoom ?? 10) }}"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
            required
        >

        @error('zoom')
            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
        @enderror
    </div>

    <div></div>

    <div>
        <label for="position_top" class="block text-sm font-semibold mb-2">
            Position Top (%)
        </label>

        <input
            type="number"
            step="0.01"
            min="0"
            max="100"
            id="position_top"
            name="position_top"
            value="{{ old('position_top', $countrySide->position_top ?? '') }}"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
            placeholder="60"
        >

        @error('position_top')
            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="position_left" class="block text-sm font-semibold mb-2">
            Position Left (%)
        </label>

        <input
            type="number"
            step="0.01"
            min="0"
            max="100"
            id="position_left"
            name="position_left"
            value="{{ old('position_left', $countrySide->position_left ?? '') }}"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
            placeholder="49"
        >

        @error('position_left')
            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
        @enderror
    </div>
</div>