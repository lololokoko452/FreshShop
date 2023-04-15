@extends('admin_layout.master')

@section('title')
    Sliders
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sliders</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Sliders</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Sliders</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Num.</th>
                                        <th>Picture</th>
                                        <th>Description one</th>
                                        <th>Description Two</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sliders as $slider)
                                        <tr>
                                            <td>{{ $slider->id }}</td>
                                            <td>
                                                <img src="{{ asset("storage/slider_images/" . $slider->imageName) }}" style="height : 50px; width : 50px" class="img-circle elevation-2" alt="Slider Image">
                                            </td>
                                            <td>{{ $slider->description1 }}</td>
                                            <td>{{ $slider->description2 }}</td>
                                            <td>
                                                @if($slider->status)
                                                    <a href="{{ route("admin.slider.status", compact("slider")) }}" class="btn btn-warning">Unactivate</a>
                                                @else
                                                    <a href="{{ route("admin.slider.status", compact("slider")) }}" class="btn btn-success">Activate</a>
                                                @endif
                                                <a href="{{ route("admin.slider.edit", compact("slider")) }}" class="btn btn-primary"><i class="nav-icon fas fa-edit"></i></a>
                                                <a href="{{ route("admin.slider.delete", compact("slider")) }}" class="btn btn-danger" ><i class="nav-icon fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Num.</th>
                                        <th>Picture</th>
                                        <th>Description one</th>
                                        <th>Description Two</th>
                                        <th>Actions</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset("backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}">
    <link rel="stylesheet" href="{{ asset("backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css") }}">
@endsection

@section('scripts')
    <!-- DataTables -->
    <script src="{{ asset("backend/plugins/datatables/jquery.dataTables.min.js") }}"></script>
    <script src="{{ asset("backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") }}"></script>
    <script src="{{ asset("backend/plugins/datatables-responsive/js/dataTables.responsive.min.js") }}"></script>
    <script src="{{ asset("backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js") }}"></script>

    <!-- page script -->
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

    @if(Session::has("success"))
        <script>
            document.addEventListener("DOMContentLoaded", function(event) {
                Swal.fire({
                    title: '{{ Session::get("success") }}',
                    icon: 'success',
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    toast: true,
                });
            });
        </script>
    @endif

@endsection
