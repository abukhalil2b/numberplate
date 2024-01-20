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

        <div class="p-3 flex">
            <svg class="w-4 h-5 flex-none " viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" fill="black" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            <a class="block w-32 text-center" href="{{ route('profile') }}">
                <div class="text-red-900 text-xs">{{ app()->getLocale() == 'ar' ? Auth::user()->ar_name : Auth::user()->en_name}}</div>
                <div class="text-[10px] text-gray-500">{{ Auth::user()->email }}</div>
            </a>

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