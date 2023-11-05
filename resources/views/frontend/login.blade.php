<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row d-flex justify-content-center aling-items-center">
            <!-- Login Form -->
            <div class="col-8">
                @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form id="form_login" method="post" action="{{url('/authenticate-user')}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <h2>Login</h2>
                        <p>Enter your credentials to log in.</p>
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" value="umarwahab672@gmail.com" class="form-control" name="email" id="login_email" placeholder="yourname@example.com" required>
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <input type="password" value="password" name="password" class="form-control" id="login_password" placeholder="Enter Password" required>
                    </div>
                    <div class="form-group d-flex justify-content-end ">
                        <div  class="pr-4">
                            <p><a href="/register">Register</a> here</p>
                        </div>
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary">Login</button>

                        </div>
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
     $(document).ready(function() {
        $('#form_register').submit(function(e) {
            e.preventDefault();
            var token = $('input[name=_token]').val();
            var formdata = $('#form_register').serialize();

            $.ajax({
                type: "post",
                headers: { 'X-CSRF-TOKEN': token },
                url: "{{ url('/user-register') }}",
                dataType: "json",
                data: formdata,
                success: function(data) {
                    if (data.response == 1) {
                        Swal.fire('You Have Successfully Registered!');
                        $('#form_register')[0].reset();
                    }
                    else {
                        Swal.fire('Email is already in use. Please use a different email.');
                    }
                }
            });
        });
    });

    </script>
</body>
</html>
