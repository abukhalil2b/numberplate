<x-layout.admin>

    <!-- vertically centered -->
    <div class="mb-5">

        <div class="flex flex-wrap gap-2">
            @foreach($roles as $role)
            <a href="{{ route('admin.permission_role.index',$role->id) }}" class="w-60 p-3 border rounded bg-white">
                <div class="flex gap-2 items-center justify-start">
                    <img src="{{ asset('assets/images/avatar.png') }}" alt="avatar" class="w-16 h-16 rounded">
                    <div class="text-md font-bold"> {{ Str::upper($role->title) }} </div>
                </div>
            </a>
            @endforeach
        </div>

    </div>

</x-layout.admin>