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

    <div class="flex flex-col gap-6 h-full max-w-sm mx-auto">
        <form action="{{ route('admin.posts.update', $post) }}" method="POST" class="flex flex-col gap-6 justify-center h-full">
            @csrf
            @method('PUT')

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

            <flux:field variant="inline">
                <flux:checkbox name="is_published" :checked="old('is_published', $post->is_published) == 1" />

                <flux:label>Is published the posts?</flux:label>

                <flux:error name="terms" />
            </flux:field>

            <flux:select label="Category" name="category_id" placeholder="Choose category...">
                @foreach ($categories as $category)
                    <flux:select.option :value="$category->id" :selected="$category->id == old('category_id', $post->category_id)">{{ $category->name }}</flux:select.option>
                @endforeach
            </flux:select>

            <div class="flex items-center justify-end">
                <flux:button variant="primary" type="submit" class="w-full">Create</flux:button>
            </div>
        </form>
    </div>

    @push('js')
        <script>
            function string_to_slug(str, querySelector){
                // Eliminar espacios al inicio y final
                str = str.replace(/^\s+|\s+$/g, '');

                // Convertir todo a minúsculas
                str = str.toLowerCase();

                // Definir caracteres especiales y sus reemplazos
                var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
                var to = "aaaaeeeeiiiioooouuuunc------";

                // Reemplazar caracteres especiales por los correspondientes en 'to'
                for (var i = 0, l = from.length; i < l; i++) {
                    str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
                }

                // Eliminar caracteres no alfanuméricos y reemplazar espacios por guiones
                str = str.replace(/[^a-z0-9 -]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');

                // Asignar el slug generado al campo de entrada correspondiente
                document.querySelector(querySelector).value = str;
            }
        </script>
    @endpush
</x-layouts.app>


