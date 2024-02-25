<x-app-layout>
    <form method="post" action="{{ route('test.bill.plate.store') }}">
        @csrf

        <div x-data="testalpine">

            <!-- Plate Info -->
            <div class="p-3 flex flex-col items-center bg-gray-100">
                <div class="text-xl font-bold text-red-800">{{ __('Plate Info') }}</div>

                <div class="w-80 mt-5 flex justify-between">
                    <div class="text-center w-32">
                        {{ __('code') }}
                        <x-text-input type="text" name="plate_code" class="w-full mt-1 block" />
                    </div>
                    <div class="text-center w-32">
                        {{ __('number') }}
                        <x-text-input type="text" name="plate_num" class="w-full mt-1 block" />
                    </div>
                </div>

                <div class="w-80 mt-2 grid grid-cols-3 gap-2">
                    <div class="private_plate" :class="plateType == 'private' ? 'private_plate_selected' : '' " @click="selectPlateType('private')">
                        {{ __('private') }}
                    </div>

                    <div class="commercial_plate" :class="plateType == 'commercial' ? 'commercial_plate_selected' : '' " @click="selectPlateType('commercial')">
                        {{ __('commercial') }}
                    </div>

                    @if( auth()->user()->hasPermission('diplomatic') )
                    <div class="diplomatic_plate " :class="plateType == 'diplomatic' ? 'diplomatic_plate_selected' : '' " @click="selectPlateType('diplomatic')">
                        {{ __('diplomatic') }}
                    </div>
                    @endif

                    @if( auth()->user()->hasPermission('temporary') )
                    <div class="temporary_plate" :class="plateType == 'temporary' ? 'temporary_plate_selected' : '' " @click="selectPlateType('temporary')">
                        {{ __('temporary') }}
                    </div>
                    @endif

                    @if( auth()->user()->hasPermission('export') )
                    <div class="export_plate" :class="plateType == 'export' ? 'export_plate_selected' : '' " @click="selectPlateType('export')">
                        {{ __('export') }}
                    </div>
                    @endif

                    <div class="specific_plate" :class="plateType == 'specific' ? 'specific_plate_selected' : '' " @click="selectPlateType('specific')">
                        {{ __('specific use') }}
                    </div>

                    @if( auth()->user()->hasPermission('learner') )
                    <div class="learner_plate" :class="plateType == 'learner' ? 'learner_plate_selected' : '' " @click="selectPlateType('learner')">
                        {{ __('learner') }}
                    </div>
                    @endif

                    @if( auth()->user()->hasPermission('government') )
                    <div class="government_plate" :class="plateType == 'government' ? 'government_plate_selected' : '' " @click="selectPlateType('government')">
                        {{ __('government') }}
                    </div>
                    @endif

                </div>
                <input type="hidden" x-model="plateType" name="type">
            </div>

            <!-- Printing Plate -->
            <div x-show="plateType != '' " class="p-3 flex flex-col items-center bg-white">
                <div class="text-xl font-bold text-red-800">
                    {{ __('Printing Plate') }}
                </div>
                @if( auth()->user()->hasPermission('bike') )
                <div class="mt-2 flex gap-2" x-cloak x-show="showBike(plateType)">
                    <div class="card w-80 h-14 justify-between">
                        {{ __('bike') }}
                        <div class="flex gap-1">
                            <div class="w-8 text-red-800 font-bold text-2xl" x-text="bikeQuantity"></div>
                            <div class="card w-16 h-10 cursor-pointer" @click="addPlateSize('bike')">+</div>
                            <div class="card w-16 h-10 cursor-pointer" @click="removePlateSize('bike')">-</div>
                        </div>
                    </div>
                </div>
                @endif

                <div class="mt-2 flex gap-2" x-cloak x-show="showSmall(plateType)">
                    <div class="card w-80 h-14 justify-between">
                        {{ __('small') }}
                        <div class="flex gap-1">
                            <div class="w-8 text-red-800 font-bold text-2xl" x-text="smallQuantity"></div>
                            <div class="card w-16 h-10 cursor-pointer" @click="addPlateSize('small')">+</div>
                            <div class="card w-16 h-10 cursor-pointer" @click="removePlateSize('small')">-</div>
                        </div>
                    </div>
                </div>

                <div class="mt-2 flex gap-2" x-cloak x-show="showMedium(plateType)">
                    <div class="card w-80 h-14 justify-between">
                        {{ __('medium') }}
                        <div class="flex gap-1">
                            <div class="w-8 text-red-800 font-bold text-2xl" x-text="mediumQuantity"></div>
                            <div class="card w-16 h-10 cursor-pointer" @click="addPlateSize('medium')">+</div>
                            <div class="card w-16 h-10 cursor-pointer" @click="removePlateSize('medium')">-</div>
                        </div>
                    </div>
                </div>

                <div class="mt-2 flex gap-2" x-cloak x-show="showLarge(plateType)">
                    <div class="card w-80 h-14 justify-between">
                        {{ __('large') }}
                        <div class="flex gap-1">
                            <div class="w-8 text-red-800 font-bold text-2xl" x-text="largeQuantity"></div>
                            <div class="card w-16 h-10 cursor-pointer" @click="addPlateSize('large')">+</div>
                            <div class="card w-16 h-10 cursor-pointer" @click="removePlateSize('large')">-</div>
                        </div>
                    </div>
                </div>

                @if( auth()->user()->hasPermission('large with khanjer') )
                <div class="mt-2 flex gap-2" x-cloak x-show="showLargeWithKhanjer(plateType)">
                    <div class="card w-80 h-14 justify-between">
                        {{ __('large with khanjer') }}
                        <div class="flex gap-1">
                            <div class="w-8 text-red-800 font-bold text-2xl" x-text="largeWithKhanjerQuantity"></div>
                            <div class="card w-16 h-10 cursor-pointer" @click="addPlateSize('largeWithKhanjer')">+</div>
                            <div class="card w-16 h-10 cursor-pointer" @click="removePlateSize('largeWithKhanjer')">-</div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- sizeForStatement -->
                <input type="hidden" name="sizeForStatement" x-model="sizeForStatement">
                <div class="p-1 mt-2 w-80 text-center border border-info rounded">
                    <div x-show="required == 'pair' " class="text-xl text-blue-800">{{ __('pair') }}</div>
                    <div x-show="required == 'single' " class="text-xl text-blue-800">{{ __('single') }}</div>
                    <input type="hidden" name="required" x-model="required">

                    <div class="text-info">
                        <div x-show="sizeForStatement == 'bike' ">{{ __('bike') }}</div>
                        <div x-show="sizeForStatement == 'small' ">{{ __('small') }}</div>
                        <div x-show="sizeForStatement == 'medium' ">{{ __('medium') }}</div>
                        <div x-show="sizeForStatement == 'large' ">{{ __('large') }}</div>
                        <div x-show="sizeForStatement == 'largeWithKhanjer' ">{{ __('largeWithKhanjer') }}</div>
                    </div>
                </div>
            </div>

            <!-- Printing Price -->
            <div x-show="plates.length > 0" class="p-3 flex flex-col items-center bg-white">
                <div class="py-1 text-xl font-bold text-red-800">{{ __('Printing Price') }}</div>
                <template x-if="showCollectedByMeButton">
                    <div class="plate w-80" :class="price_collected_by_rop ? '' : 'plate_selected' " @click="setPriceCollectByROP(false)">
                        {{ __('Collected By Me') }}
                    </div>
                </template>

                <div class="mt-5 plate w-80" :class="price_collected_by_rop ? 'plate_selected' : '' " @click="setPriceCollectByROP(true)">{{ __('Collected By ROP') }}</div>

                <template x-if="price_collected_by_rop">
                    <div class="mt-2 w-80">
                        {{ __('ROP Bill Number') }}
                        <x-text-input type="number" name="ref_num" class="w-80 mt-1 block" />
                    </div>
                </template>
                <input type="hidden" name="price_collected_by_rop" x-model="price_collected_by_rop">
                <input type="hidden" name="printing_price" x-model="printing_price">
            </div>


            <!-- fixing plate -->
            <div x-show="plateType != '' " class="p-3 flex flex-col items-center bg-gray-100">
                <div class="py-1 mt-3 text-xl font-bold text-red-800">{{ __('fixing plate') }}:</div>
                <div class="w-80 flex gap-1 items-center">

                    <div class="plate text-[11px] w-full" :class="fixing_price == 0 ? 'plate_selected' : 'plate' " @click="selectRequiredFixingPlate('no')">{{ __('No') }}</div>
                    <div class="plate text-[11px] w-full" :class="fixing_price == 0.5 ? 'plate_selected' : 'plate' " @click="selectRequiredFixingPlate('single')">{{ __('single') }} 0.5 R.O</div>
                    <div class="plate text-[11px] w-full" :class="fixing_price == 1 ? 'plate_selected' : 'plate' " @click="selectRequiredFixingPlate('pair')">{{ __('pair') }} 1 R.O</div>

                </div>

            </div>

            <!-- buy frame -->
            <div x-show="plateType != '' " class="p-3 flex flex-col items-center bg-gray-100">
                <div class="py-1 mt-3 text-xl font-bold text-red-800">{{ __('buy frame') }}:</div>
                <div class="w-80 flex gap-1 items-center">
                    <div class="plate text-[11px] w-full" :class="buyframe_price == 0 ? 'plate_selected' : 'plate' " @click="selectRequiredBuyFrame('no')">{{ __('No') }}</div>
                    <div class="plate text-[11px] w-full" :class="buyframe_price == 3 ? 'plate_selected' : 'plate' " @click="selectRequiredBuyFrame('single')">{{ __('single') }} 3 R.O</div>
                    <div class="plate text-[11px] w-full" :class="buyframe_price == 6 ? 'plate_selected' : 'plate' " @click="selectRequiredBuyFrame('pair')">{{ __('pair') }} 6 R.O</div>

                </div>

            </div>

            <!-- Payment Method -->
            <div x-show="printing_price > 0 || buyframe_price > 0 || fixing_price > 0" class="p-3 flex flex-col items-center bg-white">
                <div class="p-3 flex flex-col items-center">
                    <div class="w-80 flex justify-between items-center text-center">
                        <div>
                            <div>{{ __('Printing') }}:</div>
                            <span x-text="printing_price" class="text-xl text-red-800 font-bold"></span>
                            <span class="text-xl text-red-800 font-bold"> R.O</span>
                        </div>

                        <div>
                            <div> {{ __('Extra') }}:</div>
                            <span x-text="extra_price" class="text-xl text-red-800 font-bold"></span>
                            <span class="text-xl text-red-800 font-bold"> R.O</span>
                        </div>

                        <div>
                            <div>{{ __('Total') }}:</div>
                            <span x-text="total_price" class="text-xl text-red-800 font-bold"></span>
                            <span class="text-xl text-red-800 font-bold"> R.O</span>
                        </div>
                    </div>
                    <div class="py-1 mt-3 text-xl font-bold text-red-800">{{ __('Payment Method') }}:</div>
                    <div class="w-80 flex gap-3">
                        <label class="py-3 px-1 border rounded w-full flex gap-1 items-center cursor-pointer">
                            <input type="radio" id="cash" name="payment_method" value="cash">
                            {{ __('CASH') }}
                        </label>
                        <label class="py-3 px-1 border rounded w-full flex gap-1 items-center cursor-pointer">
                            <input type="radio" id="visa" name="payment_method" value="visa">
                            {{ __('VISA') }}
                        </label>
                    </div>
                </div>
            </div>

            <input type="hidden" name="plates" x-model="JSON.stringify(plates)">
            <input type="hidden" name="extras" x-model="JSON.stringify(extras)">
            <!-- Save  -->
            <div x-show="plateType != '' " class="p-3 flex flex-col items-center bg-gray-100">
                <div class="mt-10" onclick="document.getElementById('btn-save').style.display = 'none' ">
                    <button id="btn-save" class="btn btn-outline-primary w-80 h-14"> {{ __('Save') }}</button>
                </div>
            </div>
            plates
            <div class="text-xs" x-text="JSON.stringify(plates)"></div>
            extras
            <div x-text="JSON.stringify(extras)"></div>
        </div>

    </form>

    <script>
        document.addEventListener("alpine:init", () => {
            Array.prototype.removeByValue = function(val) {
                for (var i = 0; i < this.length; i++) {
                    if (this[i] === val) {
                        this.splice(i, 1);
                        break;
                    }
                }
                return this;
            };
            Alpine.data("testalpine", () => ({
                plateType: '',

                sizeForStatement: "",

                required: "",

                plates: [],

                extras: [],

                bikeQuantity: 0,

                smallQuantity: 0,

                mediumQuantity: 0,

                largeQuantity: 0,

                largeWithKhanjerQuantity: 0,

                printing_price: 0,

                fixing_price: 0,

                buyframe_price: 0,

                extra_price: 0,

                total_price: 0,

                price_collected_by_rop: true,

                showCollectedByMeButton: false,

                selectPlateType(type) {

                    this.resetValues();

                    this.plateType = type;

                    this.showCollectedByMeButton = this.checkPlateTypeMoneyCollection(type);
                },

                resetValues() {
                    this.plateType = '';
                    this.sizeForStatement = "";
                    this.required = "";
                    this.plates = [];
                    this.extras = [];
                    this.bikeQuantity = 0;
                    this.smallQuantity = 0;
                    this.mediumQuantity = 0;
                    this.largeQuantity = 0;
                    this.largeWithKhanjerQuantity = 0;
                    this.printing_price = 0;
                    this.fixing_price = 0;
                    this.buyframe_price = 0;
                    this.extra_price = 0;
                    this.total_price = 0;
                    this.price_collected_by_rop = true;
                    this.showCollectedByMeButton = false;
                },


                addPlateSize(size) {

                    this.clearNextStep();

                    if (this.plates.length == 2) {
                        return;
                    }

                    if (this.plates.length == 1) {
                        if (this.plates[0].quantity == 2) {
                            return;
                        }
                    }

                    switch (size) {
                        case 'bike':
                            // this size cannot mix with others
                            if (this.plates.filter(plate => ['small', 'medium', 'large', 'largeWithKhanjer'].includes(plate.size)).length > 0) {
                                return;
                            }

                            //in case selected same plate size let quantity only to be change
                            let bikePlatesLength = this.plates.filter(p => p.size == 'bike').length

                            if (this.plates.length == 0) {
                                this.plates.push({
                                    cate: 'plate',
                                    type: this.plateType,
                                    size: 'bike',
                                    quantity: 1,
                                    price: 1,
                                    required: 'single',
                                    description: 'print single plate'
                                });
                                this.bikeQuantity = 1
                            } else {

                                if (bikePlatesLength == 0) {
                                    this.plates.push({
                                        cate: 'plate',
                                        type: this.plateType,
                                        size: 'bike',
                                        quantity: 1,
                                        price: 1,
                                        required: 'pair',
                                        description: 'print pair plate'
                                    });
                                    this.bikeQuantity = 1
                                }

                                if (bikePlatesLength == 1) {
                                    this.plates = this.plates.map(plate => ({
                                        cate: 'plate',
                                        type: this.plateType,
                                        size: 'bike',
                                        quantity: 2,
                                        price: 2,
                                        required: 'pair',
                                        description: 'print pair plate'
                                    }));
                                    this.bikeQuantity = 2
                                }

                            }

                            break;
                        case 'small':
                            // if bike selected do not allow to add this size
                            if (this.plates.filter(plate => plate.size == 'bike' || plate.size == 'largeWithKhanjer').length > 0) {
                                return;
                            }

                            //in case selected same plate size let quantity only to be change
                            let smallPlatesLength = this.plates.filter(p => p.size == 'small').length

                            this.getPrintingPrice()

                            if (this.plates.length == 0) {
                                this.plates.push({
                                    cate: 'plate',
                                    type: this.plateType,
                                    size: 'small',
                                    quantity: 1,
                                    price: this.printing_price,
                                    required: 'single',
                                    description: 'print single plate'
                                });
                                this.smallQuantity = 1
                            } else {

                                if (smallPlatesLength == 0) {
                                    this.plates.push({
                                        cate: 'plate',
                                        type: this.plateType,
                                        size: 'small',
                                        quantity: 1,
                                        price: this.printing_price,
                                        required: 'pair',
                                        description: 'print pair plate'
                                    });
                                    this.smallQuantity = 1
                                }

                                if (smallPlatesLength == 1) {
                                    this.plates = this.plates.map(plate => ({
                                        cate: 'plate',
                                        type: this.plateType,
                                        size: 'small',
                                        quantity: 2,
                                        price: this.printing_price,
                                        required: 'pair',
                                        description: 'print pair plate'
                                    }));
                                    this.smallQuantity = 2
                                }

                            }


                            break;
                        case 'medium':
                            // if bike selected do not allow to add this size
                            if (this.plates.filter(plate => plate.size == 'bike' || plate.size == 'largeWithKhanjer').length > 0) {
                                return;
                            }

                            //in case selected same plate size let quantity only to be change
                            let mediumPlatesLength = this.plates.filter(p => p.size == 'medium').length

                            this.getPrintingPrice()

                            if (this.plates.length == 0) {
                                this.plates.push({
                                    cate: 'plate',
                                    type: this.plateType,
                                    size: 'medium',
                                    quantity: 1,
                                    price: this.printing_price,
                                    required: 'single',
                                    description: 'print single plate'
                                });
                                this.mediumQuantity = 1
                            } else {

                                if (mediumPlatesLength == 0) {
                                    this.plates.push({
                                        cate: 'plate',
                                        type: this.plateType,
                                        size: 'medium',
                                        quantity: 1,
                                        price: this.printing_price,
                                        required: 'pair',
                                        description: 'print pair plate'
                                    });
                                    this.mediumQuantity = 1
                                }

                                if (mediumPlatesLength == 1) {
                                    this.plates = this.plates.map(plate => ({
                                        cate: 'plate',
                                        type: this.plateType,
                                        size: 'medium',
                                        quantity: 2,
                                        price: this.printing_price,
                                        required: 'pair',
                                        description: 'print pair plate'
                                    }));
                                    this.mediumQuantity = 2
                                }

                            }

                            break;
                        case 'large':
                            // if bike or largewihtkhanjer is selected do not allow to add this size
                            if (this.plates.filter(plate => plate.size == 'bike' || plate.size == 'largeWithKhanjer').length > 0) {
                                return;
                            }

                            //in case selected same plate size let quantity only to be change
                            let largePlatesLength = this.plates.filter(p => p.size == 'large').length

                            this.getPrintingPrice()

                            if (this.plates.length == 0) {
                                this.plates.push({
                                    cate: 'plate',
                                    type: this.plateType,
                                    size: 'large',
                                    quantity: 1,
                                    price: this.printing_price,
                                    required: 'single',
                                    description: 'print single plate'
                                });
                                this.largeQuantity = 1
                            } else {

                                if (largePlatesLength == 0) {
                                    this.plates.push({
                                        cate: 'plate',
                                        type: this.plateType,
                                        size: 'large',
                                        quantity: 1,
                                        price: this.printing_price,
                                        required: 'pair',
                                        description: 'print pair plate'
                                    });
                                    this.largeQuantity = 1
                                }

                                if (largePlatesLength == 1) {
                                    this.plates = this.plates.map(plate => ({
                                        cate: 'plate',
                                        type: this.plateType,
                                        size: 'large',
                                        quantity: 2,
                                        price: this.printing_price,
                                        required: 'pair',
                                        description: 'print pair plate'
                                    }));
                                    this.largeQuantity = 2
                                }

                            }

                            break;
                        case 'largeWithKhanjer':
                            // this size cannot mix with others
                            if (this.plates.filter(plate => ['small', 'medium', 'large', 'bike'].includes(plate.size)).length > 0) {
                                return;
                            }

                            //in case selected same plate size let quantity only to be change
                            let largeWithKhanjerPlatesLength = this.plates.filter(p => p.size == 'largeWithKhanjer').length

                            if (this.plates.length == 0) {
                                this.plates.push({
                                    cate: 'plate',
                                    type: this.plateType,
                                    size: 'largeWithKhanjer',
                                    quantity: 1,
                                    price: 12,
                                    required: 'single',
                                    description: 'print single plate'
                                });
                                this.largeWithKhanjerQuantity = 1
                            } else {

                                if (largeWithKhanjerPlatesLength == 0) {
                                    this.plates.push({
                                        cate: 'plate',
                                        type: this.plateType,
                                        size: 'largeWithKhanjer',
                                        quantity: 1,
                                        price: 12,
                                        required: 'pair',
                                        description: 'print pair plate'
                                    });
                                    this.largeWithKhanjerQuantity = 1
                                }

                                if (largeWithKhanjerPlatesLength == 1) {
                                    this.plates = this.plates.map(plate => ({
                                        cate: 'plate',
                                        type: this.plateType,
                                        size: 'largeWithKhanjer',
                                        quantity: 2,
                                        price: 24,
                                        required: 'pair',
                                        description: 'print pair plate'
                                    }));
                                    this.largeWithKhanjerQuantity = 2
                                }

                            }

                            break;
                    }

                    this.setSizeForStatement()

                    this.setRequired()

                    this.getPrintingPrice()
                },

                removePlateSize(size) {

                    this.clearNextStep();

                    if (size == 'bike') {
                        this.plates = this.plates.filter(p => p.size != 'bike')
                        this.bikeQuantity = this.plates.filter(p => p.size == 'bike').length
                    }

                    if (size == 'small') {
                        this.plates = this.plates.filter(p => p.size != 'small')
                        this.smallQuantity = this.plates.filter(p => p.size == 'small').length
                    }

                    if (size == 'medium') {
                        this.plates = this.plates.filter(p => p.size != 'medium')
                        this.mediumQuantity = this.plates.filter(p => p.size == 'medium').length
                    }

                    if (size == 'large') {
                        this.plates = this.plates.filter(p => p.size != 'large')
                        this.largeQuantity = this.plates.filter(p => p.size == 'large').length
                    }

                    if (size == 'largeWithKhanjer') {
                        this.plates = this.plates.filter(p => p.size != 'largeWithKhanjer')
                        this.largeWithKhanjerQuantity = this.plates.filter(p => p.size == 'largeWithKhanjer').length
                    }

                    this.setSizeForStatement()

                    this.setRequired()


                },

                clearNextStep() {
                    this.fixing_price = 0;
                    this.printing_price = 0;
                    this.extra_price = 0;
                    this.total_price = 0;
                    this.extras = [];
                    this.price_collected_by_rop = true;
                },

                setPriceCollectByROP(value) {

                    this.price_collected_by_rop = value;

                    //if price collect by me then get this price
                    this.getPrintingPrice();
                },

                setSizeForStatement() {
                    if (this.plates.length == 0) {
                        this.sizeForStatement = '';
                    }
                    if (this.plates.length == 1) {
                        this.sizeForStatement = this.plates[0].size;
                    }
                    if (this.plates.length == 2) {
                        // CASE: small and medium THEN size = medium
                        if (
                            this.plates[0].size == "medium" &&
                            this.plates[1].size == "small"
                        ) {
                            this.sizeForStatement = "medium";
                        }

                        if (
                            this.plates[1].size == "medium" &&
                            this.plates[0].size == "small"
                        ) {
                            this.sizeForStatement = "medium";
                        }
                        // CASE: medium and large THEN size = large
                        if (
                            this.plates[0].size == "large" &&
                            this.plates[1].size == "medium"
                        ) {
                            this.sizeForStatement = "large";
                        }

                        if (
                            this.plates[1].size == "large" &&
                            this.plates[0].size == "medium"
                        ) {
                            this.sizeForStatement = "large";
                        }

                        // CASE: small and large THEN size = large
                        if (
                            this.plates[0].size == "large" &&
                            this.plates[1].size == "small"
                        ) {
                            this.sizeForStatement = "large";
                        }

                        if (
                            this.plates[1].size == "large" &&
                            this.plates[0].size == "small"
                        ) {
                            this.sizeForStatement = "large";
                        }
                    }
                },

                setRequired() {
                    if (this.plates.length == 1) {
                        if (this.plates[0].quantity == 2) {
                            this.required = "pair";
                        } else {
                            this.required = "single";
                        }
                    }

                    if (this.plates.length == 2) {
                        this.required = "pair";
                    }

                    if (this.plates.length == 0) {
                        this.required = '';
                    }
                },

                getPrintingPrice() {

                    //reset value
                    this.printing_price = 0;

                    if (!this.price_collected_by_rop) {

                        /*-- bike --*/
                        if (this.sizeForStatement == 'bike') {
                            if (this.required == 'single')
                                this.printing_price = 2;
                            else
                                this.printing_price = 4;
                        }

                        /*-- small --*/
                        if (this.sizeForStatement == 'small') {
                            if (this.required == 'single')
                                this.printing_price = 2;
                            else
                                this.printing_price = 4;
                        }

                        /*-- medium --*/
                        if (this.sizeForStatement == 'medium') {
                            if (this.required == 'single')
                                this.printing_price = 4;
                            else
                                this.printing_price = 8;
                        }

                        /*-- large --*/
                        if (this.sizeForStatement == 'large') {
                            if (this.required == 'single')
                                this.printing_price = 6;
                            else
                                this.printing_price = 12;
                        }

                        this.total_price = this.printing_price;

                    }

                    if (this.price_collected_by_rop) {
                        this.total_price = 0;
                    }

                },

                selectRequiredFixingPlate(required) {

                    if (required == 'single') {

                        //remove pair if exist
                        this.extras = this.extras.filter(extra => extra.description != 'fix pair plate');
                        //check if single is exist and not doublicate
                        if (this.extras.filter(extra => extra.description == 'fix single plate').length > 0) {
                            return;
                        }

                        this.extras.push({
                            description: 'fix single plate',
                            price: 0.5
                        });

                        this.fixing_price = 0.5;

                    }

                    if (required == 'pair') {

                        //remove single if exist
                        this.extras = this.extras.filter(f => f.description != 'fix single plate');

                        //check if pair is exist and not doublicate
                        if (this.extras.filter(f => f.description == 'fix pair plate').length > 0) {
                            return;
                        }

                        this.extras.push({
                            description: 'fix pair plate',
                            price: 1
                        });

                        this.fixing_price = 1;
                    }

                    if (required == 'no') {

                        this.extras = this.extras.filter(f => f.description != 'fix single plate');
                        this.extras = this.extras.filter(f => f.description != 'fix pair plate');
                        this.fixing_price = 0;
                    }

                    this.extra_price = this.extras.reduce((acc, curr) => acc + curr.price, 0)

                    this.total_price = this.printing_price + this.extra_price;
                },

                selectRequiredBuyFrame(required) {

                    if (required == 'single') {

                        //remove pair if exist 
                        this.extras = this.extras.filter(f => f.description != 'buy pair frame');
                        //check if single is exist and not doublicate
                        if (this.extras.filter(f => f.description == 'buy single frame').length > 0) {
                            return;
                        }

                        this.extras.push({
                            description: 'buy single frame',
                            price: 3
                        });

                        this.buyframe_price = 3;

                    }

                    if (required == 'pair') {

                        //remove single if exist by filtering pair
                        this.extras = this.extras.filter(f => f.description != 'buy single frame');

                        //check if pair is exist and not doublicate
                        if (this.extras.filter(f => f.description == 'buy pair frame').length > 0) {
                            return;
                        }

                        this.extras.push({
                            description: 'buy pair frame',
                            price: 6
                        });

                        this.buyframe_price = 6;
                    }

                    if (required == 'no') {

                        this.extras = this.extras.filter(f => f.description != 'buy single frame');
                        this.extras = this.extras.filter(f => f.description != 'buy pair frame');
                        this.buyframe_price = 0;
                    }

                    this.extra_price = this.extras.reduce((acc, curr) => acc + curr.price, 0)

                    this.total_price = this.printing_price + this.extra_price;
                },

                /*-- show price for plate  input -- */
                checkPlateTypeMoneyCollection(plateType) {
                    return ['diplomatic'].filter(item => item == plateType).length > 0
                },

                /* start-- check for plate type is exist -- */
                showLargeWithKhanjer(plateType) {

                    return ['government'].filter(item => item == plateType).length > 0
                },

                showLarge(plateType) {

                    return ['government', 'specific', 'private', 'commercial', 'diplomatic'].filter(item => item == plateType).length > 0
                },

                showMedium(plateType) {
                    //this check no need to be applied
                    return ['government', 'specific', 'private', 'commercial', 'learner', 'diplomatic', 'temporary', 'export'].filter(item => item == plateType).length > 0
                },

                showSmall(plateType) {

                    return ['private', 'specific'].filter(item => item == plateType).length > 0
                },

                showBike(plateType) {

                    return ['government', 'specific', 'private', 'commercial', 'learner', 'diplomatic', 'temporary'].filter(item => item == plateType).length > 0
                }
                /* end-- check for plate type is exist -- */
            }));
        });
    </script>
</x-app-layout>