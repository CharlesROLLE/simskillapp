<x-layouts::app :title="__('Edit Tag')">
    <flux:heading size="xl" level="1">{{ __('Edit Tag') }}</flux:heading>
    <flux:subheading>{{ $tag->name }}</flux:subheading>

    <form method="POST" action="{{ route('admin.tags.update', $tag) }}" class="mt-8 max-w-2xl space-y-6">
        @csrf
        @method('PUT')

        <flux:field>
            <flux:label>{{ __('Name') }}</flux:label>
            <flux:input type="text" name="name" value="{{ old('name', $tag->name) }}" required />
            <flux:error name="name" />
        </flux:field>

        <div class="flex items-center gap-3">
            <flux:button type="submit">{{ __('Update') }}</flux:button>
            <flux:button variant="ghost" :href="route('admin.tags.index')" wire:navigate>{{ __('Cancel') }}</flux:button>
        </div>
    </form>

    <form method="POST" action="{{ route('admin.tags.destroy', $tag) }}" class="mt-8 pt-8 border-t border-zinc-200 dark:border-zinc-700" onsubmit="return confirm('{{ __('Delete this tag?') }}')">
        @csrf
        @method('DELETE')
        <flux:button type="submit" variant="danger">{{ __('Delete Tag') }}</flux:button>
    </form>
</x-layouts::app>
