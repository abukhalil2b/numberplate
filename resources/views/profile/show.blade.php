<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <div class="py-1" x-data="numbercodes">
        <div class="p-1 max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="text-red-900 text-xs">{{ $user->name }}</div>
            <div class="text-[10px] text-gray-500">{{ $user->email }}</div>

            <div class="mt-4 flex gap-2">
            <a class="block bg-gray-100 border rounded p-1 w-24 text-xs text-center" href="{{ route('localization.store','ar') }}">اللغة العربية</a>
            <a class="block bg-gray-100 border rounded p-1 w-24 text-xs text-center" href="{{ route('localization.store','en') }}">english</a>
            </div>
        </div>

    </div>
    
</x-app-layout>