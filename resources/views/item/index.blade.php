<x-app-layout>

    <div class="flex gap-4 justify-center items-center">
        @include('item._bill_delete')
        @include('item._bill_edit')
    </div>

    <div class="py-12">
        <div class="p-1 max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="w-full bg-white p-3 border rounded text-xl">
                <div> {{ __($bill->type) }}</div>
                <span>{{ $bill->plate_num }}</span>
                <span>{{ $bill->plate_code }}</span>
            </div>

            <div class="mt-5 overflow-x-auto">
                <table class="w-full text-sm text-center text-gray-500">
                    <thead class="text-xs bg-gray-600 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                {{ __('size') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('type') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('quantity') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('printing status') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($plateItems as $plateItem)
                        <tr class="bg-white border-b ">
                            <td class="px-6 py-4">

                                <div>
                                    {{ __($plateItem->size) }}
                                </div>
                            </td>
                            <td class="px-6 py-4">

                                <div>
                                    {{ __($plateItem->type) }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                {{ $plateItem->quantity }}
                            </td>

                            <td class="px-6 py-4">
                                {{ __($plateItem->status) }}
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-1">
                @include('inc._model_failedprint')
            </div>

            <div class="mt-5 overflow-x-auto">
                <table class="w-full text-sm text-center text-gray-500">
                    <thead class="text-xs text-gray-50 bg-gray-600 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                {{ __('extra') }}
                            </th>

                            <th scope="col" class="px-6 py-3">
                                {{ __('price') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($extraItems as $extraItem)
                        <tr class="bg-white border-b ">
                            <td class="px-6 py-4">
                                <div>
                                    {{ __($extraItem->description) }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                {{ $extraItem->price }}
                            </td>
                            <td>

                                @include('item._extra_item_delete')
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-1">
                @include('inc._model_extra')
            </div>


        </div>
    </div>

</x-app-layout>