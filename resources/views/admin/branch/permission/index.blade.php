<x-layout.admin>

    <div class="mt-1 p-3 text-xl text-red-800">
        Permissions: {{ app()->getLocale() == 'ar' ? $branch->ar_name : $branch->en_name }}
    </div>

    <form action="{{ route('admin.branch.permission.update',$branch->id) }}" method="POST">
        @csrf

        @foreach($permissions as $permission)
        <div class="p-2 mt-2 bg-white ">
            <label>
                <input type="checkbox" name="permissionIds[]" value="{{ $permission->id }}" @if($permission->has_permission) checked @endif>
                {{ $permission->title }}
            </label>
            {{ $permission->description }}
        </div>
        @endforeach
        <button class="mt-4 btn btn-outline-primary">{{ __('Save') }}</button>
    </form>

</x-layout.admin>