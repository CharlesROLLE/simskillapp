<x-layouts::app :title="__('Edit Approach')">
    <flux:heading size="xl" level="1">{{ __('Edit Approach') }}</flux:heading>
    <flux:subheading>{{ $approach->icao }} - {{ $approach->name }}</flux:subheading>

    <form method="POST" action="{{ route('admin.approaches.update', $approach) }}" class="mt-8 max-w-2xl space-y-6">
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
            <flux:label>{{ __('Extract') }}</flux:label>
            <flux:textarea name="extract" rows="2" required>{{ old('extract', $approach->extract) }}</flux:textarea>
            <flux:error name="extract" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Description') }}</flux:label>
            <input type="hidden" name="description" id="description" value="{{ old('description', $approach->description) }}" />
            <trix-editor input="description" class="trix-content"></trix-editor>
            <flux:error name="description" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Image URL') }}</flux:label>
            <flux:input type="text" name="image" value="{{ old('image', $approach->image) }}" placeholder="https://..." required />
            <flux:error name="image" />
        </flux:field>

        <div class="flex items-center gap-3">
            <flux:button type="submit">{{ __('Update') }}</flux:button>
            <flux:button variant="ghost" :href="route('admin.approaches.index')" wire:navigate>{{ __('Cancel') }}</flux:button>
        </div>
    </form>

    <form method="POST" action="{{ route('admin.approaches.destroy', $approach) }}" class="mt-8 pt-8 border-t border-zinc-200 dark:border-zinc-700" onsubmit="return confirm('{{ __('Delete this approach?') }}')">
        @csrf
        @method('DELETE')
        <flux:button type="submit" variant="danger">{{ __('Delete Approach') }}</flux:button>
    </form>
</x-layouts::app>
