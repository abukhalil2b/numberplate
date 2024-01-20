<x-layout.admin>
    <div>
        <!-- form -->
        <form method="post" action="{{ route('admin.user.store') }}" class="p-2">
            @csrf

            <div class="mt-5 {{ $errors->get('name') ? 'has-error':'' }} ">
                <label for="role_title">select user type | اختر نوع الحساب</label>
                <select id="role_title" name="role_title" class="form-select text-white-dark" required>
                    @foreach($roles as $role)
                    <option value="{{ $role->title }}">{{ $role->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-5 {{ $errors->get('ar_name') ? 'has-error':'' }} ">
                <label for="inputName"> اسم صاحب الحساب </label>
                <input id="inputName" name="ar_name" type="text" placeholder="arabic name" class="form-input" required />
            </div>

            <div class="mt-5 {{ $errors->get('en_name') ? 'has-error':'' }} ">
                <label for="inputName"> Acount Name </label>
                <input id="inputName" name="en_name" type="text" placeholder="english name" class="form-input" required />
            </div>

            <div class="mt-5 {{ $errors->get('email') ? 'has-error':'' }} ">
                <label for="inputUsername"> username | المستخدم </label>
                <input id="inputUsername" name="email" type="text" placeholder="username" class="form-input" required />
            </div>

            <button type="submit" class="btn btn-primary !mt-6"> {{__('Save')}} </button>
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

        <div class="mb-5">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th class="text-center">Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="whitespace-nowrap">
                                <div>
                                    {{ app()->getLocale() == 'ar' ? $user->ar_name : $user->en_name }}
                                </div>
                                <div>
                                    @foreach($user->roles as $role)
                                    <span class="mx-2 text-gray-400 text-xs">{{ __($role->title) }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                <div>{{ $user->email }}</div>
                            </td>
                            <td>
                                <span class="bg-gradient-light">{{ $user->plain_password }}
                            </td>

                            <td class="text-center">
                                <a href="{{ route('admin.user.edit',$user->id) }}" x-tooltip="Edit">
 
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 text-success">
                                        <path d="M15.2869 3.15178L14.3601 4.07866L5.83882 12.5999L5.83881 12.5999C5.26166 13.1771 4.97308 13.4656 4.7249 13.7838C4.43213 14.1592 4.18114 14.5653 3.97634 14.995C3.80273 15.3593 3.67368 15.7465 3.41556 16.5208L2.32181 19.8021L2.05445 20.6042C1.92743 20.9852 2.0266 21.4053 2.31063 21.6894C2.59466 21.9734 3.01478 22.0726 3.39584 21.9456L4.19792 21.6782L7.47918 20.5844L7.47919 20.5844C8.25353 20.3263 8.6407 20.1973 9.00498 20.0237C9.43469 19.8189 9.84082 19.5679 10.2162 19.2751C10.5344 19.0269 10.8229 18.7383 11.4001 18.1612L11.4001 18.1612L19.9213 9.63993L20.8482 8.71306C22.3839 7.17735 22.3839 4.68748 20.8482 3.15178C19.3125 1.61607 16.8226 1.61607 15.2869 3.15178Z" stroke="currentColor" stroke-width="1.5" />
                                        <path opacity="0.5" d="M14.36 4.07812C14.36 4.07812 14.4759 6.04774 16.2138 7.78564C17.9517 9.52354 19.9213 9.6394 19.9213 9.6394M4.19789 21.6777L2.32178 19.8015" stroke="currentColor" stroke-width="1.5" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-layout.default>