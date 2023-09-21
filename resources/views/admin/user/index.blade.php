<x-app-layout>
    <div class="p-1 max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- content -->
        <div class="overflow-x-auto bg-white border rounded p-1">
            <div class="text-red-800 text-center">Superadmin</div>
            <table class="w-full text-sm text-center text-gray-500">
                <thead class="text-xs text-gray-700 bg-gray-50 ">
                    <tr>
                        <th scope="col" class="text-xl px-6 py-3">
                            name
                        </th>
                        <th scope="col" class="text-xl px-6 py-3">
                            username
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="mt-1 bg-white  ">
                        <td class="">
                            <div class="text-xs">
                                {{ $user->name }}
                            </div>
                        </td>
                        <td class="">
                            <div class="text-xs">
                                {{ $user->email }}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-2 overflow-x-auto bg-white border rounded p-1">
            <div class="text-red-800 text-center"> المدير العام | General Director</div>
            <table class="w-full text-sm text-center text-gray-500">
                <thead class="text-xs text-gray-700 bg-gray-50 ">
                    <tr>
                        <th scope="col" class="text-xl px-6 py-3">
                            name
                        </th>
                        <th scope="col" class="text-xl px-6 py-3">
                            username
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="mt-1 bg-white  ">
                        <td class="">
                            <div class="text-xs">
                                {{ $user->name }}
                            </div>
                        </td>
                        <td class="">
                            <div class="text-xs">
                                {{ $user->email }}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <div class="mt-2 overflow-x-auto bg-white border rounded p-1">
            <div class="text-red-800 text-center"> الرئيس التنفيذي | Executive </div>
            <table class="w-full text-sm text-center text-gray-500">
                <thead class="text-xs text-gray-700 bg-gray-50 ">
                    <tr>
                        <th scope="col" class="text-xl px-6 py-3">
                            name
                        </th>
                        <th scope="col" class="text-xl px-6 py-3">
                            username
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="mt-1 bg-white  ">
                        <td class="">
                            <div class="text-xs">
                                {{ $user->name }}
                            </div>
                        </td>
                        <td class="">
                            <div class="text-xs">
                                {{ $user->email }}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-2 overflow-x-auto bg-white border rounded p-1">
            <div class="text-red-800 text-center">رئيس مجلس الإدارة | Chairman</div>
            <table class="w-full text-sm text-center text-gray-500">
                <thead class="text-xs text-gray-700 bg-gray-50 ">
                    <tr>
                        <th scope="col" class="text-xl px-6 py-3">
                            name
                        </th>
                        <th scope="col" class="text-xl px-6 py-3">
                            username
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="mt-1 bg-white  ">
                        <td class="">
                            <div class="text-xs">
                                {{ $user->name }}
                            </div>
                        </td>
                        <td class="">
                            <div class="text-xs">
                                {{ $user->email }}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-2 overflow-x-auto bg-white border rounded p-1">
            <div class="text-red-800 text-center">المحاسب | Accountant</div>
            <table class="w-full text-sm text-center text-gray-500">
                <thead class="text-xs text-gray-700 bg-gray-50 ">
                    <tr>
                        <th scope="col" class="text-xl px-6 py-3">
                            name
                        </th>
                        <th scope="col" class="text-xl px-6 py-3">
                            username
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="mt-1 bg-white  ">
                        <td class="">
                            <div class="text-xs">
                                {{ $user->name }}
                            </div>
                        </td>
                        <td class="">
                            <div class="text-xs">
                                {{ $user->email }}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <div class="mt-2 overflow-x-auto bg-white border rounded p-1">
            <div class="text-red-800 text-center">مدير الفرع Branch Manager</div>
            <table class="w-full text-sm text-center text-gray-500">
                <thead class="text-xs text-gray-700 bg-gray-50 ">
                    <tr>
                        <th scope="col" class="text-xl px-6 py-3">
                            name
                        </th>
                        <th scope="col" class="text-xl px-6 py-3">
                            username
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="mt-1 bg-white  ">
                        <td class="">
                            <div class="text-xs">
                                {{ $user->name }}
                            </div>
                        </td>
                        <td class="">
                            <div class="text-xs">
                                {{ $user->email }}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <div class="mt-2 overflow-x-auto bg-white border rounded p-1">
            <div class="text-red-800 text-center">مسؤل المخزن | Store Keeper</div>
            <table class="w-full text-sm text-center text-gray-500">
                <thead class="text-xs text-gray-700 bg-gray-50 ">
                    <tr>
                        <th scope="col" class="text-xl px-6 py-3">
                            name
                        </th>
                        <th scope="col" class="text-xl px-6 py-3">
                            username
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="mt-1 bg-white  ">
                        <td class="">
                            <div class="text-xs">
                                {{ $user->name }}
                            </div>
                        </td>
                        <td class="">
                            <div class="text-xs">
                                {{ $user->email }}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <div class="mt-2 overflow-x-auto bg-white border rounded p-1">
            <div class="text-red-800 text-center">مدير المشروع | Project Manager</div>
            <table class="w-full text-sm text-center text-gray-500">
                <thead class="text-xs text-gray-700 bg-gray-50 ">
                    <tr>
                        <th scope="col" class="text-xl px-6 py-3">
                            name
                        </th>
                        <th scope="col" class="text-xl px-6 py-3">
                            username
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="mt-1 bg-white  ">
                        <td class="">
                            <div class="text-xs">
                                {{ $user->name }}
                            </div>
                        </td>
                        <td class="">
                            <div class="text-xs">
                                {{ $user->email }}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <!-- /content -->

    </div>
</x-app-layout>