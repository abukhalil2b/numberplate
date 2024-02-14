<!DOCTYPE html>
<html lang="en" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

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

        <div class="p-3 flex gap-4 justify-between">
            <a href="/branch/dashboard">
                <img src="/assets/images/logo.png" width="100" />
            </a>
            <div class="border rounded px-4 flex justify-center items-center">
                <a class="flex items-center" href="{{ route('profile') }}">
                    <x-svgicon.person />
                    <div class="text-red-900">{{ app()->getLocale() == 'ar' ? Auth::user()->ar_name : Auth::user()->en_name}}</div>
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
    @if(auth()->user()->isImpersonating())
    <div class="p-1 text-orange-500 text-center bg-red-100">
        <a href="{{ route('admin.impersonate.disable') }}">
            الخروج من الحساب
        </a>
    </div>
    @endif
    <div class="mt-3">
        {{ $slot }}
    </div>

    @include('layouts._display_error')
    <footer class="p-5"></footer>
</body>

</html>