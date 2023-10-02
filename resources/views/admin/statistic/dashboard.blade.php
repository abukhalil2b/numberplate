@extends('layouts.admin')

@section('title', 'Statistics')

@section('content')
<!-- DataTables -->

<link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-12">

                    <!-- TABLE: Statistic -->
                    @foreach($branches as $branch)
                    <div class="mt-1 card">

                            <a class="card-body" href="{{ route('admin.statistic.index',$branch->id) }}">
                                {{ $branch->name }}
                            </a>
                     
                        </div>
                        @endforeach

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