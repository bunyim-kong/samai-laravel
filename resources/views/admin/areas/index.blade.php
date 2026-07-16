@extends('layouts.admin')

@section('title', 'Areas - Samai Admin')
@section('page-title', 'Areas')
@section(
    'page-description',
    'Manage venues and map locations'
)

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
        <div class="overflow-x-auto">
            <table class="w-full min-w-[950px]">
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
                                    @if ($firstImage)
                                        <img
                                            src="{{ $firstImage->image_url }}"
                                            alt="{{ $area->title }}"
                                            class="w-12 h-12 rounded-xl object-cover"
                                        >
                                    @else
                                        <div
                                            class="w-12 h-12 rounded-xl bg-[#f1e7dc] text-[#9d7a54] flex items-center justify-center"
                                        >
                                            <i
                                                class="fa-solid fa-image"
                                            ></i>
                                        </div>
                                    @endif

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
                                class="px-6 py-4 text-sm text-gray-600"
                            >
                                {{ $area->countrySide?->name
                                    ?? 'Not assigned' }}
                            </td>

                            <td
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

                            <td class="px-6 py-4">
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

                            <td class="px-6 py-4">
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