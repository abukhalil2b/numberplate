<div>

    <a href="#" x-data="" x-on:click.prevent="$dispatch('open-modal', 'update_price{{$plateItem->id}}')" class="p-1 font-bold text-warning text-xs">
        {{ __('Update') }}
    </a>

    <x-modal name="update_price{{$plateItem->id}}" :show="$errors->isNotEmpty()" focusable>
        <div class="flex items-center justify-between p-5 font-semibold text-lg dark:text-white">
            {{ __('Update') }}
            <button type="button" @click="toggle" class="text-white-dark hover:text-dark">

                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <form action="{{ route('item.price_update',$plateItem->id) }}" method="POST" class="p-3 flex flex-col items-start">
            @csrf

            <div class="mt-5 {{ $errors->get('price') ? 'has-error':'' }} ">
                <label for="price"> {{ __('price') }}</label>
                <input id="price" name="price" type="number" step="any" placeholder="0.000" class="form-input" value="{{ $plateItem->price }}" />
            </div>


            <div class="mt-4 w-full flex gap-2">
                <x-primary-button type="submit" class="w-full flex justify-center">
                    {{ __('Update') }}
                </x-primary-button>
                <x-secondary-button x-on:click.prevent="show = false" class="w-full flex justify-center">
                    {{ __('cancel') }}
                </x-secondary-button>
            </div>
        </form>
    </x-modal>
</div>
