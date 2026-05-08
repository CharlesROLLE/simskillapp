<x-layouts::app :title="__('Manage VR Tools')">
    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl" level="1">{{ __('VR Tools') }}</flux:heading>
            <flux:subheading>{{ __('Manage VR articles and guides') }}</flux:subheading>
        </div>
        <flux:button :href="route('admin.vrtools.create')" wire:navigate>
            {{ __('New VR Tool') }}
        </flux:button>
    </div>

    @if (session('success'))
        <flux:callout color="emerald" icon="check-circle" class="mt-6">{{ session('success') }}</flux:callout>
    @endif

    <div class="mt-8 overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-zinc-200 dark:border-zinc-700 text-left">
                    <th class="py-3 px-4 font-semibold">{{ __('Title') }}</th>
                    <th class="py-3 px-4 font-semibold">{{ __('Category') }}</th>
                    <th class="py-3 px-4 font-semibold">{{ __('Author') }}</th>
                    <th class="py-3 px-4 font-semibold">{{ __('Published') }}</th>
                    <th class="py-3 px-4"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($vrtools as $vrtool)
                    <tr class="border-b border-zinc-100 dark:border-zinc-800 hover:bg-zinc-50 dark:hover:bg-zinc-800/50">
                        <td class="py-3 px-4 max-w-xs truncate font-medium">{{ $vrtool->title }}</td>
                        <td class="py-3 px-4 text-gray-500">{{ $vrtool->category?->name }}</td>
                        <td class="py-3 px-4 text-gray-500">{{ $vrtool->user?->name }}</td>
                        <td class="py-3 px-4 text-gray-500">{{ $vrtool->published_at?->diffForHumans() ?? __('Unpublished') }}</td>
                        <td class="py-3 px-4 text-right">
                            <flux:button size="sm" variant="ghost" :href="route('admin.vrtools.edit', $vrtool)" wire:navigate>
                                {{ __('Edit') }}
                            </flux:button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center text-gray-400">{{ __('No VR tools found.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $vrtools->links() }}
    </div>
</x-layouts::app>
