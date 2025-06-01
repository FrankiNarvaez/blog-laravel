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
                New
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <a href="{{route('admin.posts.index') }}" class="btn btn-blue">Go back</a>
    </div>

    <div class="flex flex-col gap-6 h-full max-w-sm mx-auto">
        <form action="{{ route('admin.posts.store') }}" method="POST" class="flex flex-col gap-6 justify-center h-full">
            @csrf

            <flux:input
                label="Title"
                name="title"
                oninput="string_to_slug(this.value, '#slug')"
                autofocus
                required
                placeholder="Write the post title"
                :value="old('title')"
            />

            <flux:input
                label="Slug"
                name="slug"
                id="slug"
                required
                placeholder="Write the post slug"
                :value="old('slug')"
            />

            <flux:select label="Category" name="category_id" placeholder="Choose category...">
                @foreach ($categories as $category)
                    <flux:select.option :value="$category->id">{{ $category->name }}</flux:select.option>
                @endforeach
            </flux:select>

            <div class="flex items-center justify-end">
                <flux:button variant="primary" type="submit" class="w-full">Create</flux:button>
            </div>
        </form>
    </div>
</x-layouts.app>

