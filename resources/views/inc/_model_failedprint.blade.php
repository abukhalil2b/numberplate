<div>

    <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-failedprint')" class="text-xs">
        + {{__('failed print')}}
    </x-primary-button>


    <x-modal name="create-failedprint" :show="$errors->isNotEmpty()" focusable>

        <form action="{{ route('item.failedprint.store') }}" method="POST" class="p-3 flex flex-col items-center">
            @csrf

            @include('inc._plate_size')

            <input type="hidden" name="bill_id" value="{{ $bill->id }}">

            <div class="mt-2 w-60 flex justify-center">

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