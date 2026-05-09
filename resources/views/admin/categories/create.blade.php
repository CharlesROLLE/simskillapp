<x-layouts::app :title="__('Create Category')">
    <flux:heading size="xl" level="1">{{ __('Create Category') }}</flux:heading>
    <flux:subheading>{{ __('Add a new category') }}</flux:subheading>

    <form method="POST" action="{{ route('admin.categories.store') }}" class="mt-8 max-w-2xl space-y-6">
        @csrf

        <flux:field>
            <flux:label>{{ __('Name') }}</flux:label>
            <flux:input type="text" name="name" value="{{ old('name') }}" required />
            <flux:error name="name" />
        </flux:field>

        <div class="flex items-center gap-3">
            <flux:button type="submit">{{ __('Create') }}</flux:button>
            <flux:button variant="ghost" :href="route('admin.categories.index')" wire:navigate>{{ __('Cancel') }}</flux:button>
        </div>
    </form>
</x-layouts::app>
