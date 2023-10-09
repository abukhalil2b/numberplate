<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

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

    <div x-data="{ open: false }" class="flex">
        <aside x-cloak class="bg-gray-600/[0.2] transition ease-in-out text-white" :class=" open ? 'block fixed w-full h-full' : 'w-0 hidden' ">
            <div class="w-32 text-xs bg-white shadow-md h-full overflow-scroll">
                <div class="py-10 px-2">
                    <a href="/" class="flex justify-center">
                        <x-application-logo class="block h-9 w-auto fill-current " />
                    </a>
                    @include('layouts.navigation')
                </div>
            </div>
        </aside>
        <main class="w-full">
            <div class="h-10">
                @include('layouts.humberger')
            </div>
            <div class="mt-3">
                {{ $slot }}
            </div>

            <div class="p-3 mt-3">

                @if($errors->any())
                @foreach($errors->all() as $error)

                <div class="text-red-400">
                    {{ $error}}
                </div>

                @endforeach
                @endif
            </div>

        </main>
    </div>


</body>

</html>