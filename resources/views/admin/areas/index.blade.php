@extends('layouts.admin')

@section('title', 'Areas - Samai Admin')

@section('content')
<div
    class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6"
>
    <div>
        <h3 class="text-xl font-bold">
            All Areas
        </h3>

        <p class="text-sm text-gray-500 mt-1">
            {{ $areas->total() }} records found
        </p>
    </div>

    <a
        href="{{ route('admin.areas.create') }}"
        class="inline-flex items-center justify-center gap-2 bg-[#b7936e] hover:bg-[#a5825e] text-[#2d241c] px-5 py-3 rounded-xl font-semibold text-sm"
    >
        <i class="fa-solid fa-plus"></i>
        Add Area
    </a>
</div>

<form
    id="areaFilters"
    method="GET"
    action="{{ route('admin.areas.index') }}"
    class="mb-6"
>
    <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1fr)_280px] gap-4">
        <div>
            <label
                for="search"
                class="block text-sm font-semibold mb-2 text-[#3a3028]"
            >
                Search
            </label>

            <div class="relative">
                <i
                    class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"
                ></i>

                <input
                    type="search"
                    id="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search title, slug, address, description or serves"
                    autocomplete="off"
                    class="w-full rounded-xl bg-[#fffdfb] border border-[#ddd4ca] pl-11 pr-4 py-3 text-sm focus:border-[#b7936e] focus:ring-[#b7936e]"
                >
            </div>
        </div>

        <div>
            <label
                for="country_side_id"
                class="block text-sm font-semibold mb-2 text-[#3a3028]"
            >
                Country Side
            </label>

            <div class="relative">
                <select
                    id="country_side_id"
                    name="country_side_id"
                    class="w-full appearance-none rounded-xl bg-[#fffdfb] border border-[#ddd4ca] pl-4 pr-12 py-3 text-sm focus:border-[#b7936e] focus:ring-[#b7936e]"
                >
                    <option value="">
                        All country sides
                    </option>

                    @foreach ($countrySides as $countrySide)
                        <option
                            value="{{ $countrySide->id }}"
                            @selected((string) request('country_side_id') === (string) $countrySide->id)
                        >
                            {{ $countrySide->name }}
                        </option>
                    @endforeach
                </select>

                <i
                    class="fa-solid fa-chevron-down pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-xs"
                ></i>
            </div>
        </div>
    </div>
</form>

<div
    class="bg-white rounded-2xl border border-[#e4ddd5] shadow-sm overflow-hidden"
>
    @if ($areas->isEmpty())
        <div class="py-16 text-center">
            <i
                class="fa-solid fa-location-dot text-4xl text-[#b7936e]"
            ></i>

            <h4 class="font-semibold mt-4">
                No areas found
            </h4>
        </div>
    @else
        <div class="overflow-hidden">
            <table class="admin-responsive-table w-full">
                <thead class="bg-[#faf8f5]">
                    <tr
                        class="text-left text-xs uppercase tracking-wide text-gray-500"
                    >
                        <th class="px-6 py-4 font-semibold">
                            Area
                        </th>

                        <th class="px-6 py-4 font-semibold">
                            Country Side
                        </th>

                        <th class="px-6 py-4 font-semibold">
                            Coordinates
                        </th>

                        <th class="px-6 py-4 font-semibold">
                            Status
                        </th>

                        <th
                            class="px-6 py-4 font-semibold text-right"
                        >
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody
                    class="divide-y divide-[#eee7df]"
                >
                    @foreach ($areas as $area)
                        @php
                            $firstImage =
                                $area->images->first();
                        @endphp

                        <tr class="hover:bg-[#faf8f5]">
                            <td class="px-6 py-4">
                                <div
                                    class="flex items-center gap-3"
                                >

                                    <div>
                                        <p class="font-semibold">
                                            {{ $area->title }}
                                        </p>

                                        <p
                                            class="text-xs text-gray-500 mt-1"
                                        >
                                            {{ $area->address
                                                ?: 'No address' }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td
                                data-label="Country Side"
                                class="px-6 py-4 text-sm text-gray-600"
                            >
                                {{ $area->countrySide?->name
                                    ?? 'Not assigned' }}
                            </td>

                            <td
                                data-label="Coordinates"
                                class="px-6 py-4 text-sm text-gray-600"
                            >
                                @if (
                                    $area->lat !== null &&
                                    $area->lng !== null
                                )
                                    {{ $area->lat }},
                                    {{ $area->lng }}
                                @else
                                    <span
                                        class="text-gray-400"
                                    >
                                        Not provided
                                    </span>
                                @endif
                            </td>

                            <td data-label="Status" class="px-6 py-4">
                                @if ($area->is_active)
                                    <span
                                        class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700"
                                    >
                                        Active
                                    </span>
                                @else
                                    <span
                                        class="inline-flex rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600"
                                    >
                                        Inactive
                                    </span>
                                @endif
                            </td>

                            <td
                                data-label="Actions"
                                data-actions
                                class="px-6 py-4"
                            >
                                <div
                                    class="flex justify-end gap-2"
                                >
                                    <a
                                        href="{{ route(
                                            'admin.areas.show',
                                            $area
                                        ) }}"
                                        class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center"
                                    >
                                        <i
                                            class="fa-solid fa-eye text-sm"
                                        ></i>
                                    </a>

                                    <a
                                        href="{{ route(
                                            'admin.areas.edit',
                                            $area
                                        ) }}"
                                        class="w-9 h-9 rounded-lg bg-[#f1e7dc] text-[#9d7a54] flex items-center justify-center"
                                    >
                                        <i
                                            class="fa-solid fa-pen text-sm"
                                        ></i>
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route(
                                            'admin.areas.destroy',
                                            $area
                                        ) }}"
                                        onsubmit="return confirm('Delete this area?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="w-9 h-9 rounded-lg bg-red-50 text-red-600 flex items-center justify-center cursor-pointer"
                                        >
                                            <i
                                                class="fa-solid fa-trash text-sm"
                                            ></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if ($areas->hasPages())
            <div
                class="px-6 py-4 border-t border-[#eee7df]"
            >
                {{ $areas->links() }}
            </div>
        @endif
    @endif
</div>
@endsection

@push('scripts')
<script>
    const areaFilters = document.getElementById('areaFilters');
    const areaSearch = document.getElementById('search');
    const countrySideFilter = document.getElementById('country_side_id');
    let areaSearchTimer;

    function submitAreaFilters() {
        areaFilters?.requestSubmit();
    }

    areaSearch?.addEventListener('input', () => {
        clearTimeout(areaSearchTimer);
        areaSearchTimer = setTimeout(submitAreaFilters, 450);
    });

    countrySideFilter?.addEventListener('change', submitAreaFilters);
</script>
@endpush
