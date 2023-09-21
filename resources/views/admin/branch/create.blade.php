<x-app-layout>

    <div class="p-1 max-w-7xl mx-auto sm:px-6 lg:px-8">

        @include('inc._modal_create_branch')


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
                                <div class="mt-1 border rounded p-1 w-32">
                                    <a href="{{ route('admin.statement.index',$user->id) }}" class="text-xs">statement </a>
                                </div>
                                <div class="mt-1 border rounded p-1 w-32">
                                    <a href="{{ route('admin.branch.stock.index',$user->id) }}" class="text-xs">stock </a>
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