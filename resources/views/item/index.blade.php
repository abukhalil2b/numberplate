<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <div class="py-12">
        <div class="p-1 max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="w-full bg-white p-3 border rounded shadow">
                <div> {{ $bill->type }}</div>
                <span>{{ $bill->plate_num }}</span>
                <span>{{ $bill->plate_code }}</span>
            </div>

            <div class="mt-5 overflow-x-auto">
                <table class="w-full text-sm text-center text-gray-500">
                    <thead class="text-xs text-gray-50 bg-gray-600 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                الغرض
                            </th>
                            <th scope="col" class="px-6 py-3">
                                العدد
                            </th>
                            <th scope="col" class="px-6 py-3">
                                حالة الطباعة
                            </th>

                            <th scope="col" class="px-6 py-3">
                                price
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr class="bg-white border-b ">
                            <td class="px-6 py-4">
                                {{ $item->cate }}
                                <div>
                                    @if($item->cate == 'plate')
                                    {{ $item->size }}
                                    @else
                                    {{ $item->note }}
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->quantity }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $item->status }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->price }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-5 flex gap-1">
                @include('inc._model_extra')

                @include('inc._model_failedprint')
            </div>

        </div>
    </div>
</x-app-layout>