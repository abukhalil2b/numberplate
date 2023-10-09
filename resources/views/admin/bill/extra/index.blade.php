@extends('layouts.admin')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> {{ $branch->name }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"> {{ $branch->name }}</li>
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
                            <form action="{{ route('admin.bill.extra.search',$branch->id) }}" method="POST">
                                @csrf
                                <label>
                                    from date
                                    <input type="date" name="date_from" class="form-control" value="{{ $date_from }}">
                                </label>
                                <label>
                                    to date
                                    <input type="date" name="date_to" class="form-control" value="{{ $date_to }}">
                                </label>
                                <button class="btn btn-primary">search</button>
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            description
                                        </th>
                                        <th>
                                            quantity
                                        </th>
                                        <th>
                                            total price
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $item)
                                    <tr class="bg-white border-b text-xs">
                                        <td>
                                            {{ $item->description }}
                                        </td>
                                        <td>
                                            {{ $item->quantity }}
                                        </td>
                                        <td>
                                            {{ $item->totalPrice }}
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

        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection