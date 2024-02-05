<x-layout.admin>
    <div class="w-44 btn btn-success my-4">{{ __('today sales') }}
        <span class="badge my-0 bg-white-light text-black ltr:ml-4 rtl:mr-4">{{ count($latestBills) }}</span>
    </div>
    <div class="table-responsive">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="px-2 py-1">
                        branch name
                    </th>

                    <th scope="col" class="px-2 py-1">
                        plate
                    </th>

                    <th scope="col" class="px-2 py-1">
                        single/pair
                    </th>

                    <th scope="col" class="px-2 py-1">
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
                    <td class="px-2 py-1">
                        <div>{{ $latestBill->type }}</div>
                        <span>{{ $latestBill->plate_num }}</span>
                        <span>{{ $latestBill->plate_code }}</span>
                    </td>

                    <td class="px-2 py-1">
                        <div> {{ $latestBill->required }}</div>
                        <div class="text-xs">
                            @foreach($latestBill->items as $item)
                            <div class="badge badge-secondary">{{ $item->size }}</div>
                            @endforeach
                        </div>
                    </td>

                    <td class="px-2 py-1">
                        {{ $latestBill->ref_num }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout.admin>