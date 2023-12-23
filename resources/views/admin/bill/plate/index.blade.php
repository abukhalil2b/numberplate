<x-layout.default>
    <div>

    <div class="p-5">
        {{ $branch->name }}
    </div>
        <div>
            <form action="{{ route('admin.bill.plate.search',$branch->id) }}" method="POST">
                @csrf
                <label>
                    type
                    <select name="type" class="form-input">
                        <option @if($type=='private' ) selected @endif value="private">private</option>
                        <option @if($type=='commercial' ) selected @endif value="commercial">commercial</option>
                        <option @if($type=='diplomatic' ) selected @endif value="diplomatic">diplomatic</option>
                        <option @if($type=='temporary' ) selected @endif value="temporary">temporary</option>
                        <option @if($type=='export' ) selected @endif value="export">export</option>
                        <option @if($type=='specific' ) selected @endif value="specific">specific</option>
                        <option @if($type=='learners' ) selected @endif value="learners">learners</option>
                        <option @if($type=='government' ) selected @endif value="government">government</option>
                        <option @if($type=='other' ) selected @endif value="other">other</option>
                    </select>
                </label>
                <label>
                    single/pair
                    <select name="required" class="form-input">
                        <option @if($required=='single' ) selected @endif value="single">single</option>
                        <option @if($required=='pair' ) selected @endif value="pair">pair</option>
                    </select>
                </label>
                <label>
                    from date
                    <input type="date" name="date_from" class="form-input" value="{{ $date_from }}">
                </label>
                <label>
                    to date
                    <input type="date" name="date_to" class="form-input" value="{{ $date_to }}">
                </label>
                <button class="mt-4 btn btn-primary">search</button>
                <div class="mt-4 text-xl text-warning">Result: {{ count($bills) }}</div>
            </form>
        </div>

        <div class="mt-4 table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>
                            plate
                        </th>

                        <th>
                            single/pair
                        </th>

                        <th>
                            رصد
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($bills as $bill)
                    <tr class="bg-white border-b text-xs">

                        <td class="">
                            <div>{{ $bill->type }}</div>
                            <span>{{ $bill->plate_num }}</span>
                            <span>{{ $bill->plate_code }}</span>
                        </td>

                        <td>
                            {{ $bill->required }}
                        </td>

                        <td>
                            {{ $bill->ref_num }}
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout.default>