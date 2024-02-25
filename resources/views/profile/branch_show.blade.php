<x-app-layout>
    <div class="p-1 text-center text-blue-800 font-bold">
        {{ $branch->description }}
    </div>

    <div class="mt-5 text-xl flex justify-center items-center">
        <span class="pb-2 border-red-800 border-b-2 text-red-800 text-xl"> {{ __('Stock') }} </span>
    </div>

    <div class="mt-4 px-5 grid grid-cols-1 gap-6 pt-2 md:grid-cols-2 lg:grid-cols-4">

        <!-- private -->
        @include('stock._private_plate_index')

        <!-- commercial  -->
        @include('stock._commercial_plate_index')

        <!-- diplomatic -->
        @if(auth()->user()->permission('diplomatic'))
        @include('stock._diplomatic_plate_index')
        @endif

        <!-- temporary -->
        @if(auth()->user()->permission('temporary'))
        @include('stock._temporary_plate_index')
        @endif

        <!-- export -->
        @if(auth()->user()->permission('export'))
        @include('stock._export_plate_index')
        @endif

        <!-- specific -->
        @include('stock._specific_plate_index')

        <!-- learner -->
        @if(auth()->user()->permission('learner'))
        @include('stock._learner_plate_index')
        @endif

        <!-- government -->
        @if(auth()->user()->permission('government'))
        @include('stock._government_plate_index')
        @endif

    </div>

    <div class="mt-5 text-xl flex justify-center items-center">
        <span class="pb-2 border-red-800 border-b-2 text-red-800 text-xl"> {{ __('extra') }} {{ __('Month') }}: {{ $month }} </span>
    </div>

    <div class="table-responsive px-5">
        <table>
            <tr>
                <td>{{ __('Job Done') }}</td>
                <td>{{ __('Plate Type') }}</td>
                <td>{{ __('Count') }}</td>
                <td>{{ __('Total Price') }}</td>
            </tr>

            @php
            $allPlateTotal = 0;

            @endphp

            @foreach($items as $item)

            @php
            $style = '';
            if($item->description == "fix single plate"){
            $style = 'bg-orange-500';
            }

            if($item->description == "fix pair plate"){
            $style = 'bg-blue-500';
            }

            if($item->description == "buy single frame"){
            $style = 'bg-green-500';
            }

            if($item->description == "buy pair frame"){
            $style = 'bg-purple-500';
            }

            if(
            $item->description == "print pair large plate"
            ||
            $item->description == "print single large plate"
            ||
            $item->description == "print pair medium plate"
            ||
            $item->description == "print single medium plate"
            ){
            $style = 'bg-yellow-500';
            }

            @endphp

            <tr>
                <td>
                    <div class="w-40 text-xs badge {{ $style }}">
                        {{ __($item->description) }}
                    </div>
                </td>
                <td>{{ __($item->type) }}</td>

                <td>
                    {{ $item->count }}
                </td>
                <td>
                    {{ $item->totalPrice }}
                </td>
            </tr>
            @php
            $allPlateTotal = $allPlateTotal + $item->totalPrice;
            @endphp
            @endforeach

            <tr>
                <td colspan="4">
                    <div class="text-center text-xl">{{ $allPlateTotal }}</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="mt-5 text-xl flex justify-center items-center">
        <span class="pb-2 border-red-800 border-b-2 text-red-800 text-xl"> {{ __('Sales History') }} </span>
    </div>

    <div class="mt-5 px-5 flex flex-wrap gap-3">
        @foreach($issueDates as $issueDate)

        @if($issueDate->issue_date)
        <div class="p-3 border rounded bg-slate-100 flex-col flex items-center gap-2 border-slate-400">
            {{ $issueDate->issue_date }}
            <div class="flex gap-3">
                <a class="btn btn-sm btn-outline-primary" href="{{ route('plate.sale_history',$issueDate->issue_date) }}">
                    {{ __('printing plate') }}
                </a>
                <a class="btn btn-sm btn-outline-primary" href="{{ route('extra.sale_history',$issueDate->issue_date) }}">
                    {{ __('fixing plate') }}
                    {{ __('buy frame') }}
                </a>
            </div>
        </div>
        @endif

        @endforeach
    </div>

</x-app-layout>