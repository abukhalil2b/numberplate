<div>

    <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-failedprint')" class="text-xs">
        + {{__('failed print')}}
    </x-primary-button>

    <x-modal name="create-failedprint" :show="false" focusable>

        <form action="{{ route('item.failedprint.store') }}" method="POST" class="p-3">
            @csrf

            <div class="p-5">
                {{ __('printing was failed') }}
            </div>
            <!-- plate is single -->
            @if($bill->required == 'single')
            <label class="p-3 flex gap-2 items-center bg-gray-400 w-full ">
                <input type="checkbox" checked name="itemId" value="{{ $plateItems[0]->id }}">
                <div>
                    {{ __($plateItems[0]->type)  }} {{ __($plateItems[0]->size)  }}
                </div>
            </label>
            <input type="hidden" name="plate_failed" value="single">
            @endif

            @if($bill->required == 'pair')
            <!-- plate is pair both are same size -->
            @if($bill->successPlateItems->count() == 1)
            <div class="mt-1 flex gap-2 items-center">
                <input type="checkbox" checked name="itemId" value="{{ $plateItems[0]->id }}">
                <div>
                    {{ __($plateItems[0]->type)  }} {{ __($plateItems[0]->size)  }}
                </div>
            </div>
            <input type="hidden" name="plate_failed" value="pair_same_size">
            @endif

            <!-- plate is pair in different size -->
            @if($bill->successPlateItems->count() == 2)
            <div>
                <label class="p-3 flex gap-2 items-center bg-gray-400 w-full ">
                    <input type="checkbox" name="itemIds[]" value="{{ $plateItems[0]->id }}">
                    <div>
                        {{ __($plateItems[0]->type)  }} {{ __($plateItems[0]->size)  }}
                    </div>
                </label>

                <label class="p-3 flex gap-2 items-center bg-gray-400 w-full ">
                    <input type="checkbox" name="itemIds[]" value="{{ $plateItems[1]->id }}">
                    <div>
                        {{ __($plateItems[1]->type)  }} {{ __($plateItems[1]->size)  }}
                    </div>
                </label>
            </div>
            <input type="hidden" name="plate_failed" value="pair_in_different_size">
            @endif
            @endif

            <input type="hidden" name="bill_id" value="{{ $bill->id }}">

            <div class="mt-2 w-full flex gap-2">

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