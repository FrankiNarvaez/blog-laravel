<x-layouts.public>
    <section class="space-y-4 mx-[17%]">
        @foreach ($posts as $post)
            <a href="{{ route('posts.show', $post) }}" class="relative flex items-center bg-white border border-gray-200 rounded-lg shadow-sm md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                <span class="absolute bg-gray-400/70 rounded-lg right-3 top-3 px-3 py-1 text-white">{{ $post->published_at }}</span>
                <img class="object-cover w-full rounded-t-lg h-96 max-w-sm md:h-auto md:rounded-none md:rounded-s-lg" src="{{ $post->image }}" alt="">
                <div class="flex flex-col justify-between p-4 leading-normal">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $post->title }}</h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $post->excerpt }}</p>
                    <div class="gap-2">
                        @foreach ($post->tags as $tag)
                            <span class="bg-gray-400/60 text-sm text-white rounded-lg px-2 py-1">#{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </div>
            </a>
        @endforeach
    </section>

    <div>
        {{ $posts->links() }}
    </div>
</x-layouts.public>

