<div class="space-y-6">
    {{-- Title Field --}}
    <div>
        <label for="title" class="mb-3 block text-sm font-medium text-gray-800 dark:text-white/90">
            {{ __('Title') }}
        </label>
        <input id="title" name="title" type="text"
               class="w-full rounded-lg border border-gray-200 bg-transparent px-5 py-3 font-medium text-gray-800 outline-none transition focus:border-brand-500 active:border-brand-500 dark:border-gray-800 dark:bg-white/[0.03] dark:text-white/90"
               value="{{ old('title', $post?->title) }}"
               placeholder="{{ __('Title') }}">

        @error('title')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Body Field --}}
    <div>
        <label for="body" class="mb-3 block text-sm font-medium text-gray-800 dark:text-white/90">
            {{ __('Body') }}
        </label>
        <input id="body" name="body" type="text"
               class="w-full rounded-lg border border-gray-200 bg-transparent px-5 py-3 font-medium text-gray-800 outline-none transition focus:border-brand-500 active:border-brand-500 dark:border-gray-800 dark:bg-white/[0.03] dark:text-white/90"
               value="{{ old('body', $post?->body) }}"
               placeholder="{{ __('Body') }}">

        @error('body')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>
