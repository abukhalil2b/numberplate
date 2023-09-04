<x-app-layout>

    <div class="p-1 max-w-7xl mx-auto sm:px-6 lg:px-8">

        <form method="post" action="{{ route('admin.branch.store') }}" class="p-2 text-[#035b62]">
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

        </form>

        <div class=" overflow-x-auto">
            <table class="w-full text-sm text-center text-gray-500">
                <thead class="text-xs text-gray-700 bg-gray-50 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            اسم الفرع
                        </th>
                        <th scope="col" class="px-6 py-3">
                            المستخدم
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="mt-1 bg-white border-b ">
                        <td class="px-6 py-4">
                            <div class="text-xl">
                                {{ $user->name }}
                            </div>

                            <div>
                                <div class="border rounded p-1 w-32">
                                <a href="{{ route('admin.bill.index',$user->id) }}" class="text-xs">عرض المبيعات</a>
                                </div>
                                <div  class="mt-1 border rounded p-1 w-32">
                                <a href="{{ route('admin.statement.index',$user->id) }}" class="text-xs">statement </a>
                                </div>
                                
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-xl">
                                {{ $user->email }}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>