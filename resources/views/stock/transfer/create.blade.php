<x-app-layout>
    <div class="px-5 md:px-20">
    
    @if($type == 'private')
    @include('stock.transfer._private')
    @endif

    @if($type == 'commercial')
    @include('stock.transfer._commercial')
    @endif

    @if($type == 'diplomatic')
    @include('stock.transfer._diplomatic')
    @endif

    @if($type == 'specific')
    @include('stock.transfer._specific')
    @endif

    @if($type == 'learner')
    @include('stock.transfer._learner')
    @endif

    @if($type == 'government')
    @include('stock.transfer._government')
    @endif

    </div>
</x-app-layout>