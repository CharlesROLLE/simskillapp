<x-layouts::app :title="__('Manage Approaches')">
    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl" level="1">{{ __('Approaches') }}</flux:heading>
            <flux:subheading>{{ __('Manage approach charts and descriptions') }}</flux:subheading>
        </div>
        <flux:button :href="route('admin.approaches.create')" wire:navigate>
            {{ __('New Approach') }}
        </flux:button>
    </div>

    @if (session('success'))
        <flux:callout color="emerald" icon="check-circle" class="mt-6">{{ session('success') }}</flux:callout>
    @endif

    <div class="mt-8 overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-zinc-200 dark:border-zinc-700 text-left">
                    <th class="py-3 px-4 font-semibold">{{ __('ICAO') }}</th>
                    <th class="py-3 px-4 font-semibold">{{ __('Name') }}</th>
                    <th class="py-3 px-4 font-semibold">{{ __('Country') }}</th>
                    <th class="py-3 px-4 font-semibold">{{ __('City') }}</th>
                    <th class="py-3 px-4"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($approaches as $approach)
                    <tr class="border-b border-zinc-100 dark:border-zinc-800 hover:bg-zinc-50 dark:hover:bg-zinc-800/50">
                        <td class="py-3 px-4 font-mono font-bold">{{ $approach->icao }}</td>
                        <td class="py-3 px-4">{{ $approach->name }}</td>
                        <td class="py-3 px-4 text-gray-500">{{ $approach->country }}</td>
                        <td class="py-3 px-4 text-gray-500">{{ $approach->city }}</td>
                        <td class="py-3 px-4 text-right space-x-2">
                            <flux:button size="sm" variant="ghost" :href="route('admin.approaches.edit', $approach)" wire:navigate>
                                {{ __('Edit') }}
                            </flux:button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center text-gray-400">{{ __('No approaches found.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $approaches->links() }}
    </div>
</x-layouts::app>
