<div>

    <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-printing')" class="text-xs">
        + {{__('printing')}}
    </x-primary-button>


    <x-modal name="create-printing" :show="$errors->isNotEmpty()" focusable>

        <form action="{{ route('item.printing.store') }}" method="POST" class="p-3 flex flex-col items-start">
            @csrf

            <div class="flex flex-col items-center" x-data="{requiredPrintingPlate:0 } ">

                <div class="mt-2 py-2">{{ __('printing plate') }}:</div>

                <div class="flex flex-wrap gap-1 items-center">
                    <div class="plate text-xs w-24" :class="requiredPrintingPlate == 0 ? 'plate_selected' : 'plate' " @click="requiredPrintingPlate =  0 ">{{ __('No') }}</div>

                    <div class="plate flex-col text-xs w-24" :class="requiredPrintingPlate == '4' ? 'plate_selected' : 'plate' " @click="requiredPrintingPlate =  '4' ">
                        {{ __('single medium') }}
                        <div>4 R.O</div>
                    </div>

                    <div class="plate flex-col text-xs w-24" :class="requiredPrintingPlate == '8' ? 'plate_selected' : 'plate' " @click="requiredPrintingPlate = '8' ">
                        {{ __('pair medium') }}
                        <div> 8 R.O</div>
                    </div>

                    <div class="plate flex-col text-xs w-24" :class="requiredPrintingPlate == '6' ? 'plate_selected' : 'plate' " @click="requiredPrintingPlate =  '6' ">
                        {{ __('single large') }}
                        <div>6 R.O</div>
                    </div>

                    <div class=" plate flex-col text-xs w-24" :class="requiredPrintingPlate == '12' ? 'plate_selected' : 'plate' " @click="requiredPrintingPlate = '12' ">
                        {{ __('single large') }}
                        <div> 8 R.O</div>
                    </div>

                </div>
                <input type="hidden" x-model="requiredPrintingPlate" name="requiredPrintingPlate">

                <div x-cloak x-show="requiredPrintingPlate !=0 ">

                    <p class="mt-3 text-center">{{ __('Payment Method') }}:</p>
                    <div class="mt-3 w-80 flex gap-3">
                        <label class="py-3 px-1 border rounded w-full flex gap-1 items-center bg-white cursor-pointer">
                            <input type="radio" id="cash" name="payment_method" value="cash" @if($bill->payment_method == 'cash') checked @endif>
                            {{ __('cash') }}
                        </label>
                        <label class="py-3 px-1 border rounded w-full flex gap-1 items-center bg-white cursor-pointer">
                            <input type="radio" id="visa" name="payment_method" value="visa" @if($bill->payment_method == 'visa') checked @endif>
                            {{ __('visa') }}
                        </label>
                    </div>

                </div>

            </div>

            <input type="hidden" name="bill_id" value="{{ $bill->id }}">
            <input type="hidden" name="type" value="{{ $bill->type }}">

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