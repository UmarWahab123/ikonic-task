@extends('layouts.main')
@section('title', 'Add Product')
@section('css')
    <style>
        #formFileold {
            border: none;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add Product</h6>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form action="{{ route('store-product') }}" method="post" enctype="multipart/form-data">
                        @csrf <!-- Add CSRF token for security -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="product_title">Product Title</label>
                                    <input type="text" class="form-control @error('product_title') is-invalid @enderror" id="product_title" name="product_title" required>
                                    @error('product_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="product_price">Product Price</label>
                                    <input type="text" class="form-control @error('product_price') is-invalid @enderror" id="product_price" name="product_price" required>
                                    @error('product_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="product_image">Product Image</label>
                                    <input type="file" class="form-control @error('product_image') is-invalid @enderror" id="product_image" name="product_image" accept="image/*" required>
                                    @error('product_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="product_description">Product Description:</label>
                                    <textarea class="form-control @error('product_description') is-invalid @enderror" id="product_description" name="product_description" rows="4"></textarea>
                                    @error('product_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                        <a href="{{url('/products')}}" class="btn btn-dark">Back</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
