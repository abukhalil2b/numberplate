<div class="text-center text-2xl">private</div>

<form action="{{ route('admin.stock.transfer.private_store') }}" method="post">
    @csrf

    <div class="bg-private p-3">

        <div class="flex gap-1">
            <span class="bg-white">From Branch: {{ app()->getLocale() == 'ar' ? $fromBranch->ar_name : $fromBranch->en_name}} To Branch:</span>
            <select class="form-select text-white-dark" name="toBranch_id">
                @foreach($branches as $branch)
                <option value="{{ $branch->id }}">

                    {{ app()->getLocale() == 'ar' ? $branch->ar_name : $branch->en_name }}

                </option>
                @endforeach
            </select>
        </div>

        <div class="mt-4">
            <label for="exampleInpuQuantity"> bike quantity maximam is: <span class="text-orange-400"> {{ $bikePlateStock->quantity }} </span></label>
            <input name="bikeSizeQuantity" type="number" value="{{ $bikePlateStock->quantity }}" class="form-input" id="exampleInpuQuantity" placeholder="bike">
        </div>

        <div class="mt-4">
            <label for="exampleInpuQuantity"> small quantity maximam is: <span class="text-orange-400"> {{ $smallPlateStock->quantity }} </span></label>
            <input name="smallSizeQuantity" type="number" value="{{ $smallPlateStock->quantity }}" class="form-input" id="exampleInpuQuantity" placeholder="small">
        </div>

        <div class="mt-4">
            <label for="exampleInpuQuantity"> medium quantity maximam is: <span class="text-orange-400"> {{ $mediumPlateStock->quantity }} </span></label>
            <input name="mediumSizeQuantity" type="number" value="{{ $mediumPlateStock->quantity }}" class="form-input" id="exampleInpuQuantity" placeholder="medium quantity">
        </div>

        <div class="mt-4">
            <label for="exampleInpuQuantity"> large quantity maximam is: <span class="text-orange-400"> {{ $largePlateStock->quantity }} </span></label>
            <input name="largeSizeQuantity" type="number" value="{{ $largePlateStock->quantity }}" class="form-input" id="exampleInpuQuantity" placeholder="large quantity">
        </div>

        <input type="hidden" name="fromBranch_id" value="{{ $fromBranch->id }}">
    </div>

    <button class="mt-4 btn btn-outline-primary">transfer</button>

</form>