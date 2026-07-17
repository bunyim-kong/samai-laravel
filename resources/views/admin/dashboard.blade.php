@extends('layouts.admin')

@section('title', 'Dashboard - Samai Admin')

@section('page-title', 'Dashboard')

@section('page-description', 'Overview of provinces, venues and gallery images')

@section('content')

<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5 mb-8">

    <div class="bg-white rounded-2xl border border-[#e4ddd5] p-6 shadow-sm">
        <div class="flex items-center justify-between">

            <div>
                <p class="text-sm text-gray-500 font-medium">
                    Country Sides
                </p>

                <h3 class="text-3xl font-bold mt-2 text-[#2d241c]">
                    {{ $countrySideCount }}
                </h3>
            </div>

            <div class="w-13 h-13 rounded-2xl bg-[#f1e7dc] text-[#9d7a54] flex items-center justify-center">
                <i class="fa-solid fa-map text-xl"></i>
            </div>

        </div>

        <a
            href="{{ route('admin.country-sides.index') }}"
            class="inline-flex items-center gap-2 mt-5 text-sm font-semibold text-[#9d7a54] hover:text-[#765738]"
        >
            Manage country sides
            <i class="fa-solid fa-arrow-right text-xs"></i>
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-[#e4ddd5] p-6 shadow-sm">
        <div class="flex items-center justify-between">

            <div>
                <p class="text-sm text-gray-500 font-medium">
                    Total Areas
                </p>

                <h3 class="text-3xl font-bold mt-2 text-[#2d241c]">
                    {{ $areaCount }}
                </h3>
            </div>

            <div class="w-13 h-13 rounded-2xl bg-[#f1e7dc] text-[#9d7a54] flex items-center justify-center">
                <i class="fa-solid fa-location-dot text-xl"></i>
            </div>

        </div>

        <a
            href="{{ route('admin.areas.index') }}"
            class="inline-flex items-center gap-2 mt-5 text-sm font-semibold text-[#9d7a54] hover:text-[#765738]"
        >
            Manage areas
            <i class="fa-solid fa-arrow-right text-xs"></i>
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-[#e4ddd5] p-6 shadow-sm">
        <div class="flex items-center justify-between">

            <div>
                <p class="text-sm text-gray-500 font-medium">
                    Gallery Images
                </p>

                <h3 class="text-3xl font-bold mt-2 text-[#2d241c]">
                    {{ $imageCount }}
                </h3>
            </div>

            <div class="w-13 h-13 rounded-2xl bg-[#f1e7dc] text-[#9d7a54] flex items-center justify-center">
                <i class="fa-solid fa-images text-xl"></i>
            </div>

        </div>

        <p class="mt-5 text-sm text-gray-500">
            Images uploaded for venue galleries
        </p>
    </div>

</div>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

    <div class="xl:col-span-2 bg-white rounded-2xl border border-[#e4ddd5] shadow-sm overflow-hidden">

        <div class="px-6 py-5 border-b border-[#eee7df] flex items-center justify-between">

            <div>
                <h3 class="font-bold text-lg">
                    Latest Areas
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Recently added venues
                </p>
            </div>

            <a
                href="{{ route('admin.areas.index') }}"
                class="text-sm font-semibold text-[#9d7a54] hover:text-[#765738]"
            >
                View all
            </a>

        </div>

        @if ($latestAreas->isEmpty())

            <div class="px-6 py-14 text-center">

                <div class="w-16 h-16 rounded-full bg-[#f1e7dc] text-[#9d7a54] mx-auto flex items-center justify-center">
                    <i class="fa-solid fa-location-dot text-2xl"></i>
                </div>

                <h4 class="font-semibold mt-4">
                    No areas added yet
                </h4>

                <p class="text-sm text-gray-500 mt-2">
                    Add your first venue to display it on the map.
                </p>

                <a
                    href="{{ route('admin.areas.create') }}"
                    class="inline-flex items-center gap-2 mt-5 bg-[#b7936e] hover:bg-[#a5825e] text-[#2d241c] px-4 py-2.5 rounded-xl text-sm font-semibold"
                >
                    <i class="fa-solid fa-plus"></i>
                    Add Area
                </a>

            </div>

        @else

            <div class="overflow-x-auto">
                <table class="w-full">

                    <thead class="bg-[#faf8f5] text-left">
                        <tr class="text-xs uppercase tracking-wide text-gray-500">
                            <th class="px-6 py-4 font-semibold">Area</th>
                            <th class="px-6 py-4 font-semibold">Country Side</th>
                            <th class="px-6 py-4 font-semibold">Coordinates</th>
                            <th class="px-6 py-4 font-semibold text-right">Action</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-[#eee7df]">

                        @foreach ($latestAreas as $area)
                            <tr class="hover:bg-[#faf8f5]">

                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        
                                        <div>
                                            <p class="font-semibold text-sm">
                                                {{ $area->title }}
                                            </p>

                                            <p class="text-xs text-gray-500 mt-1">
                                                {{ $area->created_at?->format('d M Y') }}
                                            </p>
                                        </div>

                                    </div>
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $area->countrySide?->name ?? 'Not assigned' }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-600">
                                    @if ($area->lat && $area->lng)
                                        {{ $area->lat }}, {{ $area->lng }}
                                    @else
                                        <span class="text-gray-400">
                                            Not provided
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <a
                                        href="{{ route('admin.areas.edit', $area) }}"
                                        class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-[#f1e7dc] text-[#9d7a54] hover:bg-[#b7936e] hover:text-[#2d241c]"
                                    >
                                        <i class="fa-solid fa-pen text-sm"></i>
                                    </a>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>

        @endif

    </div>

    <div class="bg-white rounded-2xl border border-[#e4ddd5] shadow-sm">

        <div class="px-6 py-5 border-b border-[#eee7df]">

            <h3 class="font-bold text-lg">
                Country Sides
            </h3>

            <p class="text-sm text-gray-500 mt-1">
                Areas inside each province
            </p>

        </div>

        <div class="p-5 space-y-3">

            @forelse ($countrySides as $countrySide)

                <div class="flex items-center justify-between px-4 py-3 rounded-xl bg-[#faf8f5]">

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-xl bg-[#f1e7dc] text-[#9d7a54] flex items-center justify-center">
                            <i class="fa-solid fa-map-pin"></i>
                        </div>

                        <div>
                            <p class="font-semibold text-sm">
                                {{ $countrySide->name }}
                            </p>

                            <p class="text-xs text-gray-500">
                                {{ $countrySide->slug }}
                            </p>
                        </div>

                    </div>

                    <span class="min-w-9 h-9 px-2 rounded-lg bg-white border border-[#e4ddd5] flex items-center justify-center text-sm font-bold">
                        {{ $countrySide->areas_count }}
                    </span>

                </div>

            @empty

                <div class="py-10 text-center">

                    <i class="fa-solid fa-map text-3xl text-[#b7936e]"></i>

                    <p class="text-sm text-gray-500 mt-3">
                        No country sides found.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</div>

@endsection