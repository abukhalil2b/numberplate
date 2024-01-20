@if($errors->any())
@foreach($errors->all() as $error)
<div class="p-3 mt-3">
    <div class="text-red-400">
        {{ $error}}
    </div>
</div>
@endforeach
@endif