<x-layout.default>
    <div>
        <form action="{{ route('admin.stock.transfer.store') }}" method="post">

            @csrf

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                size
                            </th>
                            <th scope="col" class="px-6 py-3">
                                From Branch
                            </th>
                            <th scope="col" class="px-6 py-3">
                                To Branch
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>
                                {{ $size}}
                            </td>
                            <td>
                                {{ $fromBranch->name}}
                            </td>
                            <td>
                                <div class="form-group">
                                    <label>Select Branch</label>
                                    <select class="form-control" name="toBranch_id">
                                        @foreach($branches as $branch)
                                        <option value="{{ $branch->id }}">
                                            {{ $branch->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="3">

                                <div class="form-group">
                                    <label for="exampleInpuQuantity"> quantity </label>
                                    <input name="quantity" type="number" value="{{ $plateStock->quantity }}" class="form-control" id="exampleInpuQuantity" placeholder="quantity">
                                </div>

                                <p class="text-orange-400">maximam is: {{ $plateStock->quantity }}</p>
                                <input type="hidden" name="size" value="{{ $size }}">
                                <input type="hidden" name="fromBranch_id" value="{{ $fromBranch->id }}">

                                <button class="btn btn-primary">transfer</button>

                                <!-- show errors -->
                                @foreach($errors->all() as $error)

                                <div class="text-danger">
                                    {{ $error}}
                                </div>

                                @endforeach

                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </form>
    </div>
</x-layout.default>