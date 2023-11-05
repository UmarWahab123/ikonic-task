@extends('layouts.main')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <!-- Content Row -->
        <div class="card">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">General Settings</h6>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    @include('partials.alerts')
                    <form action="{{ route('update.GeneralSetting') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @php
                            $setting = get_settings();
                        @endphp
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1" class="form-label">Logo</label>
                                    @if($setting != null && optional($setting)->logo != null)
                                    <img src="{{ asset('img/' . optional($setting)->logo) }}" alt="alternative-text" width="100px"
                                        height="50px">
                                    @endif

                                    <input type="file" name="logo"
                                        class="form-control input-default mt-3">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1" class="form-label">Favicon</label>
                                      @if($setting != null && optional($setting)->favicon != null)
                                    <img src="{{ asset('img/' . optional($setting)->favicon) }}" alt="" width="100px"
                                        height="50px">
                                      @endif
                                    <input type="file" name="favicon"
                                        class="form-control input-default mt-3">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row pt-3">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1" class="form-label">Site Name</label>
                                    <input type="text" class="form-control input-default"
                                        name="site_name" placeholder="Site Name" value="{{ old('site_name')?? optional($setting)->site_name  }}">
                                </div>
                            </div>
                            <!--  -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                                    <input type="email" class="form-control input-default"
                                        name="email" placeholder="Email" value="{{ old('email')?? optional($setting)->email  }}">
                                </div>
                            </div>
                            <!--  -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1" class="form-label">Phone</label>
                                    <input type="number" class="form-control input-default"
                                        name="phone_no" placeholder="Phone" value="{{ old('phone_no')?? optional($setting)->phone_no  }}">
                                </div>
                            </div>
                            <!--  -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1" class="form-label">Copyright</label>
                                    <input type="text" class="form-control input-default"
                                        name="copyright" placeholder="Copyrights 2023 All Rights  Reserved." value="{{ old('copyright')?? optional($setting)->copyright  }}">
                                </div>
                            </div>

                        </div>
                        <div class="form-group row pt-3">
                            <div class="col-sm-10">

                                <input type="submit" name="submit" class="btn btn-outline-secondary">

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
