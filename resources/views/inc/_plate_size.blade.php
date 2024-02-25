<div class="mt-6">
    <div class="mt-2 flex gap-2" x-cloak x-show="showBike(plateType)">
        <div class="card w-80 h-14 justify-between">
            {{ __('bike') }}
            <div class="flex gap-1">
                <div class="w-8 text-red-800 font-bold text-2xl" x-text="bike"></div>
                <div class="card w-16 h-10 cursor-pointer" @click="addBike">+</div>
                <div class="card w-16 h-10 cursor-pointer" @click="subBike">-</div>
            </div>
        </div>
    </div>

    <div class="mt-2 flex gap-2" x-cloak x-show="showSmall(plateType)">
        <div class="card w-80 h-14 justify-between">
            {{ __('small') }}
            <div class="flex gap-1">
                <div class="w-8 text-red-800 font-bold text-2xl" x-text="small"></div>
                <div class="card w-16 h-10 cursor-pointer" @click="addSmall">+</div>
                <div class="card w-16 h-10 cursor-pointer" @click="subSmall">-</div>
            </div>
        </div>
    </div>

    <div class="mt-2 flex gap-2" x-cloak x-show="showMedium(plateType)">
        <div class="card w-80 h-14 justify-between">
            {{ __('medium') }}
            <div class="flex gap-1">
                <div class="w-8 text-red-800 font-bold text-2xl" x-text="medium"></div>
                <div class="card w-16 h-10 cursor-pointer" @click="addMedium">+</div>
                <div class="card w-16 h-10 cursor-pointer" @click="subMedium">-</div>
            </div>
        </div>
    </div>

    <div class="mt-2 flex gap-2" x-cloak x-show="showLarge(plateType)">
        <div class="card w-80 h-14 justify-between">
            {{ __('large') }}
            <div class="flex gap-1">
                <div class="w-8 text-red-800 font-bold text-2xl" x-text="large"></div>
                <div class="card w-16 h-10 cursor-pointer" @click="addLarge">+</div>
                <div class="card w-16 h-10 cursor-pointer" @click="subLarge">-</div>
            </div>
        </div>
    </div>

    @if( auth()->user()->hasPermission('large with khanjer') )
    <div class="mt-2 flex gap-2" x-cloak x-show="showLargeWithKhanjer(plateType)">
        <div class="card w-80 h-14 justify-between">
            {{ __('large with khanjer') }}
            <div class="flex gap-1">
                <div class="w-8 text-red-800 font-bold text-2xl" x-text="largeWithKhanjer"></div>
                <div class="card w-16 h-10 cursor-pointer" @click="addLargeWithKhanjer">+</div>
                <div class="card w-16 h-10 cursor-pointer" @click="subLargeWithKhanjer">-</div>
            </div>
        </div>
    </div>
    @endif

    <input type="hidden" name="small" x-model="small">
    <input type="hidden" name="medium" x-model="medium">
    <input type="hidden" name="large" x-model="large">
    <input type="hidden" name="largeWithKhanjer" x-model="largeWithKhanjer">
    <input type="hidden" name="bike" x-model="bike">

</div>