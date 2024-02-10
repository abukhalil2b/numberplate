<x-layout.admin>

    <div class="mt-1 p-3 text-xl text-red-800">
        {{ __('Branches were managed by') }}: {{ app()->getLocale() == 'ar' ? $user->ar_name : $user->en_name }}
    </div>

    <form action="{{ route('admin.branch.manage_permission.update',$user->id) }}" method="POST">
        @csrf

        <div class="sm:flex flex-wrap gap-1">
        @foreach($branches as $branch)
        <div class="p-2 mt-2 bg-white sm:w-52 ">
            <label>
                <input class="rounded" type="checkbox" name="branchIds[]" value="{{ $branch->id }}" @if($branch->selected) checked @endif>
                {{ app()->getLocale() == 'ar' ? $branch->ar_name : $branch->en_name }}
            </label>
        </div>
        @endforeach
        </div>
        <button class="mt-4 btn btn-outline-primary">{{ __('Save') }}</button>
    </form>

</x-layout.admin>