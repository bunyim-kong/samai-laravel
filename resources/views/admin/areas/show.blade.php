@extends('layouts.admin')

@section(
    'title',
    $area->title . ' - Samai Admin'
)

@section('page-title', $area->title)
@section('page-description', 'Area details')

@section('content')
<div class="flex flex-wrap gap-3 mb-6">
    <a
        href="{{ route('admin.areas.index') }}"
        class="inline-flex items-center gap-2 border border-[#d9d1c8] px-5 py-3 rounded-xl font-semibold text-sm"
    >
        <i class="fa-solid fa-arrow-left"></i>
        Back
    </a>

    <a
        href="{{ route('admin.areas.edit', $area) }}"
        class="inline-flex items-center gap-2 bg-[#b7936e] px-5 py-3 rounded-xl font-semibold text-sm"
    >
        <i class="fa-solid fa-pen"></i>
        Edit
    </a>
</div>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
    <div class="xl:col-span-2 space-y-6">

        @if ($area->images->isNotEmpty())
            <div
                class="bg-white rounded-2xl border border-[#e4ddd5] shadow-sm p-6"
            >
                <h3 class="font-bold text-lg mb-5">
                    Venue Photos
                </h3>

                <div
                    class="grid grid-cols-2 md:grid-cols-3 gap-4"
                >
                    @foreach ($area->images as $image)
                        <img
                            src="{{ $image->image_url }}"
                            alt="{{ $area->title }} photo {{ $loop->iteration }}"
                            class="w-full aspect-video object-cover rounded-xl"
                        >
                    @endforeach
                </div>
            </div>
        @endif

        <div
            class="bg-white rounded-2xl border border-[#e4ddd5] shadow-sm p-6"
        >
            <h3 class="font-bold text-lg mb-5">
                Venue Information
            </h3>

            <div class="space-y-6">
                <div>
                    <p class="text-sm text-gray-500">
                        Address
                    </p>

                    <p class="mt-1">
                        {{ $area->address ?: '—' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">
                        Opening Hours
                    </p>

                    <p class="mt-1 whitespace-pre-line">
                        {{ $area->open_hours ?: '—' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">
                        Description
                    </p>

                    <p
                        class="mt-1 whitespace-pre-line leading-7"
                    >
                        {{ $area->description ?: '—' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">
                        Samai Signature Serves
                    </p>

                    <p class="mt-1 whitespace-pre-line">
                        {{ $area->serves ?: '—' }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div
        class="bg-white rounded-2xl border border-[#e4ddd5] shadow-sm p-6 h-fit"
    >
        <h3 class="font-bold text-lg mb-5">
            Details
        </h3>

        <div class="space-y-5 text-sm">
            <div>
                <p class="text-gray-500">
                    Country Side
                </p>

                <p class="font-semibold mt-1">
                    {{ $area->countrySide?->name ?? '—' }}
                </p>
            </div>

            <div>
                <p class="text-gray-500">
                    Coordinates
                </p>

                <p class="font-semibold mt-1">
                    {{ $area->lat ?? '—' }},
                    {{ $area->lng ?? '—' }}
                </p>
            </div>

            <div>
                <p class="text-gray-500">
                    Status
                </p>

                <p class="font-semibold mt-1">
                    {{ $area->is_active
                        ? 'Active'
                        : 'Inactive' }}
                </p>
            </div>

            <div>
                <p class="text-gray-500">
                    Phone 1
                </p>

                <p class="font-semibold mt-1">
                    {{ $area->phone ?: '—' }}
                </p>
            </div>

            <div>
                <p class="text-gray-500">
                    Phone 2
                </p>

                <p class="font-semibold mt-1">
                    {{ $area->secondary_phone ?: '—' }}
                </p>
            </div>

            <div>
                <p class="text-gray-500">
                    Email
                </p>

                <p class="font-semibold mt-1 break-all">
                    {{ $area->email ?: '—' }}
                </p>
            </div>

            @if ($area->maps_url)
                <a
                    href="{{ $area->maps_url }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex text-[#9d7a54] font-semibold"
                >
                    View on Google Maps
                </a>
            @endif
        </div>
    </div>
</div>
@endsection
