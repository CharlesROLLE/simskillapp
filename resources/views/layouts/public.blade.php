<x-layouts::app.header :title="$title ?? null">
    <flux:main class="flex-1">
        {{ $slot }}
    </flux:main>
</x-layouts::app.header>