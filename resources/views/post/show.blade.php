@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Post Details"/>

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
                        <p class="mt-1 text-lg font-semibold text-gray-800 dark:text-white/90 hitespace-normal break-words max-w-full">{{ $post->title }}</p>
                    </div>

                    {{-- Author --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Author</p>
                        <p class="mt-1 text-theme-sm text-gray-700 dark:text-gray-300 hitespace-normal break-words max-w-full">{{ $post->user->name ?? 'Unknown' }}</p>
                    </div>

                    {{-- Slug --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Slug</p>
                        <p class="mt-1 text-theme-sm text-gray-700 dark:text-gray-300 hitespace-normal break-words max-w-full">{{ $post->slug }}</p>
                    </div>

                    {{-- Created On --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Time Created</p>
                        <p class="mt-1 text-theme-sm text-gray-700 dark:text-gray-300">
                            {{ $post->created_at->format('F j, Y \a\t g:i A') }}
                        </p>
                    </div>

                    {{-- Updated At --}}
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Last Updated</p>
                        <p class="mt-1 text-theme-sm text-gray-700 dark:text-gray-300">
                            {{ $post->updated_at->diffForHumans() }}
                        </p>
                    </div>

                    {{-- Body/Content --}}
                    <div class="sm:col-span-2">
                        <p class="mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">Content</p>
                        <div
                            class="prose prose-sm max-w-none rounded-lg border border-gray-100 bg-gray-50/50 p-4 dark:border-gray-800 dark:bg-white/[0.02] dark:text-gray-300 hitespace-normal break-words max-w-full">
                            {!! nl2br(e($post->body)) !!}
                        </div>
                    </div>
                </div>

                {{-- Footer Actions --}}
                @if(auth()->id() === $post->user_id || auth()->user()->can(['edit content']))
                    <div class="mt-8 flex items-center gap-3 border-t border-gray-100 pt-6 dark:border-gray-800">
                        <a href="{{ route('posts.edit', $post->id) }}"
                           class="inline-flex items-center justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white shadow-theme-xs transition hover:bg-brand-600">
                            Edit Post
                        </a>

                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this post?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center justify-center rounded-lg border border-red-200 bg-white px-4 py-2.5 text-sm font-medium text-red-600 shadow-theme-xs transition hover:bg-red-50 dark:border-red-900/30 dark:bg-gray-800 dark:text-red-500 dark:hover:bg-red-500/10">
                                Delete Post
                            </button>
                        </form>
                    </div>
                @endif

                {{-- COMMENTS SECTION --}}
                <div class="mt-8 border-t border-gray-100 pt-8 dark:border-gray-800">
                    <h3 class="mb-6 text-base font-medium text-gray-800 dark:text-white/90">
                        Comments ({{ $post->comments->count() }})
                    </h3>

                    {{-- Leave a Comment Form --}}
                    @auth
                        <form action="{{ route('comments.store') }}" method="POST" class="mb-8">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">

                            <div>
                                <label for="body" class="sr-only">Leave a comment</label>
                                <textarea id="body" name="body" rows="3" required
                                          placeholder="Write a comment..."
                                          class="w-full rounded-lg border border-gray-200 bg-transparent px-4 py-3 text-sm font-medium text-gray-800 outline-none transition focus:border-brand-500 dark:border-gray-800 dark:bg-white/[0.03] dark:text-white/90"></textarea>
                            </div>
                            <div class="mt-3 flex justify-end">
                                <button type="submit" class="rounded-lg bg-brand-500 px-4 py-2 text-sm font-medium text-white transition hover:bg-brand-600">
                                    Post Comment
                                </button>
                            </div>
                        </form>
                    @else
                        <p class="mb-8 text-sm text-gray-500">You must <a href="{{ route('login') }}" class="text-brand-500 hover:underline">log in</a> to leave a comment.</p>
                    @endauth

                    {{-- The Comments Feed --}}
                    <div class="space-y-6">
                        @forelse($post->comments as $comment)
                            <div class="flex gap-4">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-brand-100 text-brand-600 dark:bg-brand-500/20 dark:text-brand-400">
                                    {{ substr($comment->user->name, 0, 1) }}
                                </div>

                                <div class="flex-1 rounded-lg border border-gray-100 bg-gray-50 p-4 dark:border-gray-800 dark:bg-white/[0.02]">
                                    <div class="mb-2 flex items-center justify-between">
                                        <p class="text-sm font-semibold text-gray-800 dark:text-white/90">
                                            {{ $comment->user->name }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                    <p class="text-sm text-gray-700 dark:text-gray-300">
                                        {{ $comment->body }}
                                    </p>

                                    @if(auth()->id() === $comment->user_id || auth()->user()?->hasAnyRole(['Admin', 'Editor']))
                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="mt-3 text-right">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Delete this comment?')" class="text-xs font-medium text-red-500 hover:text-red-700 hover:underline">
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500 dark:text-gray-400">Comments are shown in the Comments section in the sidebar!</p>
                        @endforelse
                    </div>
                </div>
                {{-- END COMMENTS SECTION --}}
            </div>
        </div>
    </div>
@endsection
