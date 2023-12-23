<x-slot:title>{{ $title }}</x-slot>
<div class="table-responsive">
<h1 class="p-3">
                month: ({{ $thisMonth }}) | Branch: {{ $branch->name }}
            </h1>


            <div class="p-3">


                <form action="{{ route('admin.statement.search',$branch->id) }}" method="POST" x-data="{ focus: false }" @click.outside="focus = false">
                    @csrf
                    months
                  <div class="flex gap-2">
                     
                        
                        <select name="month" class="form-select text-white-dark">
                            @foreach($months as $month)
                            <option @if($thisMonth==$month) selected @endif value="{{ $month }}">{{ $month }}</option>
                            @endforeach
                        </select>
                   

                    <button type="submit" class="btn btn-primary gap-2">
                        <svg class="mx-auto" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="11.5" cy="11.5" r="9.5" stroke="currentColor" stroke-width="1.5" opacity="0.5"></circle>
                            <path d="M18.5 18.5L22 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                        </svg>
                        search
                    </button>
                  </div>

                </form>
    <table >
        <thead>
            <tr>
                <th>type</th>
                <th>single/pair</th>
                <th>size</th>
                <th>total</th>
            </tr>
        </thead>
        <tbody>

            @foreach($statements as $statement)
            <tr>
                <td>
                    <div>{{ $statement->type }}</div>
                </td>

                <td>
                    {{ $statement->required }}
                </td>

                <td>
                    {{ $statement->size }}
                </td>

                <td>
                    {{ $statement->total }}
                </td>
            </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <th rowspan="1" colspan="1">type</th>
                <th rowspan="1" colspan="1">single/pair</th>
                <th rowspan="1" colspan="1"> size </th>
                <th rowspan="1" colspan="1">total</th>
            </tr>
        </tfoot>
    </table>
</div>