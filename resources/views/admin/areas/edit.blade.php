@extends('layouts.admin')

@section('title', 'Edit Area - Samai Admin')
@section('page-title', 'Edit Area')
@section('page-description', 'Update ' . $area->title)

@section('content')
<div class="max-w-6xl">
    <div class="bg-white rounded-2xl border border-[#e4ddd5] shadow-sm p-6 sm:p-8">

        <form
            method="POST"
            action="{{ route('admin.areas.update', $area) }}"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            @include('admin.areas.form')

            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 mt-8 pt-6 border-t border-[#eee7df]">

                <a
                    href="{{ route('admin.areas.index') }}"
                    class="inline-flex justify-center items-center px-5 py-3 rounded-xl border border-[#d9d1c8] font-semibold text-sm hover:bg-[#f4f1ed]"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="inline-flex justify-center items-center gap-2 bg-[#b7936e] hover:bg-[#a5825e] text-[#2d241c] px-5 py-3 rounded-xl font-semibold text-sm cursor-pointer"
                >
                    <i class="fa-solid fa-floppy-disk"></i>
                    Update Area
                </button>

            </div>
        </form>

    </div>
</div>
@endsection