@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Update Post" />

    <div class="space-y-6">
        <div class="rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-800">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    {{ __('Update Existing Post') }}
                </h3>
            </div>

            <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                @method('PATCH')

                {{-- This includes your shared form fields --}}
                @include('post.form')

                <div class="mt-6 w-full">
                    <div class="flex items-center gap-3">
                        <button type="submit" class="bg-brand-500 hover:bg-brand-600 flex items-center justify-center gap-2 rounded-lg px-4 py-3 text-sm font-medium text-white transition">
                            Update Post
                        </button>

                        <a href="{{ route('posts.index') }}"
                           class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-3 text-sm font-medium text-gray-700 shadow-theme-xs transition hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
