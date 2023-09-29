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
                                    @foreach($plateStocks as $plateStock)
                                    <tr>
                                        <td>
                                            {{ $plateStock->size}}
                                        </td>
                                        <td>
                                            {{ $plateStock->totalQuantity}}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.stock.transfer.create',['fromBranch'=>$branch->id,'size'=>$plateStock->size]) }}" class="btn btn-outline-primary">
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


                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection