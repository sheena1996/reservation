@extends('layouts.dashboard.app') 
@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-primary">
            <div class="row">
                <div class="col-md-10">
                    <h4 class="card-title ">Reservation Items</h4>
                    <p class="card-category">Lorem ipsum dolor sit amet.</p>
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class=" text-primary">
                        <th></th>
                        <th>
                            Client
                        </th>
                        <th>
                            Classification
                        </th>
                        <th>
                            Total Amount
                        </th>
                        <th>
                            Status
                        </th>
                        <th class="text-right">
                            Actions
                        </th>
                    </thead>
                    <tbody>
                        @forelse ($reservations as $reservation)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $reservation->client->first_name." ".$reservation->client->last_name }}</td>
                            <td>{{ $reservation->classification }}</td>
                            <td>{{ $reservation->total_amount }}</td>
                            <td>
                                @if($reservation->status == 1)
                                    <p class="text-success">Approved</p>
                                @else
                                    <p class="text-danger">Declined</p>
                                @endif
                            </td>
                            <td class="td-actions text-right">
                                <a href="{{ route('admin.reservations.edit', $reservation->id) }}" rel="tooltip" class="btn btn-success" data-original-title="" title="Edit">
                                    <i class="material-icons">edit</i>
                                    <div class="ripple-container"></div> 
                                </a>
                                {!! Form::open(array('action'=>['Admin\ReservationController@destroy', $reservation->id ], 'method' => 'DELETE', 'class' => 'delete-item')) !!}
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
                        <tr>
                            <td>No data to show</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection