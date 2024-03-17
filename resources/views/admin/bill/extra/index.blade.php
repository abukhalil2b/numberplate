<x-layout.admin>


    <div class="p-5">
        <span>Extra Job</span>
        <span class="text-red-800"> {{ app()->getLocale() == 'ar' ? $branch->ar_name : $branch->en_name }} </span>
    </div>

    <form action="{{ route('admin.bill.extra.index',$branch->id) }}" method="POST">
        <div class="flex flex-wrap items-end gap-1">
            @csrf
            <div>
                From Date
                <input type="date" name="date_from" class="h-10 form-input" value="{{ $date_from }}">
            </div>
            <div>
                To Date
                <input type="date" name="date_to" class="h-10 form-input" value="{{ $date_to }}">
            </div>
            <button class="btn shadow-none border h-10 hover:bg-white">Search</button>
        </div>
    </form>

    <div class="mt-4 text-warning">{{ $message }}</div>

    <div class="mt-4 table-responsive">
        <table>
            <thead>
                <tr>
                    <th>
                        Description
                    </th>
                    <th>
                        Quantity
                    </th>
                    <th>
                        Total Price
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                $totalPrice = 0;
                @endphp
                @foreach($groupedItems as $groupedItem)
                <tr class="bg-white border-b text-xs">
                    <td>
                        {{ $groupedItem->description }}
                    </td>
                    <td>
                        {{ $groupedItem->quantity }}
                    </td>
                    <td>
                        {{ $groupedItem->totalPrice }}
                    </td>
                </tr>
                @php
                $totalPrice = $totalPrice + $groupedItem->totalPrice ;
                @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-center font-bold text-blue-800">
                        Total:{{ $totalPrice }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="mt-4 table-responsive">
        <table>
            <thead>
                <tr>
                    <th>
                        Date
                    </th>
                    <th>
                        Description
                    </th>
                    <th>
                        Type
                    </th>
                    <th>
                        Price
                    </th>
                    <th>
                        Details
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr class="bg-white border-b text-xs">
                    <td>
                        {{ $item->issue_date }}
                    </td>
                    <td>
                        {{ $item->description }}
                    </td>
                    <td>
                        {{ $item->type }}
                    </td>
                    <td>
                        {{ $item->price }}
                    </td>
                    <td>
                        {{ $item->plate_num }} {{ $item->plate_code }}
                        <a class="text-red-800" href="{{ route('admin.bill.show',$item->bill_id) }}">show</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-layout.admin>