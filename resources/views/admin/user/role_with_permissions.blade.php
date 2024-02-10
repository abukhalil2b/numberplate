<x-layout.admin>


    <div class="mt-3 p-3 text-xl text-red-800">
        Permissions: {{ app()->getLocale() == 'ar' ? $user->ar_name : $user->en_name }}
    </div>
    @foreach($roleWithPermissions as $role)
    <div class="border p-3 rounded bg-white">
        {{ $role->title }}
    </div>
    @foreach($role->permissions as $permissions)
    <div>
        {{ $permissions->title }}
    </div>
    @endforeach
    @endforeach

</x-layout.admin>