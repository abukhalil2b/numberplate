<x-app-layout>

    <div class="" x-data="plate">

        <div class="p-1 max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col items-center">

            <!-- plate size -->
            <div x-data="{ show:false }">
                <div @click="show = ! show" class="border rounded p-1 cursor-pointer w-40 text-center text-xs" :class="show ? 'bg-blue-100' : '' "> {{ __('show stock balance') }}</div>
                <div x-cloak x-show="show" class="p-1">
                    <div>
                        {{ __('small') }}:
                        {{$smallPlate->total}}
                    </div>
                    <div>
                        {{ __('medium') }}:
                        {{$mediumPlate->total}}
                    </div>
                    <div>
                        {{ __('large') }}:
                        {{$largePlate->total}}
                    </div>
                    <div>
                        {{ __('largeWithKhanjer') }}:
                        {{$largeWithKhanjerPlate->total}}
                    </div>
                    <div>
                        {{ __('bike') }}:
                        {{$bikePlate->total}}
                    </div>
                </div>
            </div>

            <form method="post" action="{{ route('bill.store') }}">
                @csrf

                <div class=" mt-5 w-full text-center">
                    {{ __('select plate type') }}
                </div>

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

                    <div class="temporary_plate" :class="plateType == 'temporary' ? 'temporary_plate_selected' : '' " @click="getTemporaryCode">
                        {{ __('temporary') }}
                    </div>

                    <div class="export_plate" :class="plateType == 'export' ? 'export_plate_selected' : '' " @click="getExportCode">
                        {{ __('export') }}
                    </div>

                    <div class="specific_plate" :class="plateType == 'specific' ? 'specific_plate_selected' : '' " @click="getSpecificCode">
                        {{ __('specific use') }}
                    </div>

                    <div class="learners_plate" :class="plateType == 'learners' ? 'learners_plate_selected' : '' " @click="getLearnersCode">
                        {{ __('learners') }}
                    </div>

                    <div class="government_plate" :class="plateType == 'government' ? 'government_plate_selected' : '' " @click="getGovernmentCode">
                        {{ __('government') }}
                    </div>

                    <div class="other_plate " :class="plateType == 'other' ? 'other_plate_selected' : '' " @click="getOtherCode">
                        {{ __('other') }}
                    </div>
                </div>

                <input type="hidden" x-model="plateType" name="type">

                <div class="mt-5 flex flex-wrap gap-1">
                    <template x-for="code in codes">
                        <div x-text="code" class="card cursor-pointer w-10" @click="selectedCode = code" :class="selectedCode == code ? 'selected' : '' "></div>
                    </template>
                </div>


                <div class="mt-5 flex gap-1 justify-center">
                    <div class="text-center w-32">
                        {{ __('code') }}
                        <x-text-input type="text" name="plate_code" x-model="selectedCode" class="w-full mt-1 block" />
                    </div>
                    <div class="text-center w-32">
                        {{ __('number') }}
                        <x-text-input type="text" name="plate_num" class="w-full mt-1 block" />
                    </div>
                </div>

                <div class="mt-5 w-full flex justify-center">
                    <div>
                        رصد
                        <x-text-input type="number" name="ref_num" class="w-64 mt-1 block" />
                    </div>
                </div>

                <div class="flex flex-col items-center">

                    <div class="mt-4 w-64 flex gap-1">
                        <div @click="selectPairPlate" class="plate" :class="required == 'pair' ? 'plate_selected' : '' ">
                            {{ __('pair') }}
                        </div>
                        <div @click="selectSinglePlate" class="plate" :class="required == 'single' ? 'plate_selected' : '' ">
                            {{ __('single') }}
                        </div>

                        <input type="hidden" name="required" x-model="required">
                    </div>

                    @include('inc._plate_size')
                    <div>for statement: <span x-text='sizeForStatement'></span></div>
                    <input type="hidden" name="sizeForStatement" x-model="sizeForStatement">
                </div>

                <div class="p-1 mt-6 flex flex-col justify-center items-center" x-data="{ extra_option:'no'}">
                    <p class="mt-3">{{ __('Extra') }}:</p>
                    <label class="mt-2 border w-64 flex gap-1 items-center bg-white cursor-pointer">
                        <input type="radio" id="no" name="extra_option" value="no" x-model="extra_option">
                        {{ __('NO') }}
                    </label>

                    <label class="mt-2 border w-64 flex gap-1 items-center bg-white cursor-pointer">
                        <input type="radio" id="fixing_plate" name="extra_option" value="fixing_plate" x-model="extra_option">
                        {{ __('fixing plate') }}: 1 R.O
                    </label>

                    <label class="mt-2 border w-64 flex gap-1 items-center bg-white cursor-pointer">
                        <input type="radio" id="frame_with_fixing_plate" name="extra_option" value="frame_with_fixing_plate" x-model="extra_option">
                        {{ __('frame with fixing plate') }}: 3 R.O
                    </label>

                    <div x-cloak x-show="extra_option != 'no' ">

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
</x-app-layout>