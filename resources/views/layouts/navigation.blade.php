<div class="p-1 text-center">

    <a class="block mt-1 p-1 border rounded" href="{{ route('profile') }}">
        <div class="text-red-900 text-xs">{{ Auth::user()->name }}</div>
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

<hr>

<x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="w-full mt-4">
    الصفحة الرئيسية
</x-nav-link>
<hr class="mt-5">

<x-nav-link :href="route('stock.index')" :active="request()->routeIs('stock.index')" class="w-full mt-4">
    المخزن
</x-nav-link>
