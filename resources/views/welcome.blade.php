<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <div class="p-5 min-h-screen bg-gray-100 text-xl">

        <div class="flex justify-center text-2xl text-red-900">

            برنامج تتبع تسجيل أرقام المركبات

        </div>

        <div class="mt-10 py-10 flex justify-center text-purple-800">
            ( النسخة التجريبية الثالثة )
        </div>

        <div class="mt-5 flex justify-center">
            @auth
            @if(auth()->user()->profile == 'admin')
            <a href="{{ url('admin/dashboard') }}" class="">دخول</a>
            @else
            <a href="{{ url('branch/dashboard') }}" class="">دخول</a>
            @endif
            @else
            <a href="{{ route('login') }}" class="">دخول</a>
            @endauth
        </div>

    </div>
</body>

</html>