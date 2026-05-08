<x-layouts::app :title="__('Admin Dashboard')">
    <flux:heading size="xl" level="1">{{ __('Admin Dashboard') }}</flux:heading>
    <flux:subheading>{{ __('Overview of your platform') }}</flux:subheading>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-8">
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-zinc-200 dark:border-zinc-700 p-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-indigo-100 dark:bg-indigo-900/40 flex items-center justify-center">
                    <flux:icon.users class="w-6 h-6 text-indigo-600" />
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['users'] }}</p>
                    <p class="text-sm text-gray-500">{{ __('Users') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-zinc-200 dark:border-zinc-700 p-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-emerald-100 dark:bg-emerald-900/40 flex items-center justify-center">
                    <flux:icon.paper-airplane class="w-6 h-6 text-emerald-600" />
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['approaches'] }}</p>
                    <p class="text-sm text-gray-500">{{ __('Approaches') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-zinc-200 dark:border-zinc-700 p-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-amber-100 dark:bg-amber-900/40 flex items-center justify-center">
                    <flux:icon.book-open class="w-6 h-6 text-amber-600" />
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['posts'] }}</p>
                    <p class="text-sm text-gray-500">{{ __('Posts') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-zinc-200 dark:border-zinc-700 p-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-rose-100 dark:bg-rose-900/40 flex items-center justify-center">
                    <flux:icon.wrench-screwdriver class="w-6 h-6 text-rose-600" />
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['vrtools'] }}</p>
                    <p class="text-sm text-gray-500">{{ __('VR Tools') }}</p>
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>
