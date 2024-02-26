<x-app-layout>
    <div class="p-3">
        <div class="flex p-3 gap-4 justify-center items-center">
            @include('item._bill_delete')
            @include('item._bill_edit')
        </div>

        <div class="w-full bg-{{$bill->type}} p-3 border rounded text-xl flex justify-between">
            <div>
                <div>
                    {{ __($bill->type) }}
                    {{ __($bill->required) }}
                </div>
                <div>
                    <span>{{ $bill->plate_num }}</span>
                    <span>{{ $bill->plate_code }}</span>
                </div>
                <span>{{ $bill->ref_num }}</span>
            </div>
            <div class="flex justify-center items-center bg-white p-1 rounded text-red-700 border-red-700 w-24">
                {{ __($bill->payment_method) }}
            </div>
        </div>

        <!-- do not show if this plate is export or temporary -->
        @if($bill->type != 'export' &&  $bill->type != 'temporary')
        <div class="mt-5 overflow-x-auto">
            {{ __('Printing') }}
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
                        <th scope="col" class="px-6 py-3">
                            {{ __('Price') }}
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
                            <div class="text-[9px]">
                                {{ $plateItem->created_at }}
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
                            <span class="badge {{ $plateItem->status == 'success' ? 'badge-outline-success' : 'badge-outline-warning' }} ">
                                {{ __($plateItem->status) }}
                            </span>
                        </td>
                        <td>
                            {{ $plateItem->price }}
                            @if($plateItem->type == 'diplomatic' || $plateItem->size == 'largeWithKhanjer')
                            @include('inc._modal_update_item_price')
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-2 flex gap-3">
            @include('inc._modal_failedprint')

        </div>
        @endif

        <div class="mt-5 overflow-x-auto">
        {{ __('Extra') }}
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
                            <div class="text-[9px]">
                                {{ $extraItem->created_at }}
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
</x-app-layout>