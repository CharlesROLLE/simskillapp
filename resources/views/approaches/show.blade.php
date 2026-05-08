<x-layouts::public :title="__($approach->icao)">
    <div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16">

        <a href="{{ route('approaches.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium inline-flex items-center gap-1 mb-6">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            {{ __('Back to Approaches') }}
        </a>

        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg overflow-hidden">
            <div class="relative">
                <img class="w-full h-72 md:h-96 object-cover"
                    src="{{ $approach->image }}"
                    alt="{{ $approach->icao }}">
                <div class="absolute top-4 right-4 bg-indigo-600 px-4 py-2 text-white text-sm font-bold rounded-lg">
                    {{ $approach->icao }}
                </div>
            </div>

            <div class="p-6 md:p-10">
                <div class="flex flex-wrap items-center gap-3 mb-4">
                    <h1 class="text-3xl md:text-4xl font-bold">{{ $approach->name }}</h1>
                    <span class="text-gray-400 text-lg">|</span>
                    <span class="text-gray-500 text-lg">{{ $approach->city }}, {{ $approach->country }}</span>
                </div>

                <p class="text-gray-600 dark:text-gray-300 text-lg leading-relaxed mb-8">
                    {{ $approach->description }}
                </p>

                @if ($approach->charts->isNotEmpty())
                    <div class="border-t pt-8">
                        <h2 class="text-2xl font-bold mb-6">{{ __('Charts') }}</h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach ($approach->charts as $chart)
                                <div>
                                    <flux:modal.trigger name="chart-{{ $chart->id }}">
                                        <button
                                            x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'chart-{{ $chart->id }}')"
                                            class="flex items-center gap-3 p-4 rounded-lg border border-gray-200 dark:border-zinc-600 hover:border-indigo-400 hover:bg-indigo-50 dark:hover:bg-zinc-700 transition-colors text-left w-full"
                                        >
                                            <svg class="w-8 h-8 text-indigo-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                                            </svg>
                                            <span class="font-medium">{{ $chart->name }}</span>
                                        </button>
                                    </flux:modal.trigger>
                                </div>
                            @endforeach
                        </div>

                        @foreach ($approach->charts as $chart)
                            <flux:modal name="chart-{{ $chart->id }}" class="max-w-4xl">
                                <div class="space-y-4">
                                    <img
                                        src="{{ $chart->image }}"
                                        alt="{{ $chart->name }}"
                                        class="w-full rounded-lg"
                                    >
                                    <div class="flex items-center justify-between">
                                        <flux:heading size="lg">{{ $chart->name }}</flux:heading>
                                        <flux:modal.close>
                                            <flux:button variant="ghost">{{ __('Close') }}</flux:button>
                                        </flux:modal.close>
                                    </div>
                                </div>
                            </flux:modal>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

    </div>
</x-layouts::public>
