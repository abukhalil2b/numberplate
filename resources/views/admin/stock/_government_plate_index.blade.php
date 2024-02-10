<div>
    <div class="h-48 plate-box bg-government">
        <div class="text-xl">
            <h2 class="text-center">government</h2>
        </div>
        <div class="">

            <div class="p-1 flex justify-between">
                <div>
                    bike
                </div>
                <div class="badge bg-dark w-16">{{ $bikeGovernment->total ?? 0 }}</div>
            </div>

            <div class="p-1 flex justify-between">
                <div>
                    medium
                </div>
                <div class="badge bg-dark w-16">{{ $mediumGovernment->total ?? 0 }}</div>
            </div>

            <div class="p-1 flex justify-between">
                <div>
                    large
                </div>
                <div class="badge bg-dark w-16">{{ $largeGovernment->total ?? 0 }}</div>
            </div>
            
            @if(auth()->user()->permission('large with khanjer'))
            <div class="p-1 flex justify-between">
                <div>
                    large with khanjer
                </div>
                <div class="badge bg-dark w-16">{{ $largeWithKhanjerGovernment->total ?? 0 }}</div>
            </div>
            @endif

        </div>
    </div>
    <!-- control -->
    <div class="mt-1 flex gap-1">
        <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.stock.create',['branch'=>$branch->id,'type'=>'government']) }}">+ new plate</a>
    </div>
</div>