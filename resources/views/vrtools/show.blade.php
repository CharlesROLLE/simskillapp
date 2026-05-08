<x-layouts::public :title="__($vrtool->title)">
    <div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16">

        <a href="{{ route('vrtools.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium inline-flex items-center gap-1 mb-6">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            {{ __('Back to VR Tools') }}
        </a>

        <article class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg overflow-hidden">
            <div class="relative">
                <img class="w-full h-72 md:h-96 object-cover"
                    src="{{ $vrtool->image }}"
                    alt="{{ $vrtool->title }}">
                @if ($vrtool->category)
                    <div class="absolute top-4 right-4 bg-indigo-600 px-4 py-2 text-white text-sm font-bold rounded-lg">
                        {{ $vrtool->category->name }}
                    </div>
                @endif
            </div>

            <div class="p-6 md:p-10">
                <div class="flex flex-wrap items-center gap-3 mb-2">
                    <div class="w-10 h-10 rounded-full bg-indigo-600 flex items-center justify-center text-white text-sm font-bold">
                        {{ $vrtool->user->initials() }}
                    </div>
                    <div>
                        <span class="font-semibold text-sm">{{ $vrtool->user->name }}</span>
                        <span class="text-gray-400 text-xs block">{{ $vrtool->published_at?->diffForHumans() ?? __('Unpublished') }}</span>
                    </div>
                </div>

                <h1 class="text-3xl md:text-4xl font-bold mt-4 mb-3">{{ $vrtool->title }}</h1>

                @if ($vrtool->tags->isNotEmpty())
                    <div class="flex flex-wrap gap-2 mb-6">
                        @foreach ($vrtool->tags as $tag)
                            <span class="px-3 py-1 bg-gray-100 dark:bg-zinc-700 text-gray-600 dark:text-gray-300 text-xs font-medium rounded-full">
                                #{{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                @endif

                <div class="prose prose-lg dark:prose-invert max-w-none text-gray-700 dark:text-gray-200 leading-relaxed">
                    {{ $vrtool->body }}
                </div>

                <div class="border-t pt-8 mt-8">
                    @livewire('vrtool-comments', ['vrtool' => $vrtool], key($vrtool->id))
                </div>
            </div>
        </article>

    </div>
</x-layouts::public>
