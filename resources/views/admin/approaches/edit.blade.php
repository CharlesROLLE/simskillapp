<x-layouts::app :title="__('Edit Approach')">
    <flux:heading size="xl" level="1">{{ __('Edit Approach') }}</flux:heading>
    <flux:subheading>{{ $approach->icao }} - {{ $approach->name }}</flux:subheading>

    <form method="POST" action="{{ route('admin.approaches.update', $approach) }}" enctype="multipart/form-data" class="mt-8 max-w-2xl space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <flux:field>
                <flux:label>{{ __('ICAO') }}</flux:label>
                <flux:input type="text" name="icao" value="{{ old('icao', $approach->icao) }}" maxlength="4" class="uppercase font-mono" required />
                <flux:error name="icao" />
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Name') }}</flux:label>
                <flux:input type="text" name="name" value="{{ old('name', $approach->name) }}" required />
                <flux:error name="name" />
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Country') }}</flux:label>
                <flux:input type="text" name="country" value="{{ old('country', $approach->country) }}" required />
                <flux:error name="country" />
            </flux:field>

            <flux:field>
                <flux:label>{{ __('City') }}</flux:label>
                <flux:input type="text" name="city" value="{{ old('city', $approach->city) }}" required />
                <flux:error name="city" />
            </flux:field>
        </div>

        <flux:field>
            <flux:label>{{ __('Description') }}</flux:label>
            <input type="hidden" name="description" id="description" value="{{ old('description', $approach->description) }}" />
            <trix-editor input="description" class="trix-content"></trix-editor>
            <flux:error name="description" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Extract') }}</flux:label>
            <flux:textarea name="extract" id="extract" rows="2" required>{{ old('extract', $approach->extract) }}</flux:textarea>
            <flux:error name="extract" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Image') }}</flux:label>
            <div id="current-image" class="mb-3 {{ $approach->image ? '' : 'hidden' }}">
                <img src="{{ $approach->image ?? '' }}" alt="{{ $approach->name }}" id="current-image-src" class="w-48 h-32 object-cover rounded-lg border border-zinc-200 dark:border-zinc-700">
            </div>
            <div id="image-preview" class="mb-3 hidden">
                <img src="" alt="Preview" class="w-48 h-32 object-cover rounded-lg border border-zinc-200 dark:border-zinc-700" />
            </div>
            <input type="file" name="image" id="image-input" accept="image/jpeg,image/png"
                class="block w-full text-sm text-zinc-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-600 file:text-white hover:file:bg-purple-700 cursor-pointer" />
            <flux:error name="image" />
        </flux:field>

        <div class="flex items-center gap-3">
            <flux:button type="submit">{{ __('Update') }}</flux:button>
            <flux:button variant="ghost" :href="route('admin.approaches.index')" wire:navigate>{{ __('Cancel') }}</flux:button>
        </div>
    </form>

    <div class="mt-8 pt-8 border-t border-zinc-200 dark:border-zinc-700">
        <div class="flex items-center justify-between mb-4">
            <flux:heading size="lg">{{ __('Charts') }}</flux:heading>
            <flux:button :href="route('admin.approaches.charts.create', $approach)" wire:navigate>
                {{ __('Add Chart') }}
            </flux:button>
        </div>

        @if ($approach->charts->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach ($approach->charts as $chart)
                    <div class="flex items-center justify-between p-4 rounded-lg border border-zinc-200 dark:border-zinc-700">
                        <div class="flex items-center gap-3 min-w-0">
                            @if ($chart->image)
                                <img src="{{ $chart->image }}" alt="{{ $chart->name }}" class="w-12 h-12 rounded object-cover shrink-0">
                            @endif
                            <span class="font-medium truncate">{{ $chart->name }}</span>
                        </div>
                        <div class="flex items-center gap-1 shrink-0">
                            <flux:button variant="ghost" size="sm" :href="route('admin.charts.edit', $chart)" wire:navigate>
                                {{ __('Edit') }}
                            </flux:button>
                            <form method="POST" action="{{ route('admin.charts.destroy', $chart) }}" onsubmit="return confirm('{{ __('Delete this chart?') }}')">
                                @csrf
                                @method('DELETE')
                                <flux:button type="submit" variant="danger" size="sm">{{ __('Delete') }}</flux:button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-sm">{{ __('No charts yet.') }}</p>
        @endif
    </div>

    <form method="POST" action="{{ route('admin.approaches.destroy', $approach) }}" class="mt-8 pt-8 border-t border-zinc-200 dark:border-zinc-700" onsubmit="return confirm('{{ __('Delete this approach?') }}')">
        @csrf
        @method('DELETE')
        <flux:button type="submit" variant="danger">{{ __('Delete Approach') }}</flux:button>
    </form>

    <script>
        document.getElementById('image-input').addEventListener('change', function (e) {
            const current = document.getElementById('current-image');
            const preview = document.getElementById('image-preview');
            const img = preview.querySelector('img');
            const file = e.target.files[0];

            if (file) {
                current.classList.add('hidden');
                const reader = new FileReader();
                reader.onload = function (event) {
                    img.src = event.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('extract').addEventListener('focus', function () {
            if (this.value.trim() !== '') return;

            const desc = document.getElementById('description').value;
            const text = new DOMParser().parseFromString(desc, 'text/html').body.textContent || '';
            this.value = text.substring(0, 500);
        });
    </script>
</x-layouts::app>
