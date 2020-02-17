@extends('layouts.dashboard.app') 
@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-primary">
            <div class="row">
                <div class="col-md-10">
                    <h4 class="card-title"> Reservations</h4>
                    <p class="card-category">Lorem ipsum dolor sit amet..</p>
                </div>
                <div class="col-md-2">
                    <a href="{{ url('clients/reservations/create') }}" class="btn btn-white btn-sm float-right">Add Reservation</a>
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
                            <td>{{ ucwords($reservation->client->first_name." ".$reservation->client->last_name) }}</td>
                            <td>{{ ucwords($reservation->classification) }}</td>
                            <td>{{ $reservation->total_amount }}</td>
                            <td>
                                @if($reservation->status == 1)
                                    <p class="text-success">Approved</p>
                                @elseif($reservation->status == 0)
                                     <p class="text-warning">Declined</p>
                                @else
                                    <p class="text-danger">Pending</p>
                                @endif
                            </td>
                            <td class="td-actions text-right">
                                <a href="{{ route('client.reservations.edit', $reservation->id) }}" rel="tooltip" class="btn btn-success" data-original-title="" title="Edit">
                                    <i class="material-icons">edit</i>
                                    <div class="ripple-container"></div> 
                                </a>
                                {!! Form::open(array('action'=>['Client\ReservationController@destroy', $reservation->id ], 'method' => 'DELETE', 'class' => 'delete-item')) !!}
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

<script>

(function( $ ) {

    $(".tbl-reservation input[type=checkbox]").change(function(){
        totalCost();
    });
    function totalCost(){
        var sum = 0;
        $(".tbl-reservation input[type=checkbox]:checked").each(function(){
        sum += parseFloat($(this).data("cost"));
        });
        $("input#totalCost").val(sum);
    }

})(jQuery);

</script>

@endsection