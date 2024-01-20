<div>
    <div class="h-48 plate-box bg-specific">
        <div class="text-xl">
            <h2 class="text-center">specific</h2>
        </div>
        <div class="">

            <div class="p-1 flex justify-between">
                <div>
                    bike
                </div>
                <div class="badge bg-dark w-16">{{ $bikeSpecific->total ?? 0 }}</div>
            </div>

            <div class="p-1 flex justify-between">
                <div>
                    medium
                </div>
                <div class="badge bg-dark w-16">{{ $mediumSpecific->total ?? 0 }}</div>
            </div>

            <div class="p-1 flex justify-between">
                <div>
                    large
                </div>
                <div class="badge bg-dark w-16">{{ $largeSpecific->total ?? 0 }}</div>
            </div>

        </div>
    </div>
    <!-- control -->
    <div class="mt-1 flex gap-1">
        <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.stock.create',['branch'=>$branch->id,'type'=>'specific']) }}">+ new plate</a>
        <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.stock.transfer.create',['fromBranch'=>$branch->id,'type'=>'specific']) }}">transfer</a>
    </div>
</div>