<?php
use Illuminate\Support\Facades\Route;
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-bind:class="($flux.appearance == 'dark' || ($flux.appearance == 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)) ? 'dark' : ''">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800 flex flex-col">
    <flux:header container class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden mr-2" icon="bars-2" inset="left" />

        <x-app-logo href="{{ route('dashboard') }}" wire:navigate />

        <flux:navbar class="-mb-px max-lg:hidden">
            <flux:navbar.item icon="home" :href="route('home')" :current="request()->routeIs('home')"
                wire:navigate>
                {{ __('Home') }}
            </flux:navbar.item>
            <flux:navbar.item icon="paper-airplane" href="{{ route('approaches.index') }}" :current="request()->routeIs('approaches.index')"
                    wire:navigate>
                {{ __('Approaches') }}
            </flux:navbar.item>
            <flux:navbar.item icon="book-open" href="{{ route('posts.index') }}" :current="request()->routeIs('posts.index')"
                    wire:navigate>
                {{ __('Blog') }}
            </flux:navbar.item>
            <flux:navbar.item icon="wrench-screwdriver" href="{{ route('vrtools.index') }}" :current="request()->routeIs('vrtools.*')"
                wire:navigate>
                {{ __('VR-Tools') }}
            </flux:navbar.item>
            <flux:navbar.item icon="rectangle-group" href="{{ route('about') }}" wire:navigate>
                {{ __('About') }}
            </flux:navbar.item>


        </flux:navbar>
        <flux:spacer />
        @if (Route::has('login'))
            @auth
                <flux:navbar class="-mb-px max-lg:hidden">
                    <flux:navbar.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')"
                        wire:navigate>
                        {{ __('Dashboard') }}
                    </flux:navbar.item>
                </flux:navbar>
            @else
                <a href="{{ route('login') }}"
                    class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
                    Log in
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                        Register
                    </a>
                @endif
            @endauth

        @endif





        <x-desktop-user-menu />
    </flux:header>

    <!-- Mobile Menu -->
    <flux:sidebar collapsible="mobile" sticky
        class="lg:hidden border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.header>
            <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
            <flux:sidebar.collapse
                class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
        </flux:sidebar.header>

        <flux:sidebar.nav>
            <flux:sidebar.group :heading="__('Navigation')">
                <flux:sidebar.item icon="home" :href="route('home')"
                    :current="request()->routeIs('home')" wire:navigate>
                    {{ __('Home') }}
                </flux:sidebar.item>
                <flux:sidebar.item icon="paper-airplane" :href="route('approaches.index')"
                    :current="request()->routeIs('approaches.*')" wire:navigate>
                    {{ __('Approaches') }}
                </flux:sidebar.item>
                <flux:sidebar.item icon="book-open" :href="route('posts.index')"
                    :current="request()->routeIs('posts.*')" wire:navigate>
                    {{ __('Blog') }}
                </flux:sidebar.item>
                <flux:sidebar.item icon="wrench-screwdriver" :href="route('vrtools.index')"
                    :current="request()->routeIs('vrtools.*')" wire:navigate>
                    {{ __('VR-Tools') }}
                </flux:sidebar.item>
                <flux:sidebar.item icon="rectangle-group" :href="route('about')" wire:navigate>
                    {{ __('About') }}
                </flux:sidebar.item>
            </flux:sidebar.group>
        </flux:sidebar.nav>

        @auth
            <flux:sidebar.nav>
                <flux:sidebar.item icon="layout-grid" :href="route('dashboard')"
                    :current="request()->routeIs('dashboard')" wire:navigate>
                    {{ __('Dashboard') }}
                </flux:sidebar.item>
            </flux:sidebar.nav>
        @endauth
    </flux:sidebar>

    <div class="flex-1 flex flex-col">
        {{ $slot }}

        @include('partials.footer')
    </div>

    @fluxScripts
</body>

</html>