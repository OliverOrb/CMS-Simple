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
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400 uppercase">Author</p>
                        </th>
                        <th class="px-5 py-3 text-left sm:px-6">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400 uppercase">Comment</p>
                        </th>
                        <th class="px-5 py-3 text-left sm:px-6">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400 uppercase">Post</p>
                        </th>
                        <th class="px-5 py-3 text-left sm:px-6">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400 uppercase">Date</p>
                        </th>
                        <th class="px-5 py-3 text-right sm:px-6">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400 uppercase">Actions</p>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($comments as $comment)
                        <tr class="border-b border-gray-100 dark:border-gray-800">

                            {{-- Author --}}
                            <td class="px-5 py-4 sm:px-6">
                                <p class="text-gray-800 text-theme-sm font-medium dark:text-white/90">
                                    {{ $comment->user->name ?? 'Deleted User' }}
                                </p>
                            </td>

                            {{-- Comment Snippet (Limits to 50 characters) --}}
                            <td class="px-5 py-4 sm:px-6">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                    {{ \Illuminate\Support\Str::limit($comment->body, 50) }}
                                </p>
                            </td>

                            {{-- Link to the Post --}}
                            <td class="px-5 py-4 sm:px-6">
                                @if($comment->post)
                                    <a href="{{ route('posts.show', $comment->post->id) }}" class="text-brand-500 text-theme-sm hover:underline">
                                        {{ \Illuminate\Support\Str::limit($comment->post->title, 30) }}
                                    </a>
                                @else
                                    <span class="text-gray-400 text-theme-sm italic">Deleted Post</span>
                                @endif
                            </td>

                            {{-- Date --}}
                            <td class="px-5 py-4 sm:px-6">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                    {{ $comment->created_at->format('M d, Y') }}
                                </p>
                            </td>

                            {{-- Actions --}}
                            <td class="px-5 py-4 sm:px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    @if(auth()->id() === $comment->user_id || auth()->user()->hasAnyRole(['Admin', 'Editor']))
                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this comment?')"
                                                    class="inline-flex items-center justify-center rounded-lg border border-red-200 bg-white px-3 py-2 text-sm font-medium text-red-600 shadow-theme-xs transition hover:bg-red-50 dark:border-red-900/30 dark:bg-gray-800 dark:text-red-500 dark:hover:bg-red-500/10">
                                                Delete
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
