@extends('layouts.main')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

        <!-- Content Row -->

        <div class="card">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Change Password</h6>
            </div>
            <div class="card-body">
                <div class="basic-form">

                    @include('partials.alerts')
                    <form action="{{ route('password.change') }}" method="POST" id="staffForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!--- For Edit Purpose-->
                            <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Old Password</label>
                                    <input type="password" value="" name="password" required id="oldpassword"
                                        class="form-control input-default" placeholder="Enter Old Password" minlength="8"
                                        required="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> New Password</label>
                                    <input type="password" name="new_password" id="new_password"
                                        class="form-control input-default" placeholder="Enter New Password" minlength="8"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Confirm New Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-control input-default" placeholder="Confirm New Password" minlength="8"
                                        required>
                                </div>
                            </div>
                            <div class="error-message" id="password-error" style="color: red;"></div>

                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <input type="submit" name="submit" id="submit" value="Update"
                                    class="btn btn-outline-secondary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Content Row -->


    </div>
    <!-- /.container-fluid -->
@endsection
