<x-layout.admin>
    <div>
        <h1 class="p-5 text-xl">{{ __('today sales') }}</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="px-6 py-3">
                        branch name
                    </th>

                    <th scope="col" class="px-6 py-3">
                        plate
                    </th>

                    <th scope="col" class="px-6 py-3">
                        single/pair
                    </th>

                    <th scope="col" class="px-6 py-3">
                        رصد
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($latestBills as $latestBill)
                <tr class="bg-white border-b ">
                    <td>
                        {{ app()->getLocale() == 'ar' ? $latestBill->branch->ar_name : $latestBill->branch->en_name }}
                    </td>
                    <td class="px-6 py-4">
                        <div>{{ $latestBill->type }}</div>
                        <span>{{ $latestBill->plate_num }}</span>
                        <span>{{ $latestBill->plate_code }}</span>
                    </td>

                    <td class="px-6 py-4">
                        <div> {{ $latestBill->required }}</div>
                        <div class="text-xs">
                            @foreach($latestBill->items as $item)
                            <div class="badge badge-secondary">{{ $item->size }}</div>
                            @endforeach
                        </div>
                    </td>

                    <td class="px-6 py-4">
                        {{ $latestBill->ref_num }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout.admin>