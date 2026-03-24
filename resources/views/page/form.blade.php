<div class="space-y-6">
    {{-- Title Field --}}
    <div>
        <label for="title" class="mb-3 block text-sm font-medium text-gray-800 dark:text-white/90">
            {{ __('Title') }}
        </label>
        <input id="title" name="title" type="text"
               class="w-full rounded-lg border border-gray-200 bg-transparent px-5 py-3 font-medium text-gray-800 outline-none transition focus:border-brand-500 active:border-brand-500 dark:border-gray-800 dark:bg-white/[0.03] dark:text-white/90"
               value="{{ old('title', $page?->title) }}"
               placeholder="{{ __('Title') }}">

        @error('title')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Content Field --}}
    <div>
        <label for="content" class="mb-3 block text-sm font-medium text-gray-800 dark:text-white/90">
            {{ __('Content') }}
        </label>
        <input id="content" name="content" type="text"
               class="w-full rounded-lg border border-gray-200 bg-transparent px-5 py-3 font-medium text-gray-800 outline-none transition focus:border-brand-500 active:border-brand-500 dark:border-gray-800 dark:bg-white/[0.03] dark:text-white/90"
               value="{{ old('content', $page?->content) }}"
               placeholder="{{ __('Content') }}">

        @error('body')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Is Published Field --}}
    <div>
        <label for="is_published" class="mb-3 block text-sm font-medium text-gray-800 dark:text-white/90">
            {{ __('Is Published') }}
        </label>
        <input id="is_published" name="is_published" type="text"
               class="w-full rounded-lg border border-gray-200 bg-transparent px-5 py-3 font-medium text-gray-800 outline-none transition focus:border-brand-500 active:border-brand-500 dark:border-gray-800 dark:bg-white/[0.03] dark:text-white/90"
               value="{{ old('is_published', $page?->is_published) }}"
               placeholder="{{ __('Is Published') }}">

        @error('image')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>
