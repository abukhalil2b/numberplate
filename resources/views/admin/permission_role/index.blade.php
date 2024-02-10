<x-layout.admin>
    <div class="flex gap-2 items-center justify-start">
        <img src="{{ asset('assets/images/avatar.png') }}" alt="avatar" class="w-16 h-16 rounded">
        <div class="text-md font-bold"> {{ Str::upper($role->title) }} </div>
    </div>


    <form action="{{ route('admin.permission_role.update',$role->id) }}" method="POST">
        @csrf

        @foreach($rolePermissions as $permission)
        <div class="p-2 mt-2 bg-white ">
            <label>
                <input type="checkbox" name="permissionIds[]" value="{{ $permission->id }}" @if($permission->selected) checked @endif>
                {{ $permission->title }}
            </label>
            {{ $permission->description }}
        </div>
        @endforeach
        <button class="mt-4 btn btn-outline-primary">{{ __('Save') }}</button>
    </form>

</x-layout.admin>