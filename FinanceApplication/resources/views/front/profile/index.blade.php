@extends('layouts.app')
@section('content')
    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Profile</h6>
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Panel</a>
                </li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>

        </div>
        <!-- /.page-title-right -->
    </div>
    <!-- /.page-title -->
    <!-- =================================== -->
    <!-- Different data widgets ============ -->
    <!-- =================================== -->
    <div class="widget-list">
        <div class="row">

            <!-- Tabs Content -->
            <div class="col-12 col-md-12 mr-b-30">
                <ul class="nav nav-tabs contact-details-tab">

                    <li class="nav-item"><a href="#profile-tab-bordered-1" class="nav-link active" data-toggle="tab">Update Profile</a>
                    </li>
                </ul>
                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane active" id="profile-tab-bordered-1">
                        <div class="contact-details-profile">
                            <h5 class="mr-b-20">Update Profile</h5>
                            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="contact-details-cell">
                                            <small class="heading-font-family fw-500">Photo of Profile</small>
                                            <input type="file" name="photo" class="form-control">
                                        </div>
                                        <!-- /.contact-details-cell -->
                                    </div>
                                    <!-- /.col-md-6 -->

                                    <div class="col-md-12">
                                        <div class="contact-details-cell"><small class="heading-font-family fw-500">Name Lastname</small>
                                            <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                                        </div>
                                        <!-- /.contact-details-cell -->
                                    </div>
                                    <!-- /.col-md-6 -->
                                    <div class="col-md-12">
                                        <div class="contact-details-cell"><small class="heading-font-family fw-500">Email</small>
                                            <input type="text" name="email" class="form-control" value="{{ Auth::user()->email }}">
                                        </div>
                                        <!-- /.contact-details-cell -->
                                    </div>
                                    <!-- /.col-md-6 -->
                                    <div class="col-md-12">
                                        <div class="contact-details-cell"><small class="heading-font-family fw-500">Password</small>
                                            <input type="text" name="password" class="form-control" value="">
                                        </div>
                                        <!-- /.contact-details-cell -->
                                    </div>
                                    <!-- /.col-md-6 -->
                                    <div class="col-md-6">
                                        <button class="btn btn-success btn-rounded">Save</button>
                                    </div>
                                    <!-- /.col-md-6 -->
                                </div>
                                <!-- /.row -->
                            </form>
                        </div>

                        <!-- /.row -->
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.col-sm-8 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.widget-list -->

@endsection
