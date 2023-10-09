<div>

    <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-failedprint')" class="text-xs">
        + {{__('failed print')}}
    </x-primary-button>


    <x-modal name="create-failedprint" :show="false" focusable>

        <form action="{{ route('item.failedprint.store') }}" method="POST" class="p-3 flex flex-col items-center">
            @csrf

            @include('inc._plate_size')

            <input type="hidden" name="bill_id" value="{{ $bill->id }}">

            <div class="mt-2 w-full flex gap-2">

                <x-primary-button type="submit" class="w-full flex justify-center">
                    save
                </x-primary-button>

                <x-secondary-button x-on:click.prevent="show = false" class="w-full flex justify-center">
                {{ __('cancel') }}
                </x-secondary-button>

            </div>

        </form>

    </x-modal>
</div>