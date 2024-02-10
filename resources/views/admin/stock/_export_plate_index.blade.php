<div>
    <div class="h-48 plate-box bg-export">
        <div class="text-xl">
            <h2 class="text-center">export</h2>
        </div>
        <div class="">

            <div class="p-1 flex justify-between">
                <div>
                    medium
                </div>
                <div class="badge bg-dark w-16">{{ $mediumExport->total ?? 0 }}</div>
            </div>

        </div>
    </div>
    <!-- control -->
    <div class="mt-1 flex gap-1">
        <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.stock.create',['branch'=>$branch->id,'type'=>'export']) }}">+ new plate</a>
    </div>
</div>