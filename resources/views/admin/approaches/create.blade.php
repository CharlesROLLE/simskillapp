<x-layouts::app :title="__('Create Approach')">
    <flux:heading size="xl" level="1">{{ __('Create Approach') }}</flux:heading>
    <flux:subheading>{{ __('Add a new airport approach') }}</flux:subheading>

    <form method="POST" action="{{ route('admin.approaches.store') }}" class="mt-8 max-w-2xl space-y-6">
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
            <flux:label>{{ __('Extract') }}</flux:label>
            <flux:textarea name="extract" rows="2" required>{{ old('extract') }}</flux:textarea>
            <flux:error name="extract" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Description') }}</flux:label>
            <input type="hidden" name="description" id="description" value="{{ old('description') }}" />
            <trix-editor input="description" class="trix-content"></trix-editor>
            <flux:error name="description" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Image URL') }}</flux:label>
            <flux:input type="text" name="image" value="{{ old('image') }}" placeholder="https://..." required />
            <flux:error name="image" />
        </flux:field>

        <div class="flex items-center gap-3">
            <flux:button type="submit">{{ __('Create') }}</flux:button>
            <flux:button variant="ghost" :href="route('admin.approaches.index')" wire:navigate>{{ __('Cancel') }}</flux:button>
        </div>
    </form>
</x-layouts::app>
