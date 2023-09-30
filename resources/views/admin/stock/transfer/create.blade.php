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
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->

@endsection