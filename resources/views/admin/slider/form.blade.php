@extends('admin_layout.master')

@section('title')
    Slider
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Slider</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Slider</li>
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
                                'entity' => $slider,
                                'editTitle' => 'Slider edit : ' . $slider->name,
                                'newTitle' => 'New slider',
                                'listUrl' => route('admin.slider.index')
                            ])

                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
                                @if($slider->id)
                                    @method('PUT')
                                @endif
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="slider.description1">Slider description 1</label>
                                        <input type="text" name="description1" class="form-control @error('description1') is-invalid @enderror"
                                               value="{{ old('slider.description1', $slider->description1) }}" placeholder="Enter slider description">
                                        @error('description1')
                                        <small class="text-danger"><em>{{ $message }}</em></small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="slider.description2">Slider description 2</label>
                                        <input type="text" name="description2" class="form-control @error('description2') is-invalid @enderror"
                                               value="{{ old('slider.description2', $slider->description2) }}" placeholder="Enter slider description">
                                        @error('description2')
                                        <small class="text-danger"><em>{{ $message }}</em></small>
                                        @enderror
                                    </div>
                                    <label for="slider.image">Slider image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="image">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                    @error('image')
                                    <small class="text-danger"><em>{{ $message }}</em></small>
                                    @enderror
                                </div>
                                <!-- /.card-body -->
                                @include('includes.forms.form-footer', [
                                    'entity' => $slider
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
