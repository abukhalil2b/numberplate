<x-layout.admin>
    <form action="{{ route('admin.permission_role.update',$role->id) }}">
    <!-- vertically centered -->
    <div class="mb-5">
        <div class="p-5 text-center text-3xl text-blue-800">
            {{ $role->title }}
        </div>
       <div class="flex flex-wrap gap-2">
       @foreach($rolePermissions as $permission)
        <label class="w-72 text-xs p-3 border rounded bg-white">
            <input class="rounded mx-1" name="permissionIds[]" type="checkbox" value="{{ $permission->id }}" @if($permission->selected) checked @endif>
            {{ $permission->title }}
        </label>
        @endforeach
       </div>
    </div>
    <button class="btn btn-outline-primary">update</button>
    </form>
</x-layout.admin>