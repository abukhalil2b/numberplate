<x-app-layout>

    <div class="" x-data="plate">

        <div class="p-1 max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col items-center">


            <form method="post" action="{{ route('bill.plate.store') }}">
                @csrf

                <div class="mt-2 flex flex-wrap gap-1 justify-center">
                    <div class="private_plate" :class="plateType == 'private' ? 'private_plate_selected' : '' " @click="getPrivateCode">
                        {{ __('private') }}
                    </div>

                    <div class="commercial_plate" :class="plateType == 'commercial' ? 'commercial_plate_selected' : '' " @click="getCommercialCode">
                        {{ __('commercial') }}
                    </div>

                    @if( auth()->user()->hasPermission('diplomatic') )
                    <div class="diplomatic_plate " :class="plateType == 'diplomatic' ? 'diplomatic_plate_selected' : '' " @click="getDiplomaticCode">
                        {{ __('diplomatic') }}
                    </div>
                    @endif

                    @if( auth()->user()->hasPermission('temporary') )
                    <div class="temporary_plate" :class="plateType == 'temporary' ? 'temporary_plate_selected' : '' " @click="getTemporaryCode">
                        {{ __('temporary') }}
                    </div>
                    @endif

                    @if( auth()->user()->hasPermission('export') )
                    <div class="export_plate" :class="plateType == 'export' ? 'export_plate_selected' : '' " @click="getExportCode">
                        {{ __('export') }}
                    </div>
                    @endif

                    <div class="specific_plate" :class="plateType == 'specific' ? 'specific_plate_selected' : '' " @click="getSpecificCode">
                        {{ __('specific use') }}
                    </div>

                    @if( auth()->user()->hasPermission('learner') )
                    <div class="learner_plate" :class="plateType == 'learner' ? 'learner_plate_selected' : '' " @click="getLearnerCode">
                        {{ __('learner') }}
                    </div>
                    @endif

                    @if( auth()->user()->hasPermission('government') )
                    <div class="government_plate" :class="plateType == 'government' ? 'government_plate_selected' : '' " @click="getGovernmentCode">
                        {{ __('government') }}
                    </div>
                    @endif

                </div>

                <input type="hidden" x-model="plateType" name="type">

                <div class="mt-5 flex flex-wrap gap-1">
                    <template x-for="code in codes">
                        <div x-text="code" class="card cursor-pointer w-10" @click="selectedCode = code" :class="selectedCode == code ? 'selected' : '' "></div>
                    </template>
                </div>

 
                <div class="mt-5 flex gap-1 justify-center" x-cloak x-show="plateType != '' ">
                    <div class="text-center w-32">
                        {{ __('code') }}
                        <x-text-input type="text" name="plate_code" x-model="selectedCode" class="w-full mt-1 block" />
                    </div>
                    <div class="text-center w-32">
                        {{ __('number') }}
                        <x-text-input type="text" name="plate_num" class="w-full mt-1 block" />
                    </div>
                </div>

                <div class="mt-5 w-full flex justify-center" x-cloak x-show="plateType != '' ">
                    <div>
                        رصد
                        <x-text-input type="number" name="ref_num" class="w-64 mt-1 block" />
                    </div>
                </div>

                <div class="flex flex-col items-center">

                    <div class="mt-4 w-64 flex gap-1" x-cloak x-show="plateType != '' ">
                        <div @click="selectPairPlate" class="plate" :class="required == 'pair' ? 'plate_selected' : '' ">
                            {{ __('pair') }}
                        </div>
                        <div @click="selectSinglePlate" class="plate" :class="required == 'single' ? 'plate_selected' : '' ">
                            {{ __('single') }}
                        </div>

                        <input type="hidden" name="required" x-model="required">
                    </div>

                    @include('inc._plate_size')

                    <!-- sizeForStatement -->
                    <input type="hidden" name="sizeForStatement" x-model="sizeForStatement">
                </div>

                <div class="p-1 mt-6 flex flex-col justify-center items-center" x-data="{ extra_option:[]}">
                    <p class="mt-3">{{ __('Extra') }}:</p>


                    <label class="mt-2 border w-64 flex gap-1 items-center bg-white cursor-pointer">
                        <input class="rounded" type="checkbox" name="extra_option[]" value="fix plate" x-model="extra_option">
                        {{ __('fixing plate') }}:
                        <span class="text-red-700" x-cloak x-show="required == 'pair' ">1 R.O</span>
                        <span class="text-red-700" x-cloak x-show="required == 'single' ">0.5 R.O</span>
                    </label>

                    <label class="mt-2 border w-64 flex gap-1 items-center bg-white cursor-pointer">
                        <input class="rounded" type="checkbox" name="extra_option[]" value="buy frame" x-model="extra_option">
                        {{ __('buy frame') }}:
                        <span class="text-red-700" x-cloak x-show="required == 'pair' ">6 R.O</span>
                        <span class="text-red-700" x-cloak x-show="required == 'single' ">3 R.O</span>
                    </label>

                    <div x-cloak x-show="extra_option.length > 0">

                        <p class="mt-3 text-center">{{ __('Payment Method') }}:</p>
                        <label class="mt-2 border w-64 flex gap-1 items-center bg-white cursor-pointer">
                            <input type="radio" id="cash" name="payment_method" value="cash">
                            {{ __('cash') }}
                        </label>
                        <label class="mt-2 border w-64 flex gap-1 items-center bg-white cursor-pointer">
                            <input type="radio" id="visa" name="payment_method" value="visa">
                            {{ __('visa') }}
                        </label>

                    </div>

                </div>


                <div class="mt-6 flex justify-center">

                    <x-primary-button>
                        {{ __('save') }}
                    </x-primary-button>

                </div>

            </form>

            <div class="mt-4 w-full">
                @include('inc._latest_bill_index')
            </div>

        </div>

    </div>
    <footer class="p-5"></footer>

</x-app-layout>