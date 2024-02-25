<x-app-layout>

    <div class="" x-data="plate">

        <div class="p-1 max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col items-center">

            <!-- alert -->
            @if(session('message'))
            <div class="flex items-center rounded bg-danger-light p-3.5 text-danger dark:bg-danger-dark-light">
                {{ __(session('message')) }}
            </div>
            @endif

            <form method="post" action="{{ route('bill.plate.store') }}">
                @csrf

                <div class="mt-2 w-80 grid grid-cols-3 gap-1">
                    <div class="private_plate" :class="plateType == 'private' ? 'private_plate_selected' : '' " @click="selectPlateType('private')">
                        {{ __('private') }}
                    </div>

                    <div class="commercial_plate" :class="plateType == 'commercial' ? 'commercial_plate_selected' : '' " @click="selectPlateType('commercial')">
                        {{ __('commercial') }}
                    </div>

                    @if( auth()->user()->hasPermission('diplomatic') )
                    <div class="diplomatic_plate " :class="plateType == 'diplomatic' ? 'diplomatic_plate_selected' : '' " @click="selectPlateType('diplomatic')">
                        {{ __('diplomatic') }}
                    </div>
                    @endif

                    @if( auth()->user()->hasPermission('temporary') )
                    <div class="temporary_plate" :class="plateType == 'temporary' ? 'temporary_plate_selected' : '' " @click="selectPlateType('temporary')">
                        {{ __('temporary') }}
                    </div>
                    @endif

                    @if( auth()->user()->hasPermission('export') )
                    <div class="export_plate" :class="plateType == 'export' ? 'export_plate_selected' : '' " @click="selectPlateType('export')">
                        {{ __('export') }}
                    </div>
                    @endif

                    <div class="specific_plate" :class="plateType == 'specific' ? 'specific_plate_selected' : '' " @click="selectPlateType('specific')">
                        {{ __('specific use') }}
                    </div>

                    @if( auth()->user()->hasPermission('learner') )
                    <div class="learner_plate" :class="plateType == 'learner' ? 'learner_plate_selected' : '' " @click="selectPlateType('learner')">
                        {{ __('learner') }}
                    </div>
                    @endif

                    @if( auth()->user()->hasPermission('government') )
                    <div class="government_plate" :class="plateType == 'government' ? 'government_plate_selected' : '' " @click="selectPlateType('government')">
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


                <div class="mt-5 w-80 flex gap-1 justify-center" x-cloak x-show="plateType != '' ">
                    <div class="text-center">
                        {{ __('code') }}
                        <x-text-input type="text" name="plate_code" class="w-full mt-1 block" x-model="selectedCode"/>
                    </div>
                    <div class="text-center">
                        {{ __('number') }}
                        <x-text-input type="text" name="plate_num" class="w-full mt-1 block" />
                    </div>
                </div>

                <div class="mt-5 w-full flex justify-center" x-cloak x-show="showROPBillNumber">
                    <div>
                        {{ __('ROP Bill Number') }}
                        <x-text-input type="number" name="ref_num" class="w-80 mt-1 block" />
                    </div>
                </div>

                <div class="flex flex-col items-center" x-cloak x-show="showPrintingOption">

                    <div class="mt-4 w-80 flex gap-1" x-cloak x-show="plateType != '' ">
                        <div @click="selectPairPlate" class="plate w-full" :class="required == 'pair' ? 'plate_selected' : '' ">
                            {{ __('pair') }}
                        </div>
                        <div @click="selectSinglePlate" class="plate w-full" :class="required == 'single' ? 'plate_selected' : '' ">
                            {{ __('single') }}
                        </div>

                        <input type="hidden" name="required" x-model="required">
                    </div>

                    @include('inc._plate_size')

                    <!-- sizeForStatement -->
                    <input type="hidden" name="sizeForStatement" x-model="sizeForStatement">
                </div>

                <div class="mt-6 flex flex-col items-center" x-cloak x-show="showFixingBuySaveBtn">

                    <div class="mt-2">{{ __('fixing plate') }}:</div>
                    <div class="w-80 flex gap-1 items-center">


                        <div class="plate text-[11px] w-full" :class="requiredFixingPlate == '' ? 'plate_selected' : 'plate' " @click="requiredFixingPlate =  '' ">{{ __('No') }}</div>
                        <div class="plate text-[11px] w-full" :class="requiredFixingPlate == 'pair' ? 'plate_selected' : 'plate' " @click="requiredFixingPlate =  'pair' ">{{ __('pair') }} 1 R.O</div>
                        <div class="plate text-[11px] w-full" :class="requiredFixingPlate == 'single' ? 'plate_selected' : 'plate' " @click="requiredFixingPlate = 'single' ">{{ __('single') }} 0.5 R.O</div>

                    </div>
                    <input type="hidden" x-model="requiredFixingPlate" name="requiredFixingPlate">

                    <div class="mt-2">{{ __('buy frame') }}:</div>
                    <div class="w-80 flex gap-1 items-center">


                        <div class="plate text-[11px] w-full" :class="requiredBuyFrame == '' ? 'plate_selected' : 'plate' " @click="requiredBuyFrame = '' ">{{ __('No') }}</div>
                        <div class="plate text-[11px] w-full" :class="requiredBuyFrame == 'pair' ? 'plate_selected' : 'plate' " @click="requiredBuyFrame = 'pair' ">{{ __('pair') }} 6 R.O</div>
                        <div class="plate text-[11px] w-full" :class="requiredBuyFrame == 'single' ? 'plate_selected' : 'plate' " @click="requiredBuyFrame = 'single' ">{{ __('single') }} 3 R.O</div>

                    </div>
                    <input type="hidden" x-model="requiredBuyFrame" name="requiredBuyFrame">

                    <!-- price for plate (not ready)-->
                    <div class="w-80 mt-6 flex flex-col justify-center items-center" x-cloak x-show="showPriceInput(plateType)">
                        <p class="py-3 text-center">{{ __('Price for Plate') }}:</p>
                        <div class="w-full flex gap-1 items-center">
                            <div class="plate text-[11px] w-full" :class="priceForPlate == 0 ? 'plate_selected' : 'plate' " @click="priceForPlate =  0 ">{{ __('No') }}</div>
                            <div class="plate text-[11px] w-full" :class="priceForPlate == 1 ? 'plate_selected' : 'plate' " @click="priceForPlate =  1 ">{{ __('Yes') }}</div>
                        </div>
                        <template x-if="priceForPlate == 1">
                            <x-text-input type="number" name="plate_price" class="w-full mt-1 block" step="any" />
                        </template>
                    </div>
                    <!-- / price for plate -->

                    <div x-cloak x-show="requiredFixingPlate !='' || requiredBuyFrame !='' ">

                        <p class="mt-3 text-center">{{ __('Payment Method') }}:</p>
                        <div class="mt-3 w-80 flex gap-3">
                            <label class="py-3 px-1 border rounded w-full flex gap-1 items-center bg-white cursor-pointer">
                                <input type="radio" id="cash" name="payment_method" value="cash">
                                {{ __('cash') }}
                            </label>
                            <label class="py-3 px-1 border rounded w-full flex gap-1 items-center bg-white cursor-pointer">
                                <input type="radio" id="visa" name="payment_method" value="visa">
                                {{ __('visa') }}
                            </label>
                        </div>

                    </div>


                <div class="mt-10 flex justify-center" onclick="document.getElementById('btn-save').style.display = 'none' ">

                    <button id="btn-save" class="btn btn-outline-primary w-80 h-14"> {{ __('Save') }}</button>

                </div>

                </div>

            </form>

            <div class="mt-4 w-full">
                @include('inc._latest_bill_index')
            </div>

        </div>

    </div>
    <footer class="p-5"></footer>

</x-app-layout>