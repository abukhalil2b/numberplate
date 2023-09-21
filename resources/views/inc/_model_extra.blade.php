<div>

    <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-extra')" class="text-xs">
        + {{__('extra')}}
    </x-primary-button>


    <x-modal name="create-extra" :show="$errors->isNotEmpty()" focusable>

        <form action="{{ route('item.extra.store') }}" method="POST" class="p-3 flex flex-col items-center">
            @csrf

            <div class="mt-6 flex flex-col gap-3" x-data="extraJob">

                <div class="mt-4 w-64">

                    <div @click="fixingPlateOnly" class="mt-3 card w-full cursor-pointer" :class="extra_option == 'fixing_plate' ? 'selectedCard' : '' ">
                        <span class="text-xs">fixing plate: 1 R.O</span>
                    </div>
                    <div @click="fixingPlateWithFrame" class="mt-1 card w-full cursor-pointer" :class="extra_option == 'frame_with_fixing_plate' ? 'selectedCard' : '' ">
                        <span class="text-xs">frame with fixing plate: 3 R.O</span>
                    </div>
                </div>


                <div class="w-full flex gap-1">
                    <div @click="cashPayment" class="mt-1 card w-full cursor-pointer" :class="payment_method == 'cash' ? 'selectedCard' : '' ">
                        <span class="text-xs">cash</span>
                    </div>
                    <div @click="visaPayment" class="mt-1 card w-full cursor-pointer" :class="payment_method == 'visa' ? 'selectedCard' : '' ">
                        <span class="text-xs">visa</span>
                    </div>
                </div>

                <input type="hidden" name="extra" x-model="extra">
                <input type="hidden" name="extra_option" x-model="extra_option">
                <input type="hidden" name="payment_method" x-model="payment_method">
            </div>


            <input type="hidden" name="bill_id" value="{{ $bill->id }}">

            <div class="mt-4 w-60 flex justify-center">

                <x-secondary-button type="submit" class="w-full flex justify-center">
                    save
                </x-secondary-button>

            </div>

            @if($errors->any())
            @foreach($errors->all() as $error)

            <div class="text-red-400">
                {{ $error}}
            </div>

            @endforeach
            @endif
        </form>

    </x-modal>
</div>