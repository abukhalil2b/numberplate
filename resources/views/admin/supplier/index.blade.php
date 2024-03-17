<x-layout.admin>
    @include('admin.supplier._modal_create_supplier')
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Action </th>
                </tr>
            </thead>
            <tbody>
                @foreach($suppliers as $supplier)
                <tr>
                    <td>
                        {{ $supplier->name }}
                    </td>

                    <td>
                        <a href="{{ route('admin.supplier.edit',$supplier->id) }}" class="flex gap-1 items-center">
                            <x-svgicon.pen />
                            {{ __('Edit') }}
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    </x-layout.default>