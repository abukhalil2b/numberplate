<div>

    <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-extra')" class="text-xs">
        + {{__('extra')}}
    </x-primary-button>


    <x-modal name="create-extra" :show="$errors->isNotEmpty()" focusable>

        <form action="{{ route('item.extra.store') }}" method="POST" class="p-3 flex flex-col items-start">
            @csrf

            <div class="mt-6 flex flex-col items-center" x-data="{ requiredFixingPlate:'',requiredBuyFrame:'' } ">

                    <div class="mt-2">{{ __('fixing plate') }}:</div>
                    <div class="w-72 flex gap-1 items-center">


                        <div class="plate text-xs w-24" :class="requiredFixingPlate == '' ? 'plate_selected' : 'plate' " @click="requiredFixingPlate =  '' ">{{ __('No') }}</div>
                        <div class="plate text-xs w-24" :class="requiredFixingPlate == 'pair' ? 'plate_selected' : 'plate' " @click="requiredFixingPlate =  'pair' ">{{ __('pair') }} 1 R.O</div>
                        <div class="plate text-xs w-24" :class="requiredFixingPlate == 'single' ? 'plate_selected' : 'plate' " @click="requiredFixingPlate = 'single' ">{{ __('single') }} 0.5 R.O</div>

                    </div>
                    <input type="hidden" x-model="requiredFixingPlate" name="requiredFixingPlate">

                    <div class="mt-2">{{ __('buy frame') }}:</div>
                    <div class="w-72 flex gap-1 items-center">


                        <div class="plate text-xs w-24" :class="requiredBuyFrame == '' ? 'plate_selected' : 'plate' " @click="requiredBuyFrame = '' ">{{ __('No') }}</div>
                        <div class="plate text-xs w-24" :class="requiredBuyFrame == 'pair' ? 'plate_selected' : 'plate' " @click="requiredBuyFrame = 'pair' ">{{ __('pair') }} 6 R.O</div>
                        <div class="plate text-xs w-24" :class="requiredBuyFrame == 'single' ? 'plate_selected' : 'plate' " @click="requiredBuyFrame = 'single' ">{{ __('single') }} 3 R.O</div>

                    </div>
                    <input type="hidden" x-model="requiredBuyFrame" name="requiredBuyFrame">

                    <div x-cloak x-show="requiredFixingPlate !='' || requiredBuyFrame !='' ">

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

            <input type="hidden" name="bill_id" value="{{ $bill->id }}">

            <div class="mt-4 w-full flex gap-2">

                <x-primary-button type="submit" class="w-full flex justify-center">
                    {{ __('save') }}
                </x-primary-button>
                <x-secondary-button x-on:click.prevent="show = false" class="w-full flex justify-center">
                    {{ __('cancel') }}
                </x-secondary-button>

            </div>

        </form>

    </x-modal>
</div>