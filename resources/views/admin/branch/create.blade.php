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
                @include('inc._modal_create_branch')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">الفروع</h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            اسم الفرع
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            المستخدم
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>
                                            {{ $user->name }}

                                            <div class="d-flex justify-content-between">
                                                <a href="{{ route('admin.bill.today_index',$user->id) }}" class="btn btn-xs btn-secondary">  today sales </a>
                                                <a href="{{ route('admin.bill.index',$user->id) }}" class="btn btn-xs btn-secondary">  sales </a>
                                                <a href="{{ route('admin.statement.index',$user->id) }}" class="btn btn-xs btn-secondary">statement </a>
                                                <a href="{{ route('admin.branch.stock.index',$user->id) }}" class="btn btn-xs btn-secondary">stock </a>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $user->email }}
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