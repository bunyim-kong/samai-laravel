@extends('layouts.admin')

@section('title', 'Country Sides - Samai Admin')
@section('page-title', 'Country Sides')
@section('page-description', 'Manage provinces shown on the Cambodia map')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <div>
        <h3 class="text-xl font-bold">All Country Sides</h3>
        <p class="text-sm text-gray-500 mt-1">
            {{ $countrySides->total() }} records found
        </p>
    </div>

    <a
        href="{{ route('admin.country-sides.create') }}"
        class="inline-flex items-center justify-center gap-2 bg-[#b7936e] hover:bg-[#a5825e] text-[#2d241c] px-5 py-3 rounded-xl font-semibold text-sm transition"
    >
        <i class="fa-solid fa-plus"></i>
        Add Country Side
    </a>
</div>

<div class="bg-white rounded-2xl border border-[#e4ddd5] shadow-sm overflow-hidden">
    @if ($countrySides->isEmpty())
        <div class="py-16 text-center">
            <div class="w-16 h-16 rounded-full bg-[#f1e7dc] text-[#9d7a54] mx-auto flex items-center justify-center">
                <i class="fa-solid fa-map text-2xl"></i>
            </div>

            <h4 class="font-semibold mt-4">No country sides found</h4>

            <p class="text-sm text-gray-500 mt-2">
                Create your first province.
            </p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full min-w-[850px]">
                <thead class="bg-[#faf8f5]">
                    <tr class="text-left text-xs uppercase tracking-wide text-gray-500">
                        <th class="px-6 py-4 font-semibold">Name</th>
                        <th class="px-6 py-4 font-semibold">Map Center</th>
                        <th class="px-6 py-4 font-semibold">Zoom</th>
                        <th class="px-6 py-4 font-semibold">Position</th>
                        <th class="px-6 py-4 font-semibold">Areas</th>
                        <th class="px-6 py-4 font-semibold text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-[#eee7df]">
                    @foreach ($countrySides as $countrySide)
                        <tr class="hover:bg-[#faf8f5]">
                            <td class="px-6 py-4">
                                <p class="font-semibold">{{ $countrySide->name }}</p>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $countrySide->slug }}
                                </p>
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-600">
                                @if ($countrySide->center_lat !== null && $countrySide->center_lng !== null)
                                    {{ $countrySide->center_lat }},
                                    {{ $countrySide->center_lng }}
                                @else
                                    <span class="text-gray-400">Not provided</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $countrySide->zoom }}
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-600">
                                @if ($countrySide->position_top !== null && $countrySide->position_left !== null)
                                    Top: {{ $countrySide->position_top }}%
                                    <br>
                                    Left: {{ $countrySide->position_left }}%
                                @else
                                    <span class="text-gray-400">Not provided</span>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                <span class="inline-flex min-w-9 h-9 px-3 items-center justify-center rounded-lg bg-[#f1e7dc] text-[#765738] font-bold text-sm">
                                    {{ $countrySide->areas_count }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a
                                        href="{{ route('admin.country-sides.show', $countrySide) }}"
                                        class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 flex items-center justify-center"
                                        title="View"
                                    >
                                        <i class="fa-solid fa-eye text-sm"></i>
                                    </a>

                                    <a
                                        href="{{ route('admin.country-sides.edit', $countrySide) }}"
                                        class="w-9 h-9 rounded-lg bg-[#f1e7dc] text-[#9d7a54] hover:bg-[#e8d7c5] flex items-center justify-center"
                                        title="Edit"
                                    >
                                        <i class="fa-solid fa-pen text-sm"></i>
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route('admin.country-sides.destroy', $countrySide) }}"
                                        onsubmit="return confirm('Delete this country side and all its areas?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="w-9 h-9 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 flex items-center justify-center cursor-pointer"
                                            title="Delete"
                                        >
                                            <i class="fa-solid fa-trash text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if ($countrySides->hasPages())
            <div class="px-6 py-4 border-t border-[#eee7df]">
                {{ $countrySides->links() }}
            </div>
        @endif
    @endif
</div>
@endsection