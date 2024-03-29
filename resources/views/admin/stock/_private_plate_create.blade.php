<form action="{{ route('admin.stock.store',['branch'=>$branch->id,'type'=>'private']) }}" method="POST">
    @csrf
    <div class="plate-box">
        <div class="text-xl">
            <h2 class="text-center">
                add private plate to 
            {{ app()->getLocale() == 'ar' ? $branch->ar_name : $branch->en_name }}
            </h2>
        </div>
        <div class="rounded bg-private">

            <div class="p-1 flex justify-between">
                <div>
                    bike
                </div>
                <div class="w-1/2">
                    <input class="form-input" type="number" value="0" name="bike">
                </div>
            </div>

            <div class="p-1 flex justify-between">
                <div>
                    small
                </div>
                <div class="w-1/2">
                    <input class="form-input" type="number" value="0" name="small">
                </div>
            </div>

            <div class="p-1 flex justify-between">
                <div>
                    medium
                </div>
                <div class="w-1/2">
                    <input class="form-input" type="number" value="0" name="medium">
                </div>
            </div>

            <div class="p-1 flex justify-between">
                <div>
                    large
                </div>
                <div class="w-1/2">
                    <input class="form-input" type="number" value="0" name="large">
                </div>
            </div>

        </div>

        <div class="mt-4">
            Description if available
        </div>
        <textarea name="description" class="border rounded w-full h-40"></textarea>
        <button class="mt-4 btn btn-outline-primary">{{ __('Transfer') }}</button>
    </div>
</form>