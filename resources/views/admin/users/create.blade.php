<x-layouts::app :title="__('Create User')">
    <flux:heading size="xl" level="1">{{ __('Create User') }}</flux:heading>
    <flux:subheading>{{ __('Add a new user account') }}</flux:subheading>

    <form method="POST" action="{{ route('admin.users.store') }}" class="mt-8 max-w-lg space-y-6">
        @csrf

        <flux:field>
            <flux:label>{{ __('Name') }}</flux:label>
            <flux:input type="text" name="name" value="{{ old('name') }}" required />
            <flux:error name="name" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Email') }}</flux:label>
            <flux:input type="email" name="email" value="{{ old('email') }}" required />
            <flux:error name="email" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Password') }}</flux:label>
            <flux:input type="password" name="password" required />
            <flux:error name="password" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Role') }}</flux:label>
            <flux:select name="role" required>
                <option value="">-- {{ __('Select Role') }} --</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}" @selected(old('role') === $role->name)>{{ $role->name }}</option>
                @endforeach
            </flux:select>
            <flux:error name="role" />
        </flux:field>

        <div class="flex items-center gap-3">
            <flux:button type="submit">{{ __('Create') }}</flux:button>
            <flux:button variant="ghost" :href="route('admin.users.index')" wire:navigate>{{ __('Cancel') }}</flux:button>
        </div>
    </form>
</x-layouts::app>
