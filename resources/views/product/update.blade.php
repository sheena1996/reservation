@extends('layouts.dashboard.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Add Product </h4>
                    <p class="card-category">Product Form Information</p>
                </div>
                <div class="card-body">
                    {!! Form::open(['method' => 'PUT' ,'route' => ['products.update', $product->id] ]) !!}
                        <div class="row">
                            <div class="col-md-12">
                            <h4 class="font-weight-bold pt-3 pb-2">Product Information</h4>
                                <div class="form-group pb-4">
                                    <label class="bmd-label-floating">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $product->name }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group pb-4">
                                    <label class="bmd-label-floating">SKU</label>
                                        <input type="text" name="sku" class="form-control" value="{{ $product->sku }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group pb-4">
                                    <label class="bmd-label-floating">Cost</label>
                                        <input type="text" name="cost" class="form-control" value="{{ $product->cost }}">
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



