<x-layouts::public :title="__('Posts')">
    <section class="pt-20 lg:pt-[120px] pb-10 lg:pb-20">
       <div class="container mx-auto px-4">
          <div class="flex flex-wrap justify-center -mx-4">
             <div class="w-full px-4">
                <div class="text-center mx-auto mb-[60px] lg:mb-20 max-w-[510px]">
                   <span class="font-semibold text-lg text-indigo-600 mb-2 block">
                   {{ __('Our Blogs') }}
                   </span>
                   <h2 class="font-bold text-3xl sm:text-4xl md:text-[40px] text-gray-900 dark:text-white mb-4">
                   {{ __('Our Recent News') }}
                   </h2>
                   <p class="text-base text-gray-500">
                   {{ __('Discover the latest in flight simulation, VR, and aviation techniques.') }}
                   </p>
                </div>
             </div>
          </div>
          <div class="flex flex-wrap -mx-4">
            @forelse ($posts as $post)
                <div class="w-full md:w-1/2 lg:w-1/3 px-4">
                    <div class="max-w-[370px] mx-auto mb-10">
                        <a href="{{ route('posts.show', $post) }}" class="rounded overflow-hidden mb-8 block">
                            <img
                               src="{{ $post->image }}"
                               alt="{{ $post->title }}"
                               class="w-full h-48 object-cover"
                            />
                        </a>
                        <div>
                            @if ($post->category)
                                <span class="bg-indigo-600 rounded inline-block text-center py-1 px-4 text-xs leading-loose font-semibold text-white mb-3">
                                    {{ $post->category->name }}
                                </span>
                            @endif
                            <h3>
                                <a
                                    href="{{ route('posts.show', $post) }}"
                                    class="font-semibold text-xl sm:text-2xl lg:text-xl xl:text-2xl mb-3 inline-block text-gray-900 dark:text-white hover:text-indigo-600 transition-colors"
                                >
                                    {{ $post->title }}
                                </a>
                            </h3>
                            <div class="flex items-center gap-2 text-xs text-gray-400 mb-2">
                                <span>{{ $post->user->name }}</span>
                                <span>&middot;</span>
                                <span>{{ $post->published_at?->diffForHumans() ?? __('Unpublished') }}</span>
                            </div>
                            <p class="text-base text-gray-500 mb-3">
                                {{ Str::limit(strip_tags($post->body), 120) }}
                            </p>
                            @if ($post->tags->isNotEmpty())
                                <div class="flex flex-wrap gap-1">
                                    @foreach ($post->tags as $tag)
                                        <span class="text-xs text-gray-400">#{{ $tag->name }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="w-full text-center py-12">
                    <p class="text-gray-400">{{ __('No posts yet.') }}</p>
                </div>
            @endforelse
          </div>
       </div>
    </section>
</x-layouts::public>
