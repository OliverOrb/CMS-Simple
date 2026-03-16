@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Add Post"/>
    <div class="space-y-6">
        <div class="rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-800">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    {{ __('Create') }} Post
                </h3>
            </div>

            <div class="py-12">
                <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="w-full">
                            <div class="sm:flex sm:items-center">
                                <div class="sm:flex-auto">
                                    <h1 class="text-base font-semibold leading-6 text-gray-900">{{ __('Create') }}
                                        Post</h1>
                                    <p class="mt-2 text-sm text-gray-700">Add a new {{ __('Post') }}.</p>
                                </div>
                            </div>
                            <div class="mt-4 w-full px-2.5">
                                <div class="mt-1 flex items-center gap-3">
                                    <button type="submit" class="bg-brand-500 hover:bg-brand-600 flex items-center justify-center gap-2 rounded-lg px-4 py-3 text-sm font-medium text-white">
                                        Publish
                                    </button>

                                    <a href="{{ route('posts.index') }}"
                                       class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-3 text-sm font-medium text-gray-700 shadow-theme-xs transition hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                                        Back
                                    </a>
                                </div>
                            </div>
                            <div class="flow-root">
                                <div class="mt-8 overflow-x-auto">
                                    <div class="max-w-xl py-2 align-middle">
                                        <form method="POST" action="{{ route('posts.store') }}" role="form"
                                              enctype="multipart/form-data">
                                            @csrf

                                            @include('post.form')
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
