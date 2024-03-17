<x-layout.admin>
    <!-- form -->
    <form method="post" action="{{ route('admin.mainstock.update',$mainstock->id) }}" class="p-2">
        @csrf

        <div class="mt-5 {{ $errors->get('name') ? 'has-error':'' }} ">
            <label for="inputName"> Name </label>
            <input id="inputName" name="name" type="text" placeholder="name" class="form-input" required value="{{ $mainstock->name }}" />
        </div>

        <button type="submit" class="btn btn-primary !mt-6"> {{__('Update')}} </button>

    </form>
    <!-- /form -->
    </x-layout.default>