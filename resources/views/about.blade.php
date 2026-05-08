<x-layouts::public :title="__('About')">
    <section class="pt-20 lg:pt-[120px] pb-10 lg:pb-20">
        <div class="container mx-auto px-4">
            <div class="flex flex-col items-center">
                    <img
                        src="{{ asset('images/sim_skill_app_logo.svg') . '?v=' . time() }}"
                        alt="{{ __('About SimSkillApp') }}"
                        class="mx-auto rounded-xl shadow-lg object-cover mb-8"
                        style="width: 140px; height: auto;"
                    />
                <div class="w-full max-w-2xl text-center px-4">
                    <span class="font-semibold text-lg text-indigo-600 mb-2 block">
                        {{ __('About Us') }}
                    </span>
                    <h2 class="font-bold text-3xl sm:text-4xl md:text-[40px] text-gray-900 dark:text-white mb-6">
                        {{ __('SimSkillApp — Flight Simulation & VR') }}
                    </h2>
                    <p class="text-base text-gray-500 mb-4 leading-relaxed">
                        {{ __('SimSkillApp is your go-to resource for flight simulation enthusiasts. We provide detailed approach charts, in-depth articles on flight techniques, VR hardware guides, and a community-driven platform for sharing knowledge about Microsoft Flight Simulator, X-Plane, and virtual reality in aviation.') }}
                    </p>
                    <p class="text-base text-gray-500 mb-4 leading-relaxed">
                        {{ __('Whether you are a seasoned virtual pilot or just starting your journey, our curated content helps you master approaches, optimize your VR setup, and stay up to date with the latest in flight simulation.') }}
                    </p>
                    <p class="text-base text-gray-500 leading-relaxed">
                        {{ __('Join our community and take your flight simulation skills to the next level.') }}
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-layouts::public>
