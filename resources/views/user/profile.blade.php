@extends('layouts.dashboard.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">User </h4>
                    <p class="card-category">Form Information</p>
                </div>
                <div class="card-body">
                    {!! Form::open(['method' => 'PUT' ,'route' => ['users.update', $user->id] ]) !!}
                        <!-- User Info -->
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="font-weight-bold pt-3 pb-2">Profile Information</h4>
                                <div class="form-group pb-4">
                                    <label class="bmd-label-floating">Fist Name</label>
                                    <input type="text" name="first_name" class="form-control" value="{{ $user->client->first_name }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group pb-4">
                                    <label class="bmd-label-floating">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" value="{{ $user->client->last_name }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group pb-4">
                                    <label class="bmd-label-floating">Contact Number</label>
                                    <input type="text" name="contact_number" class="form-control" value="{{ $user->client->contact_number }}" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group pb-4">
                                    <label class="bmd-label-floating">Adress</label>
                                    <input type="text" name="address" class="form-control" value="{{ $user->client->address }}">
                                </div>
                            </div>
                        </div>
                        <!-- Account Info -->
                        <div class="row">
                            <div class="col-md-12">
                            <h4 class="font-weight-bold pt-3 pb-2">Account Information</h4>
                                <div class="form-group pb-4">
                                    <label class="bmd-label-floating">Email address</label>
                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" >
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group pb-4">
                                    <label class="bmd-label-floating">Password</label>
                                        <input type="password" name="password" class="form-control" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group pb-4">
                                    <label class="bmd-label-floating">Password Confirmation</label>
                                        <input type="password" name="password_confirmation" class="form-control" value="">
                                </div>
                            </div>
                            
                        </div>

                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
                        <div class="clearfix"></div>

                    {{ Form::close() }}
                </div>
            </div>            
        </div>

    </div>
</div>

@endsection



