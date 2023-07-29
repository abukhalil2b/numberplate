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

            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-center text-gray-500">
                    <thead class="text-xs text-gray-700 bg-gray-50 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                اللوحة
                            </th>
                            <th scope="col" class="px-6 py-3">
                                نوع اللوحة
                            </th>
                            <th scope="col" class="px-6 py-3">
                                العدد
                            </th>
                            <th scope="col" class="px-6 py-3">
                                حالة الطباعة
                            </th>
                            <th scope="col" class="px-6 py-3">
                                رصد
                            </th>
                            <th scope="col" class="px-6 py-3">
                                الفرع
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bills as $bill)
                        <tr class="bg-white border-b ">
                            <td class="px-6 py-4">
                                <span>{{ $bill->num_plate }}</span>
                                <span>{{ $bill->zone_plate }}</span>
                            </td>
                            <td class="px-6 py-4">
                                {{ $bill->size_plate }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $bill->quantity }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $bill->success_printing ? 'نجحت' : 'لم تنجح' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $bill->ref_num }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $bill->branch->name }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>



        </div>
    </div>
</x-app-layout>