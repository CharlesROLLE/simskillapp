<x-layouts::app :title="__('Manage Users')">
    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl" level="1">{{ __('Users') }}</flux:heading>
            <flux:subheading>{{ __('Manage user accounts and roles') }}</flux:subheading>
        </div>
        <flux:button :href="route('admin.users.create')" wire:navigate>
            {{ __('New User') }}
        </flux:button>
    </div>

    @if (session('success'))
        <flux:callout color="emerald" icon="check-circle" class="mt-6">{{ session('success') }}</flux:callout>
    @endif

    <div class="mt-8 overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-zinc-200 dark:border-zinc-700 text-left">
                    <th class="py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">{{ __('Name') }}</th>
                    <th class="py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">{{ __('Email') }}</th>
                    <th class="py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">{{ __('Role') }}</th>
                    <th class="py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">{{ __('Joined') }}</th>
                    <th class="py-3 px-4"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr class="border-b border-zinc-100 dark:border-zinc-800 hover:bg-zinc-50 dark:hover:bg-zinc-800/50">
                        <td class="py-3 px-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-indigo-600 flex items-center justify-center text-white text-xs font-bold">
                                    {{ $user->initials() }}
                                </div>
                                <span class="font-medium">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="py-3 px-4 text-gray-500">{{ $user->email }}</td>
                        <td class="py-3 px-4">
                            @foreach ($user->roles as $role)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 dark:bg-indigo-900/40 text-indigo-700 dark:text-indigo-300">
                                    {{ $role->name }}
                                </span>
                            @endforeach
                        </td>
                        <td class="py-3 px-4 text-gray-500">{{ $user->created_at->diffForHumans() }}</td>
                        <td class="py-3 px-4 text-right">
                            <flux:button size="sm" variant="ghost" :href="route('admin.users.edit', $user)" wire:navigate>
                                {{ __('Edit') }}
                            </flux:button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center text-gray-400">{{ __('No users found.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>
</x-layouts::app>
