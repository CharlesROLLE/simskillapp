<x-layouts::app :title="__('Edit Post')">
    <flux:heading size="xl" level="1">{{ __('Edit Post') }}</flux:heading>
    <flux:subheading>{{ $post->title }}</flux:subheading>

    <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data" class="mt-8 max-w-2xl space-y-6">
        @csrf
        @method('PUT')

        <flux:field>
            <flux:label>{{ __('Title') }}</flux:label>
            <flux:input type="text" name="title" value="{{ old('title', $post->title) }}" required />
            <flux:error name="title" />
        </flux:field>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <flux:field>
                <flux:label>{{ __('Category') }}</flux:label>
                <flux:select name="category_id" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id) === $category->id)>{{ $category->name }}</option>
                    @endforeach
                </flux:select>
                <flux:error name="category_id" />
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Published At') }}</flux:label>
                <flux:input type="datetime-local" name="published_at" value="{{ old('published_at', $post->published_at?->format('Y-m-d\TH:i')) }}" />
                <flux:error name="published_at" />
            </flux:field>
        </div>

        <flux:field>
            <flux:label>{{ __('Body') }}</flux:label>
            <input type="hidden" name="body" id="body" value="{{ old('body', $post->body) }}" />
            <trix-editor input="body" class="trix-content"></trix-editor>
            <flux:error name="body" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Image') }}</flux:label>
            <div id="current-image" class="mb-3 {{ $post->image ? '' : 'hidden' }}">
                <img src="{{ $post->image ?? '' }}" alt="{{ $post->title }}" class="w-48 h-32 object-cover rounded-lg border border-zinc-200 dark:border-zinc-700">
            </div>
            <div id="image-preview" class="mb-3 hidden">
                <img src="" alt="Preview" class="w-48 h-32 object-cover rounded-lg border border-zinc-200 dark:border-zinc-700" />
            </div>
            <input type="file" name="image" id="image-input" accept="image/jpeg,image/png"
                class="block w-full text-sm text-zinc-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-600 file:text-white hover:file:bg-purple-700 cursor-pointer" />
            <flux:error name="image" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Tags') }}</flux:label>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 mt-1">
                @foreach ($tags as $tag)
                    <label class="flex items-center gap-2 text-sm">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" @checked(in_array($tag->id, old('tags', $post->tags->pluck('id')->all()))) />
                        {{ $tag->name }}
                    </label>
                @endforeach
            </div>
            <flux:error name="tags" />
        </flux:field>

        <div class="flex items-center gap-3">
            <flux:button type="submit">{{ __('Update') }}</flux:button>
            <flux:button variant="ghost" :href="route('admin.posts.index')" wire:navigate>{{ __('Cancel') }}</flux:button>
        </div>
    </form>

    <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" class="mt-8 pt-8 border-t border-zinc-200 dark:border-zinc-700" onsubmit="return confirm('{{ __('Delete this post?') }}')">
        @csrf
        @method('DELETE')
        <flux:button type="submit" variant="danger">{{ __('Delete Post') }}</flux:button>
    </form>

    <script>
        document.getElementById('image-input').addEventListener('change', function (e) {
            const current = document.getElementById('current-image');
            const preview = document.getElementById('image-preview');
            const img = preview.querySelector('img');
            const file = e.target.files[0];
            if (file) {
                current.classList.add('hidden');
                const reader = new FileReader();
                reader.onload = function (event) {
                    img.src = event.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-layouts::app>
