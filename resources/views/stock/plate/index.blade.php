<x-app-layout>

    <div class="mt-5 p-4">
        <div class="p-1 rounded border m-1">
            <div class="text-xl"> {{ __($title) }}: </div>
            <div> {{ $loggedUser->name }}</div>
        </div>
        <table class="w-full text-sm text-center text-gray-500">
            <thead class="text-xs text-gray-50 bg-gray-600 ">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        {{ __('size') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('quantity') }}
                    </th>

                    <th scope="col" class="px-6 py-3">
                        {{ __('date') }}
                    </th>

                </tr>
            </thead>
            <tbody>
                @foreach($plateStocks as $plateStock)
                <tr class="border-b">
                    <td class="px-6">
                        {{ __($plateStock->size) }}
                    </td>
                    <td class="px-6 py-1">
                        {{ abs($plateStock->quantity) }}
                    </td>

                    <td class="text-xs">
                        {{ $plateStock->created_at->format('d-m-Y') }}
                    </td>


                </tr>
                @endforeach
                <tr>
                    <td colspan="3">
                        {{ $plateStocks->links() }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="py-3">

    </div>
</x-app-layout>