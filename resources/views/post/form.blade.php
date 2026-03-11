<div class="space-y-6">
    
    <div>
        <x-input-label for="user_id" :value="__('User Id')"/>
        <x-text-input id="user_id" name="user_id" type="text" class="mt-1 block w-full" :value="old('user_id', $post?->user_id)" autocomplete="user_id" placeholder="User Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('user_id')"/>
    </div>
    <div>
        <x-input-label for="title" :value="__('Title')"/>
        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $post?->title)" autocomplete="title" placeholder="Title"/>
        <x-input-error class="mt-2" :messages="$errors->get('title')"/>
    </div>
    <div>
        <x-input-label for="slug" :value="__('Slug')"/>
        <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full" :value="old('slug', $post?->slug)" autocomplete="slug" placeholder="Slug"/>
        <x-input-error class="mt-2" :messages="$errors->get('slug')"/>
    </div>
    <div>
        <x-input-label for="body" :value="__('Body')"/>
        <x-text-input id="body" name="body" type="text" class="mt-1 block w-full" :value="old('body', $post?->body)" autocomplete="body" placeholder="Body"/>
        <x-input-error class="mt-2" :messages="$errors->get('body')"/>
    </div>
    <div>
        <x-input-label for="image" :value="__('Image')"/>
        <x-text-input id="image" name="image" type="text" class="mt-1 block w-full" :value="old('image', $post?->image)" autocomplete="image" placeholder="Image"/>
        <x-input-error class="mt-2" :messages="$errors->get('image')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>