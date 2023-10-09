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
                            <form action="{{ route('admin.bill.plate.search',$branch->id) }}" method="POST">
                            @csrf
                                <label>
                                    type
                                    <select name="type" class="form-control">
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
                                    <select name="required" class="form-control">
                                        <option @if($required=='single' ) selected @endif value="single">single</option>
                                        <option @if($required=='pair' ) selected @endif value="pair">pair</option>
                                    </select>
                                </label>
                                <label>
                                    from date
                                    <input type="date" name="date_from" class="form-control" value="{{ $date_from }}">
                                </label>
                                <label>
                                    to date
                                    <input type="date" name="date_to" class="form-control" value="{{ $date_to }}">
                                </label>
                                <button class="btn btn-primary">search</button>
                                <div class="text-xl text-danger">Result: {{ count($bills) }}</div>
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
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