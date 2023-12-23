<x-layout.default>
    <div>
        <!-- form -->
        <form method="post" action="{{ route('admin.user.update') }}" class="p-2">
            @csrf

            <div class="mt-5 {{ $errors->get('name') ? 'has-error':'' }} ">
                <label for="role_title">select user type | اختر نوع الحساب</label>
                <select id="role_title" name="role_title" class="form-select text-white-dark" required>
                    @foreach($roles as $role)
                    <option value="{{ $role->title }}" @if($role_title==$role->title) selected @endif >
                        {{ $role->title }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mt-5 {{ $errors->get('name') ? 'has-error':'' }} ">
                <label for="inputName"> name | اسم صاحب الحساب </label>
                <input id="inputName" name="name" type="text" placeholder="name" class="form-input" value="{{ $user->name }}" required />
            </div>

            <input type="hidden" name="user_id" value="{{ $user->id }}">

            <div class="mt-3 gap-1 flex">
                <label class="w-12 h-6 relative">
                    <input type="checkbox" name="reset_password" value="1" class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer" id="custom_switch_checkbox2" />
                    <span for="custom_switch_checkbox2" class="outline_checkbox bg-icon border-2 border-[#ebedf2] dark:border-white-dark block h-full rounded-full before:absolute before:left-1 before:bg-[#ebedf2] dark:before:bg-white-dark before:bottom-1 before:w-4 before:h-4 before:rounded-full before:bg-[url('../images/close.svg')] before:bg-no-repeat before:bg-center peer-checked:before:left-7 peer-checked:before:bg-[url('../images/checked.svg')] peer-checked:border-primary peer-checked:before:bg-primary before:transition-all before:duration-300"></span>
                </label>
                Reset Password
            </div>
            <button type="submit" class="btn btn-primary !mt-6"> {{__('Update')}} </button>
            <div class="p-3">
                @foreach($errors->all() as $error)
                <div class="text-red-400">{{ $error }}</div>
                @endforeach
            </div>
            <div class="p-3">
                @if(session('success'))
                <div class="text-green-600">{{ session('success') }}</div>
                @endif
            </div>
        </form>
        <!-- /form -->


    </div>
</x-layout.default>