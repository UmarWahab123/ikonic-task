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
            <!-- Register Form -->
            <div class="col-8">
                <form id="form_register" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <h2>Register</h2>
                        <p>Enter your details to become a member.</p>
                    </div>
                    <input class="form-control" value="2" name="role_id" type="hidden">
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" id="user_name" class="form-control" name="name" placeholder="Enter your name" required>
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="yourname@example.com" required>
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password" required>
                    </div>

                    <div class="form-group d-flex justify-content-end ">
                        <div  class="pr-4">
                            <p><a href="/login">login</a> here</p>
                        </div>
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary">Register</button>

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
                        setTimeout(() => {
                            window.location.href = '/login';
                        }, 3000);
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
