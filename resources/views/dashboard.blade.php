<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <div class="py-12">


        <div class="p-1 max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form method="post" action="{{ route('bill.store') }}" class="p-2 text-[#035b62]">
                @csrf

                <div class="text-xl mt-5 w-full">
                    اللوحة
                </div>
                <div class="mt-2 flex items-center gap-3">
                    <div>
                        الرقم
                        <x-text-input type="number" name="num_plate" class="w-32 mt-1 block" />
                    </div>
                    <div>
                        الرمز
                        <x-text-input type="text" name="zone_plate" class="w-32 mt-1 block" oninput="this.value=this.value.replace(/[^A-Za-z\s]/g,'');" />
                    </div>
                </div>
                <x-input-error :messages="$errors->get('num_plate')" />
                <x-input-error :messages="$errors->get('zone_plate')" />

                <div class="text-xl mt-5 w-full">
                    نوع اللوحة
                </div>
                <select name="size_plate" class="mt-2 rounded w-64 block">
                    <option value="خصوصي كبير">خصوصي كبير</option>
                    <option value="خصوصي متوسط">خصوصي متوسط</option>
                    <option value="خصوصي صغير">خصوصي صغير</option>
                    <option value="تجاري كبير">تجاري كبير</option>
                    <option value="تجاري متوسط">تجاري متوسط</option>
                    <option value="حكومي كبير">حكومي كبير</option>
                    <option value="حكومي صغير">حكومي صغير</option>
                    <option value="حكومي دراجات">حكومي دراجات</option>
                    <option value="دبلوماسي كبير">دبلوماسي كبير</option>
                    <option value="دبلوماسي متوسط">دبلوماسي متوسط</option>
                    <option value="دبلوماسي دراجات">دبلوماسي دراجات</option>
                    <option value="تصدير">تصدير</option>
                    <option value="تعليم سياقة متوسط">تعليم سياقة متوسط</option>
                    <option value="تعليم سياقة دراجات">تعليم سياقة دراجات</option>
                </select>
                <x-input-error :messages="$errors->get('size_plate')" />


                <div class="text-xl mt-5 w-full">
                    العدد
                </div>
                <div class="mt-2 flex items-center gap-16">
                    <label class="flex justify-center items-center gap-1">
                        <input type="radio" name="quantity" class="w-6 h-6 mt-1" value="2" checked />
                        <span class="text-xl"> لوحتان </span>
                    </label>

                    <label class="flex justify-center items-center gap-1">
                        <input type="radio" name="quantity" class="w-6 h-6 mt-1" value="1" />
                        <span class="text-xl"> لوحة واحدة </span>
                    </label>

                </div>
                <x-input-error :messages="$errors->get('quantity')" />

                <div class="text-xl mt-5 w-full">
                    حالة الطباعة
                </div>
                <div class="mt-2 flex items-center gap-5">
                    <label class="flex justify-center items-center gap-1">
                        <input type="radio" name="success_printing" class="w-6 h-6 mt-1" value="1" checked />
                        <span class="text-md"> تمت الطباعة بنجاح </span>
                    </label>
                    <label class="flex justify-center items-center gap-1">
                        <input type="radio" name="success_printing" class="w-6 h-6 mt-1" value="0" />
                        <span class="text-md"> لم تنجح الطباعة </span>
                    </label>
                </div>
                <x-input-error :messages="$errors->get('success_printing')" />


                <div class="mt-5 text-xl w-full">
                    رصد رقم
                    <x-text-input type="number" name="ref_num" class="w-64 mt-1 block" />
                </div>
                <x-input-error :messages="$errors->get('success_printing')" />

                <div class="mt-6 ">

                    <x-primary-button class="ml-3 w-14">
                        حفظ
                    </x-primary-button>

                </div>

            </form>


            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-center text-gray-500">
                    <thead class="text-xs text-gray-700 bg-gray-50 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                اللوحة
                            </th>
                            <th scope="col" class="px-6 py-3">
                                نوع اللوحة
                            </th>
                            <th scope="col" class="px-6 py-3">
                                العدد
                            </th>
                            <th scope="col" class="px-6 py-3">
                                حالة الطباعة
                            </th>
                            <th scope="col" class="px-6 py-3">
                                رصد
                            </th>
                            <th scope="col" class="px-6 py-3">
                                الفرع
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bills as $bill)
                        <tr class="bg-white border-b ">
                            <td class="px-6 py-4">
                                <span>{{ $bill->num_plate }}</span>
                                <span>{{ $bill->zone_plate }}</span>
                            </td>
                            <td class="px-6 py-4">
                                {{ $bill->size_plate }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $bill->quantity }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $bill->success_printing ? 'نجحت' : 'لم تنجح' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $bill->ref_num }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $bill->branch->name }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>
</x-app-layout>