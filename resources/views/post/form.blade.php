<div class="space-y-6">

    <div>
        <label for="user_id" :value="__('User Id')"/>
        <input id="user_id" name="user_id" type="text" class="mt-1 block w-full" :value="old('user_id', $post?->user_id)" autocomplete="user_id" placeholder="User Id"/>
        <error class="mt-2" :messages="$errors->get('user_id')"/>
    </div>
    <div>
        <label for="title" :value="__('Title')"/>
        <input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $post?->title)" autocomplete="title" placeholder="Title"/>
        <error class="mt-2" :messages="$errors->get('title')"/>
    </div>
    <div>
        <label for="slug" :value="__('Slug')"/>
        <input id="slug" name="slug" type="text" class="mt-1 block w-full" :value="old('slug', $post?->slug)" autocomplete="slug" placeholder="Slug"/>
        <error class="mt-2" :messages="$errors->get('slug')"/>
    </div>
    <div>
        <label for="body" :value="__('Body')"/>
        <input id="body" name="body" type="text" class="mt-1 block w-full" :value="old('body', $post?->body)" autocomplete="body" placeholder="Body"/>
        <error class="mt-2" :messages="$errors->get('body')"/>
    </div>
    <div>
        <label for="image" :value="__('Image')"/>
        <input id="image" name="image" type="text" class="mt-1 block w-full" :value="old('image', $post?->image)" autocomplete="image" placeholder="Image"/>
        <error class="mt-2" :messages="$errors->get('image')"/>
    </div>

    <div class="flex items-center gap-4">
        <button>Submit</button>
    </div>
</div>
