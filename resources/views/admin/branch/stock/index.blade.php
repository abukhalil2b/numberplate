<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <div class="p-3">
        @include('inc._modal_create_stock')
        <div class="mt-3 p-3 text-xl text-red-800">
            {{ $branch->name}}
        </div>

        <div class="w-60">

            <div class="w-full mt-1 p-1 flex justify-between border rounded bg-white">
                <div class="text-red-800">
                    Size
                </div>
                <div class="text-red-800">
                    Total Quantity
                </div>
            </div>
            @foreach($plateStocks as $plateStock)

            <div class="w-full mt-1 p-1 flex justify-between border rounded bg-white">
                <div>
                    {{ $plateStock->size}}
                </div>
                <div>
                    {{ $plateStock->totalQuantity}}
                </div>
                <a href="{{ route('admin.stock.transfer.create',['fromBranch'=>$branch->id,'size'=>$plateStock->size]) }}">
                    transfer
                </a>
            </div>

            @endforeach
        </div>

    </div>

</x-app-layout>