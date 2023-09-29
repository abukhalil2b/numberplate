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

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">مبيعات اليوم</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            plate
                                        </th>

                                        <th scope="col" class="px-6 py-3">
                                            single/pair
                                        </th>

                                        <th scope="col" class="px-6 py-3">
                                            رصد
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($latestBills as $latestBill)
                                    <tr class="bg-white border-b ">

                                        <td class="px-6 py-4">
                                            <div>{{ $latestBill->type }}</div>
                                            <span>{{ $latestBill->plate_num }}</span>
                                            <span>{{ $latestBill->plate_code }}</span>
                                        </td>

                                        <td class="px-6 py-4">
                                            {{ $latestBill->required }}
                                        </td>

                                        <td class="px-6 py-4">
                                            {{ $latestBill->ref_num }}
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