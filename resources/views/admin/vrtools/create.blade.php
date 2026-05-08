<x-layouts::app :title="__('Create VR Tool')">
    <flux:heading size="xl" level="1">{{ __('Create VR Tool') }}</flux:heading>
    <flux:subheading>{{ __('Write a new VR article or guide') }}</flux:subheading>

    <form method="POST" action="{{ route('admin.vrtools.store') }}" class="mt-8 max-w-2xl space-y-6">
        @csrf

        <flux:field>
            <flux:label>{{ __('Title') }}</flux:label>
            <flux:input type="text" name="title" value="{{ old('title') }}" required />
            <flux:error name="title" />
        </flux:field>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <flux:field>
                <flux:label>{{ __('Category') }}</flux:label>
                <flux:select name="category_id" required>
                    <option value="">-- {{ __('Select Category') }} --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id') === $category->id)>{{ $category->name }}</option>
                    @endforeach
                </flux:select>
                <flux:error name="category_id" />
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Published At') }}</flux:label>
                <flux:input type="datetime-local" name="published_at" value="{{ old('published_at') }}" />
                <flux:error name="published_at" />
            </flux:field>
        </div>

        <flux:field>
            <flux:label>{{ __('Body') }}</flux:label>
            <input type="hidden" name="body" id="body" value="{{ old('body') }}" />
            <trix-editor input="body" class="trix-content"></trix-editor>
            <flux:error name="body" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Image URL') }}</flux:label>
            <flux:input type="text" name="image" value="{{ old('image') }}" placeholder="https://..." required />
            <flux:error name="image" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Tags') }}</flux:label>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 mt-1">
                @foreach ($tags as $tag)
                    <label class="flex items-center gap-2 text-sm">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" @checked(in_array($tag->id, old('tags', []))) />
                        {{ $tag->name }}
                    </label>
                @endforeach
            </div>
            <flux:error name="tags" />
        </flux:field>

        <div class="flex items-center gap-3">
            <flux:button type="submit">{{ __('Create') }}</flux:button>
            <flux:button variant="ghost" :href="route('admin.vrtools.index')" wire:navigate>{{ __('Cancel') }}</flux:button>
        </div>
    </form>
</x-layouts::app>
