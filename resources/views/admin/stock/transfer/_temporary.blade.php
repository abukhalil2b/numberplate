<div class="text-center text-2xl">temporary</div>

<form action="{{ route('admin.stock.transfer.temporary_store') }}" method="post">
    @csrf

    <div class="bg-temporary p-3">
        <div class="flex gap-1">
            <span class="bg-green-400">From Branch: {{ app()->getLocale() == 'ar' ? $fromBranch->ar_name : $fromBranch->en_name}} To Branch:</span>
            <select class="form-select text-white-dark" name="toBranch_id">
                @foreach($branches as $branch)
                <option value="{{ $branch->id }}">

                    {{ app()->getLocale() == 'ar' ? $branch->ar_name : $branch->en_name }}

                </option>
                @endforeach
            </select>
        </div>

        <div class="mt-4">
            <label for="exampleInpuQuantity"> bike quantity maximam is: <span class="text-orange-400"> {{ $bikePlateStock->quantity ?? 0 }} </span></label>
            <input name="bikeSizeQuantity" type="number" value="{{ $bikePlateStock->quantity ?? 0 }}" class="form-input" id="exampleInpuQuantity" placeholder="bike">
        </div>

        <div class="mt-4">
            <label for="exampleInpuQuantity"> medium quantity maximam is: <span class="text-orange-400"> {{ $mediumPlateStock->quantity ?? 0 }} </span></label>
            <input name="mediumSizeQuantity" type="number" value="{{ $mediumPlateStock->quantity ?? 0 }}" class="form-input" id="exampleInpuQuantity" placeholder="medium quantity">
        </div>

        <input type="hidden" name="fromBranch_id" value="{{ $fromBranch->id }}">
    </div>
    <button class="mt-4 btn btn-outline-primary">transfer</button>

</form>