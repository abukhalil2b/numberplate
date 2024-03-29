<div>

    <div x-data="" x-on:click.prevent="$dispatch('open-modal', 'transfer-stock{{ $branch->id }}')" class="card text-xs">
                    
    {{ $branch->en_name }} | {{ $branch->ar_name }}

    </div>


    <x-modal name="transfer-stock{{ $branch->id }}" :show="$errors->isNotEmpty()" focusable>

        <form action="{{ route('stock.transfer.store') }}" method="POST" class="p-3 flex flex-col items-center">
            @csrf

            <div class="mt-4 w-full ">
                description

                <x-textarea name="description" />
            </div>

            <div class="mt-4 w-full ">
            {{ app()->getLocale() == 'ar' ? $branch->ar_name :  $branch->ar_name }}
            <input type="hidden" name="branch_id" value="{{ $branch->id }}">
            </div>

            <div class="mt-4 w-full ">
            plate size

                <select name="size" class="w-full">
                    <option value="small">small</option>
                    <option value="medium">medium</option>
                    <option value="large">large</option>
                    <option value="largeWithKhanjer">Large With Khanjer</option>
                    <option value="bike">bike</option>
                </select>
            </div>

            <div class="mt-2 w-full flex flex-col items-center">
                quantity
                <x-text-input type="number" name="quantity" class="w-60 mt-1 block" />
            </div>


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