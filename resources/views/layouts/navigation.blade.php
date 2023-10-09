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

<x-nav-link :href="route('branch.dashboard')" :active="request()->routeIs('branch.dashboard')" class="w-full mt-4">
    الصفحة الرئيسية
</x-nav-link>


<hr class="mt-5">

<x-nav-link :href="route('stock.plate.sold')" :active="request()->routeIs('stock.plate.sold')" class="w-full mt-4">
   {{ __('plate sold') }}
</x-nav-link>

<x-nav-link :href="route('stock.plate.transferred')" :active="request()->routeIs('stock.plate.transferred')" class="w-full mt-4">
   {{ __('plate transferred') }}
</x-nav-link>

<x-nav-link :href="route('stock.plate.received')" :active="request()->routeIs('stock.plate.received')" class="w-full mt-4">
   {{ __('plate received') }}
</x-nav-link>