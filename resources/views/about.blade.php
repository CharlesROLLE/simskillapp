<x-layouts::public :title="__('About')">
    @php $page = \App\Models\Page::where('slug', 'about')->first(); @endphp
    <section class="pt-20 lg:pt-[120px] pb-10 lg:pb-20">
        <div class="container mx-auto px-4">
            <div class="flex flex-col items-center">
                @if ($page && $page->image)
                    <img
                        src="{{ $page->image }}"
                        alt="{{ __('About SimSkillApp') }}"
                        class="mx-auto rounded-xl shadow-lg object-cover mb-8"
                        style="width: 140px; height: auto;"
                    />
                @endif
                <div class="w-full max-w-2xl text-center px-4">
                    @if ($page)
                        <span class="font-semibold text-lg text-indigo-600 mb-2 block">
                            {{ __('About Us') }}
                        </span>
                        <h2 class="font-bold text-3xl sm:text-4xl md:text-[40px] text-gray-900 dark:text-white mb-6">
                            {{ $page->title }}
                        </h2>
                        <div class="text-base text-gray-500 leading-relaxed prose prose-lg dark:prose-invert max-w-none">
                            {!! $page->body !!}
                        </div>
                    @else
                        <p class="text-gray-400">{{ __('No content yet.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
</x-layouts::public>
