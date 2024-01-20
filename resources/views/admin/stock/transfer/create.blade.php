<x-layout.admin>

@if($type == 'private')
@include('admin.stock.transfer._private')
@endif

@if($type == 'commercial')
@include('admin.stock.transfer._commercial')
@endif

@if($type == 'diplomatic')
@include('admin.stock.transfer._diplomatic')
@endif

@if($type == 'temporary')
@include('admin.stock.transfer._temporary')
@endif

@if($type == 'export')
@include('admin.stock.transfer._export')
@endif

@if($type == 'specific')
@include('admin.stock.transfer._specific')
@endif

@if($type == 'learner')
@include('admin.stock.transfer._learner')
@endif

@if($type == 'government')
@include('admin.stock.transfer._government')
@endif

</x-layout.admin>