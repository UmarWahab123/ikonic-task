@extends('layouts.main')
@section('title', 'Products')
@section('css')
    <style>
        #formFileold {
            border: none;
        }
    </style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

@endsection
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Products</h6>
            </div>
            <div class="card-header py-3 text-right">
                <a class="btn btn-primary" href="{{url('/add-product')}}">Add Product</a>

            </div>
            <div class="card-body">
                @include('partials.alerts')
                <table id="product-table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Product Title</th>
                            <th>Product Price</th>
                            <th>Product Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $key=>$product)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td><img src="{{ asset('img/' . $product->product_image) }}" alt=""
                                    width="60"></td>
                                <td>{{ $product->product_title }}</td>
                                <td>{{ $product->product_price }}</td>
                                <td><button type="button" data-id="{{$product->id}}" class="btn btn-danger delete-button" data-toggle="modal" data-target="#deleteModal">Delete </button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
        <div class="modal-content">
         <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
         </div>
         <div class="modal-body">
          <p>Are you sure you want to delete this product ?</p>
          <form action="{{url('/delete-product')}}" method="POST">
              @csrf
            <input type="text" name="id" id="delete-id">
        </div>
        <div class="modal-footer">
         <button type="button" class="btn btn-secondary close_delete_modal" data-dismiss="modal" id="close_delete_modal">No</button>
          <button type="submit" class="btn btn-danger">Yes</button>
         </div>
          </form>
        </div>
        </div>
        </div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
     $(document).ready(function() {
        $(".delete-button").click(function() {
        var productId = $(this).attr("data-id"); // Get the data-id attribute value
        $("#deleteModal input[name='id']").val(productId); // Set the value of the hidden input field
    });
    });
</script>
