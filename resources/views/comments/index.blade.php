@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="All Comments"/>

    <div class="space-y-6">
        {{-- Success Alert --}}
        @if(session('success'))
            <x-ui.alert variant="success">
                {{ session('success') }}
            </x-ui.alert>
        @endif

        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="max-w-full overflow-x-auto custom-scrollbar">
                <table class="w-full min-w-[900px]">
                    <thead>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <th class="px-5 py-3 text-left sm:px-6">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400 uppercase">№</p>
                        </th>
                        <th class="px-5 py-3 text-left sm:px-6">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400 uppercase">Author</p>
                        </th>
                        <th class="px-5 py-3 text-left sm:px-6">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400 uppercase">Comment</p>
                        </th>
                        <th class="px-5 py-3 text-left sm:px-6">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400 uppercase">Post</p>
                        </th>
                        <th class="px-5 py-3 text-left sm:px-6">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400 uppercase">Time Created</p>
                        </th>
                        <th class="px-5 py-3 text-right sm:px-6">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400 uppercase">Actions</p>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($comments as $comment)
                        <tr class="border-b border-gray-100 dark:border-gray-800">

                            <td class="px-5 py-4 sm:px-6">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400 hitespace-normal break-words max-w-full">{{ $comments->total() - $comments->firstItem() - $loop->index + 1 }}</p>
                            </td>

                            {{-- Author --}}
                            <td class="px-5 py-4 sm:px-6">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400 hitespace-normal break-words max-w-full">
                                    {{ Str::limit($comment->user->name ?? 'Deleted User', 15) }}
                                </p>
                            </td>

                            {{-- Comment Snippet (Limits to 80 characters) --}}
                            <td class="px-5 py-4 sm:px-6">
                                <p class="text-gray-800 text-theme-sm font-medium dark:text-white/90 hitespace-normal break-words max-w-full">
                                    {{ Str::limit($comment->body, 70) }}
                                </p>
                            </td>

                            {{-- Link to the Post --}}
                            <td class="px-5 py-4 sm:px-6">
                                @if($comment->post)
                                    <a href="{{ route('posts.show', $comment->post) }}" class="text-brand-500 text-theme-sm hover:underline hitespace-normal break-words max-w-full">
                                        {{ Str::limit($comment->post->title, 30) }}
                                    </a>
                                @else
                                    <span class="text-gray-400 text-theme-sm italic">Deleted Post</span>
                                @endif
                            </td>

                            {{-- Date --}}
                            <td class="px-5 py-4 sm:px-6">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                    {{ $comment->created_at->format('H:i • d M, Y') }}
                                </p>
                            </td>

                            <td class="px-5 py-4 sm:px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    {{-- Show Button --}}
                                    <a href="{{ route('comments.show', $comment) }}"
                                       class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm font-medium text-gray-700 shadow-theme-xs transition hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>

                                    @if(auth()->id() === $comment->user_id || auth()->user()->hasAnyRole(['Admin', 'Editor']))
                                        {{-- Delete Button --}}
                                        <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this comment?')"
                                                    class="inline-flex items-center justify-center rounded-lg border border-red-200 bg-white px-3 py-2 text-sm font-medium text-red-600 shadow-theme-xs transition hover:bg-red-50 dark:border-red-900/30 dark:bg-gray-800 dark:text-red-500 dark:hover:bg-red-500/10">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-8 text-center">
                                <p class="text-gray-500 dark:text-gray-400">No comments found.</p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        @if ($comments->hasPages())
            <div class="mt-4">
                {{ $comments->links() }}
            </div>
        @endif
    </div>
@endsection
