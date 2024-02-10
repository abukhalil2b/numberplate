<div>
    <div class="h-48 plate-box bg-private">
        <div class="text-xl">
            <h2 class="text-center">{{ __('private') }}</h2>
        </div>
        <div class="">

            <div class="p-1 flex justify-between">
                <div>
                {{ __('bike') }}
                </div>
                <div class="badge bg-dark w-16">{{ $bikePrivate->total ?? 0 }}</div>
            </div>

            <div class="p-1 flex justify-between">
                <div>
                    {{ __('small') }}
                </div>
                <div class="badge bg-dark w-16">{{ $smallPrivate->total ?? 0 }}</div>
            </div>

            <div class="p-1 flex justify-between">
                <div>
                {{ __('medium') }}
                </div>
                <div class="badge bg-dark w-16">{{ $mediumPrivate->total ?? 0 }}</div>
            </div>
            
            <div class="p-1 flex justify-between">
                <div>
                {{ __('large') }}
                </div>
                <div class="badge bg-dark w-16">{{ $largePrivate->total ?? 0 }}</div>
            </div>

        </div>
    </div>
    <!-- control -->
    <div class="mt-1 flex gap-1">
        <a class="btn btn-sm btn-outline-primary" href="{{ route('stock.transfer.create',['fromBranch'=>$branch->id,'type'=>'private']) }}">
        {{ __('Transfer') }}
        </a>
    </div>
</div>