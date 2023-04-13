@extends('admin_layout.master')

@section('title')
    Category
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Category</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            @include('includes.forms.form-header', [
                                'entity' => $category,
                                'editTitle' => 'Category edit : ' . $category->name,
                                'newTitle' => 'New category',
                                'listUrl' => route('admin.category.index')
                            ])
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ $formAction }}" method="POST">
                                @if($category->id)
                                    @method('PUT')
                                @endif
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="category.name">Category name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                                               value="{{ old('category.name', $category->name) }}" placeholder="Enter category" >
                                        @error('name')
                                        <small class="text-danger"><em>{{ $message }}</em></small>
                                        @enderror
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                @include('includes.forms.form-footer', [
                                    'entity' => $category
                                ])
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection

@section('styles')
    <link rel="stylesheet" href="/node_modules/sweetalert2/dist/sweetalert2.min.css">
@endsection

@section('scripts')
    <script src="/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>

    @if(Session::has("error"))
        <script>
            document.addEventListener("DOMContentLoaded", function(event) {
                Swal.fire({
                    title: '{{ Session::get("error") }}',
                    icon: 'warning',
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    toast: true,
                });
            });
        </script>
    @endif
@endsection
