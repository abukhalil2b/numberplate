<x-layout.admin>
    @php
    $inStocksTotal = 0 ;
    $outStocksTotal = 0;
    foreach($drinkInStocks as $drinkInStock)
    {
    $inStocksTotal = $inStocksTotal + $drinkInStock->quantity;
    }

    foreach($drinkOutStocks as $drinkOutStock)
    {
    $outStocksTotal = $outStocksTotal + $drinkOutStock->quantity;
    }
    @endphp
    <div class="p-3">
        <div class="p-3 flex gap-3">
            <div class="bg-purple-600 text-white w-20 h-10 rounded flex justify-center items-center">
                buy
                : {{ $inStocksTotal }}
            </div>
            <div class="bg-orange-600 text-white w-20 h-10 rounded flex justify-center items-center">
                sold
                : {{ abs($outStocksTotal) }}
            </div>
        </div>
        <table>
            <tr>
                <td>Drink</td>
                <td>Quantity</td>
                <td>Customer</td>
                <td>Sold Date</td>
                <td>Update</td>
            </tr>

            @foreach($drinkStocks as $drinkStock)
            <tr class="mt-1 p-1 border rounded {{ $drinkStock->instock == 1 ? 'border-purple-600 bg-purple-100 text-purple-600' : 'border-orange-600 bg-orange-100 text-orange-600' }}">
                <td>{{ $drinkStock->cate }}</td>
                <td>{{ abs($drinkStock->quantity) }}</td>
                <td>{{ $drinkStock->customer_name }}</td>
                <td>{{ $drinkStock->created_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('drink_stock.edit',$drinkStock->id) }}">edit</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>

    <!-- vertically centered -->
    <div class="mb-5" x-data="modal">
        <div class="flex items-center justify-center">
            <button type="button" class="btn btn-outline-primary" @click="toggle">
                + جديد
            </button>
        </div>
        <div class="fixed inset-0 z-[999] hidden overflow-y-auto bg-[black]/60" :class="open && '!block'">
            <div class="flex min-h-screen items-center justify-center px-4" @click.self="open = false">
                <div x-show="open" x-transition x-transition.duration.300 class="panel my-8 w-full max-w-lg overflow-hidden rounded-lg border-0 p-0">
                    <div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">
                        <h5 class="text-lg font-bold"> جديد</h5>
                        <button type="button" class="text-white-dark hover:text-dark" @click="toggle">
                            <x-svgicon.close />
                        </button>
                    </div>
                    <!-- form -->
                    <form action="{{ route('drink_stock.store') }}" method="POST">
                        @csrf
                        <div class="p-5">

                            <div x-data="drinkStock">
                                <div class="mt-2 text-base font-medium text-[#1f2937] dark:text-white-dark/70">
                                    <div class=" flex gap-1 ">
                                        <div @click="instock = 1" class="green-option w-24" :class="instock == '1' ? 'green-option-selected' : '' ">buy</div>
                                        <div @click="instock = 0" class="green-option w-24 " :class="instock == '0' ? 'green-option-selected' : '' ">sell</div>
                                    </div>
                                </div>
                                <div class="mt-2 text-base font-medium text-[#1f2937] dark:text-white-dark/70">
                                    <div class=" flex gap-1 ">
                                        <div @click="cate = 'orange' " class="green-option w-24" :class="cate == 'orange' ? 'green-option-selected' : '' ">orange</div>
                                        <div @click="cate = 'lemond' " class="green-option w-24" :class="cate == 'lemond' ? 'green-option-selected' : '' ">lemond</div>
                                        <div @click="cate = 'cola' " class="green-option w-24" :class="cate == 'cola' ? 'green-option-selected' : '' ">cola</div>
                                    </div>
                                </div>
                                <input name="instock" type="hidden" x-model="instock">
                                <input name="cate" type="hidden" x-model="cate">
                            </div>

                            <div class="text-base font-medium text-[#1f2937] dark:text-white-dark/70">

                                <input name="quantity" type="number" class="mt-2 form-input" placeholder="عدد الكراتين">

                            </div>

                            <div class="text-base font-medium text-[#1f2937] dark:text-white-dark/70">

                                <input name="customer_name" type="text" class="mt-2 form-input" placeholder="اسم الزبون">

                            </div>


                            <div class="mt-8 flex items-center justify-end">
                                <button type="button" class="btn btn-outline-danger" @click="toggle">إلغاء</button>
                                <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4 flex gap-1"> <x-svgicon.save /> حفظ</button>
                            </div>
                        </div>
                    </form>
                    <!-- / form -->
                </div>
            </div>
        </div>
    </div>

    <!-- script -->
    <script>
        document.addEventListener("alpine:init", () => {

            Alpine.data("drinkStock", () => ({
                cate: '',
                instock: 0
            }));

            Alpine.data("modal", (initialOpenState = false) => ({
                open: initialOpenState,

                toggle() {
                    this.open = !this.open;
                },
            }));
        });
    </script>
</x-layout.admin>