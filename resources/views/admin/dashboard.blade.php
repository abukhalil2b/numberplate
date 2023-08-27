<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <div class="py-12">
        <div class="p-1 max-w-7xl mx-auto sm:px-6 lg:px-8">

            <a href="{{ route('admin.branch.create') }}">
                <div class="rounded border w-full p-1 bg-white">
                    الفروع
                </div>
            </a>
            <hr>

            <div class="mt-5 rounded border w-full p-1 bg-white">
                مبيعات اليوم
            </div>

            @include('inc._bill_index')


        </div>
    </div>
</x-app-layout>