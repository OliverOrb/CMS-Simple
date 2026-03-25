@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Post Details" />

    <div class="space-y-6">
        <div class="rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            {{-- Card Header --}}
            <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-800">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    {{ __('View Post') }}
                </h3>
                <a href="{{ route('posts.index') }}"
                   class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-theme-xs transition hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                    Back to List
                </a>
            </div>

            {{-- Card Body --}}
            <div class="p-6">
                <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">

                    {{-- Title Section --}}
                    <div class="sm:col-span-2">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Title</p>
                        <p class="mt-1 text-lg font-semibold text-gray-800 dark:text-white/90">{{ $post->title }}</p>
                    </div>

                    {{-- Author/User ID --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Post Number</p>
                        <p class="mt-1 text-theme-sm text-gray-700 dark:text-gray-300">{{ $post->user_id }}</p>
                    </div>

                    {{-- Slug --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Slug</p>
                        <p class="mt-1 text-theme-sm text-gray-700 dark:text-gray-300">{{ $post->slug }}</p>
                    </div>

                    {{-- Body/Content --}}
                    <div class="sm:col-span-2">
                        <p class="mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">Content</p>
                        <div class="prose prose-sm max-w-none rounded-lg border border-gray-100 bg-gray-50/50 p-4 dark:border-gray-800 dark:bg-white/[0.02] dark:text-gray-300">
                            {!! nl2br(e($post->body)) !!}
                        </div>
                    </div>
                </div>

                {{-- Footer Actions --}}
                <div class="mt-8 flex items-center gap-3 border-t border-gray-100 pt-6 dark:border-gray-800">
                    <a href="{{ route('posts.edit', $post->id) }}"
                       class="inline-flex items-center justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white shadow-theme-xs transition hover:bg-brand-600">
                        Edit Post
                    </a>

                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center justify-center rounded-lg border border-red-200 bg-white px-4 py-2.5 text-sm font-medium text-red-600 shadow-theme-xs transition hover:bg-red-50 dark:border-red-900/30 dark:bg-gray-800 dark:text-red-500 dark:hover:bg-red-500/10">
                            Delete Post
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
