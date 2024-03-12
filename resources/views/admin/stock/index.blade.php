<x-layout.admin>


    <div class="p-3 text-center text-xl">
        Stock: {{ app()->getLocale() == 'ar' ? $branch->ar_name : $branch->en_name }}
    </div>

    <div class="grid grid-cols-1 gap-6 pt-5 md:grid-cols-2 lg:grid-cols-4">

        <!-- private -->
        @include('admin.stock._private_plate_index')

        <!-- commercial  -->
        @include('admin.stock._commercial_plate_index')

        <!-- diplomatic -->
        @include('admin.stock._diplomatic_plate_index')
 
        <!-- specific -->
        @include('admin.stock._specific_plate_index')

        <!-- learner -->
        @include('admin.stock._learner_plate_index')

        <!-- government -->
        @include('admin.stock._government_plate_index')


    </div>

    <div class="mt-4 p-3 text-xs">
        <div class="p-1 text-xl">
            operations
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