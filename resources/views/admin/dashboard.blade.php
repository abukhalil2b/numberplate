<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <div class="py-12">
        <div class="p-1 max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-primary-button-link :href="route('admin.branch.create')"  class="mt-4">
            الفروع
            </x-primary-button-link>

            <div class="pb-2 text-xl mt-5">
                مبيعات اليوم
            </div>

            @include('inc._bill_index')

        </div>
    </div>
</x-app-layout>