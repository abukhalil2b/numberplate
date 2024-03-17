<x-layout.admin>

    <div class="p-5">
        <span>Plate Sold</span>
        <span class="text-red-800"> {{ app()->getLocale() == 'ar' ? $branch->ar_name : $branch->en_name }} </span>
    </div>

    <form action="{{ route('admin.bill.plate.index',$branch->id) }}" method="POST">
        @csrf
        <div class="flex flex-wrap gap-1 items-end text-xs">
            <div>
                From Date
                <input type="date" name="date_from" class="h-10 form-input" value="{{ $date_from }}">
            </div>
            <div>
                To Date
                <input type="date" name="date_to" class="h-10 form-input" value="{{ $date_to }}">
            </div>
            <div>
                type
                <select name="type" class="h-10 form-input">
                    <option @if($type=='private' ) selected @endif value="private">private</option>
                    <option @if($type=='commercial' ) selected @endif value="commercial">commercial</option>
                    <option @if($type=='diplomatic' ) selected @endif value="diplomatic">diplomatic</option>
                    <option @if($type=='specific' ) selected @endif value="specific">specific</option>
                    <option @if($type=='learner' ) selected @endif value="learner">learner</option>
                    <option @if($type=='government' ) selected @endif value="government">government</option>
                    <option @if($type=='all' ) selected @endif value="all">all</option>
                </select>
            </div>
            <div>
                single/pair
                <select name="required" class="h-10 form-input">
                    <option @if($required=='single' ) selected @endif value="single">single</option>
                    <option @if($required=='pair' ) selected @endif value="pair">pair</option>
                    <option @if($required=='both' ) selected @endif value="both">both</option>
                </select>
            </div>

            <div>
                Condition
                <select name="condition" class="h-10 form-input">
                    <option @if($condition=='sold' ) selected @endif value="sold">{{ __('Show Only Plate Sold') }}</option>
                    <option @if($condition=='failed' ) selected @endif value="failed">{{ __('Show Only Failed Print') }}</option>
                    <option @if($condition=='both' ) selected @endif value="both">{{ __('Show Both') }}</option>
                </select>
            </div>
            <button class="btn shadow-none border h-10 hover:bg-white">search</button>
        </div>

    </form>

    <div class="mt-4 text-warning">{{ $message }}</div>

    <div class="mt-4 table-responsive">
        <table>
            <thead>
                <tr>
                    <th>
                        Date
                    </th>
                    <th>
                        Plate
                    </th>

                    <th>
                        Single/Pair
                    </th>
                    <th>Extras</th>
                    <th>
                        {{ __('ROP Bill Number') }}
                    </th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bills as $bill)
                <tr class="bg-white border-b text-xs">
                    <td>
                        <div>{{ $bill->issue_date }}</div>
                    </td>
                    <td class="">
                        <div>{{ $bill->type }}</div>
                        <span>{{ $bill->plate_num }}</span>
                        <span>{{ $bill->plate_code }}</span>
                    </td>

                    <td>
                        {{ $bill->required }}
                    </td>
                    <td>
                        @if($bill->extraItems)
                        @foreach($bill->extraItems as $item)
                        <div class="text-xs text-orange-500">{{ $item->description }}</div>
                        @endforeach
                        @endif
                    </td>
                    <td>
                        {{ $bill->ref_num }}
                    </td>
                    <td>
                        <a class="text-red-800 font-bold" href="{{ route('admin.bill.show',$bill->id) }}">show</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <div class="mt-4 text-warning">{{ $failedPrintCounts }}</div>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>
                    Date
                    </th>
                    <th>
                        Plate
                    </th>
                    <th>single/pair</th>
                    <th>
                        quantity
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($failedPrints as $failedPrint)
                <tr class="bg-white border-b text-xs">
                    <td>
                        <div>{{ $failedPrint->issue_date }}</div>
                    </td>
                    <td class="">
                        <div>{{ $failedPrint->type }}</div>
                        <span>{{ $failedPrint->plate_num }}</span>
                        <span>{{ $failedPrint->plate_code }}</span>
                        <a class="text-red-800" href="{{ route('admin.bill.show',$failedPrint->bill_id) }}">show</a>
                    </td>
                    <td>
                        {{ $failedPrint->required }}
                    </td>
                    <td>
                        {{ $failedPrint->quantity }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-layout.admin>