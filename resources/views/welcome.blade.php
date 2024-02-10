<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="/assets/images/favicon.png" />
    <title>برنامج طباعة أرقام المركبات</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <div class="min-h-screen bg-gray-100 flex flex-col justify-center items-center">

        <img src="/assets/images/logo.png" alt="logo" />


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