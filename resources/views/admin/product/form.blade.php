@extends('admin_layout.master')

@section('title')
    Product
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Product</li>
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
                        <div class="card card-success">
                            @include('includes.forms.form-header', [
                                'entity' => $product,
                                'editTitle' => 'Product edit : ' . $product->name,
                                'newTitle' => 'New product',
                                'listUrl' => route('admin.product.index')
                            ])
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
                                @if($product->id)
                                    @method('PUT')
                                @endif
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="product.name">Product name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                               value="{{ old('product.name', $product->name) }}" placeholder="Enter product name">
                                        @error('name')
                                        <small class="text-danger"><em>{{ $message }}</em></small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="product.price">Product price</label>
                                        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                                               value="{{ old('product.price', $product->price) }}" placeholder="Enter product price" min="1">
                                        @error('price')
                                        <small class="text-danger"><em>{{ $message }}</em></small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="product.description">Product description</label>
                                        <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
                                               value="{{ old('product.description', $product->description) }}" placeholder="Enter product description" min="1">
                                        @error('description')
                                        <small class="text-danger"><em>{{ $message }}</em></small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Product category</label>
                                        <select name="category_id" class="form-control select2" style="width: 100%;">
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}" id="product_category_{{$category->id}}"
                                                    {{ $product ? ($product->category->id ?? null) === $category->id ? "selected" : "" : "" }}
                                                >{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label for="product.image">Product image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
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
                                    'entity' => $product
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
