<div>

    <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-branch')" class="text-xs">
        + {{__('branch')}}
    </x-primary-button>


    <x-modal name="create-branch" :show="$errors->isNotEmpty()" focusable>

        <form method="post" action="{{ route('admin.branch.store') }}" class="p-2">
            @csrf

            <div class="mt-6 flex items-center gap-1">
                <div class="text-xs w-52">
                    اسم الفرع
                </div>
                <x-text-input type="text" name="name" class="mt-1 block w-full" />
            </div>
            <x-input-error :messages="$errors->get('name')" />


            <div class="mt-6 flex items-center gap-1">
                <div class="text-xs w-52">
                    المستخدم
                </div>
                <x-text-input type="text" name="username" class="mt-1 block w-full" />
            </div>
            <x-input-error :messages="$errors->get('username')" />


            <div class="mt-6 flex items-center gap-1">
                <div class="text-xs w-52">
                    كلمة المرور
                </div>
                <x-text-input type="text" name="password" class="mt-1 block w-full" />
            </div>
            <x-input-error :messages="$errors->get('password')" />

            <div class="mt-6 ">

                <x-primary-button class="ml-3 w-14">
                    حفظ
                </x-primary-button>

            </div>


            @if($errors->any())
            @foreach($errors->all() as $error)

            <div class="text-red-400">
                {{ $error}}
            </div>

            @endforeach
            @endif
        </form>

    </x-modal>
</div>