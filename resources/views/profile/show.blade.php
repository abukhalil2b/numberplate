<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <div class="py-1" x-data="numbercodes">
        <div class="p-1 max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="text-red-900 text-xs">{{ $user->name }}</div>
            <div class="text-[10px] text-gray-500">{{ $user->email }}</div>

        </div>
    </div>
    
</x-app-layout>