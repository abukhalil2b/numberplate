@extends('layouts.admin')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">plate stock monitor</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered text-xs">
                                <thead>
                                    <tr>
                                        <th>
                                            date
                                        </th>
                                        <th>
                                            status
                                        </th>
                                        <th>
                                            note
                                        </th>
                                        <th>
                                            size
                                        </th>
                                        <th>
                                            quantity
                                        </th>
                                        <th>
                                            branch
                                        </th>
                                        <th>
                                            description
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($plateStocks as $plateStock)
                                    <tr>
                                        <td class="text-xs">
                                            {{ $plateStock->created_at->format('d-m-Y') }}
                                        </td>
                                        <td>
                                            @if($plateStock->instock == 1)
                                            <span class="text-success">IN</span>
                                            @else
                                            <span class="text-warning">OUT</span>
                                            @endif

                                        </td>
                                        <td class="text-xs">
                                            {{ $plateStock->note }}
                                        </td>
                                        <td>
                                            {{ $plateStock->size }}
                                        </td>
                                        <td>
                                            {{ abs($plateStock->quantity) }}
                                        </td>

                                        <td>
                                            {{ $plateStock->branch->name }}
                                        </td>

                                        <td class="px-6 py-1 ">
                                            <div class="text-xs">{{ $plateStock->description }}</div>
                                        </td>


                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">

                        </div>
                    </div>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection