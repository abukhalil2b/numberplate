<x-layout.admin>
<h1 class="text-3xl text-center text-red-600">UNDER CONSTRUCTION</h1>
    <div class="p-3 text-center text-xl">
        Stock: {{ app()->getLocale() == 'ar' ? $branch->ar_name : $branch->en_name }}
    </div>

    <div class="grid grid-cols-1 gap-6 pt-5 md:grid-cols-2 lg:grid-cols-4">

        <!-- private -->
        @if (in_array('private', $branchHasPermissionOnplateTypes))
        @include('admin.stock._private_plate_index')
        @endif

        <!-- commercial  -->
        @if (in_array('commercial', $branchHasPermissionOnplateTypes))
        @include('admin.stock._commercial_plate_index')
        @endif

        <!-- diplomatic -->
        @if (in_array('diplomatic', $branchHasPermissionOnplateTypes))
        @include('admin.stock._diplomatic_plate_index')
        @endif
 
        <!-- specific -->
        @if (in_array('specific', $branchHasPermissionOnplateTypes))
        @include('admin.stock._specific_plate_index')
        @endif

        <!-- learner -->
        @if (in_array('learner', $branchHasPermissionOnplateTypes))
        @include('admin.stock._learner_plate_index')
        @endif

        <!-- government -->
        @if (in_array('government', $branchHasPermissionOnplateTypes))
        @include('admin.stock._government_plate_index')
        @endif


    </div>

    <div class="mt-4 p-3 text-xs">
        <div class="p-1 text-xl">
            {{ __('Operations') }}
        </div>
        @foreach($logs as $log)

        <div class="mt-1 flex gap-1 rounded border border-red-900 p-1 bg-white">
            <div class="w-20">{{ $log->issue_date }}</div>
            <div class="w-20">{{ $log->type }}</div>
            <div class="w-20">{{ $log->size }}</div>
            <div class="w-20">{{ $log->quantity }} pcs</div>
            <div class="">{{ $log->description }}</div>
        </div>
        
        @endforeach
    </div>

</x-layout.admin>