@extends('layouts.admin')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard v2</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v2</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-12">
                    @include('inc._modal_create_stock')
                    <div class="mt-3 p-3 text-xl text-red-800">
                        {{ $branch->name}}
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Bordered Table</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>

                                        <th>Size</th>
                                        <th>Total Quantity</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($groupedPlateStocks as $groupedPlateStock)
                                    <tr>
                                        <td>
                                            {{ $groupedPlateStock->size}}
                                        </td>
                                        <td>
                                            {{ $groupedPlateStock->totalQuantity}}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.stock.transfer.create',['fromBranch'=>$branch->id,'size'=>$groupedPlateStock->size]) }}" class="btn btn-outline-primary">
                                                transfer
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Second row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> last 10 records of plate stock ( {{ $branch->name }} )</h3>
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
                                            type
                                        </th>
                                        <th>
                                            quantity
                                        </th>
                                        <th>
                                            description
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($branchPlateStocks as $branchPlateStock)
                                    <tr>
                                        <td class="text-xs">
                                            {{ $branchPlateStock->created_at->format('d-m-Y') }}
                                        </td>
                                        <td>
                                            @if($branchPlateStock->instock == 1)
                                            <span class="text-success">IN</span>
                                            @else
                                            <span class="text-warning">OUT</span>
                                            @endif

                                        </td>
                                        <td class="text-xs">
                                            {{ $branchPlateStock->note }}
                                        </td>
                                        <td>
                                            {{ $branchPlateStock->size }}
                                        </td>
                                        <td>
                                            {{ $branchPlateStock->type }}
                                        </td>
                                        <td>
                                            {{ abs($branchPlateStock->quantity) }}
                                        </td>

                                        <td class="px-6 py-1 ">
                                            <div class="text-xs">{{ $branchPlateStock->description }}</div>
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
            <!-- /Second row -->

        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection