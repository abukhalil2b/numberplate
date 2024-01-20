<div>
    <div class="h-48 plate-box bg-commercial">
        <div class="text-xl">
            <h2 class="text-center">commercial</h2>
        </div>
        <div class="">

            <div class="p-1 flex justify-between">
                <div>
                    bike
                </div>
                <div class="badge bg-dark w-16">{{ $bikeCommercial->total ?? 0 }}</div>
            </div>

            <div class="p-1 flex justify-between">
                <div>
                    medium
                </div>
                <div class="badge bg-dark w-16">{{ $mediumCommercial->total ?? 0 }}</div>
            </div>
            
            <div class="p-1 flex justify-between">
                <div>
                    large
                </div>
                <div class="badge bg-dark w-16">{{ $largeCommercial->total ?? 0 }}</div>
            </div>
            
        </div>
    </div>
    <!-- control -->
    <div class="mt-1 flex gap-1">
        <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.stock.create',['branch'=>$branch->id,'type'=>'commercial']) }}">+ new plate</a>
        <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.stock.transfer.create',['fromBranch'=>$branch->id,'type'=>'commercial']) }}">transfer</a>
    </div>
</div>