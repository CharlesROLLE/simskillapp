<x-layouts::app :title="__('Edit Chart')">
    <flux:heading size="xl" level="1">{{ __('Edit Chart') }}</flux:heading>
    <flux:subheading>{{ $chart->approach->icao }} - {{ $chart->name }}</flux:subheading>

    <form method="POST" action="{{ route('admin.charts.update', $chart) }}" enctype="multipart/form-data" class="mt-8 max-w-2xl space-y-6">
        @csrf
        @method('PUT')

        <flux:field>
            <flux:label>{{ __('Chart Name') }}</flux:label>
            <flux:input type="text" name="name" value="{{ old('name', $chart->name) }}" required />
            <flux:error name="name" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Chart Image') }}</flux:label>
            @if ($chart->image)
                <div id="current-image" class="mb-3">
                    <img src="{{ $chart->image }}" alt="{{ $chart->name }}" class="w-48 h-32 object-cover rounded-lg border border-zinc-200 dark:border-zinc-700">
                </div>
            @endif
            <div id="image-preview" class="mb-3 hidden">
                <img src="" alt="Preview" class="w-48 h-32 object-cover rounded-lg border border-zinc-200 dark:border-zinc-700" />
            </div>
            <input type="file" name="image" id="image-input" accept="image/jpeg,image/png"
                class="block w-full text-sm text-zinc-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-600 file:text-white hover:file:bg-purple-700 cursor-pointer" />
            <flux:error name="image" />
        </flux:field>

        <div class="flex items-center gap-3">
            <flux:button type="submit">{{ __('Update Chart') }}</flux:button>
            <flux:button variant="ghost" :href="route('admin.approaches.edit', $chart->approach)" wire:navigate>{{ __('Cancel') }}</flux:button>
        </div>
    </form>

    <script>
        document.getElementById('image-input').addEventListener('change', function (e) {
            const current = document.getElementById('current-image');
            const preview = document.getElementById('image-preview');
            const img = preview.querySelector('img');
            const file = e.target.files[0];
            if (file) {
                if (current) current.classList.add('hidden');
                const reader = new FileReader();
                reader.onload = function (event) {
                    img.src = event.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-layouts::app>
