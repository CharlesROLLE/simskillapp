<x-layouts::app :title="__('Create Tag')">
    <flux:heading size="xl" level="1">{{ __('Create Tag') }}</flux:heading>
    <flux:subheading>{{ __('Add a new tag') }}</flux:subheading>

    <form method="POST" action="{{ route('admin.tags.store') }}" class="mt-8 max-w-2xl space-y-6">
        @csrf

        <flux:field>
            <flux:label>{{ __('Name') }}</flux:label>
            <flux:input type="text" name="name" value="{{ old('name') }}" required />
            <flux:error name="name" />
        </flux:field>

        <div class="flex items-center gap-3">
            <flux:button type="submit">{{ __('Create') }}</flux:button>
            <flux:button variant="ghost" :href="route('admin.tags.index')" wire:navigate>{{ __('Cancel') }}</flux:button>
        </div>
    </form>
</x-layouts::app>
