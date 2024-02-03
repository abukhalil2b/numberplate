<div>

    <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-extra')" class="text-xs">
        + {{__('extra')}}
    </x-primary-button>


    <x-modal name="create-extra" :show="$errors->isNotEmpty()" focusable>

        <form action="{{ route('item.extra.store') }}" method="POST" class="p-3 flex flex-col items-start">
            @csrf

            <div class="p-1 mt-6 flex flex-col justify-center items-center" x-data="{ extra_option:[]}" x-init="required='{{$bill->required}}'">
                <p class="mt-3">{{ __('Extra') }}: {{ __($bill->required) }}</p>


                <label class="mt-2 border w-64 flex gap-1 items-center bg-white cursor-pointer">
                    <input type="checkbox" name="extra_option[]" value="fix plate" x-model="extra_option">
                    {{ __('fixing plate') }}:
                    <span class="text-red-700" x-cloak x-show="required == 'pair' ">1 R.O</span>
                    <span class="text-red-700" x-cloak x-show="required == 'single' ">0.5 R.O</span>
                </label>

                <label class="mt-2 border w-64 flex gap-1 items-center bg-white cursor-pointer">
                    <input type="checkbox" name="extra_option[]" value="buy frame" x-model="extra_option">
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