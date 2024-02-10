<div class="overflow-x-auto">

<div class="text-xl text-red-800">
    {{ __('Today Sale') }} <span class="badge bg-red-800"> {{ count($latestBills) }}</span>
</div>

    <table class="w-full text-sm text-center text-gray-500">
        <thead class="text-xs bg-gray-600 ">
            <tr>
                <th scope="col" class="px-6 py-3">
                    {{ __('time') }}
                </th>

                <th scope="col" class="px-6 py-3">
                    {{ __('plate') }}
                </th>

                <th scope="col" class="px-6 py-3">
                    {{ __('single/pair') }}
                </th>
               
                <th scope="col" class="px-6 py-3">
                    {{ __('ROP Bill Number') }}
                </th>

                <th scope="col" class="px-6 py-3">
                {{ __('details') }}
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($latestBills as $latestBill)
            <tr class="bg-white border-b border-black">

            <td class="px-6 py-4 text-xs">
                    {{ $latestBill->created_at->format('H:i') }}
                </td>

                <td class="px-6 py-4">
                    <div>{{ __($latestBill->type) }}</div>
                    <span>{{ $latestBill->plate_num }}</span>
                    <span>{{ $latestBill->plate_code }}</span>
                </td>
               
                <td class="px-6 py-4">
                    {{ __($latestBill->required) }}
                </td>

                <td class="px-6 py-4">
                    {{ $latestBill->ref_num }}
                </td>

                <td class="px-6 py-4">
                    <a href="{{ route('item.index',$latestBill->id) }}">
                         {{ __('show') }}
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>