<x-layout.admin>

    <div class="mt-1 p-3 text-xl text-red-800">
        Permissions: {{ app()->getLocale() == 'ar' ? $branch->ar_name : $branch->en_name }}
    </div>

    <form action="{{ route('admin.branch.permission.update',$branch->id) }}" method="POST">
        @csrf

        @foreach($permissions as $permission)
        @php

        $bgColor = 'bg-white';

        if($permission->cate == 'plate.size')
        $bgColor = 'bg-green-100';

        if($permission->cate == 'plate.type')
        $bgColor = 'bg-blue-100';

        if($permission->cate == 'stock')
        $bgColor = 'bg-orange-100';
        
        @endphp
        <div class="p-2 mt-2  {{ $bgColor }}">
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