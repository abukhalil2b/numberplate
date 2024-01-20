<x-layout.admin>

    <!-- vertically centered -->
    <div class="mb-5">

        <div class="flex flex-wrap gap-2">
            @foreach($roles as $role)
            <a href="{{ route('admin.permission_role.index',$role->id) }}" class="w-32 p-3 border rounded bg-white">
                {{ $role->title }}
            </a>
            @endforeach
        </div>

    </div>

</x-layout.admin>