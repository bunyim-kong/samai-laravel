@extends('layouts.admin')

@section('title', 'Add Country Side - Samai Admin')
@section('page-title', 'Add Country Side')
@section('page-description', 'Create a province for the Cambodia map')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-2xl border border-[#e4ddd5] shadow-sm p-6 sm:p-8">
        <form
            method="POST"
            action="{{ route('admin.country-sides.store') }}"
        >
            @csrf

            @include('admin.country-sides.form')

            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 mt-8 pt-6 border-t border-[#eee7df]">
                <a
                    href="{{ route('admin.country-sides.index') }}"
                    class="inline-flex justify-center items-center px-5 py-3 rounded-xl border border-[#d9d1c8] font-semibold text-sm hover:bg-[#f4f1ed]"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="inline-flex justify-center items-center gap-2 bg-[#b7936e] hover:bg-[#a5825e] text-[#2d241c] px-5 py-3 rounded-xl font-semibold text-sm cursor-pointer"
                >
                    <i class="fa-solid fa-floppy-disk"></i>
                    Save Country Side
                </button>
            </div>
        </form>
    </div>
</div>
@endsection