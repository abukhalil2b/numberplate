<!-- Success -->
<div class="p-3">
    @if(session('success'))
    <h1 class="text-success">{{session('success')}}</h1>
    @endif
</div>
<!-- /Success -->

<!-- Errors -->
<div class="p-3">
    @if($errors->any())
    @foreach($errors->all() as $error)

    <div class="text-danger">
        {{ $error}}
    </div>

    @endforeach
    @endif
</div>
<!-- /Errors -->