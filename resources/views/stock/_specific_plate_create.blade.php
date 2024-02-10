<form action="{{ route('admin.stock.store',['branch'=>$branch->id,'type'=>'specific']) }}" method="POST">
    @csrf
    <div class="plate-box">
        <div class="text-xl">
            <h2 class="text-center">
                add specific plate to {{ app()->getLocale() == 'ar' ? $branch->ar_name : $branch->en_name }}
            </h2>
        </div>
        <div class="rounded bg-specific">

            <div class="p-1 flex justify-between">
                <div>
                {{ __('bike') }}
                </div>
                <div class="w-1/2">
                    <input class="form-input" type="number" value="0" name="bike">
                </div>
            </div>

            <div class="p-1 flex justify-between">
                <div>
                {{ __('medium') }}
                </div>
                <div class="w-1/2">
                    <input class="form-input" type="number" value="0" name="medium">
                </div>
            </div>

            <div class="p-1 flex justify-between">
                <div>
                {{ __('large') }}
                </div>
                <div class="w-1/2">
                    <input class="form-input" type="number" value="0" name="large">
                </div>
            </div>

        </div>

        <div class="mt-4">
        {{ __('Description if available') }}
        </div>
        <textarea name="description" class="border rounded w-full h-40"></textarea>
        <button class="mt-4 btn btn-outline-primary">{{ __('Save') }}</button>
    </div>
</form>