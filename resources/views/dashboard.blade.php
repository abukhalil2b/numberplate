<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <div class="py-1" x-data="numbercodes">

        <div class="p-1 max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form method="post" action="{{ route('bill.store') }}" class="p-2 text-[#035b62]">
                @csrf

                <div class="text-xl mt-5 w-full">
                    نوع اللوحة
                </div>
                <div class="grid grid-cols-4 gap-1">
                    <div class="card cursor-pointer" :class="plateType == 'private' ? 'selected' : '' " @click="getPrivateCode">
                        private
                    </div>

                    <div class="card cursor-pointer" :class="plateType == 'commercial' ? 'selected' : '' " @click="getCommercialCode">
                        commercial
                    </div>

                    <div class="card cursor-pointer" :class="plateType == 'diplomatic' ? 'selected' : '' " @click="getDiplomaticCode">
                        diplomatic
                    </div>

                    <div class="card cursor-pointer" :class="plateType == 'test' ? 'selected' : '' " @click="getTestCode">
                        test
                    </div>

                    <div class="card cursor-pointer" :class="plateType == 'export' ? 'selected' : '' " @click="getExportCode">
                        export
                    </div>

                    <div class="card cursor-pointer" :class="plateType == 'limit use' ? 'selected' : '' " @click="getLimitUseCode">
                        limit use
                    </div>
                </div>

                <input type="hidden" x-model="plateType" name="type">

                <div class="text-xl mt-5 w-full">
                    code
                </div>

                <div class="flex gap-1">
                    <template x-for="code in codes">
                        <div x-text="code" class="card cursor-pointer w-10" @click="selectedCode = code" :class="selectedCode == code ? 'selected' : '' "></div>
                    </template>
                </div>

                <div class="mt-5 flex gap-1">
                    <div class=" text-xl w-32">
                        code
                        <x-text-input type="text" name="plate_code" x-model="selectedCode" class="w-32 mt-1 block" />
                    </div>
                    <div class=" text-xl w-32">
                        number
                        <x-text-input type="number" name="plate_num" class="w-32 mt-1 block" />
                    </div>
                </div>

                <div class="mt-5 text-xl w-full">
                    رصد
                    <x-text-input type="number" name="ref_num" class="w-64 mt-1 block" />
                </div>

                @include('inc._plate_size')

                <div class="mt-6 ">

                    <x-primary-button class="ml-3 w-14">
                        حفظ
                    </x-primary-button>

                </div>

            </form>


            @include('inc._bill_index')


        </div>

    </div>
</x-app-layout>