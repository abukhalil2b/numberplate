<x-app-layout>
    <div class="p-3 mt-4 text-center">
        change language | تغير لغة البرنامج
    </div>
    <div class="flex items-center justify-center gap-2">
        <a class="block bg-gray-100 border rounded p-1 w-24 text-xs text-center" href="{{ route('localization.store','en') }}">english</a>
        <a class="block bg-gray-100 border rounded p-1 w-24 text-xs text-center" href="{{ route('localization.store','ar') }}">اللغة العربية</a>
    </div>

    <div class="p-3 mt-4 text-center">
        stock | المخزن
    </div>

    <div class="p-4 grid grid-cols-1 gap-6 pt-5 md:grid-cols-2 lg:grid-cols-4">

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

</x-app-layout>