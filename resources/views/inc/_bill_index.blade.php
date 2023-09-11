<div class="overflow-x-auto">
    <table class="w-full text-sm text-center text-gray-500">
        <thead class="text-xs text-gray-50 bg-gray-600 ">
            <tr>
                <th scope="col" class="px-6 py-3">
                    plate
                </th>

                <th scope="col" class="px-6 py-3">
                    single/pair
                </th>
               
                <th scope="col" class="px-6 py-3">
                    رصد
                </th>

                <th scope="col" class="px-6 py-3">
                details
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($bills as $bill)
            <tr class="bg-white border-b ">

                <td class="px-6 py-4">
                    <div>{{ $bill->type }}</div>
                    <span>{{ $bill->plate_num }}</span>
                    <span>{{ $bill->plate_code }}</span>
                </td>
               
                <td class="px-6 py-4">
                    {{ $bill->required }}
                </td>

                <td class="px-6 py-4">
                    {{ $bill->ref_num }}
                </td>

                <td class="px-6 py-4">
                    <a href="{{ route('item.index',$bill->id) }}">
                        show
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>