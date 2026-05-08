<x-layouts::app :title="__('Edit User')">
    <flux:heading size="xl" level="1">{{ __('Edit User') }}</flux:heading>
    <flux:subheading>{{ $user->name }}</flux:subheading>

    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="mt-8 max-w-lg space-y-6">
        @csrf
        @method('PUT')

        <flux:field>
            <flux:label>{{ __('Name') }}</flux:label>
            <flux:input type="text" name="name" value="{{ old('name', $user->name) }}" required />
            <flux:error name="name" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Email') }}</flux:label>
            <flux:input type="email" name="email" value="{{ old('email', $user->email) }}" required />
            <flux:error name="email" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('New Password') }} <span class="text-gray-400 text-xs">({{ __('leave blank to keep current') }})</span></flux:label>
            <flux:input type="password" name="password" />
            <flux:error name="password" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Role') }}</flux:label>
            <flux:select name="role" required>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}" @selected(old('role', $user->roles->first()?->name) === $role->name)>{{ $role->name }}</option>
                @endforeach
            </flux:select>
            <flux:error name="role" />
        </flux:field>

        <div class="flex items-center gap-3">
            <flux:button type="submit">{{ __('Update') }}</flux:button>
            <flux:button variant="ghost" :href="route('admin.users.index')" wire:navigate>{{ __('Cancel') }}</flux:button>
        </div>
    </form>

    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="mt-8 pt-8 border-t border-zinc-200 dark:border-zinc-700" onsubmit="return confirm('{{ __('Delete this user?') }}')">
        @csrf
        @method('DELETE')
        <flux:button type="submit" variant="danger">{{ __('Delete User') }}</flux:button>
    </form>
</x-layouts::app>
