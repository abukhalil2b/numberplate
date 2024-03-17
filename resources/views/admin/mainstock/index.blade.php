<x-layout.admin>

    <!-- form -->
    <form method="post" action="{{ route('admin.mainstock.store') }}" class="p-2">
        @csrf


        <div class="bg-private p-3">
            <div class="text-xl">private</div>
            <div class="mt-1 flex">
               <div class="w-40">bike</div>
                <input name="private_bike" type="number" class="w-40 form-input" value="0">
            </div>
            <div class="mt-1 flex">
                <div class="w-40">small</div>
                <input name="private_small" type="number" class="w-40 form-input" value="0">
            </div>
            <div class="mt-1 flex">
                <div class="w-40">medium</div>
                <input name="private_medium" type="number" class="w-40 form-input" value="0">
            </div>
            <div class="mt-1 flex">
                <div class="w-40">large</div>
                <input name="private_large" type="number" class="w-40 form-input" value="0">
            </div>
        </div>


        <button type="submit" class="btn btn-primary !mt-6"> {{__('Add To Mainstock')}} </button>

    </form>
    <!-- /form -->

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Action </th>
                </tr>
            </thead>
            <tbody>
                @foreach($mainstocks as $mainstock)
                <tr>
                    <td>
                        {{ $mainstock->name }}
                    </td>

                    <td>
                        <a href="{{ route('admin.mainstock.edit',$mainstock->id) }}" class="flex gap-1 items-center">
                            <x-svgicon.pen />
                            {{ __('Edit') }}
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <h1 class="text-3xl text-center text-red-600">UNDER CONSTRUCTION</h1>
    </x-layout.default>