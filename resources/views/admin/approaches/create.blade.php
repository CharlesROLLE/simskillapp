<x-layouts::app :title="__('Create Approach')">
    <flux:heading size="xl" level="1">{{ __('Create Approach') }}</flux:heading>
    <flux:subheading>{{ __('Add a new airport approach') }}</flux:subheading>

    <form method="POST" action="{{ route('admin.approaches.store') }}" enctype="multipart/form-data" class="mt-8 max-w-2xl space-y-6">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <flux:field>
                <flux:label>{{ __('ICAO') }}</flux:label>
                <flux:input type="text" name="icao" value="{{ old('icao') }}" maxlength="4" class="uppercase font-mono" required />
                <flux:error name="icao" />
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Name') }}</flux:label>
                <flux:input type="text" name="name" value="{{ old('name') }}" required />
                <flux:error name="name" />
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Country') }}</flux:label>
                <flux:input type="text" name="country" value="{{ old('country') }}" required />
                <flux:error name="country" />
            </flux:field>

            <flux:field>
                <flux:label>{{ __('City') }}</flux:label>
                <flux:input type="text" name="city" value="{{ old('city') }}" required />
                <flux:error name="city" />
            </flux:field>
        </div>

        <flux:field>
            <flux:label>{{ __('Description') }}</flux:label>
            <input type="hidden" name="description" id="description" value="{{ old('description') }}" />
            <trix-editor input="description" class="trix-content"></trix-editor>
            <flux:error name="description" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Extract') }}</flux:label>
            <flux:textarea name="extract" id="extract" rows="2" required>{{ old('extract') }}</flux:textarea>
            <flux:error name="extract" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Image') }}</flux:label>
            <input type="file" name="image" id="image-input" accept="image/jpeg,image/png" required
                class="block w-full text-sm text-zinc-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-600 file:text-white hover:file:bg-purple-700 cursor-pointer" />
            <div id="image-preview" class="mt-3 hidden">
                <img src="" alt="Preview" class="w-48 h-32 object-cover rounded-lg border border-zinc-200 dark:border-zinc-700" />
            </div>
            <flux:error name="image" />
        </flux:field>

        <div class="flex items-center gap-3">
            <flux:button type="submit">{{ __('Create') }}</flux:button>
            <flux:button variant="ghost" :href="route('admin.approaches.index')" wire:navigate>{{ __('Cancel') }}</flux:button>
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

        document.getElementById('extract').addEventListener('focus', function () {
            if (this.value.trim() !== '') return;

            const desc = document.getElementById('description').value;
            const text = new DOMParser().parseFromString(desc, 'text/html').body.textContent || '';
            this.value = text.substring(0, 500);
        });
    </script>
</x-layouts::app>
