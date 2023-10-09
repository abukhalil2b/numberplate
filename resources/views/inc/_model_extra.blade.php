<div>

    <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-extra')" class="text-xs">
        + {{__('extra')}}
    </x-primary-button>


    <x-modal name="create-extra" :show="$errors->isNotEmpty()" focusable>

        <form action="{{ route('item.extra.store') }}" method="POST" class="p-3 flex flex-col items-start">
            @csrf

            <p class="mt-3">{{ __('Extra') }}:</p>
            <label class="block mt-2">
                <input type="radio" name="extra_option" value="no" checked>
                {{ __('NO') }}
            </label>

            <label class="block mt-2">
                <input type="radio" name="extra_option" value="fixing_plate">
                {{ __('fixing plate') }}: 1 R.O
            </label>

            <label class="block mt-2">
                <input type="radio" name="extra_option" value="frame_with_fixing_plate">
                {{ __('frame with fixing plate') }}: 3 R.O
            </label>

            <p class="mt-3">{{ __('Payment Method') }}:</p>
            <label class="block mt-2">
                <input type="radio" name="payment_method" value="cash">
                {{ __('cash') }}
            </label>
            <label class="block mt-2">
                <input type="radio" name="payment_method" value="visa">
                {{ __('visa') }}
            </label>

            <input type="hidden" name="bill_id" value="{{ $bill->id }}">

            <div class="mt-4 w-full flex gap-2">

                <x-primary-button type="submit" class="w-full flex justify-center">
                    {{ __('save') }}
                </x-primary-button>
                <x-secondary-button x-on:click.prevent="show = false"  class="w-full flex justify-center">
                {{ __('cancel') }}
                </x-secondary-button>

            </div>

        </form>

    </x-modal>
</div>