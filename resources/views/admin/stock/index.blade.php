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

        <!-- temporary -->
        @include('admin.stock._temporary_plate_index')

        <!-- export -->
        @include('admin.stock._export_plate_index')

        <!-- specific -->
        @include('admin.stock._specific_plate_index')

        <!-- learner -->
        @include('admin.stock._learner_plate_index')

        <!-- government -->
        @include('admin.stock._government_plate_index')
        
        
    </div>

</x-layout.admin>