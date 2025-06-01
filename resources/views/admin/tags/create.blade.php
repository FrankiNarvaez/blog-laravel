<x-layouts.app>
    <div class="flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">
                Dashboard
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.tags.index')">
                Tags
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item>
                New
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <a href="{{route('admin.tags.index') }}" class="btn btn-blue">Go back</a>
    </div>

    <div class="flex flex-col gap-6 h-full max-w-sm mx-auto">
        <form action="{{ route('admin.tags.store') }}" method="POST" class="flex flex-col gap-6 justify-center h-full">
            @csrf

            <flux:input
                label="Name"
                name="name"
                autofocus
                required
                placeholder="Write the tag name"
                :value="old('name')"
            />

            <div class="flex items-center justify-end">
                <flux:button variant="primary" type="submit" class="w-full">Create</flux:button>
            </div>
        </form>
    </div>
</x-layouts.app>
