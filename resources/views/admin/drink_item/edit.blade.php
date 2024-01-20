<x-layout.admin>

    <!-- vertically centered -->
    <div class="mb-5">
        <!-- form -->
        <form action="{{ route('drink_stock.update',$drinkStock->id) }}" method="POST">
            @csrf
            <div class="p-5">

                <div class="flex gap-4">
                    <div class="mt-4 text-base font-medium text-[#040507] dark:text-white-dark/70">
                        <select name="instock" id="stock">
                            <option value="1" @if($drinkStock->instock == 1) selected @endif > buy </option>
                            <option value="0" @if($drinkStock->instock == 0) selected @endif > sell </option>
                        </select>
                    </div>

                    <div class="mt-4 text-base font-medium text-[#040507] dark:text-white-dark/70">
                        <select name="cate" id="cate">
                            <option value="orange" @if($drinkStock->cate == 'orange') selected @endif > orange </option>
                            <option value="lemond" @if($drinkStock->cate == 'lemond') selected @endif > lemond </option>
                            <option value="cola" @if($drinkStock->cate == 'cola') selected @endif > cola </option>
                        </select>
                    </div>
                </div>


                <div class="mt-4 text-base font-medium text-[#1f2937] dark:text-white-dark/70">
                    quantity
                    <input name="quantity" value="{{ abs($drinkStock->quantity) }}" type="number" class="mt-2 form-input" placeholder="عدد الكراتين">

                </div>

                <div class="mt-4 text-base font-medium text-[#1f2937] dark:text-white-dark/70">
                    customer name
                    <input name="customer_name" value="{{ $drinkStock->customer_name }}" type="text" class="mt-2 form-input" placeholder="اسم الزبون">

                </div>


                <div class="mt-8 flex items-center justify-end">
                    <button type="button" class="btn btn-outline-danger" @click="toggle">إلغاء</button>
                    <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4 flex gap-1"> <x-svgicon.save /> حفظ</button>
                </div>
            </div>
        </form>
        <!-- / form -->

    </div>

</x-layout.admin>