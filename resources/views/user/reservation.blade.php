@extends('layouts.dashboard.app')

@section('content')
<div class="col-md-12">
    <div class="card reservations">
        <div class="card-header card-header-primary">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="card-title"> Reservations by {{ $client->first_name.' '.$client->last_name }}</h4>
                    <p class="card-category">List of reservation.</p>

                </div>

            </div>
        </div>
        <div class="card-body">

            <div id="accordion" role="tablist">
                @forelse($reservations as $reservation)

                    <div class="card card-collapse">
                        <div class="card-header" role="tab" id="heading{{ $loop->iteration }}">
                            <h5 class="mb-0">
                                <div class="row">
                                    <div class="col-md-9 align-self-center">
                                        <a data-toggle="collapse" href="#collapse{{ $loop->iteration }}" aria-expanded="true" aria-controls="collapse{{ $loop->iteration }}">
                                            <i class="material-icons float-right">keyboard_arrow_down</i>
                                            {{ $loop->iteration }}.<small> &nbsp;Classification: </small><strong>{{ ucfirst($reservation->classification) }}</strong>
                                        </a>
                                    </div>
                                    <div class="col-md-2 align-self-center">
                                        <small> Total Amount:  <strong class="text-primary">{{$reservation->total_amount}}</strong>
                                    </div>
                                    <div class="col-md-1 align-self-center">
                                        {!! Form::open(array('action'=>['Admin\AdminClientReservationController@destroy', $client->id, $reservation->id ], 'method' => 'DELETE', 'class' => 'delete-item')) !!}
                                            <input type="hidden" name="_method" value="DELETE">
                                            {{ csrf_field() }}
                                            <button rel="tooltip" class="btn btn-danger btn-sm float-right align-self-center" data-original-title="" title="Delete">
                                                <i class="material-icons">delete_forever</i> 
                                                <div class="ripple-container"></div> 
                                            </button>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                               
                            </h5>
                        </div>

                        <div id="collapse{{ $loop->iteration }}" class="collapse" role="tabpanel" aria-labelledby="heading{{ $loop->iteration }}" data-parent="#accordion">
                            <div class="card-body">
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class=" text-primary">
                                                <th>
                                                    Product
                                                </th>
                                                <th>
                                                    SKU
                                                </th>
                                                <th>
                                                    Cost
                                                </th>
                                                
                                            </thead>
                                            <tbody>
                                                @forelse($reservation->reservation_item as $item)

                                                    <tr>
                                                        
                                                        <td>
                                                            {{ $item->product->name }}
                                                        </td>
                                                        <td>
                                                            {{  $item->product->sku }}
                                                        </td>
                                                        <td>
                                                            {{  $item->product->cost }}
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
                @empty
                    <h3>No data found</h3>
                @endforelse
            
            </div>

        </div>
    </div>
</div>

@endsection