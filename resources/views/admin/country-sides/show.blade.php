@extends('layouts.admin')

@section('title', $countrySide->name . ' - Samai Admin')
@section('page-title', $countrySide->name)
@section('page-description', 'Country side details and connected areas')

@section('content')
<div class="flex flex-wrap gap-3 mb-6">
    <a
        href="{{ route('admin.country-sides.edit', $countrySide) }}"
        class="inline-flex items-center gap-2 bg-[#b7936e] hover:bg-[#a5825e] text-[#2d241c] px-5 py-3 rounded-xl font-semibold text-sm"
    >
        <i class="fa-solid fa-pen"></i>
        Edit
    </a>

    <a
        href="{{ route('admin.country-sides.index') }}"
        class="inline-flex items-center gap-2 border border-[#d9d1c8] px-5 py-3 rounded-xl font-semibold text-sm hover:bg-white"
    >
        <i class="fa-solid fa-arrow-left"></i>
        Back
    </a>
</div>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
    <div class="bg-white rounded-2xl border border-[#e4ddd5] shadow-sm p-6">
        <h3 class="font-bold text-lg mb-5">Information</h3>

        <div class="space-y-5 text-sm">
            <div>
                <p class="text-gray-500">Name</p>
                <p class="font-semibold mt-1">{{ $countrySide->name }}</p>
            </div>

            <div>
                <p class="text-gray-500">Slug</p>
                <p class="font-semibold mt-1">{{ $countrySide->slug }}</p>
            </div>

            <div>
                <p class="text-gray-500">Map Center</p>
                <p class="font-semibold mt-1">
                    {{ $countrySide->center_lat ?? '—' }},
                    {{ $countrySide->center_lng ?? '—' }}
                </p>
            </div>

            <div>
                <p class="text-gray-500">Zoom</p>
                <p class="font-semibold mt-1">{{ $countrySide->zoom }}</p>
            </div>

            <div>
                <p class="text-gray-500">Map Image Position</p>
                <p class="font-semibold mt-1">
                    Top: {{ $countrySide->position_top ?? '—' }}%
                    <br>
                    Left: {{ $countrySide->position_left ?? '—' }}%
                </p>
            </div>

            <div>
                <p class="text-gray-500">Label Position</p>
                <p class="font-semibold mt-1">
                    {{ ucfirst($countrySide->label_position) }} of marker
                </p>
            </div>
        </div>
    </div>

    <div class="xl:col-span-2 bg-white rounded-2xl border border-[#e4ddd5] shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-[#eee7df] flex justify-between items-center">
            <div>
                <h3 class="font-bold text-lg">Areas</h3>
                <p class="text-sm text-gray-500 mt-1">
                    {{ $countrySide->areas->count() }} connected areas
                </p>
            </div>

            <a
                href="{{ route('admin.areas.create', ['country_side_id' => $countrySide->id]) }}"
                class="inline-flex items-center gap-2 bg-[#b7936e] px-4 py-2.5 rounded-xl font-semibold text-sm"
            >
                <i class="fa-solid fa-plus"></i>
                Add Area
            </a>
        </div>

        @forelse ($countrySide->areas as $area)
            <div class="px-6 py-4 border-b border-[#eee7df] last:border-b-0 flex items-center justify-between gap-4">
                <div>
                    <p class="font-semibold">{{ $area->title }}</p>
                    <p class="text-sm text-gray-500 mt-1">
                        {{ $area->address ?: 'No address' }}
                    </p>
                </div>

                <a
                    href="{{ route('admin.areas.show', $area) }}"
                    class="w-9 h-9 rounded-lg bg-[#f1e7dc] text-[#9d7a54] flex items-center justify-center"
                >
                    <i class="fa-solid fa-eye"></i>
                </a>
            </div>
        @empty
            <div class="py-14 text-center text-gray-500">
                No areas connected to this country side.
            </div>
        @endforelse
    </div>
</div>
@endsection