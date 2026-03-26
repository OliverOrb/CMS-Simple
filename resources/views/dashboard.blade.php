@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Dashboard" />

    <div class="space-y-6">
        {{-- Welcome Message --}}
        <div class="rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03]">
            <h2 class="text-xl font-bold text-gray-800 dark:text-white/90">
                Welcome back, {{ auth()->user()->name }}! 👋
            </h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Here is a quick overview of the platform.
            </p>
        </div>

        {{-- Top Stats Grid (Replacing the E-commerce metrics) --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:gap-6 xl:grid-cols-4">

            {{-- Stat Card: Posts --}}
            <div class="rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03]">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Posts</p>
                <h4 class="mt-2 text-3xl font-bold text-gray-800 dark:text-white/90">{{ $stats['posts'] }}</h4>
            </div>

            {{-- Stat Card: Comments --}}
            <div class="rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03]">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Comments</p>
                <h4 class="mt-2 text-3xl font-bold text-gray-800 dark:text-white/90">{{ $stats['comments'] }}</h4>
            </div>

            {{-- Stat Card: Pages --}}
            <div class="rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03]">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Pages</p>
                <h4 class="mt-2 text-3xl font-bold text-gray-800 dark:text-white/90">{{ $stats['pages'] }}</h4>
            </div>

            {{-- Stat Card: Users --}}
            <div class="rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03]">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Registered Users</p>
                <h4 class="mt-2 text-3xl font-bold text-gray-800 dark:text-white/90">{{ $stats['users'] }}</h4>
            </div>
        </div>

        {{-- Recent Activity Table --}}
        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-800">
                <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Recently Created Posts</h3>
            </div>
            <div class="max-w-full overflow-x-auto custom-scrollbar">
                <table class="w-full min-w-[600px]">
                    <tbody>
                    @forelse($recentPosts as $post)
                        <tr class="border-b border-gray-100 last:border-0 dark:border-gray-800">
                            <td class="px-6 py-4">
                                <a href="{{ route('posts.show', $post) }}" class="font-medium text-brand-500 hover:underline hitespace-normal break-words max-w-full">
                                    {{ Str::limit($post->title, 100) }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400 hitespace-normal break-words max-w-full">
                                By {{ Str::limit($post->user->name, 30) }}
                            </td>
                            <td class="px-6 py-4 text-right text-sm text-gray-500 dark:text-gray-400 hitespace-normal break-words max-w-full">
                                {{ $post->created_at->diffForHumans() }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-sm text-gray-500">
                                No posts created yet.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
