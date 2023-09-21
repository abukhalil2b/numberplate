<x-app-layout>

    <div class="" x-data="numbercodes">

        <div class="p-1 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div x-data="{ show:false }">
                <div @click="show = ! show" class="border rounded p-1 cursor-pointer w-40 text-center text-xs" :class="show ? 'bg-blue-100' : '' "> show stock balance</div>
                <div x-cloak x-show="show" class="p-1">
                    <div>
                        small:
                        {{$smallPlate->total}}
                    </div>
                    <div>
                        medium:
                        {{$mediumPlate->total}}
                    </div>
                    <div>
                        large:
                        {{$largePlate->total}}
                    </div>
                    <div>
                        largeWithKhanjer:
                        {{$largeWithKhanjerPlate->total}}
                    </div>
                    <div>
                        bike:
                        {{$bikePlate->total}}
                    </div>
                </div>
            </div>
            <form method="post" action="{{ route('bill.store') }}">
                @csrf

                <div class=" mt-5 w-full">
                    select plate type
                </div>
                <div class="mt-2 flex flex-wrap gap-1">
                    <div class="private_plate" :class="plateType == 'private' ? 'private_plate_selected' : '' " @click="getPrivateCode">
                        private
                    </div>

                    <div class="commercial_plate" :class="plateType == 'commercial' ? 'commercial_plate_selected' : '' " @click="getCommercialCode">
                        commercial
                    </div>

                    <div class="diplomatic_plate " :class="plateType == 'diplomatic' ? 'diplomatic_plate_selected' : '' " @click="getDiplomaticCode">
                        diplomatic
                    </div>

                    <div class="temporary_plate" :class="plateType == 'temporary' ? 'temporary_plate_selected' : '' " @click="getTemporaryCode">
                        temporary
                    </div>

                    <div class="export_plate" :class="plateType == 'export' ? 'export_plate_selected' : '' " @click="getExportCode">
                        export
                    </div>

                    <div class="specific_plate" :class="plateType == 'specific' ? 'specific_plate_selected' : '' " @click="getSpecificCode">
                        specific use
                    </div>

                    <div class="learners_plate" :class="plateType == 'learners' ? 'learners_plate_selected' : '' " @click="getLearnersCode">
                        learners
                    </div>

                    <div class="government_plate" :class="plateType == 'government' ? 'government_plate_selected' : '' " @click="getGovernmentCode">
                        government
                    </div>

                    <div class="other_plate " :class="plateType == 'other' ? 'other_plate_selected' : '' " @click="getOtherCode">
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
                        <div @click="selectPairPlate" class="plate" :class="required == 'pair' ? 'plate_selected' : '' ">
                            pair
                        </div>
                        <div @click="selectSinglePlate" class="plate" :class="required == 'single' ? 'plate_selected' : '' ">
                            single
                        </div>

                        <input type="hidden" name="required" x-model="required">
                    </div>

                    @include('inc._plate_size')
                    <div>for statement: <span x-text='sizeForStatement'></span></div>
                    <input type="hidden" name="sizeForStatement" x-model="sizeForStatement">
                </div>

                <div class="mt-6 flex flex-col gap-3" x-data="extraJob">

                    <div class="mt-4 w-64">
                        <div @click="toggleExtraOption" class="h-12 card w-full cursor-pointer" :class="extra ? 'selectedCard' : '' ">
                            <span class="text-md" x-text="extra ? 'yes, need extra ' : 'no extra jop' "></span>
                        </div>
                        <div x-cloak x-show="extra" @click="fixingPlateOnly" class="mt-3 card w-full cursor-pointer" :class="extra_option == 'fixing_plate' ? 'selectedCard' : '' ">
                            <span class="text-xs">fixing plate: 1 R.O</span>
                        </div>
                        <div x-cloak x-show="extra" @click="fixingPlateWithFrame" class="mt-1 card w-full cursor-pointer" :class="extra_option == 'frame_with_fixing_plate' ? 'selectedCard' : '' ">
                            <span class="text-xs">frame with fixing plate: 3 R.O</span>
                        </div>
                    </div>

                    <div x-cloak x-show="extra" class="mt-2 w-64 text-center">
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


            <div class="mt-4">
                @include('inc._latest_bill_index')
            </div>


        </div>

    </div>
</x-app-layout>