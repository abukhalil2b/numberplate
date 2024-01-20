<x-layout.admin>

    <div class="py-1" x-data="numbercodes">
        <div class="p-1 max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="text-red-900 text-xs">{{ app()->getLocale() == 'ar' ? $user->ar_name :  $user->en_name }}</div>
            <div class="text-[10px] text-gray-500">{{ $user->email }}</div>

            <div class="p-3 mt-4 text-center">
            change language | تغير لغة البرنامج
            </div>
            <div class="flex gap-2">
                <a class="block bg-gray-100 border rounded p-1 w-24 text-xs text-center" href="{{ route('localization.store','en') }}">english</a>
                <a class="block bg-gray-100 border rounded p-1 w-24 text-xs text-center" href="{{ route('localization.store','ar') }}">اللغة العربية</a>
            </div>
        </div>

    </div>

</x-layout.admin>