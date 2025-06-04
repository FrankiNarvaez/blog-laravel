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
                Show
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <a href="{{route('admin.posts.index') }}" class="btn btn-blue">Go back</a>
    </div>

    <section class="space-y-4 mx-[17%]">
        <img class="object-cover aspect-video w-full rounded-t-lg h-96 md:h-auto md:rounded-none md:rounded-s-lg" src="{{ $post->image }}" alt="">
        <div class="flex justify-between">
            <span class="bg-gray-400/70 rounded-lg right-3 top-3 px-3 py-1 text-white">{{ $post->published_at }}</span>
            <div class="gap-2">
                @foreach ($post->tags as $tag)
                    <span class="bg-gray-400/60 text-sm text-white rounded-lg px-2 py-1">#{{ $tag->name }}</span>
                @endforeach
            </div>
        </div>
        <div class="flex flex-col justify-between p-4 leading-normal">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $post->title }}</h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{!! $post->content !!}</p>
        </div>
    </section>
</x-layouts.app>


