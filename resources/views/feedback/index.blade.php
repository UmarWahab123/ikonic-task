@extends('layouts.main')
@section('title', 'All Feedback')
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
                <h6 class="m-0 font-weight-bold text-primary">All Feedback</h6>
            </div>
            <div class="card-body">
                @include('partials.alerts')
                <table id="feedback-table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>User Name</th>
                            <th>Product Title</th>
                            <th>Feedback Title</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($feedbacks as $key=>$feedback)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $feedback->user->name }}</td>
                                <td>{{ $feedback->products->product_title }}</td>
                                <td>{{ $feedback->title }}</td>
                                <td>{{ Illuminate\Support\Str::limit($feedback->description, 15, '...') }}</td>
                                <td>{{ $feedback->category }}</td>
                                <td><button type="button" data-id="{{$feedback->id}}" class="btn btn-danger delete-button" data-toggle="modal" data-target="#deleteModal">Delete </button></td>
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
          <h5 class="modal-title" id="exampleModalLabel">Delete Feedback</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
         </div>
         <div class="modal-body">
          <p>Are you sure you want to delete this feeedback ?</p>
          <form action="{{url('/delete-feedback')}}" method="POST">
              @csrf
            <input type="hidden" name="id" id="delete-id">
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
        var feedbackId = $(this).attr("data-id"); // Get the data-id attribute value
        $("#deleteModal input[name='id']").val(feedbackId); // Set the value of the hidden input field
    });
    });
</script>
