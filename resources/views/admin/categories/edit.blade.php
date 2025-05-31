<x-layouts.app>
    <div class="flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">
                Dashboard
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.categories.index')">
                Categories
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item>
                Edit
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <a href="{{route('admin.categories.index') }}" class="btn btn-blue">Go back</a>
    </div>

    <div class="flex flex-col gap-6 h-full max-w-sm mx-auto">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="flex flex-col gap-6 justify-center h-full">
            @csrf
            @method('PUT')

            <flux:input
                label="Name"
                name="name"
                autofocus
                required
                placeholder="Write the category name"
                :value="old('name', $category->name)"
            />

            <div class="flex items-center justify-end">
                <flux:button variant="primary" type="submit" class="w-full">Update</flux:button>
            </div>
        </form>
    </div>
</x-layouts.app>

