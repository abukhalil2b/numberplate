<div>
    <div class="h-48 plate-box bg-government">
        <div class="text-xl">
            <h2 class="text-center">{{ __('government') }}</h2>
        </div>
        <div class="">

            <div class="p-1 flex justify-between">
                <div>
                {{ __('bike') }}
                </div>
                <div class="badge bg-dark w-16">{{ $bikeGovernment->total ?? 0 }}</div>
            </div>

            <div class="p-1 flex justify-between">
                <div>
                {{ __('medium') }}
                </div>
                <div class="badge bg-dark w-16">{{ $mediumGovernment->total ?? 0 }}</div>
            </div>

            <div class="p-1 flex justify-between">
                <div>
                {{ __('large') }}
                </div>
                <div class="badge bg-dark w-16">{{ $largeGovernment->total ?? 0 }}</div>
            </div>
            
            @if(auth()->user()->permission('large with khanjer'))
            <div class="p-1 flex justify-between">
                <div>
                    {{ __('large with khanjer') }}
                </div>
                <div class="badge bg-dark w-16">{{ $largeWithKhanjerGovernment->total ?? 0 }}</div>
            </div>
            @endif

        </div>
    </div>
    <!-- control -->
    <div class="mt-1 flex gap-1">
        <a class="btn btn-sm btn-outline-primary" href="{{ route('stock.transfer.create',['fromBranch'=>$branch->id,'type'=>'government']) }}">
        {{ __('Transfer') }}
        </a>
    </div>
</div>