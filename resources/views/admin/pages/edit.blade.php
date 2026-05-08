<x-layouts::app :title="__('Edit :name', ['name' => $page->title])">
    <flux:heading size="xl" level="1">{{ __('Edit :name', ['name' => $page->title]) }}</flux:heading>
    <flux:subheading>{{ __('Update the content of this page') }}</flux:subheading>

    @if (session('success'))
        <flux:callout color="emerald" icon="check-circle" class="mt-6">{{ session('success') }}</flux:callout>
    @endif

    <form method="POST" action="{{ route('admin.pages.update', $page->slug) }}" class="mt-8 max-w-2xl space-y-6">
        @csrf
        @method('PUT')

        <flux:field>
            <flux:label>{{ __('Title') }}</flux:label>
            <flux:input type="text" name="title" value="{{ old('title', $page->title) }}" required />
            <flux:error name="title" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Body') }}</flux:label>
            <input type="hidden" name="body" id="body" value="{{ old('body', $page->body) }}" />
            <trix-editor input="body" class="trix-content"></trix-editor>
            <flux:error name="body" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Image URL') }}</flux:label>
            <flux:input type="text" name="image" value="{{ old('image', $page->image) }}" placeholder="https://..." required />
            <flux:error name="image" />
        </flux:field>

        <div class="flex items-center gap-3">
            <flux:button type="submit">{{ __('Update') }}</flux:button>
        </div>
    </form>
</x-layouts::app>
