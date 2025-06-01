<x-layouts.app>
    <div class="flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">
                Dashboard
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.posts.index')">
                Posts
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item>
                Edit
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <a href="{{route('admin.posts.index') }}" class="btn btn-blue">Go back</a>
    </div>

    <div class="flex flex-col gap-6 h-full max-w-4xl mx-auto">
        <form action="{{ route('admin.posts.update', $post) }}" method="POST" class="flex flex-col gap-6 justify-center h-full" enctype="multipart/form-data" >
            @csrf
            @method('PUT')

            <div class="relative">
                <img
                    class="aspect-video object-cover content-center"
                    src="{{ $post->image_path ? Storage::url($post->image_path) : 'https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png' }}"
                    id="image-preview"
                >
                <label class="btn btn-alt absolute right-4 top-4">
                    Select an image
                    <input type="file" name="image" class="hidden" accept="image/*" onchange="previewImage(event, '#image-preview')" >
                </label>
            </div>

            <flux:input
                label="Title"
                name="title"
                oninput="string_to_slug(this.value, '#slug')"
                autofocus
                required
                placeholder="Write the post title"
                :value="old('title', $post->title)"
            />

            <flux:input
                label="Slug"
                name="slug"
                id="slug"
                required
                placeholder="Write the post slug"
                :value="old('slug', $post->slug)"
            />

            <flux:textarea label="Excerpt" name="excerpt">
                {{ old('excerpt', $post->excerpt) }}
            </flux:textarea>

            <flux:textarea label="Content" name="content">
                {{ old('content', $post->content) }}
            </flux:textarea>

            <flux:select label="Category" name="category_id" placeholder="Choose category...">
                @foreach ($categories as $category)
                    <flux:select.option :value="$category->id" :selected="$category->id == old('category_id', $post->category_id)">{{ $category->name }}</flux:select.option>
                @endforeach
            </flux:select>

            <flux:checkbox.group wire:model="notifications" label="Tags">
                @foreach ($tags as $tag)
                    <flux:checkbox :label="$tag->name" name="tags[]" :value="$tag->id" :checked="old('tags[]', in_array($tag->id, $post->tags->pluck('id')->toArray())) == 1" />
                @endforeach
            </flux:checkbox.group>

            <flux:field variant="inline">
                <flux:checkbox name="is_published" :checked="old('is_published', $post->is_published) == 1" />

                <flux:label>Is published the posts?</flux:label>

                <flux:error name="terms" />
            </flux:field>

            <div class="flex items-center justify-end">
                <flux:button variant="primary" type="submit">Create</flux:button>
            </div>
        </form>
    </div>
</x-layouts.app>


