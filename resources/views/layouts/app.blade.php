<x-layouts::app.sidebar :title="$title ?? null">
    <flux:main class="flex flex-col h-full">
        <div class="flex-1">
            {{ $slot }}
        </div>

        @include('partials.footer')
    </flux:main>
</x-layouts::app.sidebar>
