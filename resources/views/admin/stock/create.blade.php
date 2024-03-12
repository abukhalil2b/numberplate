<x-layout.admin>
<div class="p-3 text-2xl">
    Send Plates From Main Stock To Main Branches
</div>

    <!-- private -->
    @if($type == 'private')
    @include('admin.stock._private_plate_create')
    @endif

    <!-- commercial -->
    @if($type == 'commercial')
    @include('admin.stock._commercial_plate_create')
    @endif

    <!-- diplomatic -->
    @if($type == 'diplomatic')
    @include('admin.stock._diplomatic_plate_create')
    @endif
    
    <!-- temporary -->
    @if($type == 'temporary')
    @include('admin.stock._temporary_plate_create')
    @endif

    <!-- export -->
    @if($type == 'export')
    @include('admin.stock._export_plate_create')
    @endif

    <!-- specific -->
    @if($type == 'specific')
    @include('admin.stock._specific_plate_create')
    @endif

    <!-- learner -->
    @if($type == 'learner')
    @include('admin.stock._learner_plate_create')
    @endif

    <!-- government -->
    @if($type == 'government')
    @include('admin.stock._government_plate_create')
    @endif
    
</x-layout.admin>