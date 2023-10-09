@extends('layouts.admin')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $branch->email }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{ $branch->email }}</li>
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

                    <div class="mt-1 card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.bill.plate.index',$branch->id) }}" class="btn btn-xs btn-secondary"> plate sales </a>
                                <a href="{{ route('admin.bill.extra.index',$branch->id) }}" class="btn btn-xs btn-secondary"> extra sales </a>
                                <a href="{{ route('admin.statement.index',$branch->id) }}" class="btn btn-xs btn-secondary">statement </a>
                                <a href="{{ route('admin.statistic.index',$branch->id) }}" class="btn btn-xs btn-secondary">statistic </a>
                                <a href="{{ route('admin.branch.stock.index',$branch->id) }}" class="btn btn-xs btn-secondary">stock </a>
                            </div>
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