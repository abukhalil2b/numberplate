@extends('layouts.admin')

@section('title', 'statements')

@section('content')
<!-- DataTables -->

<link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>Statement</h3>
                    <h6 class=" text-danger">month: ({{ $thisMonth }}) | Branch: {{ $branch->name }}</h6>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Statement</li>
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

                    <!-- TABLE: statement -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <form action="{{ route('admin.statement.search',$branch->id) }}" method="POST">
                                    @csrf
                                    <label>
                                        months
                                        <select name="month" class="form-control">
                                            @foreach($months as $month)
                                            <option @if($thisMonth==$month) selected @endif value="{{ $month }}">{{ $month }}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                    <button class="btn btn-primary">search</button>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="example1_wrapper" class="">

                                <div class="row">
                                    <div class="col-sm-12" style="overflow: scroll;">
                                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                                            <thead>
                                                <tr>
                                                    <th>type</th>
                                                    <th>single/pair</th>
                                                    <th>size</th>
                                                    <th>total</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach($statements as $statement)
                                                <tr>
                                                    <td>
                                                        <div>{{ $statement->type }}</div>
                                                    </td>

                                                    <td>
                                                        {{ $statement->required }}
                                                    </td>

                                                    <td>
                                                        {{ $statement->size }}
                                                    </td>

                                                    <td>
                                                        {{ $statement->total }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>

                                            <tfoot>
                                                <tr>
                                                    <th rowspan="1" colspan="1">type</th>
                                                    <th rowspan="1" colspan="1">single/pair</th>
                                                    <th rowspan="1" colspan="1"> size </th>
                                                    <th rowspan="1" colspan="1">total</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /.card-body -->
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

@section('script')
@parent

<!-- DataTables  & Plugins -->
<script src="{{ asset('AdminLTE-3.2.0/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
    $(function() {
        $("#example1").DataTable({
            "lengthChange": true,
            "autoWidth": false,
            "buttons": ["excel", "pdf", "print", "colvis"],
            lengthMenu: [50, 100, 200, 500],
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });
</script>

@endsection