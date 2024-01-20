<x-layout.admin>
    <div>
        <div class="">
            <form action="{{ route('admin.bill.extra.search',$branch->id) }}" method="POST">
                @csrf
                <label>
                    from date
                    <input type="date" name="date_from" class="form-input" value="{{ $date_from }}">
                </label>
                <label>
                    to date
                    <input type="date" name="date_to" class="form-input" value="{{ $date_to }}">
                </label>
                <button class="mt-4 btn btn-primary">search</button>
            </form>
        </div>

        <div class="mt-4 table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>
                            description
                        </th>
                        <th>
                            quantity
                        </th>
                        <th>
                            total price
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr class="bg-white border-b text-xs">
                        <td>
                            {{ $item->description }}
                        </td>
                        <td>
                            {{ $item->quantity }}
                        </td>
                        <td>
                            {{ $item->totalPrice }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout.admin>