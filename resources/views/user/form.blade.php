@extends('layouts.dashboard.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header card-header-primary">
                    @if(isset($action) && ( $action == 'create' ))
                        <h4 class="card-title">Add User </h4>
                        <p class="card-category">Form Information</p>
                    @else
                        <h4 class="card-title">Edit User </h4>
                        <p class="card-category">Form Information</p>
                    @endif
                </div>
                <div class="card-body">
                    @if( isset($action) && $action != 'adminAccount')

                        @if(isset($action) && ( $action == 'create' ))
                            {!! Form::open(array('action' => ['Admin\AdminUserController@store'], 'method' => 'POST' )) !!}
                        @else
                            {!! Form::open(['method' => 'PUT' ,'route' => ['users.update', $user->id] ]) !!}
                        @endif
                            <!-- User Info -->
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="font-weight-bold pt-3 pb-2">Profile Information</h4>
                                    <div class="form-group pb-4">
                                        <label class="bmd-label-floating">Fist Name</label>
                                        <input type="text" name="first_name" class="form-control"
                                        @if(isset($action) && ($action == 'update'))
                                            value="{{ $user->client->first_name }}" 
                                        @else
                                            value="" 
                                        @endif >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group pb-4">
                                        <label class="bmd-label-floating">Last Name</label>
                                        <input type="text" name="last_name" class="form-control"
                                        @if(isset($action) && ($action == 'update'))
                                            value="{{ $user->client->last_name }}" 
                                        @else
                                            value="" 
                                        @endif >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group pb-4">
                                        <label class="bmd-label-floating">Contact Number</label>
                                        <input type="text" name="contact_number" class="form-control"
                                        @if(isset($action) && ($action == 'update'))
                                            value="{{ $user->client->contact_number }}" 
                                        @else
                                            value="" 
                                        @endif >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group pb-4">
                                        <label class="bmd-label-floating">Adress</label>
                                        <input type="text" name="address" class="form-control"
                                        @if(isset($action) && ($action == 'update'))
                                            value="{{ $user->client->address }}" 
                                        @else
                                            value="" 
                                        @endif >
                                    </div>
                                </div>
                            </div>
                            <!-- Account Info -->
                            <div class="row">
                                <div class="col-md-12">
                                <h4 class="font-weight-bold pt-3 pb-2">Account Information</h4>
                                    <div class="form-group pb-4">
                                        <label class="bmd-label-floating">Email address</label>
                                        <input type="email" name="email" class="form-control"
                                        @if(isset($action) && ($action == 'update') || ($action == 'adminAccount'))
                                            value="{{ $user->email }}" 
                                        @else
                                            value="" 
                                        @endif >
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
                    @else
                        {!! Form::open(['method' => 'PUT' ,'route' => ['admin.update', $user->id] ]) !!}
                            <div class="row">
                                <div class="col-md-12">
                                <h4 class="font-weight-bold pt-3 pb-2">Account Information</h4>
                                    <div class="form-group pb-4">
                                        <label class="bmd-label-floating">Email address</label>
                                        <input type="email" name="email" class="form-control"
                                        @if(isset($action) && ($action == 'update') || ($action == 'adminAccount'))
                                            value="{{ $user->email }}" 
                                        @else
                                            value="" 
                                        @endif >
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
                    @endif
                </div>
            </div>            
        </div>

    </div>
</div>


@endsection



