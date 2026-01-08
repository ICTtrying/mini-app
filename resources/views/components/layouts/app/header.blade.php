<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:header container class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <span class="ms-2 me-5 flex items-center space-x-2 rtl:space-x-reverse sm:ms-0" wire:navigate>
            <div class="ms-1 grid flex-1 text-start text-sm">
                <span class="mb-0.5 truncate weight-300 leading-tight text-xs text-gray-400 font-bold">
                    <span class="hidden sm:inline">Welkom terug</span>
                    <span class="inline sm:hidden">Welkom</span>
                </span>
                <span class="mb-0.5 truncate weight-300 leading-tight font-bold">
                    <span class="hidden sm:inline">Dit zijn jou opkomende taken</span>
                    <span class="inline sm:hidden">Uw taken:</span>
                </span>
            </div>
        </span>


        <flux:spacer />

        <flux:navbar class="me-1.5 space-x-0.5 rtl:space-x-reverse py-0!">
            <a href="{{ route('dashboard') }}"
                class="flex-shrink-0 inline-flex items-center gap-2 px-3 sm:px-4 py-1 rounded-lg bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold shadow hover:shadow-lg transform hover:-translate-y-0.5 transition-all text-sm sm:text-base">
                <span>nieuwe taak</span>
            </a>
        </flux:navbar>
        <div position="top" align="end">
            <form method="POST" action="{{ route('logout') }}" class="w-full max-[450px]:hidden">
                @csrf
                <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                    {{ __('Log Out') }}
                </flux:menu.item>
            </form>
        </div>
    </flux:header>

    <!-- Mobile Menu -->
    <flux:sidebar stashable sticky
        class="lg:hidden border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('dashboard') }}" class="ms-1 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
            <x-app-logo />
        </a>

        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('Platform')">
                <flux:navlist.item icon="layout-grid" :href="route('dashboard')"
                    :current="request()->routeIs('dashboard')" wire:navigate>
                    {{ __('Dashboard') }}
                </flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

        <flux:spacer />


    </flux:sidebar>

    {{ $slot }}

    @fluxScripts
</body>

</html>
