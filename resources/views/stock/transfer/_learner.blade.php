<div class="text-center text-2xl">{{ __('learner') }}</div>

<form action="{{ route('stock.transfer.learner_store') }}" method="post">
    @csrf

    <div class="bg-learner p-3">
        <div class="flex gap-1">
            <span class="bg-white w-64">{{ __('From Branch') }}: {{ app()->getLocale() == 'ar' ? $fromBranch->ar_name : $fromBranch->en_name}} {{ __('To Branch') }}:</span>
            <select class="form-select text-white-dark" name="toBranch_id">
                @foreach($userBranches as $branch)
                <option value="{{ $branch->id }}">

                    {{ app()->getLocale() == 'ar' ? $branch->ar_name : $branch->en_name }}

                </option>
                @endforeach
            </select>
        </div>

        @if($bikePlateStock->quantity > 0)
        <div class="mt-4">
            <label for="exampleInpuQuantity"> {{ __('bike quantity maximam is') }}: <span class="text-orange-400"> {{ $bikePlateStock->quantity ?? 0 }} </span></label>
            <input name="bikeSizeQuantity" type="number" value="{{ $bikePlateStock->quantity ?? 0 }}" class="form-input" id="exampleInpuQuantity" min="0" max="{{ $bikePlateStock->quantity }}">
        </div>
        @endif

        @if($mediumPlateStock->quantity > 0)
        <div class="mt-4">
            <label for="exampleInpuQuantity"> {{ __('medium quantity maximam is') }}: <span class="text-orange-400"> {{ $mediumPlateStock->quantity ?? 0 }} </span></label>
            <input name="mediumSizeQuantity" type="number" value="{{ $mediumPlateStock->quantity ?? 0 }}" class="form-input" id="exampleInpuQuantity" min="0" max="{{ $mediumPlateStock->quantity }}">
        </div>
        @endif

        <input type="hidden" name="fromBranch_id" value="{{ $fromBranch->id }}">
    </div>
    <button class="mt-4 btn btn-outline-primary">
    {{ __('Transfer') }}
    </button>

</form>