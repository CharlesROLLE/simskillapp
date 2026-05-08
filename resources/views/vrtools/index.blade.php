<x-layouts::public :title="__('VR Tools')">
    <section class="pt-20 lg:pt-[120px] pb-10 lg:pb-20">
       <div class="container mx-auto px-4">
          <div class="flex flex-wrap justify-center -mx-4">
             <div class="w-full px-4">
                <div class="text-center mx-auto mb-[60px] lg:mb-20 max-w-[510px]">
                   <span class="font-semibold text-lg text-indigo-600 mb-2 block">
                   {{ __('VR Tools & Guides') }}
                   </span>
                   <h2 class="font-bold text-3xl sm:text-4xl md:text-[40px] text-gray-900 dark:text-white mb-4">
                   {{ __('VR for Flight Simulation') }}
                   </h2>
                   <p class="text-base text-gray-500">
                   {{ __('Explore hardware, settings, and tips for the best VR flight sim experience.') }}
                   </p>
                </div>
             </div>
          </div>
          <div class="flex flex-wrap -mx-4">
            @forelse ($vrtools as $vrtool)
                <div class="w-full md:w-1/2 lg:w-1/3 px-4">
                    <div class="max-w-[370px] mx-auto mb-10">
                        <a href="{{ route('vrtools.show', $vrtool) }}" class="rounded overflow-hidden mb-8 block">
                            <img
                               src="{{ $vrtool->image }}"
                               alt="{{ $vrtool->title }}"
                               class="w-full h-48 object-cover"
                            />
                        </a>
                        <div>
                            @if ($vrtool->category)
                                <span class="bg-indigo-600 rounded inline-block text-center py-1 px-4 text-xs leading-loose font-semibold text-white mb-3">
                                    {{ $vrtool->category->name }}
                                </span>
                            @endif
                            <h3>
                                <a
                                    href="{{ route('vrtools.show', $vrtool) }}"
                                    class="font-semibold text-xl sm:text-2xl lg:text-xl xl:text-2xl mb-3 inline-block text-gray-900 dark:text-white hover:text-indigo-600 transition-colors"
                                >
                                    {{ $vrtool->title }}
                                </a>
                            </h3>
                            <div class="flex items-center gap-2 text-xs text-gray-400 mb-2">
                                <span>{{ $vrtool->user->name }}</span>
                                <span>&middot;</span>
                                <span>{{ $vrtool->published_at?->diffForHumans() ?? __('Unpublished') }}</span>
                            </div>
                            <p class="text-base text-gray-500 mb-3">
                                {{ Str::limit(strip_tags($vrtool->body), 120) }}
                            </p>
                            @if ($vrtool->tags->isNotEmpty())
                                <div class="flex flex-wrap gap-1">
                                    @foreach ($vrtool->tags as $tag)
                                        <span class="text-xs text-gray-400">#{{ $tag->name }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="w-full text-center py-12">
                    <p class="text-gray-400">{{ __('No VR tools articles yet.') }}</p>
                </div>
            @endforelse
          </div>
       </div>
    </section>
</x-layouts::public>
