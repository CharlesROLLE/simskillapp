<x-layouts::app :title="__('Edit VR Tool')">
    <flux:heading size="xl" level="1">{{ __('Edit VR Tool') }}</flux:heading>
    <flux:subheading>{{ $vrtool->title }}</flux:subheading>

    <form method="POST" action="{{ route('admin.vrtools.update', $vrtool) }}" class="mt-8 max-w-2xl space-y-6">
        @csrf
        @method('PUT')

        <flux:field>
            <flux:label>{{ __('Title') }}</flux:label>
            <flux:input type="text" name="title" value="{{ old('title', $vrtool->title) }}" required />
            <flux:error name="title" />
        </flux:field>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <flux:field>
                <flux:label>{{ __('Category') }}</flux:label>
                <flux:select name="category_id" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $vrtool->category_id) === $category->id)>{{ $category->name }}</option>
                    @endforeach
                </flux:select>
                <flux:error name="category_id" />
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Published At') }}</flux:label>
                <flux:input type="datetime-local" name="published_at" value="{{ old('published_at', $vrtool->published_at?->format('Y-m-d\TH:i')) }}" />
                <flux:error name="published_at" />
            </flux:field>
        </div>

        <flux:field>
            <flux:label>{{ __('Body') }}</flux:label>
            <input type="hidden" name="body" id="body" value="{{ old('body', $vrtool->body) }}" />
            <trix-editor input="body" class="trix-content"></trix-editor>
            <flux:error name="body" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Image URL') }}</flux:label>
            <flux:input type="text" name="image" value="{{ old('image', $vrtool->image) }}" placeholder="https://..." required />
            <flux:error name="image" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Tags') }}</flux:label>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 mt-1">
                @foreach ($tags as $tag)
                    <label class="flex items-center gap-2 text-sm">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" @checked(in_array($tag->id, old('tags', $vrtool->tags->pluck('id')->all()))) />
                        {{ $tag->name }}
                    </label>
                @endforeach
            </div>
            <flux:error name="tags" />
        </flux:field>

        <div class="flex items-center gap-3">
            <flux:button type="submit">{{ __('Update') }}</flux:button>
            <flux:button variant="ghost" :href="route('admin.vrtools.index')" wire:navigate>{{ __('Cancel') }}</flux:button>
        </div>
    </form>

    <form method="POST" action="{{ route('admin.vrtools.destroy', $vrtool) }}" class="mt-8 pt-8 border-t border-zinc-200 dark:border-zinc-700" onsubmit="return confirm('{{ __('Delete this VR tool?') }}')">
        @csrf
        @method('DELETE')
        <flux:button type="submit" variant="danger">{{ __('Delete VR Tool') }}</flux:button>
    </form>
</x-layouts::app>
