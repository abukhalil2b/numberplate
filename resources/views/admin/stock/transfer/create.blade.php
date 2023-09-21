<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <div class="p-3">

        <div class="p-5 border rounded border-red-800 text-xl">
            <div class="flex gap-3">
                <div class="w-32">size</div>
                <div>{{ $size}}</div>
            </div>
            <div class="flex gap-3">
                <div class="w-32">
                    From Branch
                </div>
                <div>
                    {{ $fromBranch->name}}
                </div>
            </div>

        </div>

        <form action="{{ route('admin.stock.transfer.store') }}" method="post">
            <div class="mt-3 p-5 border rounded border-red-800" x-data="{ branch_id:'',selectBranch(id){this.branch_id = id;} }">
                To Branch
                @csrf
                <div class="flex flex-wrap gap-3">
                    @foreach($branches as $branch)

                    <div @click="selectBranch({{ $branch->id }})" class="cursor-pointer card" :class="branch_id == {{ $branch->id }} ? 'selectedCard' : '' ">
                        {{ $branch->name}}
                    </div>

                    @endforeach
                </div>
                
                <input type="hidden" name="toBranch_id" x-model="branch_id">
                <input type="hidden" name="size" value="{{ $size }}">
                <input type="hidden" name="fromBranch_id" value="{{ $fromBranch->id }}">
                quantity
                <input type="number" name="quantity" value="{{ $plateStock->quantity }}" class="mt-2 rounded w-32">
                <p class="text-orange-400">maximam is: {{ $plateStock->quantity }}</p>
            </div>
            <button class="mt-2 btn">transfer</button>
        </form>

        <x-input-error :messages="$errors->get('branch_id')" />

    </div>

</x-app-layout>