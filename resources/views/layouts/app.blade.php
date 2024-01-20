<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'طباعة أرقام المركبات') }}</title>

    <!-- Fonts -->

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-50">

    <div class="w-full bg-white">

        <div class="p-3 flex gap-4">
            <a href="/branch/dashboard">
                <img src="/img/logo.png" width="100" />
            </a>
            <div class="flex items-center">
                <x-svgicon.person />
                <a class="block text-center" href="{{ route('profile') }}">
                    <div class="text-red-900 text-xs">{{ app()->getLocale() == 'ar' ? Auth::user()->ar_name : Auth::user()->en_name}}</div>
                    <div class="text-[10px] text-gray-500">{{ Auth::user()->email }}</div>
                </a>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();" class="text-red-400 text-xs">
                    تسجيل الخروج
                </x-dropdown-link>
            </form>
        </div>

    </div>

    <div class="mt-3">
        {{ $slot }}
    </div>

    @include('layouts._display_error')
    <footer class="p-5"></footer>
</body>

</html>