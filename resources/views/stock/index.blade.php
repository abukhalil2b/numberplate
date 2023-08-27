<x-app-layout>
    <x-slot name="header">

    </x-slot>

<div class="px-5">
@include('inc._modal_create_stock')
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
                        الفرع
                    </th>
                    <th scope="col" class="px-6 py-3">
                        operation
                    </th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($stocks as $stock)
                <tr class="bg-white border-b ">
                    <td class="px-6 py-4">
                        {{ $stock->cate }}
                        <div>
                            @if($stock->cate == 'plate')
                            {{ $stock->size }}
                            @else
                            {{ $stock->description }}
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        {{ $stock->quantity }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $stock->branch->name }}
                    </td>

                    <td class="px-6 py-4">
                        transfer to 
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>