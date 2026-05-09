<x-layouts::app :title="__('Add Chart')">
    <flux:heading size="xl" level="1">{{ __('Add Chart') }}</flux:heading>
    <flux:subheading>{{ $approach->icao }} - {{ $approach->name }}</flux:subheading>

    <form method="POST" action="{{ route('admin.approaches.charts.store', $approach) }}" enctype="multipart/form-data" class="mt-8 max-w-2xl space-y-6">
        @csrf

        <flux:field>
            <flux:label>{{ __('Chart Name') }}</flux:label>
            <flux:input type="text" name="name" value="{{ old('name') }}" required />
            <flux:error name="name" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Chart Image') }}</flux:label>
            <input type="file" name="image" id="image-input" accept="image/jpeg,image/png" required
                class="block w-full text-sm text-zinc-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-600 file:text-white hover:file:bg-purple-700 cursor-pointer" />
            <div id="image-preview" class="mt-3 hidden">
                <img src="" alt="Preview" class="w-48 h-32 object-cover rounded-lg border border-zinc-200 dark:border-zinc-700" />
            </div>
            <flux:error name="image" />
        </flux:field>

        <div class="flex items-center gap-3">
            <flux:button type="submit">{{ __('Add Chart') }}</flux:button>
            <flux:button variant="ghost" :href="route('admin.approaches.edit', $approach)" wire:navigate>{{ __('Cancel') }}</flux:button>
        </div>
    </form>

    <script>
        document.getElementById('image-input').addEventListener('change', function (e) {
            const preview = document.getElementById('image-preview');
            const img = preview.querySelector('img');
            const file = e.target.files[0];
            if (file) {
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
