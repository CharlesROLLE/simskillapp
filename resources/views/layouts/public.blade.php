<x-layouts::app.header :title="$title ?? null">
    <flux:main class="flex flex-col" style="min-height: calc(100vh - 4rem);">
        <div class="flex-1">
            {{ $slot }}
        </div>

        @include('partials.footer')
    </flux:main>
</x-layouts::app.header>