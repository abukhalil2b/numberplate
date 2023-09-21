<x-app-layout>
    <x-slot name="header">

    </x-slot>


    <div class="mt-5">
        <table class="w-full text-sm text-center text-gray-500">
            <thead class="text-xs text-gray-50 bg-gray-600 ">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        size
                    </th>
                    <th scope="col" class="px-6 py-3">
                        quantity
                    </th>
                    <th scope="col" class="px-6 py-3">
                        branch
                    </th>
                    <th scope="col" class="px-6 py-3">
                        description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        date
                    </th>


                </tr>
            </thead>
            <tbody>
                @foreach($plateStocks as $plateStock)
                <tr class="border-b {{ $plateStock->instock == 1 ? 'bg-white ' : 'bg-red-100 border-red-600' }}">
                    <td class="px-6">
                        {{ $plateStock->size }}
                    </td>
                    <td class="px-6 py-1">
                        {{ abs($plateStock->quantity) }}
                    </td>

                    <td class="px-6 py-1">
                        {{ $plateStock->branch->name }}
                    </td>

                    <td class="px-6 py-1 text-xs">
                        {{ $plateStock->description }}
                    </td>

                    <td class="text-xs">
                        {{ $plateStock->created_at->format('d-m-Y') }}
                    </td>


                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="py-3">

    </div>
</x-app-layout>