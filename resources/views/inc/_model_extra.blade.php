<div>

    <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-extra')" class="text-xs">
        + {{__('extra')}}
    </x-primary-button>


    <x-modal name="create-extra" :show="$errors->isNotEmpty()" focusable>

        <form action="{{ route('item.extra.store') }}" method="POST" class="p-3 flex flex-col items-center">
            @csrf

            <div class="mt-4 w-full ">
            description
                <x-textarea name="description"/>
            </div>

            <div class="mt-2 w-full flex flex-col items-center">
                price
                <x-text-input type="number" min="0.00" max="1000.00" step="0.01" name="price" class="w-60 mt-1 block" />
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