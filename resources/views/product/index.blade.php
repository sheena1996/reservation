@extends('layouts.dashboard.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-primary">
            <div class="row">
                <div class="col-md-10">
                    <h4 class="card-title ">Product List</h4>
                    <p class="card-category">List of all products</p>
                </div>
                <div class="col-md-2">
                    <a href="{{ url('admin/products/create') }}" class="btn btn-white btn-sm float-right">Add Product</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class=" text-primary">
                        <th>
                            ID
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            SKU
                        </th>
                        <th>
                            Cost
                        </th>
                        <th class="text-right">
                            Actions
                        </th>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>
                                    {{ $product->id }}
                                </td>
                                <td>
                                    {{ ucwords($product->name) }}
                                </td>
                                <td>
                                    {{  $product->sku }}
                                </td>
                                <td>
                                    {{  $product->cost }}
                                </td>
                                <td class="td-actions text-right">
                                   
                                    <a href="{{ route('products.edit', $product->id) }}" rel="tooltip" class="btn btn-success" data-original-title="" title="Edit">
                                        <i class="material-icons">edit</i>
                                        <div class="ripple-container"></div>
                                    </a>
                                    

                                    {!! Form::open(array('action'=>['Admin\ProductController@destroy', $product->id ], 'method' => 'DELETE', 'class' => 'delete-item')) !!}
                                        <input type="hidden" name="_method" value="DELETE">
                                        {{ csrf_field() }}
                                        <button rel="tooltip" class="btn btn-danger" data-original-title="" title="Delete">
                                            <i class="material-icons">delete_forever</i>
                                            <div class="ripple-container"></div>
                                        </button>
                                    {!! Form::close() !!}
                                    
                                </td>
                            </tr>
                        @empty
                            <tr><td>No data to show</td></tr>
                        @endforelse                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

   
</div>
@endsection