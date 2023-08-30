<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <div class="py-1" x-data="numbercodes">

        <div class="p-1 max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form method="post" action="{{ route('bill.store') }}" class="p-2 text-[#035b62]">
                @csrf

                <div class=" mt-5 w-full">
                    plate type
                </div>
                <div class="mt-2 flex flex-wrap gap-1">
                    <div class="plate  bg-yellow-300 text-black" :class="plateType == 'private' ? 'selected' : '' " @click="getPrivateCode">
                        private
                    </div>

                    <div class="plate bg-red-600 text-white" :class="plateType == 'commercial' ? 'selected' : '' " @click="getCommercialCode">
                        commercial
                    </div>

                    <div class="plate " :class="plateType == 'diplomatic' ? 'selected' : '' " @click="getDiplomaticCode">
                        diplomatic
                    </div>

                    <div class="plate bg-green-600 text-white" :class="plateType == 'temporary' ? 'selected' : '' " @click="getTemporaryCode">
                        temporary
                    </div>

                    <div class="plate bg-blue-600 text-white" :class="plateType == 'export' ? 'selected' : '' " @click="getExportCode">
                        export
                    </div>

                    <div class="plate bg-black text-white" :class="plateType == 'specific' ? 'selected' : '' " @click="getSpecificCode">
                        specific use
                    </div>

                    <div class="plate text-red-300" :class="plateType == 'learners' ? 'selected' : '' " @click="getLearnersCode">
                        learners
                    </div>

                    <div class="plate text-red-300" :class="plateType == 'government' ? 'selected' : '' " @click="getGovernmentCode">
                        government
                    </div>

                    <div class="plate " :class="plateType == 'other' ? 'selected' : '' " @click="getOtherCode">
                        other
                    </div>
                </div>

                <input type="hidden" x-model="plateType" name="type">

                <div class=" mt-5 w-full">
                    code
                </div>

                <div class="flex flex-wrap gap-1">
                    <template x-for="code in codes">
                        <div x-text="code" class="card cursor-pointer w-10" @click="selectedCode = code" :class="selectedCode == code ? 'selected' : '' "></div>
                    </template>
                </div>

                <div class="mt-5 flex gap-1">
                    <div class="text-center w-32">
                        code
                        <x-text-input type="text" name="plate_code" x-model="selectedCode" class="w-full mt-1 block" />
                    </div>
                    <div class="text-center w-32">
                        number
                        <x-text-input type="text" name="plate_num" class="w-full mt-1 block" />
                    </div>
                </div>

                <div class="mt-5 w-full">
                    رصد
                    <x-text-input type="number" name="ref_num" class="w-64 mt-1 block" />
                </div>

                <div x-data="plate">

                    <div class="mt-4 w-64 flex gap-1">
                        <label class="block w-24 p-1 border rounded bg-white">
                            <input type="radio" name="using" value="rop" checked>
                            ROP
                        </label>
                        <label class="block w-40 p-1 border rounded bg-white">
                            <input type="radio" name="using" value="transportation">
                            <span class="text-xs">TRANSPORTATION</span>
                        </label>
                    </div>

                    <div class="mt-4 w-64 flex gap-1">
                        <div @click="selectPairPlate" class="plate" :class="required == 'pair' ? 'selected' : '' ">
                            pair
                        </div>
                        <div @click="selectSinglePlate" class="plate" :class="required == 'single' ? 'selected' : '' ">
                            single
                        </div>

                        <input type="hidden" name="required" x-model="required">
                    </div>

                    @include('inc._plate_size')
                    <div>for statement: <span x-text='sizeForStatement'></span></div>
                </div>

                <div class="mt-6 flex flex-col gap-3" x-data="extraJob">

                    <div class="mt-4 w-64">
                        <div @click="toggleExtraOption" class="card w-full cursor-pointer" :class="extra ? 'selectedCard' : '' ">
                            <span class="text-xs" x-text="extra ? 'need extra ' : 'no extra jop' "></span>
                        </div>
                        <div x-cloak x-show="extra" @click="fixingPlateOnly" class="mt-1 card w-full cursor-pointer" :class="extra_option == 'fixing_plate' ? 'selectedCard' : '' ">
                            <span class="text-xs">fixing plate: 1 R.O</span>
                        </div>
                        <div x-cloak x-show="extra" @click="fixingPlateWithFrame" class="mt-1 card w-full cursor-pointer" :class="extra_option == 'frame_with_fixing_plate' ? 'selectedCard' : '' ">
                            <span class="text-xs">frame with fixing plate: 3 R.O</span>
                        </div>
                    </div>

                    <div x-cloak x-show="extra" class="mt-4 w-64 text-center">
                        <div class="w-full flex gap-1">
                            <div @click="cashPayment" class="mt-1 card w-full cursor-pointer" :class="payment_method == 'cash' ? 'selectedCard' : '' ">
                                <span class="text-xs">cash</span>
                            </div>
                            <div @click="visaPayment" class="mt-1 card w-full cursor-pointer" :class="payment_method == 'visa' ? 'selectedCard' : '' ">
                                <span class="text-xs">visa</span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="extra" x-model="extra">
                    <input type="hidden" name="extra_option" x-model="extra_option">
                    <input type="hidden" name="payment_method" x-model="payment_method">
                </div>

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