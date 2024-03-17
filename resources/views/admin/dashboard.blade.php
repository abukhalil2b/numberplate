<x-layout.admin>
    <div class="w-44 btn btn-success my-4 text-xs">{{ __('today sales') }}
        <span class="badge my-0 bg-white-light text-black ltr:ml-4 rtl:mr-4 text-xs">{{ count($latestBills) }}</span>
    </div>
    <div class="table-responsive">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="px-2 py-1">
                        {{ __('Branch Name') }}
                    </th>

                    <th scope="col" class="px-2 py-1">
                        {{ __('Plate') }}
                    </th>

                    <th scope="col" class="px-2 py-1">
                        single/pair
                    </th>

                    <th scope="col" class="px-2 py-1">
                        {{ __('ROP Bill Number') }}
                    </th>
                    <th scope="col" class="px-2 py-1">
                        {{ __('Details') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($latestBills as $latestBill)
                <tr class="bg-white border-b ">
                    <td>
                        {{ app()->getLocale() == 'ar' ? $latestBill->branch->ar_name : $latestBill->branch->en_name }}
                        <div class="text-[8px]">{{ $latestBill->created_at }}</div>
                        <div class="text-[8px]">{{ $latestBill->issue_date }}</div>
                    </td>
                    <td class="px-2 py-1">
                        <div>{{ $latestBill->type }}</div>
                        <span>{{ $latestBill->plate_num }}</span>
                        <span>{{ $latestBill->plate_code }}</span>
                    </td>

                    <td class="px-2 py-1">
                        <div> {{ $latestBill->required }}</div>
                        <div class="text-[8px] flex gap-1">
                            @foreach($latestBill->plateItems as $item)
                            <div class="text-red-800 border rounded p-1 w-12 text-center">{{ $item->size }}</div>
                            @endforeach
                        </div>
                    </td>

                    <td class="px-2 py-1">
                        {{ $latestBill->ref_num }}
                    </td>

                    <td class="px-2 py-1">
                        <a href="{{ route('admin.bill.show',$latestBill->id) }}">
                        {{ __('Show') }}
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout.admin>