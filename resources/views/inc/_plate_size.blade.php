<div class="mt-6" x-data="size">
    <div class="flex gap-2">
        <div class="card">small</div>
        <div class="flex gap-1">
            <div class="card w-10 cursor-pointer" @click="addSmall">+</div>
            <div class="card w-10 cursor-pointer text-red-800 font-bold" x-text="small"></div>
            <div class="card w-10 cursor-pointer" @click="subSmall">-</div>
        </div>
    </div>

    <div class="mt-2 flex gap-2">
        <div class="card">medium</div>
        <div class="flex gap-1">
            <div class="card w-10 cursor-pointer" @click="addMedium">+</div>
            <div class="card w-10 cursor-pointer text-red-800 font-bold" x-text="medium"></div>
            <div class="card w-10 cursor-pointer" @click="subMedium">-</div>
        </div>
    </div>

    <div class="mt-2 flex gap-2">
        <div class="card">large</div>
        <div class="flex gap-1">
            <div class="card w-10 cursor-pointer" @click="addLarge">+</div>
            <div class="card w-10 cursor-pointer text-red-800 font-bold" x-text="large"></div>
            <div class="card w-10 cursor-pointer" @click="subLarge">-</div>
        </div>
    </div>

    <div class="mt-2 flex gap-2">
        <div class="card">large with khanger</div>
        <div class="flex gap-1">
            <div class="card w-10 cursor-pointer" @click="addLargeWithKhanjer">+</div>
            <div class="card w-10 cursor-pointer text-red-800 font-bold" x-text="largeWithKhanjer"></div>
            <div class="card w-10 cursor-pointer" @click="subLargeWithKhanjer">-</div>
        </div>
    </div>

    <div class="mt-2 flex gap-2">
        <div class="card">bike</div>
        <div class="flex gap-1">
            <div class="card w-10 cursor-pointer" @click="addBike">+</div>
            <div class="card w-10 cursor-pointer text-red-800 font-bold" x-text="bike"></div>
            <div class="card w-10 cursor-pointer" @click="subBike">-</div>
        </div>
    </div>
    <input type="hidden" name="small" x-model="small">
    <input type="hidden" name="medium" x-model="medium">
    <input type="hidden" name="large" x-model="large">
    <input type="hidden" name="largeWithKhanjer" x-model="largeWithKhanjer">
    <input type="hidden" name="bike" x-model="bike">


</div>