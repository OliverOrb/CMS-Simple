<div class="space-y-6">
    
    <div>
        <x-input-label for="title" :value="__('Title')"/>
        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $page?->title)" autocomplete="title" placeholder="Title"/>
        <x-input-error class="mt-2" :messages="$errors->get('title')"/>
    </div>
    <div>
        <x-input-label for="slug" :value="__('Slug')"/>
        <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full" :value="old('slug', $page?->slug)" autocomplete="slug" placeholder="Slug"/>
        <x-input-error class="mt-2" :messages="$errors->get('slug')"/>
    </div>
    <div>
        <x-input-label for="content" :value="__('Content')"/>
        <x-text-input id="content" name="content" type="text" class="mt-1 block w-full" :value="old('content', $page?->content)" autocomplete="content" placeholder="Content"/>
        <x-input-error class="mt-2" :messages="$errors->get('content')"/>
    </div>
    <div>
        <x-input-label for="is_published" :value="__('Is Published')"/>
        <x-text-input id="is_published" name="is_published" type="text" class="mt-1 block w-full" :value="old('is_published', $page?->is_published)" autocomplete="is_published" placeholder="Is Published"/>
        <x-input-error class="mt-2" :messages="$errors->get('is_published')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>