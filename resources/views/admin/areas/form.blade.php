<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <div class="lg:col-span-2">
        <label
            for="country_side_id"
            class="block text-sm font-semibold mb-2"
        >
            Country Side
        </label>

        <select
            id="country_side_id"
            name="country_side_id"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 bg-white outline-none focus:border-[#b7936e]"
            required
        >
            <option value="">
                Select country side
            </option>

            @foreach ($countrySides as $countrySideOption)
                <option
                    value="{{ $countrySideOption->id }}"
                    @selected(
                        old(
                            'country_side_id',
                            $area->country_side_id
                                ?? request('country_side_id')
                        ) == $countrySideOption->id
                    )
                >
                    {{ $countrySideOption->name }}
                </option>
            @endforeach
        </select>

        @error('country_side_id')
            <p class="text-sm text-red-600 mt-2">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="lg:col-span-2">
        <label
            for="title"
            class="block text-sm font-semibold mb-2"
        >
            Title
        </label>

        <input
            type="text"
            id="title"
            name="title"
            value="{{ old('title', $area->title ?? '') }}"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
            placeholder="Samai Distillery"
            required
        >

        @error('title')
            <p class="text-sm text-red-600 mt-2">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="lg:col-span-2">
        <label
            for="slug"
            class="block text-sm font-semibold mb-2"
        >
            Slug
        </label>

        <input
            type="text"
            id="slug"
            name="slug"
            value="{{ old('slug', $area->slug ?? '') }}"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
            placeholder="samai-distillery"
            required
        >

        <p class="text-xs text-gray-500 mt-2">
            Lowercase letters, numbers and hyphens only.
        </p>

        @error('slug')
            <p class="text-sm text-red-600 mt-2">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div>
        <label
            for="lat"
            class="block text-sm font-semibold mb-2"
        >
            Latitude
        </label>

        <input
            type="number"
            step="0.0000001"
            id="lat"
            name="lat"
            value="{{ old('lat', $area->lat ?? '') }}"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
            placeholder="11.5564000"
        >

        @error('lat')
            <p class="text-sm text-red-600 mt-2">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div>
        <label
            for="lng"
            class="block text-sm font-semibold mb-2"
        >
            Longitude
        </label>

        <input
            type="number"
            step="0.0000001"
            id="lng"
            name="lng"
            value="{{ old('lng', $area->lng ?? '') }}"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
            placeholder="104.9282000"
        >

        @error('lng')
            <p class="text-sm text-red-600 mt-2">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="lg:col-span-2">
        <label
            for="google_map_url"
            class="block text-sm font-semibold mb-2"
        >
            Google Maps URL
        </label>

        <input
            type="url"
            id="google_map_url"
            name="google_map_url"
            value="{{ old(
                'google_map_url',
                $area->google_map_url ?? ''
            ) }}"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
            placeholder="https://maps.google.com/..."
        >

        @error('google_map_url')
            <p class="text-sm text-red-600 mt-2">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="lg:col-span-2">
        <div class="mb-4">
            <h3 class="text-lg font-bold">
                Venue Photos
            </h3>

            <p class="text-sm text-gray-500 mt-1">
                Upload up to five photos. Photo 1 appears
                first in the slider.
            </p>
        </div>

        <div
            class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-4"
        >
            @for ($index = 0; $index < 5; $index++)
                @php
                    $existingImage = isset($area)
                        ? $area->images->firstWhere(
                            'sort_order',
                            $index
                        )
                        : null;
                @endphp

                <div
                    class="rounded-2xl border border-[#d9d1c8] bg-[#faf8f5] p-4"
                >
                    <label
                        for="photos_{{ $index }}"
                        class="block text-sm font-semibold mb-3"
                    >
                        Photo {{ $index + 1 }}
                    </label>

                    <label
                        for="photos_{{ $index }}"
                        class="group relative w-full aspect-square rounded-xl overflow-hidden bg-white border border-[#e4ddd5] flex items-center justify-center mb-3 cursor-pointer transition hover:border-[#b7936e] hover:ring-2 hover:ring-[#b7936e]/20"
                        title="Choose photo {{ $index + 1 }}"
                    >
                        <img
                            id="previewImage{{ $index }}"
                            src="{{ $existingImage?->image_url ?? '' }}"
                            alt="Photo {{ $index + 1 }}"
                            class="{{ $existingImage ? '' : 'hidden' }} w-full h-full object-cover pointer-events-none"
                        >

                        <div
                            id="previewPlaceholder{{ $index }}"
                            class="{{ $existingImage ? 'hidden' : '' }} text-center text-gray-400 px-3 pointer-events-none"
                        >
                            <i
                                class="fa-solid fa-image text-2xl"
                            ></i>

                            <p class="text-xs mt-2">
                                No photo
                            </p>

                            <p class="text-[11px] font-semibold text-[#9d7a54] mt-1">
                                Click or tap to choose
                            </p>
                        </div>

                    </label>

                    <input
                        type="file"
                        id="photos_{{ $index }}"
                        name="photos[{{ $index }}]"
                        accept="image/jpeg,image/png,image/webp"
                        class="block w-full text-xs"
                        data-preview-index="{{ $index }}"
                    >

                    @if ($existingImage)
                        <label
                            class="flex items-center gap-2 mt-3 text-sm text-red-600 cursor-pointer"
                        >
                            <input
                                type="checkbox"
                                name="remove_photos[]"
                                value="{{ $existingImage->id }}"
                            >

                            Remove photo
                        </label>
                    @endif

                    @error("photos.$index")
                        <p class="text-xs text-red-600 mt-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            @endfor
        </div>

        @error('photos')
            <p class="text-sm text-red-600 mt-3">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="lg:col-span-2">
        <label
            for="address"
            class="block text-sm font-semibold mb-2"
        >
            Address
        </label>

        <input
            type="text"
            id="address"
            name="address"
            value="{{ old('address', $area->address ?? '') }}"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
        >

        @error('address')
            <p class="text-sm text-red-600 mt-2">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="lg:col-span-2">
        <label
            for="open_hours"
            class="block text-sm font-semibold mb-2"
        >
            Opening Hours
        </label>

        <textarea
            id="open_hours"
            name="open_hours"
            rows="3"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
        >{{ old(
            'open_hours',
            $area->open_hours ?? ''
        ) }}</textarea>

        @error('open_hours')
            <p class="text-sm text-red-600 mt-2">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="lg:col-span-2">
        <label
            for="description"
            class="block text-sm font-semibold mb-2"
        >
            Description
        </label>

        <textarea
            id="description"
            name="description"
            rows="5"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
        >{{ old(
            'description',
            $area->description ?? ''
        ) }}</textarea>

        @error('description')
            <p class="text-sm text-red-600 mt-2">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="lg:col-span-2">
        <label
            for="serves"
            class="block text-sm font-semibold mb-2"
        >
            Samai Signature Serves
        </label>

        <textarea
            id="serves"
            name="serves"
            rows="3"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
        >{{ old(
            'serves',
            $area->serves ?? ''
        ) }}</textarea>

        @error('serves')
            <p class="text-sm text-red-600 mt-2">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div>
        <label
            for="phone"
            class="block text-sm font-semibold mb-2"
        >
            Phone 1
        </label>

        <input
            type="text"
            id="phone"
            name="phone"
            value="{{ old('phone', $area->phone ?? '') }}"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
        >

        @error('phone')
            <p class="text-sm text-red-600 mt-2">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div>
        <label
            for="secondary_phone"
            class="block text-sm font-semibold mb-2"
        >
            Phone 2
            <span class="font-normal text-gray-400">
                (optional)
            </span>
        </label>

        <input
            type="text"
            id="secondary_phone"
            name="secondary_phone"
            value="{{ old(
                'secondary_phone',
                $area->secondary_phone ?? ''
            ) }}"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
        >

        @error('secondary_phone')
            <p class="text-sm text-red-600 mt-2">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div>
        <label
            for="email"
            class="block text-sm font-semibold mb-2"
        >
            Email
        </label>

        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email', $area->email ?? '') }}"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
        >

        @error('email')
            <p class="text-sm text-red-600 mt-2">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div>
        <label
            for="facebook"
            class="block text-sm font-semibold mb-2"
        >
            Facebook URL
        </label>

        <input
            type="url"
            id="facebook"
            name="facebook"
            value="{{ old(
                'facebook',
                $area->facebook ?? ''
            ) }}"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
        >

        @error('facebook')
            <p class="text-sm text-red-600 mt-2">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div>
        <label
            for="instagram"
            class="block text-sm font-semibold mb-2"
        >
            Instagram URL
        </label>

        <input
            type="url"
            id="instagram"
            name="instagram"
            value="{{ old(
                'instagram',
                $area->instagram ?? ''
            ) }}"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
        >

        @error('instagram')
            <p class="text-sm text-red-600 mt-2">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="lg:col-span-2 flex flex-col sm:flex-row sm:items-center gap-4 sm:gap-8">
        <input
            type="hidden"
            name="is_active"
            value="0"
        >

        <label
            class="inline-flex items-center gap-3 cursor-pointer"
        >
            <input
                type="checkbox"
                name="is_active"
                value="1"
                @checked(
                    old(
                        'is_active',
                        $area->is_active ?? true
                    )
                )
                class="w-5 h-5 accent-[#b7936e]"
            >

            <span class="font-semibold">
                Active
            </span>
        </label>

        <input
            type="hidden"
            name="is_recommended"
            value="0"
        >

        <label
            class="inline-flex items-center gap-3 cursor-pointer"
        >
            <input
                type="checkbox"
                name="is_recommended"
                value="1"
                @checked(
                    old(
                        'is_recommended',
                        $area->is_recommended ?? false
                    )
                )
                class="w-5 h-5 accent-[#b7936e]"
            >

            <span class="font-semibold">
                Recommended / Favorite
            </span>
        </label>
    </div>

</div>

@push('scripts')
<script>
    document
        .querySelectorAll('[data-preview-index]')
        .forEach(function (input) {
            input.addEventListener(
                'change',
                function () {
                    const index =
                        this.dataset.previewIndex;

                    const file = this.files[0];

                    if (!file) {
                        return;
                    }

                    const previewImage =
                        document.getElementById(
                            'previewImage' + index
                        );

                    const placeholder =
                        document.getElementById(
                            'previewPlaceholder' + index
                        );

                    previewImage.src =
                        URL.createObjectURL(file);

                    previewImage.classList.remove(
                        'hidden'
                    );

                    placeholder?.classList.add(
                        'hidden'
                    );
                }
            );
        });

    const titleInput =
        document.getElementById('title');

    const slugInput =
        document.getElementById('slug');

    const mapUrlInput =
        document.getElementById('google_map_url');

    const latInput =
        document.getElementById('lat');

    const lngInput =
        document.getElementById('lng');

    function validCoordinates(lat, lng) {
        return Number.isFinite(lat) &&
            Number.isFinite(lng) &&
            lat >= -90 &&
            lat <= 90 &&
            lng >= -180 &&
            lng <= 180;
    }

    function extractCoordinatesFromMapUrl(url) {
        const value = (url || '').trim();

        if (!value) {
            return null;
        }

        const patterns = [
            /@(-?\d+(?:\.\d+)?),\s*(-?\d+(?:\.\d+)?)/,
            /!3d(-?\d+(?:\.\d+)?)!4d(-?\d+(?:\.\d+)?)/
        ];

        for (const pattern of patterns) {
            const match = value.match(pattern);

            if (!match) {
                continue;
            }

            const lat = Number.parseFloat(match[1]);
            const lng = Number.parseFloat(match[2]);

            if (validCoordinates(lat, lng)) {
                return { lat, lng };
            }
        }

        try {
            const parsedUrl = new URL(value);
            const params = parsedUrl.searchParams;

            for (const key of ['query', 'q', 'll']) {
                const coordinates = params.get(key);

                if (!coordinates) {
                    continue;
                }

                const match = coordinates.match(
                    /(-?\d+(?:\.\d+)?)\s*,\s*(-?\d+(?:\.\d+)?)/
                );

                if (!match) {
                    continue;
                }

                const lat = Number.parseFloat(match[1]);
                const lng = Number.parseFloat(match[2]);

                if (validCoordinates(lat, lng)) {
                    return { lat, lng };
                }
            }
        } catch (error) {
            return null;
        }

        return null;
    }

    function syncCoordinatesFromMapUrl() {
        if (!mapUrlInput || !latInput || !lngInput) {
            return;
        }

        const coordinates = extractCoordinatesFromMapUrl(
            mapUrlInput.value
        );

        if (!coordinates) {
            return;
        }

        latInput.value = coordinates.lat.toFixed(7);
        lngInput.value = coordinates.lng.toFixed(7);
    }

    mapUrlInput?.addEventListener(
        'input',
        syncCoordinatesFromMapUrl
    );

    mapUrlInput?.addEventListener(
        'paste',
        function () {
            window.setTimeout(syncCoordinatesFromMapUrl, 0);
        }
    );

    mapUrlInput?.addEventListener(
        'change',
        syncCoordinatesFromMapUrl
    );

    if (titleInput && slugInput) {
        titleInput.addEventListener(
            'input',
            function () {
                if (
                    slugInput.dataset.edited === 'true'
                ) {
                    return;
                }

                slugInput.value = this.value
                    .toLowerCase()
                    .trim()
                    .replace(/[^a-z0-9]+/g, '-')
                    .replace(/^-+|-+$/g, '');
            }
        );

        slugInput.addEventListener(
            'input',
            function () {
                this.dataset.edited = 'true';

                this.value = this.value
                    .toLowerCase()
                    .replace(/[^a-z0-9-]/g, '');
            }
        );
    }
</script>
@endpush
