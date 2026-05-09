<x-layouts::app :title="__('Manage Categories')">
    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl" level="1">{{ __('Categories') }}</flux:heading>
            <flux:subheading>{{ __('Manage post and VR tool categories') }}</flux:subheading>
        </div>
        <flux:button :href="route('admin.categories.create')" wire:navigate>
            {{ __('New Category') }}
        </flux:button>
    </div>

    @if (session('success'))
        <flux:callout color="emerald" icon="check-circle" class="mt-6">{{ session('success') }}</flux:callout>
    @endif

    <div class="mt-8 overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-zinc-200 dark:border-zinc-700 text-left">
                    <th class="py-3 px-4 font-semibold">{{ __('Name') }}</th>
                    <th class="py-3 px-4 font-semibold">{{ __('Slug') }}</th>
                    <th class="py-3 px-4"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr class="border-b border-zinc-100 dark:border-zinc-800 hover:bg-zinc-50 dark:hover:bg-zinc-800/50">
                        <td class="py-3 px-4 font-medium">{{ $category->name }}</td>
                        <td class="py-3 px-4 text-gray-500">{{ $category->slug }}</td>
                        <td class="py-3 px-4 text-right space-x-2">
                            <flux:button size="sm" variant="ghost" :href="route('admin.categories.edit', $category)" wire:navigate>
                                {{ __('Edit') }}
                            </flux:button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-12 text-center text-gray-400">{{ __('No categories found.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $categories->links() }}
    </div>
</x-layouts::app>
