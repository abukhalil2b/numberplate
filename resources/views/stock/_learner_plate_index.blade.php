<div>
    <div class="h-48 plate-box bg-learner">
        <div class="text-xl">
            <h2 class="text-center">{{ __('learner') }}</h2>
        </div>
        <div class="">

            <div class="p-1 flex justify-between">
                <div>
                {{ __('bike') }}
                </div>
                <div class="badge bg-dark w-16">{{ $bikeLearner->total ?? 0 }}</div>
            </div>

            <div class="p-1 flex justify-between">
                <div>
                {{ __('medium') }}
                </div>
                <div class="badge bg-dark w-16">{{ $mediumLearner->total ?? 0 }}</div>
            </div>

        </div>
    </div>
    <!-- control -->
    <div class="mt-1 flex gap-1">
        <a class="btn btn-sm btn-outline-primary" href="{{ route('stock.transfer.create',['fromBranch'=>$branch->id,'type'=>'learner']) }}">
        {{ __('Transfer') }}
        </a>
    </div>
</div>