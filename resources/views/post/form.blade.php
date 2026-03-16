<div class="space-y-6">
    {{-- User ID Field --}}
    <div>
        <label for="user_id" class="mb-3 block text-sm font-medium text-black">
            {{ __('User Id') }}
        </label>
        <input id="user_id" name="user_id" type="text"
               class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input"
               value="{{ old('user_id', $post?->user_id) }}"
               placeholder="User Id">

        @error('user_id')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Title Field --}}
    <div>
        <label for="title" class="mb-3 block text-sm font-medium text-black">
            {{ __('Title') }}
        </label>
        <input id="title" name="title" type="text"
               class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input"
               value="{{ old('title', $post?->title) }}"
               placeholder="Title">

        @error('title')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Slug Field --}}
    <div>
        <label for="slug" class="mb-3 block text-sm font-medium text-black">
            {{ __('Slug') }}
        </label>
        <input id="slug" name="slug" type="text"
               class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input"
               value="{{ old('slug', $post?->slug) }}"
               placeholder="Slug">

        @error('slug')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Body Field --}}
    <div>
        <label for="body" class="mb-3 block text-sm font-medium text-black">
            {{ __('Body') }}
        </label>
        <input id="body" name="body" type="text"
               class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input"
               value="{{ old('body', $post?->body) }}"
               placeholder="Body">

        @error('body')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Image Field --}}
    <div>
        <label for="image" class="mb-3 block text-sm font-medium text-black">
            {{ __('Image') }}
        </label>
        <input id="image" name="image" type="text"
               class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input"
               value="{{ old('image', $post?->image) }}"
               placeholder="Image">

        @error('image')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Repeat this pattern for Slug, Body, and Image... --}}

    <div class="flex items-center gap-4">
        <button type="submit" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            Submit
        </button>
    </div>
</div>

