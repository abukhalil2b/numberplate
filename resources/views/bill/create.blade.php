<x-app-layout>

    <div class="p-1 max-w-7xl mx-auto sm:px-6 lg:px-8">

        <form method="post" action="{{ route('bill.store') }}" class="p-2 text-[#035b62]">
            @csrf

            <div class="mt-6 flex items-center gap-1">
                <div class="text-xs w-52">
                    الرقم
                </div>
                <x-text-input type="text" name="num_plate" class="mt-1 block w-full" />
            </div>
            <x-input-error :messages="$errors->get('num_plate')" />


            <div class="mt-6 ">

                <x-primary-button class="ml-3 w-14">
                    حفظ
                </x-primary-button>

            </div>

        </form>

    </div>

</x-app-layout>