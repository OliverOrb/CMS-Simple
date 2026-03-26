@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Comment Details"/>

    <div class="space-y-6">
        @if(session('success'))
            <x-ui.alert variant="success">
                {{ session('success') }}
            </x-ui.alert>
        @endif
        <div class="rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            {{-- Card Header --}}
            <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-800">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    {{ __('View Comment') }}
                </h3>
                <a href="{{ route('comments.index') }}"
                   class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-theme-xs transition hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                    Back to List
                </a>
            </div>

            {{-- Card Body --}}
            <div class="p-6">
                <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">

                    {{-- Author --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Original Poster</p>
                        <p class="mt-1 text-theme-sm text-gray-700 dark:text-gray-300 hitespace-normal break-words max-w-full">{{ $comment->user->name ?? 'Deleted User' }}</p>
                    </div>

                    {{-- Posted On (The Associated Post) --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 hitespace-normal break-words max-w-full">Posted On</p>
                        @if($comment->post)
                            <a href="{{ route('posts.show', $comment->post) }}"
                               class="mt-1 inline-block text-theme-sm text-brand-500 hover:underline">
                                {{ $comment->post->title }}
                            </a>
                        @else
                            <p class="mt-1 text-theme-sm text-gray-400 italic">Deleted Post</p>
                        @endif
                    </div>

                    {{-- Created On --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Time Created</p>
                        <p class="mt-1 text-theme-sm text-gray-700 dark:text-gray-300">
                            {{ $comment->created_at->format('F j, Y \a\t g:i A') }}
                        </p>
                    </div>

                    {{-- Updated At --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Last Updated</p>
                        <p class="mt-1 text-theme-sm text-gray-700 dark:text-gray-300">
                            {{ $comment->updated_at->diffForHumans() }}
                        </p>
                    </div>

                    {{-- Body/Content --}}
                    <div class="sm:col-span-2">
                        <p class="mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">Comment Content</p>
                        <div
                            class="prose prose-sm rounded-lg border border-gray-100 bg-gray-50/50 p-4 dark:border-gray-800 dark:bg-white/[0.02] dark:text-gray-300 hitespace-normal break-words max-w-full">
                            {!! nl2br(e($comment->body)) !!}
                        </div>
                    </div>
                </div>

                {{-- Footer Actions --}}
                @if(auth()->id() === $comment->user_id || auth()->user()->hasAnyRole(['Admin', 'Editor']))
                    <div class="mt-8 flex items-center gap-3 border-t border-gray-100 pt-6 dark:border-gray-800">
                        {{-- NOTE: We removed the "Edit" button here, because usually CMS comments aren't editable, just deletable! --}}
                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this comment?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center justify-center rounded-lg border border-red-200 bg-white px-4 py-2.5 text-sm font-medium text-red-600 shadow-theme-xs transition hover:bg-red-50 dark:border-red-900/30 dark:bg-gray-800 dark:text-red-500 dark:hover:bg-red-500/10">
                                Delete Comment
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
    </div>
@endsection
