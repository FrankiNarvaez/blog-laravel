@php
    $links = [
        [
            'name' => 'Home',
            'icon' => 'home',
            'url' => route('home'),
            'current' => request()->routeIs('home'),
        ]
    ];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:header container class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <a href="{{ route('home') }}" class="ms-2 me-5 flex items-center space-x-2 rtl:space-x-reverse lg:ms-0" wire:navigate>
                <x-app-logo />
            </a>

            <flux:navbar class="-mb-px max-lg:hidden">
                @foreach ($links as $link)
                    <flux:navbar.item :icon="$link['icon']" :href="$link['url']" :current="$link['current']" wire:navigate>
                        {{ $link['name'] }}
                    </flux:navbar.item>
                @endforeach
            </flux:navbar>

            <flux:spacer />

            <!-- Desktop User Menu -->
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <flux:dropdown position="top" align="end">
                            <flux:profile
                                class="cursor-pointer"
                                :initials="auth()->user()->initials()"
                            />

                            <flux:menu>
                                <flux:menu.radio.group>
                                    <div class="p-0 text-sm font-normal">
                                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                                <span
                                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                                >
                                                    {{ auth()->user()->initials() }}
                                                </span>
                                            </span>

                                            <div class="grid flex-1 text-start text-sm leading-tight">
                                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </flux:menu.radio.group>

                                <flux:menu.separator />

                                <flux:menu.radio.group>
                                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                                </flux:menu.radio.group>

                                <flux:menu.separator />

                                <form method="POST" action="{{ route('logout') }}" class="w-full">
                                    @csrf
                                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                                        {{ __('Log Out') }}
                                    </flux:menu.item>
                                </form>
                            </flux:menu>
                        </flux:dropdown>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </flux:header>

        <!-- Mobile Menu -->
        <flux:sidebar stashable sticky class="lg:hidden border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('home') }}" class="ms-1 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <x-app-logo />
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Platform')">
                    @foreach ($links as $link)
                        <flux:navlist.item :icon="$link['icon']" :href="$link['url']" :current="$link['current']" wire:navigate>
                            {{ $link['name'] }}
                        </flux:navlist.item>
                    @endforeach
                </flux:navlist.group>
            </flux:navlist>
        </flux:sidebar>

        {{ $slot }}

        @fluxScripts
    </body>
</html>
