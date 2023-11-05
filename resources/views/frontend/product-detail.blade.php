<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
     @php $setting = get_settings() @endphp
    <title>{{ optional($setting)->site_name }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/' . optional($setting)->favicon) }}">
    <link href="{{ asset('assets/css/product.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
</head>
<body>
    @include('frontend.header')
    <div class="container mt-5 mb-5">
     <div class="row">
        <div class="col-md-4">
            <img src="{{ asset('img/' . @$product->product_image) }}" alt="Product Image" class="product-image img-fluid">
        </div>
        <div class="col-md-8">
        <div class="product-details">
            <h2>{{@$product->product_title}}</h2>
            <p>{{@$product->product_description}}</p>
            <p>{{@$product->price}}</p>
        </div>
       </div>
      </div>
     <div class="row">
        <div class="col-md-12">
            <div>
                <div class="add-feedback-button text-right">
                    @if(auth()->check())
                    <button class="feedback-button add-feedback">
                        <i class="fas fa-comment"></i> Add Feedback
                    </button>
                    @else
                    <a href="{{ route('login') }}">Log in to add feedback</a>
                    @endif
                </div>
                @foreach ($feedbacks as $item)
                <div class="feedback-container mt-3">
                    <h3 class="feedback-title mt-5">{{ $item->user->name }}</h3>
                    <h3 class="feedback-title">{{ $item->title }}</h3>
                    <p class="feedback-description">{{ $item->description }}</p>
                    <!-- Display the feedback and its details -->
                    <div class="feedback-actions">
                        <!-- Upvote button and count -->
                        @if(auth()->check())
                        @if(Auth::user()->isVoted($item->id))
                        <button class="vote-button upvote bg-primary" feedback-id="{{ $item->id }}" onclick="upvoteFeedback('{{ $item->id }}')" id="voteButton">
                            <i class="fas fa-thumbs-down" id="voteIcon-{{$item->id}}"></i> Liked
                        </button>
                        @else
                        <button class="vote-button upvote" feedback-id="{{ $item->id }}" onclick="upvoteFeedback('{{ $item->id }}')" id="voteButton">
                            <i class="fas fa-thumbs-up " id="voteIcon-{{$item->id}}"></i> Like
                        </button>
                        @endif
                        <span class="upvote-count">{{count($item->votes)}} Upvotes</span>
                        @else
                        <a href="{{ route('login') }}">Log in to Upvote</a>
                        @endif
                    </div><br>
                    <div class="comment-section">
                        <!-- Comments for the feedback -->
                        @foreach ($item->comments as $comment)
                            <div class="comment-box">
                                <p><strong>{{ optional($comment->user)->name }}:</strong> {{ $comment->content }}</p>
                            </div>
                        @endforeach
                        @if (auth()->check())
                            <!-- Add a comment form -->
                            <div class="comment-section" id="comments">
                                <form id="comment-{{ $item->id }}" action="{{ route('store-comment') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" id="user_id">
                                    <input type="hidden" id="feedback_id" name="feedback_id" value="{{ $item->id }}">
                                    <input type="text" id="new-comment" name="content" placeholder="Add a comment..." required>
                                    <button onclick="submitForm('comment-{{ $item->id }}')" class="btn btn-primary">
                                        <i class="fas fa-arrow-right"></i>
                                    </button>
                                </form>
                            </div>
                        @else
                            <a href="{{ route('login') }}">Log in to add a comment</a>
                        @endif
                    </div>
                </div>


            @endforeach
            <!-- Pagination links -->
            </div>
            <div class="text-center">
                {{ $feedbacks->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
</div>
</div>
  <!-- /.container-fluid -->
  <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="feedbackModalLabel">Add Feedback</h5>
                <button type="button" class="close close_modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form method="POST" id="feedbackForm">
                @csrf
                @if(auth()->check())
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" id="user_id">
                @endif
                <input type="hidden" value="{{@$product->id}}" name="product_id" id="product_id">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required></textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control @error('category') is-invalid @enderror" id="category" name="category" required>
                        <option value="">Choose</option>
                        <option value="Bug Report">Bug Report</option>
                        <option value="Feature Request">Feature Request</option>
                        <option value="Improvement">Improvement</option>
                    </select>
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close_modal" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary submit-feedback">Submit</button>
            </div>
        </form>
        </div>
    </div>
</div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
     function submitForm(id) {
       event.preventDefault();
        // Use JavaScript to trigger form submission
        var form = document.getElementById(id);
        var formData = new FormData(form);

        fetch(form.getAttribute('action'), {
            method: 'POST',
            body: formData
        })
        .then(data => {
            location.reload();
        })
        .catch(error => console.error(error));
        // document.getElementById(formId).submit();
    }
    function upvoteFeedback(id) {
        var url = '/vote/' + id;
        $.get(url, function(data) {
            location.reload()

        })
        .fail(function(error) {
            console.error('Error:', error);
        });
        // Use JavaScript to trigger form submission


        // document.getElementById(formId).submit();
    }
     $(document).ready(function() {
        $(".add-feedback").click(function() {
            $("#feedbackModal").modal("show");
        });
        $('#feedbackForm').submit(function(e) {
            e.preventDefault();
            var token = $('input[name=_token]').val();
            var $submitButton = $(".submit-feedback");
            $submitButton.prop('disabled', true).html('Processing...');
            $.ajax({
                type: "post",
                headers: { 'X-CSRF-TOKEN': token },
                url: "{{ route('store-feedback') }}", // Use the named route
                dataType: "json",
                data: $('#feedbackForm').serialize(),
                success: function(data) {
                    Swal.fire(data.response);
                    $('#feedbackForm')[0].reset();
                    $submitButton.prop('disabled', false).html('Submit');
                    $("#feedbackModal").modal("hide");
                    location.reload();
                },
                error: function(xhr, status, error) {
                    Swal.fire('An error occurred while submitting the feedback.');
                    console.error(xhr.responseText);
                    $submitButton.prop('disabled', false).html('Submit');
                }
            });
        });
      $(".close_modal").click(function() {
            $('#feedbackForm')[0].reset();
            $("#feedbackModal").modal("hide");
        });

});
    </script>
</body>
</html>
